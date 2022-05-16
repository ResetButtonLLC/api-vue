<template>
  <div>
    <p v-if="isTemplatesLoading || isCategoriesLoading">Загрузка...</p>

    <div v-else>
      <h5>Информация по умным шаблонам</h5>
      <ul>
        <li>Умные шаблоны имеют приоритет над стандартными</li>

        <li>
          Стандарные шаблоны не генерируются для товара, если был сгенерирован
          умный шаблон
        </li>

        <li>
          Умные шаблоны имеют очередность сверху-вниз и будет использован первый
          шаблон, подходящий под условия
        </li>

        <li>Умные шаблоны можно сортировать перетаскиванием</li>
      </ul>

      <Button
        label="Создать шаблон"
        icon="pi pi-plus"
        class="p-button-success mb-2"
        @click="openCreateDialog"
      />

      <div
        v-for="(tab, tabIndex) in templateList"
        :key="tab"
        class="card"
        @drop="endDragFilter($event, tabIndex)"
        @dragover.prevent
        @dragenter.prevent
      >
        <div
          draggable="true"
          @dragstart="startDragFilter($event, tabIndex)"
          @dragover.prevent
          @dragenter.prevent
        >
          <div class="header row2">
            <span>{{ tab.name ? tab.name : "[без названия]" }}</span>

            <span>
              <i
                v-tooltip.left="'Клонировать'"
                class="pi pi-link p-button p-button-warning mr-2"
                @click="cloneTemplate(tab)"
              ></i>

              <i
                v-tooltip.left="'Редактировать'"
                class="pi pi-pencil p-button p-button-info mr-2"
                @click="openEditDialog(tabIndex)"
              ></i>

              <i
                v-tooltip.left="'Удалить'"
                class="pi pi-times-circle p-button p-button-danger"
                @click="tryDelete(tabIndex)"
              ></i>
            </span>
          </div>

          <div class="row2">
            <TemplatePreview style="flex: 1" :templateLink="tab" />

            <Rules
              style="flex: 1; text-align: center"
              :objectLink="tab"
              conditionHelpText="Применяем шаблон к товарам соответствующим условиям"
            />
          </div>
        </div>
      </div>

      <div class="savebtn">
        <Button
          class="mt-4 mb-2 p-button-success"
          label="Сохранить изменения"
          icon="pi pi-save"
          @click="saveChanges"
        ></Button>
      </div>
    </div>

    <Dialog
      v-if="isShowCreateDialog"
      :visible="true"
      :style="{ maxWidth: '100%', width: '750px' }"
      header="Создание шаблона"
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
import Rules from "@/components/Rules";

export default {
  components: {
    Template,
    TemplatePreview,
    Rules,
  },

  methods: {
    startDragFilter(evt, index) {
      evt.dataTransfer.dropEffect = "move";
      evt.dataTransfer.effectAllowed = "move";
      evt.dataTransfer.setData("itemID", index);
    },

    endDragFilter(evt, index) {
      const oldIndex = evt.dataTransfer.getData("itemID");

      this.$store.dispatch("swapTemplateCategories", {
        profileId: this.profile.id,
        oldIndex: oldIndex,
        newIndex: index,
      });
    },

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

    cloneTemplate(template) {
      this.$store.dispatch("addTemplateCategories", {
        profileId: this.profile.id,
        template: JSON.parse(JSON.stringify(template)),
      });
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
            detail: "Шаблоны успешно сохранены",
            life: 3000,
          });
        })
        .catch(() => {
          this.$toast.add({
            severity: "error",
            summary: "Ошибка",
            detail: "Не удалось сохранить шаблоны",
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

    //this.$store.dispatch("getProfileCategories", this.profile.id);
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