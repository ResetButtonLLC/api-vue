<template>
  <div class="card">
    <h4>Предпросмотр</h4>

    <div v-if="filterList.length" class="flex mb-2">
      <div class="filter" v-for="(f, index) in filterList" :key="f">
        <span>{{ toText(f) }}</span>
        <i class="pi pi-times-circle" @click="deleteFilter(index)"></i>
      </div>
    </div>

    <div>
      <FilterCreator v-if="!isLoading" :campaignList="campaigns" :categoryList="categories" :groupList="groups"
        @addFilter="addFilter" />

      <div v-else>
        <p class="text-center">
          <i class="pi pi-spin pi-spinner"></i>
          Загрузка...
        </p>
      </div>
    </div>

    <div class="mt-4 panel">
      <SelectButton v-model="currentPreviewType" :options="previewTypes" optionLabel="name" optionValue="value"
        @change="updatePreview(value)" />

      <FilterTableFields :profileLink="profile" />
    </div>

    <PreviewTable v-if="!isLoading" class="mt-4" :columnList="columnListForPreviewTable" :dataList="dataList"
      @hideColumn="hideColumn" @changeValue="changeValue" />
  </div>
</template>

<script>
import { PREVIEW_GROUP, PREVIEW_AD, PREVIEW_KEYWORD } from "@/api/apiPreview";
import apiPreview from "@/api/apiPreview";
import filterConst from "@/const/filter";
import FilterCreator from "@/components/FilterCreator";
import FilterTableFields from "@/components/FilterTableFields";
import PreviewTable from "@/components/PreviewTable";

export default {
  components: {
    FilterCreator,
    FilterTableFields,
    PreviewTable,
  },

  props: ['profileId'],

  data() {
    return {
      dataList: [{ id: 1, googleid: 123123 }, { id: 2, googleid: 1231232 }, { id: 3, googleid: 5555 }, { id: 4, googleid: 666662 }],

      profile: {},
      filterList: [],
      previewList: [],
      isPreviewLoading: false,
      currentPreviewType: PREVIEW_GROUP,
      currentPage: 1,
      previewTypes: [
        {
          name: "Группы",
          value: PREVIEW_GROUP,
        },
        {
          name: "Объявления",
          value: PREVIEW_AD,
        },
        {
          name: "Ключи",
          value: PREVIEW_KEYWORD,
        },
      ],
    };
  },

  created() {
    this.profile = { id: this.profileId }

    this.$store.dispatch("getProfileCategories", this.profile.id);
    this.$store.dispatch("getProfileCampaigns", {
      type: "imported",
      profileId: this.profile.id,
    });

    this.updatePreview();
  },

  methods: {
    hideColumn(value) {
      console.log('hide: ' + value);
      this.profile.previewActiveFields = this.profile.previewActiveFields.filter((el) => el != value);
    },

    updatePreview(newPage = 1) {
      this.currentPage = newPage;
      this.isPreviewLoading = true;

      apiPreview
        .getPreview(
          this.currentPreviewType,
          this.profile.id,
          this.activeFilterList,
          this.currentPage
        )
        .then((result) => {
          this.previewList = result.data.data;
        })
        .catch(() => {
          this.$store.dispatch("error", "Не удалось загрузить предпросмотр");
        })
        .finally(() => {
          this.isPreviewLoading = false;
        });
    },

    addFilter(filter) {
      this.filterList.push(filter);
      this.updatePreview();
    },

    deleteFilter(index) {
      this.filterList.splice(index, 1);
      this.updatePreview();
    },

    toText(filter) {
      return filterConst.filterToText(filter);
    },

    changeValue(elementIndex, value, newValue) {
      this.dataList[elementIndex][value] = newValue;
    }
  },

  computed: {
    activeFieldList() {
      switch (this.currentPreviewType) {
        case PREVIEW_GROUP:
          return filterConst.fieldListForGroups();

        case PREVIEW_AD:
          return filterConst.fieldListForAds();

        case PREVIEW_KEYWORD:
          return filterConst.fieldListForKeywords();

        default:
          return [];
      }
    },

    columnListForPreviewTable() {
      if (this.profile.previewActiveFields === undefined) {
        return [];
      }

      return this.activeFieldList.filter((el) => this.profile.previewActiveFields.indexOf(el.value) !== -1);
    },

    activeFilterList() {
      let activeOperatorList = this.activeFieldList
        .map((field) => field.operators.map((operator) => operator.value)) // только значения операторов
        .join(",") // соединяем массивы и подмассивы в 1 строку
        .split(",") // разбиваем на массив
        .filter((value, index, newArray) => newArray.indexOf(value) === index); // оставляем только уникальные значения

      return this.filterList.filter(
        (filter) => activeOperatorList.indexOf(filter.operator) !== -1
      );
    },

    groups() {
      return [
        { id: 1, name: "тест группа 1" },
        { id: 2, name: "тест группа 2" },
      ];
    },

    categories() {
      return this.$store.getters.getProfileCategories(this.profile.id);
    },

    campaigns() {
      return this.$store.getters.getProfileCampaigns(
        this.profile.id,
        "imported"
      );
    },

    isCategoriesLoading() {
      return this.$store.getters.isCategoryLoadings(this.profile.id);
    },

    isCampaignsLoading() {
      return this.$store.getters.isCampaignsLoadings(
        this.profile.id,
        "imported"
      );
    },

    isLoading() {
      return (
        this.isCategoriesLoading ||
        this.isCampaignsLoading ||
        this.isPreviewLoading
      );
    },
  },
};
</script>

<style scoped>
.filter {
  border: 1px solid #848484;
  padding: 5px 10px;
  margin: 2px;
  border-radius: 10px;
  display: flex;
  align-items: center;
  color: #494949;
  background-color: #c0c0c0;
}

.filter i {
  margin-left: 5px;
  color: #db0000;
  font-size: 1.1rem;
  cursor: pointer;
}

.flex {
  display: flex;
}

.panel {
  display: flex;
  justify-content: space-between;
}
</style>

<style>
.p-column-title {
  white-space: nowrap !important;
}
</style>