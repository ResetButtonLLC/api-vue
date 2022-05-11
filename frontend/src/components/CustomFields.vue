<template>
  <div>
    <div v-if="numbersOnly">
      <span class="p-float-label mt-4" v-for="field in fieldList" :key="field">
        <InputNumber
          :id="'in' + field.value"
          class="w-full mt-1"
          v-model="profile.csv_feed_fields[field.value]"
          mode="decimal"
          @input="$emit('onChange')"
          prefix="Столбец №"
          :useGrouping="false"
          :min="1"
          :max="100"
        />
        <label :for="'in' + field.value">{{ field.name }}</label>
      </span>
    </div>

    <div v-else>
      <span class="p-float-label mt-4" v-for="field in fieldList" :key="field">
        <Dropdown
          :id="'dd' + field.value"
          @change="$emit('onChange')"
          class="w-full"
          v-model="profile.feed_fields[field.value]"
          :options="customFields"
          optionLabel="name"
          optionValue="value"
        />
        <label :for="'dd' + field.value">{{ field.name }}</label>
      </span>
    </div>
  </div>
</template>

<script>
const FIELD_LIST = [
  { value: "id", name: "ID" },
  { value: "available", name: "Наличие" },
  { value: "url", name: "URL" },
  { value: "mobileUrl", name: "URL мобильная" },
  { value: "price", name: "Цена" },
  { value: "currency", name: "Валюта" },
  { value: "category", name: "Категория" },
  { value: "vendor", name: "Производитель" },
  { value: "model", name: "Модель" },
  { value: "description", name: "Описание" },
];

export default {
  props: {
    profileLink: {
      type: Object,
      required: true,
    },

    numbersOnly: {
      type: Boolean,
      default: false,
    },
  },

  data() {
    return {
      profile: {},
      customFields: [],
    };
  },

  created() {
    this.profile = this.profileLink;

    if (this.profile.feed_fields === undefined) {
      this.profile.feed_fields = {};
    }

    if (this.profile.csv_feed_fields === undefined) {
      this.profile.csv_feed_fields = {};
    }

    this.buildCustomFields(["id", "name", "vendor", "custom_label0"]);
  },

  methods: {
    buildCustomFields(list) {
      let newCustomFields = [];
      newCustomFields.push({
        value: null,
        name: "Определять автоматически",
      });

      list.forEach((el) => {
        newCustomFields.push({ value: el, name: el });
      });

      this.customFields = newCustomFields;
    },
  },

  computed: {
    fieldList() {
      return FIELD_LIST;
    },
  },
};
</script>