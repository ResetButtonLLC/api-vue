<template>
  <div class="table">
    <p v-if="!categories.length">
      <i class="pi pi-info-circle"></i> Нет категорий
    </p>

    <div v-else v-for="category in categories" :key="'category' + category.id">
      <div class="row">
        <div class="name">
          <Checkbox
            @input="$emit('onChange')"
            v-model="category.is_active"
            :binary="true"
          />
          <p>{{ category.name }}</p>
        </div>

        <div class="keywords">
          <MultiSelect
            @change="$emit('onChange')"
            class="w-full"
            v-model="category.keyword_types"
            :options="keywordTypes"
            optionLabel="name"
            optionValue="id"
            :filter="true"
            placeholder="Без ключевых слов"
          />
        </div>

        <div class="campaign">
          <Dropdown
            @change="$emit('onChange')"
            class="w-full"
            v-model="category.campaign"
            :options="campaignList"
            optionLabel="name"
            optionValue="id"
            placeholder="Кампания не выбрана"
          />
        </div>

        <div class="btn ml-2">
          <Button
            icon="pi pi-sliders-h"
            class="p-button-success"
            @click="openVendorDialog(category)"
          />
        </div>
      </div>
    </div>

    <CategoryVendorsDialog
      v-if="selectedCategory"
      @close="selectedCategory = null"
      :keywordTypes="keywordTypes"
      :campaignList="campaignList"
      :categoryId="selectedCategory.id"
      :vendorList="selectedCategory.vendors"
      :customVendorList="selectedCategory.customVendors"
      @onChange="$emit('onChange')"
    />
  </div>
</template>

<script>
import keywords from "../const/keywords";
import CategoryVendorsDialog from "./CategoryVendorsDialog";

export default {
  components: { CategoryVendorsDialog },

  props: ["categoriesLink", "campaignsLink"],

  created() {
    this.categories = this.categoriesLink;
    this.campaignList = this.campaignsLink;
  },

  methods: {
    openVendorDialog(category) {
      this.selectedCategory = category;
    },
  },

  data() {
    return {
      campaignList: [],

      selectedCategory: null,
    };
  },

  computed: {
    keywordTypes() {
      return keywords.keywords();
    },
  },
};
</script>

<style>
.table {
  display: flex;
  flex-direction: column;
}

.row {
  display: flex;
  align-items: center;
  margin-top: 2px;
  margin-bottom: 2px;
}

.row .name {
  display: flex;
  flex: 1 1 250px;
  overflow-wrap: anywhere;
  align-items: center;
}

.row .keywords {
  display: flex;
  flex: 1 0 250px;
  align-items: center;

  padding-left: 0.5rem;
  padding-right: 0.5rem;
}

.row .campaign {
  display: flex;
  flex: 1 0 250px;
  align-items: center;
}

.row .btn {
  display: flex;
  flex: 0 0 50px;
  align-items: center;
}

.name .p-checkbox {
  margin-right: 10px;
}
</style>