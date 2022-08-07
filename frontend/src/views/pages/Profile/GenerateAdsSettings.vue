<template>
  <div>
    <div v-if="isSettingsLoading">
      <p class="text-center">
        <i class="pi pi-spin pi-spinner"></i>
        Загрузка...
      </p>
    </div>

    <div v-else>
      <div class="infobox">
        <div class="switch">
          <InputSwitch id="no_category_in_model" v-model="profile.settings.no_category_in_model"
            @change="$emit('onChange')" />
          <label for="no_category_in_model">Вырезать название категории из названия модели</label>
        </div>

        <i class="pi pi-question-circle" v-tooltip.left="
          'Если в названии модели будет найдено название категории - оно будет вырезано'
        "></i>
      </div>

      <div class="infobox mt-4">
        <div class="switch">
          <InputSwitch id="no_cyrillic" v-model="profile.settings.no_cyrillic" @change="$emit('onChange')" />
          <label for="no_cyrillic">Убрать кириллицу из тега [NAME] в объявлении</label>
        </div>

        <i class="pi pi-question-circle" v-tooltip.left="'Из названия будет вырезанна вся кириллица'"></i>
      </div>

      <div class="infobox mt-4">
        <div class="switch">
          <InputSwitch id="format_price" v-model="profile.settings.format_price" @change="$emit('onChange')" />
          <label for="format_price">Использовать форматирование цены</label>
        </div>

        <i class="pi pi-question-circle" v-tooltip.left="'Через каждые 3 символа будет вставлен пробел'"></i>
      </div>

      <div class="savebtn">
        <Button class="mt-4 mb-2 p-button-success" label="Сохранить изменения" icon="pi pi-save"
          @click="saveChanges"></Button>
      </div>
    </div>
  </div>
</template>

<script>
import apiSettings from "@/api/apiSettings";

export default {
  props: {
    profileLink: {
      type: Object,
      required: true,
    },
  },

  created() {
    this.profile = this.profileLink;

    if (this.profile.settings === undefined) {
      this.profile.settings = {};
    }

    this.loadSettings();
  },

  data() {
    return {
      profile: {},
      isSettingsLoading: false,
    };
  },

  methods: {
    loadSettings() {
      this.isSettingsLoading = true;
      apiSettings
        .getGenerateAdsSettings(this.profile.id)
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
        .setGenerateAdsSettings(this.profile.id, this.profile.settings)
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
};
</script>