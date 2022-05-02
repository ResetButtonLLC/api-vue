<template>
  <div>
    <div v-if="!isLoaded">
      <h2 class="text-center mt-4">{{ noContentText }}</h2>
    </div>

    <div v-else>
      <div class="layout-sidebar">
        <AppMenu @menuitem-click="onMenuItemClick" />
      </div>

      <ProfileAutoupdateLogs
        v-if="isCurrentPageAutoupdateLogs"
        :profileLink="profile"
      />
      <ProfileAutoupdateSettings
        v-if="isCurrentPageAutoupdateSettings"
        :profileLink="profile"
      />

      <ProfileCampaign v-if="isCurrentPageCampaign" :profileLink="profile" />
      <ProfileCategories
        v-if="isCurrentPageCategories"
        :profileLink="profile"
      />
      <ProfileFeed v-if="isCurrentPageFeed" :profileLink="profile" />
      <ProfileInfo
        v-if="isCurrentPageInfo"
        :profileLink="profile"
        :clientLink="client"
      />
      <ProfileLogs v-if="isCurrentPageLogs" :profileLink="profile" />
      <ProfilePreview v-if="isCurrentPagePreview" :profileLink="profile" />
      <ProfileReplacement
        v-if="isCurrentPageReplacement"
        :profileLink="profile"
      />
      <ProfileSettings v-if="isCurrentPageSettings" :profileLink="profile" />
      <ProfileStatistic v-if="isCurrentPageStatistic" :profileLink="profile" />
      <ProfileTemplates v-if="isCurrentPageTemplates" :profileLink="profile" />
    </div>
  </div>
</template>

<script>
import {
  PAGE_NONE,
  PAGE_AUTOUPDATE_LOGS,
  PAGE_AUTOUPDATE_SETTINGS,
  PAGE_CAMPAIGN,
  PAGE_CATEGORIES,
  PAGE_FEED,
  PAGE_INFO,
  PAGE_LOGS,
  PAGE_PREVIEW,
  PAGE_REPLACEMENT,
  PAGE_SETTINGS,
  PAGE_STATISTIC,
  PAGE_TEMPLATES,
} from "./Profile/const";

import AppMenu from "../layout/AppMenu.vue";

import ProfileAutoupdateLogs from "./Profile/AutoupdateLogs";
import ProfileAutoupdateSettings from "./Profile/AutoupdateSettings";
import ProfileCampaign from "./Profile/Campaign";
import ProfileCategories from "./Profile/Categories";
import ProfileFeed from "./Profile/Feed";
import ProfileInfo from "./Profile/Info";
import ProfileLogs from "./Profile/Logs";
import ProfilePreview from "./Profile/Preview";
import ProfileReplacement from "./Profile/Replacement";
import ProfileSettings from "./Profile/Settings";
import ProfileStatistic from "./Profile/Statistic";
import ProfileTemplates from "./Profile/Templates";

export default {
  components: {
    AppMenu,
    ProfileAutoupdateLogs,
    ProfileAutoupdateSettings,
    ProfileCampaign,
    ProfileCategories,
    ProfileFeed,
    ProfileInfo,
    ProfileLogs,
    ProfilePreview,
    ProfileReplacement,
    ProfileSettings,
    ProfileStatistic,
    ProfileTemplates,
  },

  data() {
    return {
      currentPage: PAGE_INFO,
    };
  },

  methods: {
    onMenuItemClick(event) {
      if (event.item.id == PAGE_NONE) {
        return;
      }

      this.currentPage = event.item.id;
    },
  },

  props: {
    clientId: {
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
      return this.currentPage == PAGE_AUTOUPDATE_SETTINGS;
    },

    isCurrentPageCampaign() {
      return this.currentPage == PAGE_CAMPAIGN;
    },

    isCurrentPageCategories() {
      return this.currentPage == PAGE_CATEGORIES;
    },

    isCurrentPageFeed() {
      return this.currentPage == PAGE_FEED;
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

    isCurrentPageReplacement() {
      return this.currentPage == PAGE_REPLACEMENT;
    },

    isCurrentPageSettings() {
      return this.currentPage == PAGE_SETTINGS;
    },

    isCurrentPageStatistic() {
      return this.currentPage == PAGE_STATISTIC;
    },

    isCurrentPageTemplates() {
      return this.currentPage == PAGE_TEMPLATES;
    },

    isWrongLink() {
      return (
        (this.client == null || this.profile == null) && this.clients.length
      );
    },

    clients() {
      return this.$store.getters.getClients;
    },

    client() {
      return this.clients.find((el) => el.id == this.clientId);
    },

    clientName() {
      return this.client && this.client.name ? this.client.name : "";
    },

    profiles() {
      return this.client && this.client.profiles ? this.client.profiles : [];
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