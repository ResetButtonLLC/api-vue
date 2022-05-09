<template>
  <div>
    <h4>Предпросмотр</h4>

    <div v-if="filterList.length" class="flex mb-2">
      <div class="filter" v-for="(f, index) in filterList" :key="f">
        <span>{{ toText(f) }}</span>
        <i class="pi pi-times-circle" @click="deleteFilter(index)"></i>
      </div>
    </div>

    <div>
      <FilterCreator
        v-if="!isLoading"
        :campaignList="campaigns"
        :categoryList="categories"
        :groupList="groups"
        @addFilter="addFilter"
      />

      <div v-else>Загрузка...</div>
    </div>

    <div class="mt-4 panel">
      <SelectButton
        v-model="currentPreviewType"
        :options="previewTypes"
        optionLabel="name"
        optionValue="value"
        @change="updatePreview(value)"
      />

      <FilterTableFields :profileLink="profile" />
    </div>

    <PreviewTable
      :profileLink="profileLink"
      :activeFieldList="activeFieldList"
      :isLoading="isLoading"
      :previewList="previewList"
    />
  </div>
</template>

<script>
import { PREVIEW_GROUP, PREVIEW_AD, PREVIEW_KEYWORD } from "@/api/apiPreview";
import apiPreview from "@/api/apiPreview";
import filterConst from "@/const/filter";
import FilterCreator from "@/components/FilterCreator";
import FilterTableFields from "@/components/FilterTableFields";
import PreviewTable from "./PreviewTable";

export default {
  components: {
    FilterCreator,
    FilterTableFields,
    PreviewTable,
  },

  props: {
    profileLink: {
      type: Object,
      required: true,
    },
  },

  data() {
    return {
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
    this.profile = this.profileLink;

    this.$store.dispatch("getProfileCategories", this.profile.id);
    this.$store.dispatch("getProfileCampaigns", {
      type: "imported",
      profileId: this.profile.id,
    });

    this.updatePreview();
  },

  methods: {
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