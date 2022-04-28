<template>
  <div>
    <h4>Шаблоны</h4>

    <p v-if="isTemplatesLoading || isCategoriesLoading">Загрузка...</p>

    <TabView
      v-else
      v-model:activeIndex="activeIndex"
      @tab-click="addTab"
      scrollable
    >
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
  </div>
</template>

<script>
import Template from "@/components/Template";

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