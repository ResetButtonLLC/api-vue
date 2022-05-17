<template>
  <div>
    <h4>Автообновление</h4>

    <div v-if="isSettingsLoading">
      <p class="text-center">
        <i class="pi pi-spin pi-spinner"></i>
        Загрузка...
      </p>
    </div>

    <div v-else>
      <p>
        <i class="pi pi-info-circle"></i> Автообновление не будет работать, т.к.
        для этого нужно указать ссылку источника
      </p>

      <div class="group mt-4 mb-2">
        <InputSwitch id="autoupdate" v-model="profile.settings.autoupdate" @change="$emit('onChange')" />
        <label class="ml-2" for="autoupdate">Автообновление</label>
      </div>

      <div v-for="(update, index) in profile.settings.times" class="group w-full my-1" :key="index">
        <span class="p-float-label mt-4 mr-2">
          <Calendar class="w-full" v-model="update.time" :showTime="true" :timeOnly="true" @input="$emit('onChange')" />
          <label>Время автообновления</label>
        </span>

        <div>
          <Button icon="pi pi-trash" class="p-button-danger" @click="deleteUpdate(index)"></Button>
        </div>
      </div>

      <Button label="Добавить время автообновления" icon="pi pi-plus" class="mt-2" @click="addUpdate"></Button>

      <div class="infobox mt-4">
        <span class="p-float-label">
          <InputNumber class="w-full" id="min_count" v-model="profile.settings.min_count" mode="decimal"
            @input="$emit('onChange')" />

          <label for="min_count">Минимальное количество товаров</label>
        </span>

        <i class="pi pi-question-circle" v-tooltip.right="
          'Если при автообновлении в фиде будет меньше указанного количества товаров - то автообновление не произойдет'
        "></i>
      </div>

      <div class="infobox mt-4">
        <span class="p-float-label">
          <InputNumber class="w-full" id="cleanup" v-model="profile.settings.autoupdate_cleanup" mode="decimal"
            @input="$emit('onChange')" />

          <label for="cleanup">Количество дней для автоочистки локальной базы</label>
        </span>

        <i class="pi pi-question-circle" v-tooltip.right="
          'Очищать локальную базу от товаров которые находятся в паузе больше указанного количества дней'
        "></i>
      </div>

      <div class="savebtn">
        <Button label="Сохранить изменения" icon="pi pi-save" class="mt-4 mb-4 p-button-success"
          @click="saveChanges"></Button>
      </div>
    </div>
  </div>
</template>

<script>
const EMPTY_UPDATE = {
  time: null,
};

import apiSettings from "@/api/apiSettings";

export default {
  methods: {
    addUpdate() {
      this.profile.settings.times.push({ ...EMPTY_UPDATE });
      this.$emit("onChange");
    },

    deleteUpdate(index) {
      this.profile.settings.times.splice(index, 1);
      this.$emit("onChange");
    },

    loadSettings() {
      this.isSettingsLoading = true;
      apiSettings
        .getAutoupdateSettings(this.profile.id)
        .then((result) => {
          this.profile.settings = result.data.data;
        })
        .catch(() => {
          this.$store.dispatch("error", "Не удалось загрузить настройки");
        })
        .finally(() => {
          this.isSettingsLoading = false;
        });
    },

    saveChanges() {
      this.$toast.add({
        severity: "info",
        summary: "В процессе",
        detail: "Отправляю запрос...",
        life: 3000,
      });

      apiSettings
        .setAutoupdateSettings(this.profile.id, this.profile.settings)
        .then(() => {
          this.$toast.add({
            severity: "success",
            summary: "Сохранено",
            detail: "Настройки сохранены",
            life: 3000,
          });
        })
        .catch(() => {
          this.$toast.add({
            severity: "error",
            summary: "Ошибка",
            detail: "Не удалось сохранить настройки",
            life: 3000,
          });
        });

      this.$emit("onSave");
    },

  },

  props: {
    profileLink: {
      type: Object,
      required: true,
    },
  },

  data() {
    return {
      profile: {},
      isSettingsLoading: false,
    };
  },

  created() {
    this.profile = this.profileLink;
    this.profile.settings = {};
    this.loadSettings();
  },
};
</script>

<style scoped>
.group {
  display: flex;
}

.group label {
  align-self: center;
}

.group span {
  flex: 1;
}

.group div {
  align-self: end;
}
</style>