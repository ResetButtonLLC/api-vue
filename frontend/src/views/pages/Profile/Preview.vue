<template>
  <div>
    <h4>Предпросмотр</h4>

    <div class="panel">
      <FilterCreator
        v-if="!isLoading"
        :campaignList="campaigns"
        :categoryList="categories"
        :groupList="groups"
      />

      <div v-else>Загрузка...</div>

      <FilterTableFields :profileLink="profile" />
    </div>

    <div class="mt-4 text-center">
      <SelectButton
        v-model="currentPreviewType"
        :options="previewTypes"
        optionLabel="name"
        optionValue="value"
      />
    </div>

    <DataTable
      :value="previewList"
      :paginator="true"
      class="p-datatable-customers mt-2"
      showGridlines
      :rows="10"
      responsiveLayout="scroll"
      :loading="isLoading"
    >
      <template #empty> В локальной базе ничего нет </template>
      <template #loading> Загрузка... </template>

      <Column v-if="isShow('id')" field="id" header="ID">
        <template #body="slotProps">
          {{ slotProps.data.id }}
        </template>
      </Column>

      <Column v-if="isShow('googleid')" field="googleid" header="Google ID">
        <template #body="slotProps">
          {{ slotProps.data.googleid }}
        </template>
      </Column>

      <Column v-if="isShow('status')" field="status" header="Статус">
        <template #body="slotProps">
          {{ slotProps.data.status }}
        </template>
      </Column>

      <Column
        v-if="isShow('editstatus')"
        field="editstatus"
        header="Статус редактирования"
      >
        <template #body="slotProps">
          {{ slotProps.data.editstatus }}
        </template>
      </Column>

      <Column v-if="isShow('keyword')" field="keyword" header="Ключевое слово">
        <template #body="slotProps">
          {{ slotProps.data.keyword }}
        </template>
      </Column>

      <Column v-if="isShow('keytype')" field="keytype" header="Тип ключа">
        <template #body="slotProps">
          {{ slotProps.data.keytype }}
        </template>
      </Column>

      <Column v-if="isShow('category')" field="category" header="Категория">
        <template #body="slotProps">
          {{ slotProps.data.category }}
        </template>
      </Column>

      <Column v-if="isShow('price')" field="price" header="Цена">
        <template #body="slotProps">
          {{ slotProps.data.price }}
        </template>
      </Column>

      <Column
        v-if="isShow('adcount')"
        field="adcount"
        header="Количество объявлений"
      >
        <template #body="slotProps">
          {{ slotProps.data.adcount }}
        </template>
      </Column>

      <Column
        v-if="isShow('adcount-active')"
        field="adcount-active"
        header="Количество активных объявлений"
      >
        <template #body="slotProps">
          {{ slotProps.data.adcount_active }}
        </template>
      </Column>

      <Column
        v-if="isShow('adcount-paused')"
        field="adcount-paused"
        header="Количество объявлений в паузе"
      >
        <template #body="slotProps">
          {{ slotProps.data.adcount_paused }}
        </template>
      </Column>

      <Column
        v-if="isShow('campaignid')"
        field="campaignid"
        header="ID кампании"
      >
        <template #body="slotProps">
          {{ slotProps.data.campaignid }}
        </template>
      </Column>

      <Column
        v-if="isShow('campaigngoogleid')"
        field="campaigngoogleid"
        header="ID кампании в Google"
      >
        <template #body="slotProps">
          {{ slotProps.data.campaigngoogleid }}
        </template>
      </Column>

      <Column v-if="isShow('groupid')" field="groupid" header="ID группы">
        <template #body="slotProps">
          {{ slotProps.data.groupid }}
        </template>
      </Column>

      <Column
        v-if="isShow('groupgoogleid')"
        field="groupgoogleid"
        header="ID группы в Google"
      >
        <template #body="slotProps">
          {{ slotProps.data.groupgoogleid }}
        </template>
      </Column>

      <Column v-if="isShow('param1')" field="param1" header="Param 1">
        <template #body="slotProps">
          {{ slotProps.data.param1 }}
        </template>
      </Column>

      <Column
        v-for="headlineNumber in headlineSet"
        field="headlines"
        :header="'Заголовок ' + headlineNumber"
        :key="'headline' + headlineNumber"
      >
        <template #body="slotProps">
          {{ slotProps.data.headlines[headlineNumber].value ?? "" }}
        </template>
      </Column>

      <Column
        v-for="descriptionNumber in descriptionSet"
        field="descriptions"
        :header="'Описание ' + descriptionNumber"
        :key="'description' + descriptionNumber"
      >
        <template #body="slotProps">
          {{ slotProps.data.descriptions[descriptionNumber].value ?? "" }}
        </template>
      </Column>

      <Column v-if="isShow('path1')" field="path1" header="path1">
        <template #body="slotProps">
          {{ slotProps.data.path1 }}
        </template>
      </Column>

      <Column v-if="isShow('path2')" field="path2" header="path2">
        <template #body="slotProps">
          {{ slotProps.data.path2 }}
        </template>
      </Column>

      <Column v-if="isShow('url')" field="url" header="URL">
        <template #body="slotProps">
          {{ slotProps.data.url }}
        </template>
      </Column>
    </DataTable>
  </div>
</template>

<script>
const PREVIEW_GROUP = 1;
const PREVIEW_AD = 2;
const PREVIEW_KEYWORD = 3;

import filterConst from "@/const/filter";
import FilterCreator from "@/components/FilterCreator";
import FilterTableFields from "@/components/FilterTableFields";

export default {
  components: {
    FilterCreator,
    FilterTableFields,
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
      previewList: [],
      currentPreviewType: PREVIEW_GROUP,
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
  },

  methods: {
    isShow(name) {
      return (
        this.profile.previewActiveFields.some((el) => el == name) &&
        this.activeFieldList.some((el) => el.value == name)
      );
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

    headlineSet() {
      let resultSet = [];
      for (let num = 1; num <= 15; num++) {
        if (this.isShow("headline" + num)) {
          resultSet.push(num);
        }
      }
      return resultSet;
    },

    descriptionSet() {
      let resultSet = [];
      for (let num = 1; num <= 4; num++) {
        if (this.isShow("description" + num)) {
          resultSet.push(num);
        }
      }
      return resultSet;
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
      return this.isCategoriesLoading && this.isCampaignsLoading;
    },
  },
};
</script>

<style scoped>
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