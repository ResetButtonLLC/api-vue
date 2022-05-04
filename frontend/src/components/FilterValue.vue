<template>
  <div>
    <InputText
      :class="isShowStr2 ? 'w-50' : 'w-full'"
      v-if="isShowStr1"
      type="text"
      v-model="filter.value"
    />
    <InputText
      class="w-50"
      v-if="isShowStr2"
      type="text"
      v-model="filter.value2"
    />

    <InputNumber
      :class="isShowInt2 ? 'w-50' : 'w-full'"
      v-if="isShowInt1"
      v-model="filter.value"
      mode="decimal"
    />
    <InputNumber
      class="w-50"
      v-if="isShowInt2"
      v-model="filter.value2"
      mode="decimal"
    />

    <MultiSelect
      v-if="isShowKeyType"
      v-model="filter.value"
      :options="keywordList"
      optionLabel="name"
      optionValue="value"
      placeholder="Не выбрано"
    />

    <Calendar
      :class="isShowDate2 ? 'w-50' : 'w-full'"
      v-if="isShowDate1"
      v-model="filter.value"
      dateFormat="mm/dd/yy"
      placeholder="mm/dd/yyyy"
    />

    <Calendar
      v-if="isShowDate2"
      class="w-50"
      v-model="filter.value2"
      dateFormat="mm/dd/yy"
      placeholder="mm/dd/yyyy"
    />
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
} from "../const/filter";

import keywords from "../const/keywords";

export default {
  props: ["filterLink"],

  data() {
    return {
      filter: null,
    };
  },

  created() {
    this.filter = this.filterLink;
  },

  computed: {
    keywordList() {
      return keywords.keywords();
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
  },
};
</script>

<style scoped>
.w-50 {
  width: 50%;
}
</style>