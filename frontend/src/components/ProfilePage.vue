<template>
  <div>
    <div v-if="!isLoaded">
      <h2 class="text-center mt-4">{{ noContentText }}</h2>
    </div>

    <div v-else>
      <slot></slot>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {};
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