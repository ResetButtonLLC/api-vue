<template>
  <div>
    <h5>Заголовок</h5>

    <div
      v-for="(headline, index) in profile.template.headlines"
      :key="index"
      class="p-inputgroup w-full my-1"
    >
      <InputText
        type="text"
        :placeholder="'Заголовок ' + (index + 1)"
        v-model="headline.value"
      />

      <Button
        icon="pi pi-trash"
        class="p-button-danger"
        @click="deleteHeadline(index)"
      ></Button>
    </div>

    <Button
      v-if="headlinesCount < 6"
      label="Добавить"
      icon="pi pi-plus"
      class="mt-2"
      @click="addHeadline"
    ></Button>

    <h5>Описание</h5>

    <div
      v-for="(description, index) in profile.template.descriptions"
      :key="index"
      class="p-inputgroup w-full my-1"
    >
      <InputText
        type="text"
        :placeholder="'Описание ' + (index + 1)"
        v-model="description.value"
      />

      <Button
        icon="pi pi-trash"
        class="p-button-danger"
        @click="deleteDescription(index)"
      ></Button>
    </div>

    <Button
      v-if="descriptionsCount < 6"
      label="Добавить"
      icon="pi pi-plus"
      class="mt-2"
      @click="addDescription"
    ></Button>
  </div>
</template>

<script>
const MINIMAL_HEADLINES = 2;
const MINIMAL_DESCRIPTIONS = 2;
const EMPTY_INPUT = { value: "" };

export default {
  methods: {
    showWarning(message) {
      this.$toast.add({
        severity: "warn",
        summary: "Предупреждение",
        detail: message,
        life: 3000,
      });
    },

    addHeadline() {
      this.profile.template.headlines.push({ ...EMPTY_INPUT });
    },

    deleteHeadline(index) {
      if (this.headlinesCount <= MINIMAL_HEADLINES) {
        this.showWarning(
          "Минимальное количество заголовков = " + MINIMAL_HEADLINES
        );
        return;
      }

      this.profile.template.headlines.splice(index, 1);
    },

    addDescription() {
      this.profile.template.descriptions.push({ ...EMPTY_INPUT });
    },

    deleteDescription(index) {
      if (this.headlinesCount <= MINIMAL_DESCRIPTIONS) {
        this.showWarning(
          "Минимальное количество описаний = " + MINIMAL_DESCRIPTIONS
        );
        return;
      }

      this.profile.template.descriptions.splice(index, 1);
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
    };
  },

  computed: {
    headlinesCount() {
      return this.profile.template.headlines.length;
    },

    descriptionsCount() {
      return this.profile.template.descriptions.length;
    },
  },

  created() {
    this.profile = this.profileLink;

    if (this.profile.template === undefined) {
      this.profile.template = {};
    }

    if (this.profile.template.headlines === undefined) {
      this.profile.template.headlines = [
        { ...EMPTY_INPUT },
        { ...EMPTY_INPUT },
      ];
    }

    if (this.profile.template.descriptions === undefined) {
      this.profile.template.descriptions = [
        { ...EMPTY_INPUT },
        { ...EMPTY_INPUT },
      ];
    }
  },
};
</script>