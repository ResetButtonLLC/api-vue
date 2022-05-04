<template>
  <AutoComplete
    class="w-full"
    forceSelection
    v-model="filter.operator"
    :suggestions="filteredFieldList"
    field="name"
    :dropdown="true"
    @complete="searchField($event)"
    @item-select="onSelect"
  />
</template>

<script>
export default {
  props: ["filterLink"],

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
        (el) => el.name.toLowerCase().indexOf(event.query.toLowerCase()) != -1
      );
    },

    onSelect() {
      this.filter.value = null;
      this.filter.value2 = null;
    },
  },

  computed: {
    fieldList() {
      return this.filter.field.operators;
    },
  },
};
</script>