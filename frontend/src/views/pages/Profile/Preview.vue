<template>
  <div>
    <h4>Предпросмотр</h4>

    {{ previewFilters }}

    <DataTable
      :value="previewList"
      :paginator="true"
      class="p-datatable-customers"
      showGridlines
      :rows="10"
      dataKey="id"
      v-model:filters="previewFilters"
      filterDisplay="menu"
      responsiveLayout="scroll"
      :loading="isLoading"
      :globalFilterFields="[
        'name',
        'country.name',
        'representative.name',
        'balance',
        'status',
      ]"
    >
      <template #header>
        <div class="flex justify-content-between">
          <Button
            type="button"
            icon="pi pi-filter-slash"
            label="Очистить фильтры"
            class="p-button-outlined"
            @click="clearFilter1()"
          />
          <span class="p-input-icon-left">
            <i class="pi pi-search" />
            <InputText
              v-model="previewFilters['global'].value"
              placeholder="Фильтр"
            />
          </span>
        </div>
      </template>
      <template #empty> В локальной базе ничего нет </template>
      <template #loading> Загрузка... </template>
      <Column field="name" header="Заголовок" style="min-width: 12rem">
        <template #body="{ data }">
          {{ data.name }}
        </template>
        <template #filter="{ filterModel }">
          <InputText
            type="text"
            v-model="filterModel.value"
            class="p-column-filter"
            placeholder="Search by name"
          />
        </template>
      </Column>
      <Column
        header="Тип ключа"
        filterField="keyword_types"
        :showFilterMatchModes="false"
        :filterMenuStyle="{ width: '14rem' }"
        style="min-width: 14rem"
      >
        <template #body="{ data }">
          <span class="image-text">{{ data.keyword_types.name }}</span>
        </template>
        <template #filter="{ filterModel }">
          <div class="mb-3 font-bold">Тип ключа</div>
          <MultiSelect
            v-model="filterModel.value"
            :options="keyword_types"
            optionLabel="name"
            placeholder="Any"
            class="p-column-filter"
          >
            <template #option="slotProps">
              <div class="p-multiselect-representative-option">
                <span class="image-text">{{ slotProps.option.name }}</span>
              </div>
            </template>
          </MultiSelect>
        </template>
      </Column>
      <Column
        header="Дата создания"
        filterField="date"
        dataType="date"
        style="min-width: 10rem"
      >
        <template #body="{ data }">
          {{ formatDate(data.date) }}
        </template>
        <template #filter="{ filterModel }">
          <Calendar
            v-model="filterModel.value"
            dateFormat="mm/dd/yy"
            placeholder="mm/dd/yyyy"
          />
        </template>
      </Column>
    </DataTable>
  </div>
</template>

<script>
import { FilterMatchMode, FilterOperator } from "primevue/api";

export default {
  props: {
    profileLink: {
      type: Object,
      required: true,
    },
  },

  mounted() {
    /*
    this.customerService.getCustomersLarge().then((data) => {
      this.customers1 = data;
      this.loading1 = false;
      this.customers1.forEach(
        (customer) => (customer.date = new Date(customer.date))
      );
    });
    */
  },

  data() {
    return {
      profile: {},

      previewList: null,
      previewFilters: null,

      keyword_types: [
        { id: 1, name: "broad" },
        { id: 2, name: "exact" },
        { id: 3, name: "phrase" },
      ],

      isLoading: false,
    };
  },

  created() {
    this.profile = this.profileLink;

    this.initFilters1();
  },

  methods: {
    clearFilter1() {
      this.initFilters1();
    },
    initFilters1() {
      this.previewFilters = {
        global: { value: null, matchMode: FilterMatchMode.CONTAINS },
        name: {
          operator: FilterOperator.AND,
          constraints: [
            { value: null, matchMode: FilterMatchMode.STARTS_WITH },
          ],
        },
        keyword_types: { value: null, matchMode: FilterMatchMode.IN },
        date: {
          operator: FilterOperator.AND,
          constraints: [{ value: null, matchMode: FilterMatchMode.DATE_IS }],
        },
      };
    },
  },
};
</script>