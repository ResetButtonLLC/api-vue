<template>
  <div class="table">
    <p v-if="!categories.length">
      <i class="pi pi-info-circle"></i> Нет категорий
    </p>

    <div v-else v-for="category in categories" :key="'category' + category.id">
      <div class="row">
        <div class="name">
          <Checkbox
            @input="onChangeCategoryCheckbox(category.id, $event)"
            v-model="category.is_active"
            :binary="true"
          />
          <p>{{ category.name }}</p>
        </div>

        <div class="keywords">
          <MultiSelect
            @change="onChangeKeywordTypes(category.id, $event.value)"
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
            @change="onChangeCategoryDropdown(category.id, $event.value)"
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
      @changeCheckbox="onChangeVendorCheckbox"
      :keywordTypes="keywordTypes"
      :campaignList="campaignList"
      :categoryId="selectedCategory.id"
      :vendorList="selectedCategory.vendors"
    />
  </div>
</template>

<script>
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

    onChangeCategoryDropdown(categoryId, newValue) {
      let category = this.categories.find((el) => el.id == categoryId);

      if (!category) {
        return;
      }

      category.vendors.forEach((el) => {
        el.campaign = newValue;
      });
    },

    onChangeKeywordTypes(categoryId, newValue) {
      let category = this.categories.find((el) => el.id == categoryId);

      if (!category) {
        return;
      }

      category.vendors.forEach((el) => {
        el.keyword_types = newValue;
      });
    },

    onChangeCategoryCheckbox(categoryId, newValue) {
      let category = this.categories.find((el) => el.id == categoryId);

      if (!category) {
        return;
      }

      category.vendors.forEach((el) => {
        el.is_active = newValue;
      });
    },

    onChangeVendorCheckbox({ categoryId, newValue }) {
      let category = this.categories.find((el) => el.id == categoryId);

      if (!category) {
        return;
      }

      if (newValue) {
        category.is_active = true;
      } else {
        let isCategoryActive = false;

        category.vendors.forEach((el) => {
          if (el.is_active) {
            isCategoryActive = true;
          }
        });

        category.is_active = isCategoryActive;
      }
    },
  },

  data() {
    return {
      keywordTypes: [
        {
          id: 1,
          name: "BROAD",
        },
        {
          id: 2,
          name: "PHRASE",
        },
        {
          id: 3,
          name: "EXACT",
        },
      ],

      campaignList: [],

      selectedCategory: null,
    };
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
  margin-top: 2px;
  margin-bottom: 2px;
}

.row .name {
  display: flex;
  flex: 1 0 250px;
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
  flex: 1 0 200px;
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