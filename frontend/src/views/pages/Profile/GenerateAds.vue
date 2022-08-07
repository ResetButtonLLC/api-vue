<template>
  <div>
    <TabView scrollable>
      <TabPanel header="Шаблоны">
        <ProfileTemplateGlobal :profileLink="profile" @onChange="onChanges" @onSave="onSaveChanges" />
      </TabPanel>
      <TabPanel header="Умные шаблоны">
        <ProfileTemplateSmart :profileLink="profile" @onChange="onChanges" @onSave="onSaveChanges" />
      </TabPanel>

      <TabPanel header="Генерация">
        <GenerateAdsSettings :profileLink="profile" @onChange="onChanges" />
      </TabPanel>

      <TabPanel header="Бренды">
        <ReplacementList header="Использовать список брендов" :getPath="getBrandsPath" :setPath="setBrandsPath"
          :profileLink="profile" @onChange="onChanges" />
      </TabPanel>

      <TabPanel header="Замены">
        <ReplacementList header="Использовать список замен" :getPath="getReplacesPath" :setPath="setReplacesPath"
          :profileLink="profile" @onChange="onChanges" />
      </TabPanel>
    </TabView>
  </div>
</template>

<script>
import GenerateAdsSettings from "./GenerateAdsSettings";
import ProfileTemplateGlobal from "@/components/TemplateGlobal";
import ProfileTemplateSmart from "@/components/TemplateSmart";
import ReplacementList from "@/components/ReplacementList";

import {
  GET_AD_BRANDS_PATH,
  SET_AD_BRANDS_PATH,
  GET_AD_REPLACES_PATH,
  SET_AD_REPLACES_PATH,
} from "@/api/apiReplacement";

export default {
  components: {
    GenerateAdsSettings,
    ProfileTemplateGlobal,
    ProfileTemplateSmart,
    ReplacementList,
  },

  props: ['profileId'],

  data() {
    return {
      profile: {},
    };
  },

  created() {
    this.profile = { id: this.profileId };
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

    onChanges() { },

    onSaveChanges() { },
  },

  computed: {
    getBrandsPath() {
      return GET_AD_BRANDS_PATH;
    },

    setBrandsPath() {
      return SET_AD_BRANDS_PATH;
    },

    getReplacesPath() {
      return GET_AD_REPLACES_PATH;
    },

    setReplacesPath() {
      return SET_AD_REPLACES_PATH;
    },
  },
};
</script>