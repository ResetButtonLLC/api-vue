<template>
  <div>
    <div v-if="!isLoaded">
      <h2 class="text-center mt-4">{{ noContentText }}</h2>
    </div>

    <div v-else>
      <div class="layout-sidebar">
        <AppMenu
          @menuitem-click="onMenuItemClick"
          @hideMenu="$emit('hideMenu')"
          :currentPage="currentPage"
        />
      </div>

      <ProfileAutoupdateLogs
        v-if="isCurrentPageAutoupdateLogs"
        :profileLink="profile"
        @onChange="onChanges"
        @onSave="onSaveChanges"
      />
      <ProfileAutoupdateSettings
        v-if="isCurrentPageAutoupdateSettings"
        :profileLink="profile"
        @onChange="onChanges"
        @onSave="onSaveChanges"
      />
      <ProfileCategories
        v-if="isCurrentPageCategories"
        :profileLink="profile"
        @onChange="onChanges"
        @onSave="onSaveChanges"
      />
      <ProfileInfo
        v-if="isCurrentPageInfo"
        :profileLink="profile"
        :projectLink="project"
        @onChange="onChanges"
        @onSave="onSaveChanges"
      />
      <ProfileLogs
        v-if="isCurrentPageLogs"
        :profileLink="profile"
        @onChange="onChanges"
        @onSave="onSaveChanges"
      />
      <ProfilePreview
        v-if="isCurrentPagePreview"
        :profileLink="profile"
        @onChange="onChanges"
        @onSave="onSaveChanges"
      />
      <ProfileSettingsMain
        v-if="isCurrentPageSettingsMain"
        :profileLink="profile"
        @onChange="onChanges"
        @onSave="onSaveChanges"
      />

      <ProfileStatistic
        v-if="isCurrentPageStatistic"
        :profileLink="profile"
        @onChange="onChanges"
        @onSave="onSaveChanges"
      />

      <ProfileImportAndFilters
        v-if="isCurrentPageImportAndFilters"
        :profileLink="profile"
        @onChange="onChanges"
        @onSave="onSaveChanges"
      />
      <ProfileGenerateAds
        v-if="isCurrentPageAdsGeneration"
        :profileLink="profile"
        @onChange="onChanges"
        @onSave="onSaveChanges"
      />
      <ProfileGenerateKeywords
        v-if="isCurrentPageKeywordGeneration"
        :profileLink="profile"
        @onChange="onChanges"
        @onSave="onSaveChanges"
      />
    </div>

    <Dialog
      v-if="isShowRouteDialog"
      :visible="true"
      :style="{ width: '450px' }"
      header="Подтвердите дейтвие"
      :modal="true"
      class="p-fluid"
      @update:visible="isShowRouteDialog = false"
    >
      <p>
        Есть несохраненные изменения. Они будут отброшены после перехода на
        другую страницу. Дейтвительно хотите перейти?
      </p>

      <template #footer>
        <Button
          label="Перейти"
          icon="pi pi-sign-out"
          class="p-button-danger"
          @click="confirmRoute"
        />

        <Button
          label="Остаться"
          icon="pi pi-replay"
          class="p-button-success"
          @click="isShowRouteDialog = false"
        />
      </template>
    </Dialog>
  </div>
</template>

<script>
import {
  PAGE_NONE,
  PAGE_AUTOUPDATE_LOGS,
  PAGE_CATEGORIES,
  PAGE_INFO,
  PAGE_LOGS,
  PAGE_PREVIEW,
  PAGE_SETTINGS_MAIN,
  PAGE_SETTINGS_IMPORT,
  PAGE_SETTINGS_ADS_GENERATION,
  PAGE_SETTINGS_KEY_GENERATION,
  PAGE_SETTINGS_AUTOUPDATE,
  PAGE_STATISTIC,
} from "./Profile/const";

import AppMenu from "../layout/AppMenu.vue";

