<template>
  <div>
    <h4>Замены</h4>

    <p v-if="isReplacementsLoadings">Загрузка...</p>

    <div v-else>
      <div class="box">
        <div class="el">
          <InputSwitch
            id="global_replacement"
            v-model="profile.settings.global_replacement"
          />
          <label for="global_replacement">Использовать глобальные замены</label>
        </div>

        <i
          class="pi pi-question-circle"
          v-tooltip.left="
            'К дополнению к указанному вами списку будет использоваться список замен сформираванный администратором'
          "
        ></i>
      </div>

      <div class="el">
        <InputSwitch
          id="global_replacement"
          v-model="profile.settings.global_replacement"
        />
        <label for="global_replacement">Использовать замены профиля</label>
      </div>

      <h6 style="margin-bottom: 0px">Замены для профиля:</h6>

      <div v-for="(change, index) in replacements" class="group" :key="change">
        <span class="p-float-label mt-4 mr-2">
          <InputText
            class="w-full"
            type="text"
            id="from"
            v-model="change.from"
          />
          <label for="from">Что заменяем</label>
        </span>

        <span class="p-float-label mt-4 mx-2">
          <InputText class="w-full" type="text" id="to" v-model="change.to" />
          <label for="to">Чем заменяем</label>
        </span>

        <div>
          <Button
            icon="pi pi-trash"
            class="p-button-danger"
            @click="deleteReplacement(index)"
          ></Button>
        </div>
      </div>

      <Button
        label="Добавить"
        icon="pi pi-plus"
        class="mt-4"
        @click="addReplacement"
      ></Button>

      <div class="buttons mt-4">
        <div>
          <Button
            label="Сохранить изменения"
            icon="pi pi-save"
            @click="saveChanges"
          ></Button>
        </div>

        <div>
          <Button
            label="Добавить замены с файла"
            icon="pi pi-cloud-upload"
            class="mr-2"
          ></Button>

          <Button label="Скачать замены" icon="pi pi-cloud-download"></Button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import apiReplacement from "@/api/apiReplacement";

export default {
  methods: {
    addReplacement() {
      this.$store.dispatch("addEmptyReplacement", this.profile.id);
    },

    deleteReplacement(index) {
      this.$store.dispatch("deleteReplacement", {
        profileId: this.profile.id,
        index: index,
      });
    },

    saveChanges() {
      this.$toast.add({
        severity: "info",
        summary: "В процессе",
        detail: "Отправляю запрос...",
        life: 3000,
      });

      apiReplacement
        .setReplacement(this.profile.id, this.replacements)
        .then(() => {
          this.$toast.add({
            severity: "success",
            summary: "Сохранено",
            detail: "Успешно сохранено",
            life: 3000,
          });
        })
        .catch(() => {
          this.$toast.add({
            severity: "error",
            summary: "Ошибка",
            detail: "Не удалось сохранить",
            life: 3000,
          });
        });
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
      from: "",
      to: "",
    };
  },

  created() {
    this.profile = this.profileLink;

    this.$store.dispatch("getProfileReplacements", this.profile.id);
  },

  computed: {
    replacements() {
      return this.$store.getters.getProfileReplacements(this.profile.id);
    },

    replacementCount() {
      return this.$store.getters.getReplacementCount(this.profile.id);
    },

    isReplacementsLoadings() {
      return this.$store.getters.isReplacementsLoadings(this.profile.id);
    },
  },
};
</script>

<style scoped>
.buttons {
  display: flex;
  justify-content: space-between;
}

.group {
  display: flex;
}

.group span {
  flex: 1;
}

.group div {
  align-self: end;
}

.box {
  display: flex;
  align-items: center;
  width: 100%;
}

.box i {
  font-size: 1.4rem;
  color: var(--blue-400);
}

.el {
  flex: 1;
  display: flex;
  align-items: center;
}

.el label {
  margin-left: 10px;
}
</style>