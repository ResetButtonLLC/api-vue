<template>
  <Dialog
    :visible="true"
    :style="{ width: '82%' }"
    :header="'Редактирование правил'"
    :modal="true"
    @update:visible="$emit('close')"
  >
    <div class="text-center" v-if="isLoading">
      <h3>Идет загрузка...</h3>
    </div>

    <div v-else>
      <h3 class="text-center" v-if="!isHaveRules">Условия не указаны</h3>

      <p v-if="isHaveRules">
        <i class="pi pi-filter"></i> {{ conditionHelpText }}:
      </p>

      <div v-if="isHaveRules">
        <div
          name="drop-area"
          v-for="(rule, index) in ruleList"
          :key="rule"
          @drop="endDragFilter($event, index)"
          @dragover.prevent
          @dragenter.prevent
        >
          <RuleCondition
            draggable="true"
            @dragstart="startDragFilter($event, index)"
            @dragover.prevent
            @dragenter.prevent
            :ruleLink="rule"
            :fieldList="constFields"
            :conditionList="constFilters"
            @delete="onDeleteRule(index)"
          />
        </div>
      </div>

      <div class="text-center">
        <Button
          label="Добавить условие"
          icon="pi pi-plus"
          @click="addEmptyRule"
          class="p-button-sm"
        />
      </div>

      <div class="text-center mt-3">
        <Button
          label="Сохранить изменения"
          icon="pi pi-save"
          @click="save"
          class="p-button-success"
        />
      </div>
    </div>
  </Dialog>
</template>

<script>
import fieldHelper from "@/const/fields";
import ruleHelper from "@/const/rules";
//import apiFeeds from "@/api/apiFeeds";
import RuleCondition from "@/components/RuleCondition";

export default {
  components: {
    RuleCondition,
  },

  emits: ["onSave", "close"],
  props: {
    ruleLink: Object,
    conditionHelpText: String,
  },

  data() {
    return {
      rule: {},
      isLoading: false,

      constFilters: [],
      constFields: [],

      ruleList: [],

      isDataChecked: false,

      fieldListFiltered: [],
    };
  },

  created() {
    this.constFields = fieldHelper.getFieldList();
    this.constFilters = ruleHelper.getFilterList();

    this.rule = this.ruleLink;

    if (this.rule.conditions === undefined) {
      this.rule.conditions = [];
    }

    this.ruleList = [...this.rule.conditions];
  },

  methods: {
    checkData() {
      this.isDataChecked = true;

      let isHaveError = false;

      this.ruleList.forEach((condition) => {
        let errorNumber = ruleHelper.checkCondition(condition);

        if (errorNumber) {
          isHaveError = condition.isHaveError = true;
        } else {
          delete condition.isHaveError;
        }
      });

      if (isHaveError) {
        return false;
      }

      this.isDataChecked = false;
      return true;
    },

    startDragFilter(evt, index) {
      evt.dataTransfer.dropEffect = "move";
      evt.dataTransfer.effectAllowed = "move";
      evt.dataTransfer.setData("itemID", index);
    },

    endDragFilter(evt, index) {
      const oldIndex = evt.dataTransfer.getData("itemID");

      let tmp = this.ruleList[oldIndex];
      this.ruleList[oldIndex] = this.ruleList[index];
      this.ruleList[index] = tmp;
    },

    save() {
      if (!this.checkData()) {
        return;
      }

      this.rule.conditions = this.ruleList;

      this.$emit("close");
    },

    onDeleteRule(index) {
      this.ruleList.splice(index, 1);
    },

    addEmptyRule() {
      this.ruleList.push({});
    },

    isConditionHaveError(id) {
      return (
        undefined !==
        this.conditionIdErrorList.find((el) => {
          return id == el;
        })
      );
    },
  },

  computed: {
    isHaveRules() {
      return this.ruleList && this.ruleList.length;
    },

    getUserId() {
      return this.$store.getters.getUserId;
    },
  },
};
</script>