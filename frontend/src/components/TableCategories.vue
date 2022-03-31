<template>
  <div class="table">
    <div v-for="category in categories" :key="'category' + category.id">
      <div class="row">
        <div class="name">
          <i
            class="pi px-2 py-3 mr-2"
            :class="category.opened ? 'pi-chevron-down' : 'pi-chevron-right'"
            @click="category.opened = !category.opened ? true : false"
          ></i>

          <Checkbox
            @input="onChangeCategoryCheckbox(category.id, $event)"
            v-model="category.is_active"
            :binary="true"
          />
          <p>{{ category.name }}</p>
        </div>

        <div class="campaign">
          <Dropdown
            @change="onChangeCategoryDropdown(category.id, $event.value)"
            class="w-full"
            v-model="category.campaign"
            :options="campaignList"
            optionLabel="name"
            optionValue="id"
            placeholder="Select"
          />
        </div>
      </div>

      <div class="table" v-if="category.opened">
        <!-- NO VENDORS -->
        <div class="w-full text-center" v-if="!category.vendors.length">
          <p class="my-1">
            <i class="pi pi-info-circle"></i> В этой категории нет
            производителей
          </p>
        </div>

        <!-- VENDOR LIST -->
        <div
          class="row"
          v-for="vendor in category.vendors"
          :key="'category' + category.id + '_vendor' + vendor.id"
        >
          <div class="name vendor">
            <Checkbox
              @input="onChangeVendorCheckbox(category.id, $event)"
              v-model="vendor.is_active"
              :binary="true"
            />
            <p>{{ vendor.name }}</p>
          </div>

          <div class="campaign">
            <Dropdown
              class="w-full"
              v-model="vendor.campaign"
              :options="campaignList"
              optionLabel="name"
              optionValue="id"
              placeholder="Select"
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    onChangeCategoryDropdown(categoryId, newValue) {
      let category = this.categories.find((el) => el.id == categoryId);

      if (!category) {
        return;
      }

      category.vendors.forEach((el) => {
        el.campaign = newValue;
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

    onChangeVendorCheckbox(categoryId, newValue) {
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
      categories: [
        {
          id: 1,
          name: "category1",
          is_active: false,
          campaign: null,
          vendors: [],
        },
        {
          id: 2,
          name: "category2",
          is_active: true,
          campaign: null,
          vendors: [
            {
              id: 1,
              name: "vendor1",
              is_active: true,
              campaign: null,
            },
            {
              id: 2,
              name: "vendor2",
              is_active: false,
              campaign: null,
            },
          ],
        },
      ],

      campaignList: [
        { name: "Кампания №1", id: 1 },
        { name: "Кампания №2", id: 2 },
        { name: "Кампания №3", id: 3 },
        { name: "Кампания №4", id: 4 },
        { name: "Кампания №5", id: 5 },
      ],
    };
  },
};
</script>

<style scoped>
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
  width: 55%;
  align-items: center;
}

.row .campaign {
  display: flex;
  width: 45%;
  align-items: center;
}

.name .p-checkbox {
  margin-right: 10px;
}

.vendor {
  padding-left: 36px;
}
</style>