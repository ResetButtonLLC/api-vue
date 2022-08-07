<template>
  <div>
    <p class="error" v-if="rule.isHaveError">
      <i class="pi pi-exclamation-circle"></i> В данном блоке содержится ошибка:
    </p>

    <div class="grid">
      <span class="col-3">
        <AutoComplete
          :dropdown="true"
          :multiple="false"
          :suggestions="fieldListFiltered"
          v-model="rule.field"
          @complete="searchField($event)"
          required="true"
          style="width: 100%"
          placeholder="Атрибут"
        />
      </span>

      <span :class="conditionSize">
        <Dropdown
          @change="clearValues"
          v-model="rule.condition"
          :options="conditionList"
          optionLabel="caption"
          optionValue="value"
          name="condition"
          class="w-full"
          placeholder="Условие"
        />
      </span>

      <span v-if="isShowChips" class="col-5">
        <Chips
          :addOnBlur="true"
          v-model="rule.value"
          name="value"
          class="w-full"
          placeholder="Значение"
        />
      </span>

      <span v-if="isShowRange" class="col-5 range-input-box">
        <InputText
          class="range-input"
          type="number"
          placeholder="ОТ"
          v-model="rule.value"
        />
        <InputText
          class="range-input range-input-margin"
          type="number"
          placeholder="ДО"
          v-model="rule.value2"
        />
      </span>

      <span v-if="isShowAttr" class="col-5">
        <AutoComplete
          :dropdown="true"
          :multiple="false"
          :suggestions="fieldListFiltered"
          v-model="rule.value"
          @complete="searchField($event)"
          required="true"
          style="width: 100%"
          placeholder="Атрибут"
        />
      </span>

      <span class="col-1">
        <Button
          @click="$emit('delete')"
          icon="pi pi-times"
          class="p-button-rounded p-button-plain p-button-text"
        />
      </span>
    </div>
  </div>
</template>

<script>
import ruleHelper from "@/const/rules";

export default {
  props: ["conditionList", "fieldList", "ruleLink"],
  emits: ["delete"],

  created() {
    this.rule = this.ruleLink;
    if (this.rule.field === undefined) {
      this.rule.field = null;
    }

    if (this.rule.condition === undefined) {
      this.rule.condition = null;
    }

    if (this.rule.value === undefined) {
      this.rule.value = null;
    }

    if (this.rule.value2 === undefined) {
      this.rule.value2 = null;
    }
  },

  data() {
    return {
      fieldListFiltered: [],
    };
  },

  methods: {
    clearValues() {
      this.rule.value = this.rule.value2 = null;
    },

    searchField(event) {
      setTimeout(() => {
        if (!event.query.trim().length) {
          this.fieldListFiltered = [...this.fieldList];
        } else {
          this.fieldListFiltered = this.fieldList.filter((field) => {
            return field.toLowerCase().startsWith(event.query.toLowerCase());
          });
        }
      }, 250);
    },
  },

  computed: {
    getFinalValue() {
      if (this.isShowChips || this.isShowAttr) {
        if (this.values === null || this.values.length == 0) {
          return "";
        }

        if (this.values.length == 1) {
          return this.values[0];
        }

        return this.values;
      }

      if (this.isShowRange) {
        return [
          Number.isInteger(parseInt(this.rangeValues[0]))
            ? parseInt(this.rangeValues[0])
            : 0,
          Number.isInteger(parseInt(this.rangeValues[1]))
            ? parseInt(this.rangeValues[1])
            : 0,
        ];
      }

      return "";
    },

    conditionSize() {
      if (this.rule.condition === null) {
        return ["col-8"];
      }

      return ["col-3"];
    },

    isShowChips() {
      return ruleHelper.isFilterValueHaveTextType(this.rule.condition);
    },

    isShowRange() {
      return ruleHelper.isFilterValueHaveRangeType(this.rule.condition);
    },

    isShowAttr() {
      return ruleHelper.isFilterValueHaveAttrType(this.rule.condition);
    },
  },
};
</script>

<style>
.error {
  color: red;
  margin: 0px;
  text-align: center;
}

.p-chips .p-chips-multiple-container {
  width: 100%;
}

.range-input-box {
  display: flex;
}

.range-input {
  width: 48%;
}

.range-input-margin {
  margin-left: auto;
}
</style>