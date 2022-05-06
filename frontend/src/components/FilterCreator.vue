<template>
  <div>
    <div v-if="filterList.length" class="flex mb-2">
      <div class="filter" v-for="(f, index) in filterList" :key="f">
        <span>{{ toText(f) }}</span>
        <i class="pi pi-times-circle" @click="deleteFilter(index)"></i>
      </div>
    </div>

    <div style="position: relative" class="flex">
      <FilterField :filterLink="filter" />

      <div v-if="isShowOperator" class="optionblock card">
        <FilterOperator v-if="isShowOperator" :filterLink="filter" />
        <FilterValue
          v-if="isShowValue"
          :filterLink="filter"
          :campaignList="campaignList"
          :categoryList="categoryList"
          :groupList="groupList"
        />

        <div class="btnblock">
          <Button
            class="p-button-danger"
            icon="pi pi-times-circle"
            @click="abortFilter"
          ></Button>

          <Button
            label="Применить"
            v-if="isShowCreateButton"
            @click="addFilter"
          ></Button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import filterConst from "../const/filter";

import FilterField from "./FilterField";
import FilterOperator from "./FilterOperator";
import FilterValue from "./FilterValue";

export default {
  props: ["campaignList", "categoryList", "groupList"],

  data() {
    return {
      filterList: [],
      filter: {},
    };
  },

  methods: {
    showError(errorText) {
      this.$toast.add({
        severity: "error",
        summary: "Ошибка",
        detail: errorText,
        life: 3000,
      });
    },

    abortFilter() {
      this.filter.operator = null;
      this.filter.field = null;
      this.filter.value = null;
      this.filter.value2 = null;
      this.filter.textValue = null;
      this.filter.serverValue = null;
    },

    addFilter() {
      if (!this.filter.operator.allowNull) {
        if (this.filter.value === null) {
          return this.showError("Значение не может быть пустым");
        }

        if (
          this.filter.operator.type.length >= 2 &&
          this.filter.value2 === null
        ) {
          return this.showError("Значение №2 не может быть пустым");
        }
      }

      let value =
        this.filter.value === null
          ? this.filter.operator.default[0]
          : this.filter.value;
      let value2 =
        this.filter.value2 === null
          ? this.filter.operator.default[1]
          : this.filter.value2;

      this.filterList.push({
        field: this.filter.field.value,
        operator: this.filter.operator.value,
        value: value,
        value2: value2,
        textValue: this.filter.textValue,
        serverValue: this.filter.operator.serverValue,
      });

      this.abortFilter();
    },

    deleteFilter(index) {
      this.filterList.splice(index, 1);
    },

    toText(filter) {
      return filterConst.filterToText(filter);
    },
  },

  created() {},

  components: {
    FilterField,
    FilterOperator,
    FilterValue,
  },

  computed: {
    isShowOperator() {
      return this.filter.field != null;
    },

    isShowValue() {
      return this.filter.operator != null;
    },

    isShowCreateButton() {
      return this.isShowOperator && this.isShowValue;
    },
  },
};
</script>

<style scoped>
.filter {
  border: 1px solid #848484;
  padding: 5px 10px;
  margin: 2px;
  border-radius: 10px;
  display: flex;
  align-items: center;
  color: #494949;
  background-color: #c0c0c0;
}

.filter i {
  margin-left: 5px;
  color: #db0000;
  font-size: 1.1rem;
  cursor: pointer;
}

.flex {
  display: flex;
}

.flex1 {
  flex: 1;
}

.flex .flex1 {
  margin: 0px 2px;
}

.optionblock {
  position: absolute;
  top: 50px;
  width: 300px;
  padding: 10px;
  z-index: 100;
}

.btnblock {
  display: flex;
  justify-content: space-between;
  margin-top: 1rem;
}
</style>