<template>
  <div class="layout-menu-container">
    <AppSubmenu :items="menuItems" class="layout-menu" :root="true" @menuitem-click="onMenuItemClick" />
  </div>
</template>

<script>
import AppSubmenu from "./AppSubmenu";

export default {
  data() {
    return {
    };
  },

  methods: {
    onMenuItemClick(event) {
      if (event.item.id) {
        this.$emit("menuitem-click", event);
        this.$emit("hideMenu");
      }
    },
  },

  computed: {
    profileId() {
      return this.$router.currentRoute.value.params.profileId ?? 0;
    },

    menuItems() {
      return [
        {
          label: "Админ панель",
          items: [
            {
              label: "Информация",
              icon: "pi pi-fw pi-info-circle",
              to: {
                name: 'AdminPanel',
              }
            },

            {
              label: "Пользователи",
              icon: "pi pi-fw pi-users",
              to: {
                name: 'AdminPanelUsers',
              }
            },
            {
              label: "Замены в объявлениях",
              icon: "pi pi-fw pi-id-card",
              to: {
                name: 'AdminPanelAdReplacements',
              }
            },

            {
              label: "Замены в ключевых словах",
              icon: "pi pi-fw pi-key",
              to: {
                name: 'AdminPanelKeywordReplacements',
              }
            },
          ],
        },
      ];
    }
  },

  components: {
    AppSubmenu: AppSubmenu,
  },
};
</script>