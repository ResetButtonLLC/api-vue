<template>
  <div>
    <h4>Шаблоны</h4>

    <!-- 
   -->

    <TabView v-model:activeIndex="activeIndex" @tab-click="addTab" scrollable>
      <TabPanel
        v-for="(tab, tabIndex) in profile.template"
        :key="tab"
        :header="tabIndex + 1"
      >
        <Template :templateLink="tab" @delete="deleteTab(tabIndex)" />
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
      if (this.activeIndex != this.profile.template.length) {
        return;
      }

      this.profile.template.push({});
    },

    deleteTab(index) {
      this.profile.template.splice(index, 1);
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

    if (!this.profile.template) {
      this.profile.template = [{}];
    }

    if (!this.profile.template.length) {
      this.profile.template.push({});
    }
  },
};
</script>