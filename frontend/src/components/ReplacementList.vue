<template>
  <div>
    <div v-if="isLoading" class="text-center">
      <span><i class="pi pi-spin pi-spinner"></i> Загрузка</span>
    </div>

    <div v-else>
      <div class="text-center">
        <h5>{{ header }}</h5>

        <SelectButton
          v-model="isGlobal"
          :options="activityList"
          optionLabel="name"
          optionValue="value"
          @change="$emit('onChange')"
        />
      </div>

      <div class="copybtn mt-3 mb-1">
        <Button
          v-if="isGlobal == false"
          label="Скопировать глобальные значения в профиль"
          icon="pi pi-sync"
          class="p-button-sm p-button-info"
          @click="copyGlobal"
        ></Button>
      </div>

      <Textarea
        disabled
        v-if="isGlobal"
        class="w-full"
        :value="globalTextList"
        rows="15"
        cols="30"
        @input="this.$emit('onChange')"
      />

      <Textarea
        v-else
        class="w-full"
        v-model="profileTextList"
        rows="15"
        cols="30"
        @input="this.$emit('onChange')"
      />

      <div class="savebtn">
        <Button
          label="Сохранить изменения"
          icon="pi pi-save"
          class="mt-4 mb-4 p-button-success"
          @click="save"
        ></Button>
      </div>
    </div>
  </div>
</template>


<script>
import apiReplacement from "@/api/apiReplacement";

export default {
  props: {
    profileLink: {
      type: Object,
      required: true,
    },

    header: {
      type: String,
      default: "",
    },

    getPath: {
      type: String,
      required: true,
    },

    setPath: {
      type: String,
      required: true,
    },
  },

  data() {
    return {
      isLoading: false,
      isGlobal: true,
      globalTextList: "",
      profileTextList: "",

      activityList: [
        { name: "Глобальные", value: true },
        { name: "Из профиля", value: false },
      ],
    };
  },

  created() {
    this.load();
  },

  methods: {
    copyGlobal() {
      let newValue = this.profileTextList + "\n" + this.globalTextList;

      this.profileTextList = newValue
        .split("\n")
        .filter((value) => value.length > 0)
        .filter((value, index, newArray) => newArray.indexOf(value) === index)
        .join("\n");

      this.$emit("onChange");
    },

    load() {
      this.isLoading = true;

      apiReplacement
        .getReplacement(this.getPath, this.profileLink.id)
        .then((result) => {
          let data = result.data.data;

          this.isGlobal = data.isGlobal;
          this.globalTextList = data.globalText;
          this.profileTextList = data.profileText;
        })
        .catch(() => {
          this.$store.dispatch("error", "Не удалось загрузить список замен");
        })
        .finally(() => {
          this.isLoading = false;
        });
    },

    save() {
      this.$toast.add({
        severity: "info",
        summary: "В процессе",
        detail: "Отправляю запрос...",
        life: 3000,
      });

      apiReplacement
        .setReplacement(
          this.setPath,
          this.profileLink.id,
          this.isGlobal,
          this.profileTextList
        )
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
            detail: "Не удалось сохранить изменения",
            life: 3000,
          });
        });
    },
  },

  computed: {},
};
</script>

<style scoped>
.copybtn {
  display: flex;
  justify-content: flex-end;
}
</style>