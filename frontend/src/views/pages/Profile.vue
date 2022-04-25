<template>
  <div>
    <div v-if="!isLoaded">
      <h2 class="text-center mt-4">{{ noContentText }}</h2>
    </div>

    <div v-else>
      <div class="layout-sidebar">
        <AppMenu @menuitem-click="onMenuItemClick" />
      </div>

      <ProfileFeed v-if="isCurrentPageInfo" :profileLink="profile" />
      <ProfileCampaign v-if="isCurrentPageSettings" :profileLink="profile" />
    </div>
  </div>
</template>

<script>
import AppMenu from "../layout/AppMenu.vue";
import ProfileFeed from "@/components/ProfileFeed";
import ProfileCampaign from "@/components/ProfileCampaign";

export default {
  components: {
    AppMenu,
    ProfileFeed,
    ProfileCampaign,
  },

  data() {
    return {
      currentPage: 12,
    };
  },

  methods: {
    onMenuItemClick(event) {
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
    isCurrentPageInfo() {
      return this.currentPage == 11;
    },

    isCurrentPageSettings() {
      return this.currentPage == 12;
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