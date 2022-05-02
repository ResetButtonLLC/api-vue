<template>
  <div>
    <h4>Шаблоны</h4>

    <p v-if="isTemplatesLoading || isCategoriesLoading">Загрузка...</p>

    <div v-else>
      <TabView v-model:activeIndex="activeIndex" @tab-click="addTab" scrollable>
        <TabPanel
          v-for="(tab, tabIndex) in templateList"
          :key="tab"
          :header="tabIndex + 1"
        >
          <Template
            :templateLink="tab"
            :categoriesList="categories"
            @delete="deleteTab(tabIndex)"
          />
        </TabPanel>

        <TabPanel header="+">
          <p class="text-center">Нет ни 1 шаблона</p>
        </TabPanel>
      </TabView>

      <Button
        class="mt-4 mb-2"
        label="Сохранить изменения"
        icon="pi pi-save"
        @click="saveChanges"
      ></Button>
    </div>
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
    addTab() {
      if (this.activeIndex != this.templateCount) {
        return;
      }

      this.$store.dispatch("addEmptyTemplate", this.profile.id);
    },

    deleteTab(index) {
      this.$store.dispatch("deleteTemplate", {
        profileId: this.profile.id,
        index: index,
      });

      if (this.templateCount && this.activeIndex >= this.templateCount) {
        this.activeIndex -= 1;
      }
    },

    saveChanges() {
      this.$toast.add({
        severity: "info",
        summary: "В процессе",
        detail: "Отправляю запрос...",
        life: 3000,
      });

      apiTemplates
        .setTemplates(this.profile.id, this.templateList)
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
      profile: {},
    };
  },

  created() {
    this.profile = this.profileLink;

    this.$store.dispatch("getProfileCategories", this.profile.id);
    this.$store.dispatch("getProfileTemplates", this.profile.id);
  },

  computed: {
    templateList() {
      return this.$store.getters.getProfileTemplates(this.profile.id);
    },

    templateCount() {
      return this.$store.getters.getTemplateCount(this.profile.id);
    },

    isTemplatesLoading() {
      return this.$store.getters.isTemplatesLoadings(this.profile.id);
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