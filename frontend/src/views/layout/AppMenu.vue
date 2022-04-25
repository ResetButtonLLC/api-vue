<template>
  <div class="layout-menu-container">
    <AppSubmenu
      :items="menuItems"
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
    menuItems() {
      return [
        {
          label: "Профиль",
          items: [
            {
              id: 11,
              label: "Информация",
              icon: "pi pi-fw pi-info-circle",
            },

            {
              id: 12,
              label: "Настройки",
              icon: "pi pi-fw pi-cog",
            },

            {
              id: 13,
              label: "Автообновления",
              icon: "pi pi-fw pi-cloud-upload",
            },
          ],
        },
        {
          label: "Управление",
          items: [
            {
              id: 21,
              label: "Фид",
              icon: "pi pi-fw pi-copy",
            },
            {
              id: 22,
              label: "Кампании",
              icon: "pi pi-fw pi-wallet",
            },
            {
              id: 23,
              label: "Категории",
              icon: "pi pi-fw pi-qrcode",
            },
            {
              id: 24,
              label: "Локальная база",
              icon: "pi pi-fw pi-database",
            },
          ],
        },

        {
          label: "Другое",
          items: [
            {
              id: 31,
              label: "Шаблоны",
              icon: "pi pi-fw pi-sliders-h",
            },

            {
              id: 32,
              label: "Статистика",
              icon: "pi pi-fw pi-chart-bar",
            },

            {
              id: 33,
              label: "Логи",
              icon: "pi pi-fw pi-envelope",
            },
          ],
        },
      ];
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