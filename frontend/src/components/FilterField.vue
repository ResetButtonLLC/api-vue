<template>
  <CustomAutoComplete
    class="w-full"
    forceSelection
    v-model="filter.field"
    :suggestions="filteredFieldList"
    field="name"
    @complete="searchField($event)"
    @item-select="onSelect"
    placeholder="Добавление фильтра"
  />
</template>

<script>
import CustomAutoComplete from "./CustomAutoComplete";
import filters from "../const/filter";

export default {
  props: ["filterLink"],

  components: {
    CustomAutoComplete,
  },

  data() {
    return {
      filter: null,
      filteredFieldList: [],
    };
  },

  created() {
    this.filter = this.filterLink;

    if (this.filter.field === undefined) {
      this.filter.field = null;
    }
  },

  methods: {
    searchField(event) {
      this.filteredFieldList = this.fieldList.filter(
        (el) =>
          el.name.toLowerCase().indexOf(event.query.toLowerCase()) != -1 ||
          el.alias.toLowerCase().indexOf(event.query.toLowerCase()) != -1
      );
    },

    onSelect() {
      this.filter.operator = null;
    },
  },

  computed: {
    fieldList() {
      return filters.fieldList();
    },
  },
};
</script>