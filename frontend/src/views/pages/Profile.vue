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

      <ProfileCampaign
        v-if="isCurrentPageCampaign"
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
      <ProfileFeed
        v-if="isCurrentPageFeed"
        :profileLink="profile"
        @onChange="onChanges"
        @onSave="onSaveChanges"
      />
      <ProfileInfo
        v-if="isCurrentPageInfo"
        :profileLink="profile"
        :clientLink="client"
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
      <ProfileReplacement
        v-if="isCurrentPageReplacement"
        :profileLink="profile"
        @onChange="onChanges"
        @onSave="onSaveChanges"
      />
      <ProfileSettings
        v-if="isCurrentPageSettings"
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
      <ProfileTemplateGlobal
        v-if="isCurrentPageTemplateGlobal"
        :profileLink="profile"
        @onChange="onChanges"
        @onSave="onSaveChanges"
      />
      <ProfileTemplateCategories
        v-if="isCurrentPageTemplateCategories"
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
  PAGE_TEMPLATE_GLOBAL,
  PAGE_TEMPLATE_CATEGORIES,
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
import ProfileTemplateGlobal from "./Profile/TemplateGlobal";
import ProfileTemplateCategories from "./Profile/TemplateCategories";

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
    ProfileTemplateGlobal,
    ProfileTemplateCategories,
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

    isCurrentPageTemplateGlobal() {
      return this.currentPage == PAGE_TEMPLATE_GLOBAL;
    },

    isCurrentPageTemplateCategories() {
      return this.currentPage == PAGE_TEMPLATE_CATEGORIES;
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