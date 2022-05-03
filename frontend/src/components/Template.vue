<template>
  <div>
    <h6 v-if="!isGlobal">Название</h6>
    <InputText
      v-if="!isGlobal"
      class="w-full"
      type="text"
      placeholder="Название шаблона"
      v-model="template.name"
    />

    <h6>Заголовок</h6>

    <div
      v-for="(headline, index) in template.headlines"
      :key="index"
      class="p-inputgroup w-full my-1"
    >
      <InputText
        type="text"
        :placeholder="'Заголовок ' + (index + 1)"
        v-model="headline.value"
      />

      <Dropdown
        class="w-40"
        v-model="headline.pin"
        :options="pinList"
        optionLabel="name"
        optionValue="id"
      />

      <Button
        icon="pi pi-trash"
        class="p-button-danger"
        @click="deleteHeadline(index)"
      ></Button>
    </div>

    <Button
      label="Добавить"
      icon="pi pi-plus"
      class="mt-2"
      @click="addHeadline()"
    ></Button>

    <h6>Описание</h6>

    <div
      v-for="(description, index) in template.descriptions"
      :key="index"
      class="p-inputgroup w-full my-1"
    >
      <InputText
        type="text"
        :placeholder="'Описание ' + (index + 1)"
        v-model="description.value"
      />

      <Dropdown
        class="w-40"
        v-model="description.pin"
        :options="pinList"
        optionLabel="name"
        optionValue="id"
      />

      <Button
        icon="pi pi-trash"
        class="p-button-danger"
        @click="deleteDescription(index)"
      ></Button>
    </div>

    <Button
      label="Добавить"
      icon="pi pi-plus"
      class="mt-2"
      @click="addDescription()"
    ></Button>

    <h6>Путь</h6>
    <InputText
      class="w-full"
      type="text"
      placeholder="Путь 1"
      v-model="template.path1"
    />

    <InputText
      class="w-full mt-1"
      type="text"
      placeholder="Путь 2"
      v-model="template.path2"
    />
  </div>
</template>

<script>
const MINIMAL_HEADLINES = 1;
const MINIMAL_DESCRIPTIONS = 1;
const EMPTY_INPUT = { value: "", pin: 0 };

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
      this.template.headlines.push({ ...EMPTY_INPUT });
    },

    deleteHeadline(index) {
      if (this.template.headlines.length <= MINIMAL_HEADLINES) {
        this.showWarning(
          "Минимальное количество заголовков = " + MINIMAL_HEADLINES
        );
        return;
      }

      this.template.headlines.splice(index, 1);
    },

    addDescription() {
      this.template.descriptions.push({ ...EMPTY_INPUT });
    },

    deleteDescription(index) {
      if (this.template.descriptions.length <= MINIMAL_DESCRIPTIONS) {
        this.showWarning(
          "Минимальное количество описаний = " + MINIMAL_DESCRIPTIONS
        );
        return;
      }

      this.template.descriptions.splice(index, 1);
    },
  },

  props: {
    templateLink: {
      type: Object,
      required: true,
    },

    isGlobal: {
      type: Boolean,
      default: true,
    },
  },

  data() {
    return {
      pinList: [
        {
          id: 0,
          name: "-",
        },
        {
          id: 1,
          name: "1",
        },
        {
          id: 2,
          name: "2",
        },
        {
          id: 3,
          name: "3",
        },
      ],

      profile: {},
    };
  },

  created() {
    this.template = this.templateLink;

    if (!this.template) {
      this.template = {};
    }

    if (this.template.name === undefined) {
      this.template.name = "";
    }

    if (this.template.type === undefined) {
      this.template.type = this.isGlobal;
    }

    if (this.template.categories === undefined) {
      this.template.categories = [];
    }

    if (this.template.headlines === undefined) {
      this.template.headlines = [{ ...EMPTY_INPUT }];
    }

    if (this.template.descriptions === undefined) {
      this.template.descriptions = [{ ...EMPTY_INPUT }];
    }
  },
};
</script>

<style scoped>
.w-40 {
  max-width: 110px;
}
</style>