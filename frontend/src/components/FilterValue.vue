<template>
  <div>
    <InputText class="w-full mt-1" v-if="isShowStr1" type="text" v-model="filter.value" />
    <InputText class="w-full mt-1" v-if="isShowStr2" type="text" v-model="filter.value2" />

    <InputNumber class="w-full mt-1" v-if="isShowInt1" v-model="filter.value" mode="decimal" />
    <InputNumber class="w-full mt-1" v-if="isShowInt2" v-model="filter.value2" mode="decimal" />

    <MultiSelect class="w-full mt-1" v-if="isShowKeyType" v-model="filter.value" :options="keywordList"
      optionLabel="name" optionValue="value" placeholder="Не выбрано" />

    <MultiSelect class="w-full mt-1" v-if="isShowAdEditStatus" v-model="filter.value" :options="adStatusList"
      optionLabel="name" optionValue="value" placeholder="Не выбрано" @change="formatStatusValue(adStatusList)" />

    <MultiSelect class="w-full mt-1" v-if="isShowPins" v-model="filter.value" :options="pinList" optionLabel="name"
      optionValue="value" placeholder="Не выбрано" @change="formatStatusValue(pinList)" />

    <MultiSelect class="w-full mt-1" v-if="isShowCampaigns" v-model="filter.value" :options="campaignList"
      optionLabel="name" optionValue="id" placeholder="Не выбрано" @change="formatTextValue(campaignList)" />

    <MultiSelect class="w-full mt-1" v-if="isShowCategories" v-model="filter.value" :options="categoryList"
      optionLabel="name" optionValue="id" placeholder="Не выбрано" @change="formatTextValue(categoryList)" />

    <MultiSelect class="w-full mt-1" v-if="isShowGroups" v-model="filter.value" :options="groupList" optionLabel="name"
      optionValue="id" placeholder="Не выбрано" @change="formatTextValue(groupList)" />

    <Calendar class="w-full mt-1" v-if="isShowDate1" v-model="filter.value" dateFormat="dd.mm.yy"
      placeholder="dd.mm.yyyy" @date-select="formatDateTextValue" />

    <Calendar class="w-full mt-1" v-if="isShowDate2" v-model="filter.value2" dateFormat="dd.mm.yy"
      placeholder="dd.mm.yyyy" @date-select="formatDateTextValue" />
  </div>
</template>

<script>
import {
  VALUE_BOOLEAN,
  VALUE1_INT,
  VALUE2_INT,
  VALUE1_STR,
  VALUE2_STR,
  VALUE1_DATE,
  VALUE2_DATE,
  VALUE_KEY_TYPE,
  VALUE_AD_EDIT_STATUS,
  VALUE_LIST_CAMPAIGN,
  VALUE_LIST_GROUP,
  VALUE_LIST_CATEGORIES,
  VALUE_PIN,
} from "../const/filter";

import keywords from "../const/keywords";
import adstatus from "../const/adstatus";
import pins from "../const/pins";

export default {
  props: ["filterLink", "campaignList", "categoryList", "groupList"],

  data() {
    return {
      filter: null,
    };
  },

  created() {
    this.filter = this.filterLink;
  },

  methods: {
    formatDateTextValue() {
      let date = new Date(this.filter.value);

      this.filter.textValue =
        date.getDate() + "." + (date.getMonth() + 1) + "." + date.getFullYear();
    },

    formatStatusValue(list) {
      let currentStatus = list.find((el) => el.value == this.filter.value);

      this.filter.textValue = currentStatus ? currentStatus.name : null;
    },

    formatTextValue(list) {
      if (!Array.isArray(this.filter.value)) {
        this.filter.textValue = null;
        return;
      }

      let newTextValue = [];

      this.filter.value.forEach((value) => {
        let listElement = list.find((el) => el.id == value);

        if (listElement) {
          newTextValue.push(listElement.name);
        }
      });

      this.filter.textValue = newTextValue;
    },
  },

  computed: {
    keywordList() {
      return keywords.keywords();
    },

    adStatusList() {
      return adstatus.list();
    },

    pinList() {
      return pins.list();
    },

    valueType() {
      return this.filter.operator.type ?? [];
    },

    isShowBoolean() {
      return this.valueType.some((el) => el == VALUE_BOOLEAN);
    },

    isShowInt1() {
      return this.valueType.some((el) => el == VALUE1_INT);
    },

    isShowInt2() {
      return this.valueType.some((el) => el == VALUE2_INT);
    },

    isShowStr1() {
      return this.valueType.some((el) => el == VALUE1_STR);
    },

    isShowStr2() {
      return this.valueType.some((el) => el == VALUE2_STR);
    },

    isShowDate1() {
      return this.valueType.some((el) => el == VALUE1_DATE);
    },

    isShowDate2() {
      return this.valueType.some((el) => el == VALUE2_DATE);
    },

    isShowKeyType() {
      return this.valueType.some((el) => el == VALUE_KEY_TYPE);
    },

    isShowAdEditStatus() {
      return this.valueType.some((el) => el == VALUE_AD_EDIT_STATUS);
    },

    isShowCampaigns() {
      return this.valueType.some((el) => el == VALUE_LIST_CAMPAIGN);
    },

    isShowCategories() {
      return this.valueType.some((el) => el == VALUE_LIST_CATEGORIES);
    },

    isShowGroups() {
      return this.valueType.some((el) => el == VALUE_LIST_GROUP);
    },

    isShowPins() {
      return this.valueType.some((el) => el == VALUE_PIN);
    },
  },
};
</script>

<style scoped>
.w-50 {
  width: 50%;
}
</style>