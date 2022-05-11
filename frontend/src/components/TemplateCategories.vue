<template>
  <div>
    <p v-if="isTemplatesLoading || isCategoriesLoading">Загрузка...</p>

    <div v-else>
      <Button
        label="Создать шаблон"
        icon="pi pi-plus"
        class="p-button-success mb-2"
        @click="openCreateDialog"
      />

      <div v-for="(tab, tabIndex) in templateList" :key="tab" class="card">
        <div class="header row2">
          <span>{{ tab.name ? tab.name : "[без названия]" }}</span>

          <span>
            <i
              class="pi pi-pencil p-button p-button-info mr-2"
              @click="openEditDialog(tabIndex)"
            ></i>

            <i
              class="pi pi-times-circle p-button p-button-danger"
              @click="tryDelete(tabIndex)"
            ></i>
          </span>
        </div>

        <div class="row2">
          <TemplatePreview style="flex: 1" :templateLink="tab" />

          <MultiSelect
            @change="$emit('onChange')"
            style="flex: 1"
            :filter="true"
            display="chip"
            v-model="tab.categories"
            :options="categories"
            optionLabel="name"
            optionValue="id"
            placeholder="Для каких категорий использовать"
          />
        </div>
      </div>

      <Button
        class="mt-4 mb-2"
        label="Сохранить изменения"
        icon="pi pi-save"
        @click="saveChanges"
      ></Button>
    </div>

    <Dialog
      v-if="isShowCreateDialog"
      :visible="true"
      :style="{ maxWidth: '100%', width: '750px' }"
      header="Создание категории"
      :modal="true"
      class="p-fluid"
      :maximizable="true"
      @update:visible="isShowCreateDialog = false"
    >
      <Template :templateLink="currentTemplate" :isGlobal="false" />

      <template #footer>
        <Button
          label="Сохранить"
          icon="pi pi-save"
          class="p-button-success"
          @click="saveTemplate"
        />
      </template>
    </Dialog>

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
import Template from "@/components/Template";
import TemplatePreview from "@/components/TemplatePreview";
import apiTemplates from "@/api/apiTemplates";

export default {
  components: {
    Template,
    TemplatePreview,
  },

  methods: {
    getTemplateClone(index) {
      return JSON.parse(JSON.stringify(this.templateList[index]));
    },

    openCreateDialog() {
      this.currentTemplateIndex = null;
      this.currentTemplate = {};
      this.isShowCreateDialog = true;
    },

    openEditDialog(index) {
      this.currentTemplateIndex = index;
      this.isShowCreateDialog = true;
      this.currentTemplate = this.getTemplateClone(index);
    },

    createTemplate() {
      this.$store.dispatch("addTemplateCategories", {
        profileId: this.profile.id,
        template: this.currentTemplate,
      });
    },

    editTemplate() {
      this.templateList[this.currentTemplateIndex] = {
        ...this.currentTemplate,
      };
      this.currentTemplate = null;
    },

    saveTemplate() {
      if (this.currentTemplateIndex !== null) {
        this.editTemplate();
      } else {
        this.createTemplate();
      }

      this.isShowCreateDialog = false;
      this.$emit("onChange");
    },

    tryDelete(deleteIndex) {
      this.deleteIndex = deleteIndex;
      this.isShowDeleteDialog = true;
    },

    confirmDelete() {
      this.isShowDeleteDialog = false;

      this.$store.dispatch("deleteTemplateCategories", {
        profileId: this.profile.id,
        index: this.deleteIndex,
      });

      this.$emit("onChange");
    },

    saveChanges() {
      this.$toast.add({
        severity: "info",
        summary: "В процессе",
        detail: "Отправляю запрос...",
        life: 3000,
      });

      apiTemplates
        .setTemplatesCategories(this.profile.id, this.templateList)
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
      activeIndex: 0,
      deleteIndex: 0,
      isShowCreateDialog: false,
      isShowDeleteDialog: false,
      profile: {},
      currentTemplate: null,
      currentTemplateIndex: null,
    };
  },

  created() {
    this.profile = this.profileLink;

    this.$store.dispatch("getProfileCategories", this.profile.id);
    this.$store.dispatch("getProfileTemplatesCategories", this.profile.id);
  },

  computed: {
    templateList() {
      return this.$store.getters.getProfileTemplatesCategories(this.profile.id);
    },

    templateCount() {
      return this.$store.getters.getTemplateCategoriesCount(this.profile.id);
    },

    isTemplatesLoading() {
      return this.$store.getters.isTemplatesCategoriesLoadings(this.profile.id);
    },

    isCategoriesLoading() {
      return this.$store.getters.isCategoryLoadings(this.profile.id);
    },

    categories() {
      return this.$store.getters.getProfileCategories(this.profile.id);
    },
  },
};
</script>

<style scoped>
.row2 {
  display: flex;
  justify-content: space-between;
}

.header {
  align-items: center;
  margin-bottom: 10px;
  padding-bottom: 10px;
  border-bottom: 1px solid #aaa;
}

.header span {
  font-weight: 500;
}

.header i {
  padding: 5px;
  cursor: pointer;
}
</style>