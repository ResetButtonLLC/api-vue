<template>
  <!--
  <div class="layout-menu-container">
    <router-link class="link" to="/"
      ><i class="pi pi-fw pi-home"></i> Главная страница
    </router-link>

    <router-link
      v-for="route in projectList"
      :key="route.id"
      class="link"
      :to="{ name: 'FeedList', params: { id: route.id } }"
      ><i class="pi pi-fw pi-folder"></i> {{ route.name }}
    </router-link>
  </div>
  -->

  <div class="layout-menu-container">
    <AppSubmenu
      :items="model"
      class="layout-menu"
      :root="true"
      @menuitem-click="onMenuItemClick"
    />
  </div>
</template>

<script>
import AppSubmenu from "./AppSubmenu";

export default {
  data() {
    return {};
  },

  props: {
    model: Array,
  },
  methods: {
    onMenuItemClick(event) {
      this.$emit("menuitem-click", event);
    },
    bannerImage() {
      return this.$appState.darkTheme
        ? "images/banner-primeblocks-dark.png"
        : "images/banner-primeblocks.png";
    },
  },
  computed: {
    projectList() {
      return this.$store.getters.getProjectList;
    },

    darkTheme() {
      return this.$appState.darkTheme;
    },
  },

  components: {
    AppSubmenu: AppSubmenu,
  },
};
</script>

<style scoped>
.link {
  cursor: pointer;
  text-decoration: none;
  display: flex;
  align-items: center;
  color: #000;
  transition: color 0.2s;
  border-radius: 12px;
  transition: background-color 0.15s;
  padding: 1rem 0.8rem;
}

.link:hover {
  background-color: rgb(231, 231, 231);
  border-radius: 12px;
}

.link i {
  margin-right: 10px;
}
</style>