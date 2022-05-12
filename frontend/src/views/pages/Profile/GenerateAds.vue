<template>
  <div>
    <TabView scrollable>
      <TabPanel header="Шаблоны">
        <ProfileTemplateGlobal
          :profileLink="profile"
          @onChange="onChanges"
          @onSave="onSaveChanges"
        />
      </TabPanel>
      <TabPanel header="Умные шаблоны">
        <ProfileTemplateSmart
          :profileLink="profile"
          @onChange="onChanges"
          @onSave="onSaveChanges"
        />
      </TabPanel>

      <TabPanel header="Генерация">
        <GenerateAdsSettings :profileLink="profile" @onChange="onChanges" />
      </TabPanel>

      <TabPanel header="Бренды">
        <ReplacementList
          :isLoading="false"
          :isGlobal="true"
          header="Использовать список брендов"
          :globalTextList="'1\n2\n3\n6'"
          :localTextList="'2\n4\n5'"
          @onChange="onChanges"
          @onSave="saveBrands"
        />
      </TabPanel>

      <TabPanel header="Замены">
        <ReplacementList
          :isLoading="false"
          :isGlobal="true"
          header="Использовать список замен"
          :globalTextList="'allo,алло\n5\n7\n6'"
          :localTextList="'allo,алло\n4\n5'"
          @onChange="onChanges"
          @onSave="saveReplacements"
        />
      </TabPanel>
    </TabView>
  </div>
</template>

<script>
import GenerateAdsSettings from "./GenerateAdsSettings";
import ProfileTemplateGlobal from "@/components/TemplateGlobal";
import ProfileTemplateSmart from "@/components/TemplateSmart";
import ReplacementList from "@/components/ReplacementList";

export default {
  components: {
    GenerateAdsSettings,
    ProfileTemplateGlobal,
    ProfileTemplateSmart,
    ReplacementList,
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

  created() {
    this.profile = this.profileLink;
  },

  methods: {
    saveBrands({ isGlobal, profileText }) {
      console.log("save brand: " + isGlobal);
      console.log(profileText);
    },

    saveReplacements({ isGlobal, profileText }) {
      console.log("save replacement: " + isGlobal);
      console.log(profileText);
    },

    onChanges() {},

    onSaveChanges() {},
  },
};
</script>