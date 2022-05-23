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
          label: "Профиль",
          items: [
            {
              label: "Информация",
              icon: "pi pi-fw pi-info-circle",
              to: {
                name: 'Profile',
                params: { profileId: this.profileId },
              }
            },

            {
              label: "Настройки",
              icon: "pi pi-fw pi-cog",
              items: [
                {
                  label: "Общие",
                  icon: "pi pi-fw pi-globe",
                  to: {
                    name: 'ProfileSettingsMain',
                    params: { profileId: this.profileId },
                  }
                },

                {
                  label: "Импорт и фильтрация",
                  icon: "pi pi-fw pi-sitemap",
                  to: {
                    name: 'ProfileImportAndFilters',
                    params: { profileId: this.profileId },
                  }
                },

                {
                  label: "Категории",
                  icon: "pi pi-fw pi-qrcode",
                  to: {
                    name: 'ProfileCategories',
                    params: { profileId: this.profileId },
                  }
                },

                {
                  label: "Генерация объявлений",
                  icon: "pi pi-fw pi-briefcase",
                  to: {
                    name: 'ProfileGenerateAds',
                    params: { profileId: this.profileId },
                  }
                },

                {
                  label: "Генерация ключевых слов",
                  icon: "pi pi-fw pi-book",
                  to: {
                    name: 'ProfileGenerateKeywords',
                    params: { profileId: this.profileId },
                  }
                },

                {
                  label: "Автообновления",
                  icon: "pi pi-fw pi-cloud-upload",
                  to: {
                    name: 'ProfileAutoupdateSettings',
                    params: { profileId: this.profileId },
                  }
                },
              ],
            },

            {
              label: "Локальная база",
              icon: "pi pi-fw pi-database",
              to: {
                name: 'ProfilePreview',
                params: { profileId: this.profileId },
              }
            },
          ],
        },
        {
          label: "Информация",
          items: [
            {
              label: "Статистика",
              icon: "pi pi-fw pi-chart-bar",
              to: {
                name: 'ProfileStatistic',
                params: { profileId: this.profileId },
              }
            },

            {
              label: "История автообновлений",
              icon: "pi pi-fw pi-calendar",
              to: {
                name: 'ProfileAutoupdateLogs',
                params: { profileId: this.profileId },
              }
            },

            {
              label: "Логи",
              icon: "pi pi-fw pi-envelope",
              to: {
                name: 'ProfileLogs',
                params: { profileId: this.profileId },
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