<template>
  <div>
    <div v-if="!rules || !rules.length">Условия для фильтрации не указаны</div>

    <div v-else v-for="(rule, index) in rules" :key="rule" class="my-1">
      <div class="header">
        <span>Правило фильтрации</span>

        <div class="top-buttons">
          <i
            v-tooltip.left="'Редактировать'"
            class="pi pi-pencil btn edit"
            @click="openEditDialog(rule)"
          ></i>
          <i
            v-tooltip.left="'Удалить'"
            class="pi pi-times btn delete"
            @click="openDeleteDialog(index)"
          ></i>
        </div>
      </div>

      <div class="body">
        <template v-if="rule.conditions && rule.conditions.length">
          <p v-for="condition in rule.conditions" :key="condition">
            <i class="pi pi-question-circle mr-2" />{{ buildText(condition) }}
          </p>
        </template>

        <p v-else class="text-center">Условия для фильтрации не указаны</p>
      </div>
    </div>

    <Button
      label="Добавить правило"
      icon="pi pi-plus"
      class="p-button-secondary mt-2"
      @click="addRule"
    />

    <Dialog
      v-if="isDeleteOpened"
      :visible="true"
      :style="{ width: '450px' }"
      header="Удаление"
      :modal="true"
      class="p-fluid"
      @update:visible="isDeleteOpened = false"
    >
      <p class="line-height-3 m-0">Подтверждаете удаление?</p>
      <template #footer>
        <Button
          label="Отмена"
          icon="pi pi-times"
          class="p-button-secondary"
          @click="isDeleteOpened = false"
        />

        <Button
          label="Удалить"
          icon="pi pi-check"
          class="p-button-danger"
          @click="commitDelete"
        />
      </template>
    </Dialog>

    <RuleEditor
      v-if="isEditOpened"
      :ruleLink="currentRule"
      :conditionHelpText="conditionHelpText"
      @close="isEditOpened = false"
    />
  </div>
</template>

<script>
import RuleEditor from "@/components/RuleEditor";
import ruleHelper from "@/const/rules";

export default {
  components: {
    RuleEditor,
  },

  emits: ["onChange", "onDelete"],

  props: {
    objectLink: Object,
    conditionHelpText: {
      type: String,
      default: "Товары фильтруются по условиям",
    },
  },

  created() {
    this.object = this.objectLink;

    if (this.object.rules === undefined) {
      this.object.rules = [];
    }
  },

  methods: {
    openEditDialog(rule) {
      this.currentRule = rule;
      this.isEditOpened = true;
    },

    openDeleteDialog(index) {
      this.currentRuleIndex = index;
      this.isDeleteOpened = true;
    },

    addRule() {
      this.rules.push({});
    },

    commitDelete() {
      this.rules.splice(this.currentRuleIndex, 1);
      this.isDeleteOpened = false;
    },

    buildText(el) {
      return (
        el.field +
        " " +
        ruleHelper.getFilterTextFromValue(el.condition).toLowerCase() +
        " " +
        el.value
      );
    },
  },

  data() {
    return {
      object: {},
      currentRule: null,
      currentRuleIndex: null,
      isEditOpened: false,
      isDeleteOpened: false,
    };
  },

  computed: {
    rules() {
      return this.object.rules;
    },
  },
};
</script>

<style scoped>
.header {
  display: flex;
  align-items: center;
  border: 1px solid #d57e00;
  background-color: #f59e0b;
  padding: 5px 10px;
  border-top-right-radius: 5px;
  border-top-left-radius: 5px;
  color: white;
  font-weight: 600;
  border: 1px solid var(--green-600);
  background-color: var(--green-400);
}

.body {
  border: 1px solid var(--bluegray-200);
  background-color: #ffffff;
  border-bottom-right-radius: 5px;
  border-bottom-left-radius: 5px;
}

.body p {
  margin: 2px 10px;
}

.body i {
  font-weight: 600;
}

.top-buttons {
  margin-left: auto;
}

.btn {
  cursor: pointer;
  padding: 5px;
  border-radius: 5px;
}

.edit {
  background-color: var(--indigo-500);
  margin-right: 5px;
}

.delete {
  background-color: #ef4444;
}
</style>