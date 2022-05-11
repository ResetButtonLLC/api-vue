<template>
  <div class="layout-menu-container">
    <AppSubmenu
      :items="menuItems"
      class="layout-menu"
      :root="true"
      @menuitem-click="onMenuItemClick"
      :currentMenuItem="currentPage"
    />
  </div>
</template>

<script>
import AppSubmenu from "./AppSubmenu";
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
} from "../pages/Profile/const";

export default {
  props: {
    currentPage: Number,
  },

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
              id: PAGE_NONE,
              label: "Настройки",
              icon: "pi pi-fw pi-cog",
              items: [
                {
                  id: PAGE_SETTINGS_MAIN,
                  label: "Общие",
                  icon: "pi pi-fw pi-globe",
                },

                {
                  id: PAGE_SETTINGS_IMPORT,
                  label: "Импорт и фильтрация",
                  icon: "pi pi-fw pi-sitemap",
                },

                {
                  id: PAGE_CATEGORIES,
                  label: "Категории",
                  icon: "pi pi-fw pi-qrcode",
                },

                {
                  id: PAGE_SETTINGS_ADS_GENERATION,
                  label: "Генерация объявлений",
                  icon: "pi pi-fw pi-briefcase",
                },

                {
                  id: PAGE_SETTINGS_KEY_GENERATION,
                  label: "Генерация ключевых слов",
                  icon: "pi pi-fw pi-book",
                },

                {
                  id: PAGE_SETTINGS_AUTOUPDATE,
                  label: "Автообновления",
                  icon: "pi pi-fw pi-cloud-upload",
                },
              ],
            },

            {
              id: PAGE_PREVIEW,
              label: "Локальная база",
              icon: "pi pi-fw pi-database",
            },
          ],
        },
        {
          label: "Информация",
          items: [
            {
              id: PAGE_STATISTIC,
              label: "Статистика",
              icon: "pi pi-fw pi-chart-bar",
            },

            {
              id: PAGE_AUTOUPDATE_LOGS,
              label: "История автообновлений",
              icon: "pi pi-fw pi-calendar",
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
      if (event.item.id) {
        this.$emit("menuitem-click", event);
        this.$emit("hideMenu");
      }
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