import ProfileAutoupdateLogs from "./Profile/AutoupdateLogs";
import ProfileAutoupdateSettings from "./Profile/AutoupdateSettings";
import ProfileCategories from "./Profile/Categories";
import ProfileInfo from "./Profile/Info";
import ProfileLogs from "./Profile/Logs";
import ProfilePreview from "./Profile/Preview";
import ProfileSettingsMain from "./Profile/SettingsMain";
import ProfileStatistic from "./Profile/Statistic";
import ProfileImportAndFilters from "./Profile/ImportAndFilters";
import ProfileGenerateAds from "./Profile/GenerateAds";
import ProfileGenerateKeywords from "./Profile/GenerateKeywords";

export default {
  components: {
    AppMenu,
    ProfileAutoupdateLogs,
    ProfileAutoupdateSettings,
    ProfileCategories,
    ProfileInfo,
    ProfileLogs,
    ProfilePreview,
    ProfileSettingsMain,
    ProfileStatistic,
    ProfileImportAndFilters,
    ProfileGenerateAds,
    ProfileGenerateKeywords,
  },

  data() {
    return {
      isHaveChanges: false,
      isShowRouteDialog: false,
      routeId: 0,
      currentPage: PAGE_INFO,
    };
  },

  methods: {
    onChanges() {
      this.isHaveChanges = true;
    },

    onSaveChanges() {
      this.isHaveChanges = false;
    },

    confirmRoute() {
      this.isHaveChanges = false;
      this.isShowRouteDialog = false;
      this.currentPage = this.routeId;
    },

    onMenuItemClick(event) {
      if (event.item.id == PAGE_NONE) {
        return;
      }

      if (this.isHaveChanges) {
        this.routeId = event.item.id;
        this.isShowRouteDialog = true;
      } else {
        this.currentPage = event.item.id;
      }
    },
  },

  props: {
    projectId: {
      default: 0,
    },
    id: {
      default: 0,
    },
  },
  computed: {
    isCurrentPageAutoupdateLogs() {
      return this.currentPage == PAGE_AUTOUPDATE_LOGS;
    },

    isCurrentPageAutoupdateSettings() {
      return this.currentPage == PAGE_SETTINGS_AUTOUPDATE;
    },

    isCurrentPageCategories() {
      return this.currentPage == PAGE_CATEGORIES;
    },

    isCurrentPageInfo() {
      return this.currentPage == PAGE_INFO;
    },

    isCurrentPageLogs() {
      return this.currentPage == PAGE_LOGS;
    },

    isCurrentPagePreview() {
      return this.currentPage == PAGE_PREVIEW;
    },

    isCurrentPageSettingsMain() {
      return this.currentPage == PAGE_SETTINGS_MAIN;
    },

    isCurrentPageStatistic() {
      return this.currentPage == PAGE_STATISTIC;
    },

    isCurrentPageImportAndFilters() {
      return this.currentPage == PAGE_SETTINGS_IMPORT;
    },

    isCurrentPageAdsGeneration() {
      return this.currentPage == PAGE_SETTINGS_ADS_GENERATION;
    },

    isCurrentPageKeywordGeneration() {
      return this.currentPage == PAGE_SETTINGS_KEY_GENERATION;
    },

    isWrongLink() {
      return (
        (this.project == null || this.profile == null) && this.projects.length
      );
    },

    projects() {
      return this.$store.getters.getProjects;
    },

    project() {
      return this.projects.find((el) => el.id == this.projectId);
    },

    projectName() {
      return this.project && this.project.name ? this.project.name : "";
    },

    profiles() {
      return this.project && this.project.profiles ? this.project.profiles : [];
    },

    profile() {
      return this.profiles.find((el) => el.id == this.id);
    },

    profileName() {
      return this.isLoaded ? this.profile.name : "";
    },

    isLoaded() {
      return this.profile != null;
    },

    noContentText() {
      return this.isWrongLink
        ? "Не удается получить данные. Проверте правильность ссылки."
        : "Загрузка...";
    },
  },
};
</script>

<style>
.switch {
  flex: 1;
  display: flex;
}

.switch label {
  align-self: center;
  margin-left: 10px;
}

.savebtn {
  display: flex;
  justify-content: center;
}

.infobox {
  display: flex;
  align-items: center;
  width: 100%;
}

.infobox i {
  font-size: 1.4rem;
  color: var(--blue-400);
}

.infobox .p-float-label {
  flex: 1;
  margin-right: 10px;
}
</style>
