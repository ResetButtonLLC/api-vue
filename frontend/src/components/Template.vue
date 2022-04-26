<template>
  <div>
    <h6>Название</h6>
    <InputText
      class="w-full"
      type="text"
      placeholder="Название шаблона"
      v-model="template.name"
    />

    <h6>Тип</h6>

    <Dropdown
      class="w-full"
      v-model="template.type"
      :options="typeList"
      optionLabel="name"
      optionValue="id"
      placeholder="Когда нужно использовать шаблон"
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

    <div class="mt-4 text-center">
      <Button
        label="Удалить шаблон"
        icon="pi pi-trash"
        class="mt-4 p-button-danger"
        @click="tryDelete"
      ></Button>
    </div>

    <Dialog
      v-if="isShowDeleteDialog"
      :visible="true"
      :style="{ width: '450px' }"
      header="Подтвердите удаление"
      :modal="true"
      class="p-fluid"
      @update:visible="isShowDeleteDialog = false"
    >
      <p>Удалить шаблон?</p>

      <template #footer>
        <Button
          label="Удалить"
          icon="pi pi-trash"
          class="p-button-danger"
          @click="confirmDelete"
        />
      </template>
    </Dialog>
  </div>
</template>

<script>
const MINIMAL_HEADLINES = 1;
const MINIMAL_DESCRIPTIONS = 2;
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

    tryDelete() {
      this.isShowDeleteDialog = true;
    },

    confirmDelete() {
      this.isShowDeleteDialog = false;
      this.$emit("delete");
    },
  },

  props: {
    templateLink: {
      type: Object,
      required: true,
    },
  },

  data() {
    return {
      isShowDeleteDialog: false,

      typeList: [
        {
          id: "all",
          name: "Использовать для генерации всегда",
        },
        {
          id: "default",
          name: "Использовать если больше нет вариантов",
        },
        {
          id: "category",
          name: "Использовать для выбранных категорий",
        },
      ],

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
      this.template.name = "unknown";
    }

    if (this.template.type === undefined) {
      this.template.type = null;
    }

    if (this.template.headlines === undefined) {
      this.template.headlines = [{ ...EMPTY_INPUT }];
    }

    if (this.template.descriptions === undefined) {
      this.template.descriptions = [{ ...EMPTY_INPUT }, { ...EMPTY_INPUT }];
    }
  },
};
</script>

<style scoped>
.w-40 {
  max-width: 110px;
}
</style>