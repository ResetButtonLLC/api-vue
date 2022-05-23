<template>
  <div>
    <TabView scrollable>
      <TabPanel header="Генерация">
        <GenerateKeywordsSettings :profileLink="profile" @onChange="onChanges" />
      </TabPanel>

      <TabPanel header="Бренды">
        <ReplacementList header="Использовать список брендов" :getPath="getBrandsPath" :setPath="setBrandsPath"
          :profileLink="profile" @onChange="onChanges" />
      </TabPanel>

      <TabPanel header="Замены">
        <ReplacementList header="Использовать список замен" :getPath="getReplacesPath" :setPath="setReplacesPath"
          :profileLink="profile" @onChange="onChanges" />
      </TabPanel>

      <TabPanel header="Цвета">
        <ReplacementList header="Использовать цвета" :getPath="getKeysPath" :setPath="setKeysPath"
          :profileLink="profile" @onChange="onChanges" />
      </TabPanel>

      <TabPanel header="Кривые кеи">
        <ReplacementList header="Использовать кривые кеи" :getPath="getKeysPath" :setPath="setKeysPath"
          :profileLink="profile" @onChange="onChanges" />
      </TabPanel>
    </TabView>
  </div>
</template>

<script>
import GenerateKeywordsSettings from "./GenerateKeywordsSettings";
import ReplacementList from "@/components/ReplacementList";

import {
  GET_KEYWORD_BRANDS_PATH,
  SET_KEYWORD_BRANDS_PATH,
  GET_KEYWORD_REPLACES_PATH,
  SET_KEYWORD_REPLACES_PATH,
  GET_KEYWORD_COLORS_PATH,
  SET_KEYWORD_COLORS_PATH,
  GET_KEYWORD_KEYS_PATH,
  SET_KEYWORD_KEYS_PATH,
} from "@/api/apiReplacement";

export default {
  components: {
    GenerateKeywordsSettings,
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
      return GET_KEYWORD_BRANDS_PATH;
    },

    setBrandsPath() {
      return SET_KEYWORD_BRANDS_PATH;
    },

    getReplacesPath() {
      return GET_KEYWORD_REPLACES_PATH;
    },

    setReplacesPath() {
      return SET_KEYWORD_REPLACES_PATH;
    },

    getColorsPath() {
      return GET_KEYWORD_COLORS_PATH;
    },

    setColorsPath() {
      return SET_KEYWORD_COLORS_PATH;
    },

    getKeysPath() {
      return GET_KEYWORD_KEYS_PATH;
    },

    setKeysPath() {
      return SET_KEYWORD_KEYS_PATH;
    },
  },
};
</script>