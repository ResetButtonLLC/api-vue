<template>
  <div>
    <p v-if="isTemplatesLoading">Загрузка...</p>

    <div v-else>
      <TabView v-model:activeIndex="activeIndex" @tab-click="addTab" scrollable>
        <TabPanel header="Default">
          <Template
            @onChange="$emit('onChange')"
            :templateLink="profile.defaultTemplate"
            :isGlobal="true"
          />
        </TabPanel>

        <TabPanel
          v-for="(tab, tabIndex) in templateList"
          :key="tab"
          :header="tabIndex + 1"
        >
          <Template
            @onChange="$emit('onChange')"
            :templateLink="tab"
            :isGlobal="true"
          />

          <div class="mt-4 text-center">
            <Button
              label="Удалить шаблон"
              icon="pi pi-trash"
              class="mt-4 p-button-danger"
              @click="tryDelete(tabIndex)"
            ></Button>
          </div>
        </TabPanel>

        <TabPanel header="+">
          <p class="text-center">Нет ни 1 шаблона</p>
        </TabPanel>
      </TabView>

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
import apiTemplates from "@/api/apiTemplates";

export default {
  components: {
    Template,
  },

  methods: {
    tryDelete(deleteIndex) {
      this.deleteIndex = deleteIndex;
      this.isShowDeleteDialog = true;
    },

    confirmDelete() {
      this.isShowDeleteDialog = false;
      this.deleteTab(this.deleteIndex);
      this.$emit("onChange");
    },

    addTab() {
      if (this.activeIndex != this.templateCount + 1) {
        return;
      }

      this.$store.dispatch("addEmptyTemplateGlobal", this.profile.id);
      this.$emit("onChange");
    },

    deleteTab(index) {
      this.$store.dispatch("deleteTemplateGlobal", {
        profileId: this.profile.id,
        index: index,
      });

      this.activeIndex -= 1;
    },

    saveChanges() {
      this.$toast.add({
        severity: "info",
        summary: "В процессе",
        detail: "Отправляю запрос...",
        life: 3000,
      });

      apiTemplates
        .setTemplatesGlobal(this.profile.id, this.templateList)
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
      isShowDeleteDialog: false,
      profile: {},
    };
  },

  created() {
    this.profile = this.profileLink;

    if (this.profile.defaultTemplate === undefined) {
      this.profile.defaultTemplate = {};
    }

    this.$store.dispatch("getProfileTemplatesGlobal", this.profile.id);
  },

  computed: {
    templateList() {
      return this.$store.getters.getProfileTemplatesGlobal(this.profile.id);
    },

    templateCount() {
      return this.$store.getters.getTemplateGlobalCount(this.profile.id);
    },

    isTemplatesLoading() {
      return this.$store.getters.isTemplatesGlobalLoadings(this.profile.id);
    },
  },
};
</script>