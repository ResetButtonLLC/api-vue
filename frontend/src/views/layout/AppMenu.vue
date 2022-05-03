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
} from "../pages/Profile/const";

export default {
  data() {
    return {
      menuItems: [
        {
          label: "Профиль",
          items: [
            {
              id: PAGE_INFO,
              label: "Информация",
              icon: "pi pi-fw pi-info-circle",
            },

            {
              id: PAGE_SETTINGS,
              label: "Настройки",
              icon: "pi pi-fw pi-cog",
            },

            {
              id: PAGE_NONE,
              label: "Автообновления",
              icon: "pi pi-fw pi-cloud-upload",
              items: [
                {
                  id: PAGE_AUTOUPDATE_LOGS,
                  label: "История",
                  icon: "pi pi-fw pi-calendar",
                },

                {
                  id: PAGE_AUTOUPDATE_SETTINGS,
                  label: "Настройки",
                  icon: "pi pi-fw pi-filter",
                },
              ],
            },
          ],
        },
        {
          label: "Управление",
          items: [
            {
              id: PAGE_FEED,
              label: "Фид",
              icon: "pi pi-fw pi-copy",
            },
            {
              id: PAGE_CAMPAIGN,
              label: "Кампании",
              icon: "pi pi-fw pi-wallet",
            },
            {
              id: PAGE_CATEGORIES,
              label: "Категории",
              icon: "pi pi-fw pi-qrcode",
            },
            {
              id: PAGE_PREVIEW,
              label: "Локальная база",
              icon: "pi pi-fw pi-database",
            },

            {
              id: PAGE_NONE,
              label: "Шаблоны",
              icon: "pi pi-fw pi-sliders-h",
              items: [
                {
                  id: PAGE_TEMPLATE_GLOBAL,
                  label: "Основное",
                  icon: "pi pi-fw pi-globe",
                },

                {
                  id: PAGE_TEMPLATE_CATEGORIES,
                  label: "Для категорий",
                  icon: "pi pi-fw pi-folder",
                },
              ],
            },

            {
              id: PAGE_REPLACEMENT,
              label: "Замены",
              icon: "pi pi-fw pi-sync",
            },
          ],
        },

        {
          label: "Другое",
          items: [
            {
              id: PAGE_STATISTIC,
              label: "Статистика",
              icon: "pi pi-fw pi-chart-bar",
            },

            {
              id: PAGE_LOGS,
              label: "Логи",
              icon: "pi pi-fw pi-envelope",
            },
          ],
        },
      ],
    };
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