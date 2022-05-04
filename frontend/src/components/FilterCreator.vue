<template>
  <div>
    <div class="flex">
      <FilterField style="flex: 0 0 200px" :filterLink="filter" />
      <FilterOperator
        style="flex: 0 0 200px"
        v-if="isShowOperator"
        :filterLink="filter"
      />
      <FilterValue
        style="flex: 1 1 400px"
        v-if="isShowValue"
        :filterLink="filter"
      />

      <Button
        v-if="isShowCreateButton"
        icon="pi pi-plus"
        @click="addFilter"
      ></Button>
    </div>

    <div class="flex">
      <div class="filter" v-for="(f, index) in filterList" :key="f">
        <span>{{ toText(f) }}</span>
        <i class="pi pi-times-circle" @click="deleteFilter(index)"></i>
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
      });

      this.filter.operator = null;
      this.filter.field = null;
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
</style>