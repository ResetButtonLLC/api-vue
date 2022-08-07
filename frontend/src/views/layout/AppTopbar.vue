<template>
  <div class="layout-topbar">
    <router-link to="/">
      <img alt="Logo" src="@/assets/images/logo.png" />
    </router-link>
    <button v-if="isAuthorized && isCanToggleMenu" class="p-link layout-menu-button layout-topbar-button"
      @click="onMenuToggle">
      <i class="pi pi-bars"></i>
    </button>

    <button class="p-link layout-topbar-menu-button layout-topbar-button" v-styleclass="{
      selector: '@next',
      enterClass: 'hidden',
      enterActiveClass: 'scalein',
      leaveToClass: 'hidden',
      leaveActiveClass: 'fadeout',
      hideOnOutsideClick: true,
    }">
      <i class="pi pi-ellipsis-v"></i>
    </button>

    <ul v-if="isAuthorized" class="layout-topbar-menu hidden lg:flex origin-top">

      <li class="mr-4" @click="toAdminpanel">
        <i class="pi pi-id-card p-text-secondary mr-2"></i> <span class="p-text-secondary">Админ. панель</span>
      </li>


      <li class="mr-4" @click="toggleNotificationTable">
        <i v-if="userNotificationCount" class="pi pi-bell p-text-secondary" v-badge.danger="userNotificationCount"></i>
        <i v-else class="pi pi-bell p-text-secondary"></i>

        <OverlayPanel ref="notifypanel" appendTo="body" :showCloseIcon="true" class="mt-4" style="width: 450px">
          <DataTable v-if="userNotificationCount" :value="userNotifications" :paginator="true" :rows="5">
            <Column field="time" header="Время" :sortable="true"></Column>
            <Column field="description" header="Сообщение"></Column>
            <Column headerStyle="width: 4rem">
              <template #body="slotProps">
                <Button class="p-button-rounded p-button-danger" @click="hideNotification(slotProps.data.id)">
                  <span class="pi pi-times p-button-icon"></span>
                </Button>
              </template>
            </Column>
          </DataTable>

          <p v-else class="text-center">
            <span class="pi pi-info-circle"></span> Нет уведомлений
          </p>
        </OverlayPanel>
      </li>

      <li @click="toggleMenu">
        <img class="avatar" :src="userInfoAvatar" alt="avatar" />

        {{ userInfoName }}

        <Menu ref="menu" :model="overlayMenuItems" :popup="true" />
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    return {
      overlayMenuItems: [
        {
          label: "Выйти",
          icon: "pi pi-sign-out",
          command: () => {
            this.logout();
          },
        },
      ],
    };
  },

  methods: {
    hideNotification(id) {
      this.$store.dispatch("deleteNotification", id);
    },

    logout() {
      this.$store.dispatch("logout");
      window.location = "/logout";
    },

    toggleNotificationTable(event) {
      this.$refs.notifypanel.toggle(event);
    },

    toAdminpanel() {
      this.$store.dispatch('route', {
        name: "AdminPanel",
        params: {},
      });
    },

    toggleMenu(event) {
      this.$refs.menu.toggle(event);
    },

    onMenuToggle(event) {
      if (this.isCanToggleMenu) {
        this.$emit("menu-toggle", event);
      } else {
        event.preventDefault();
      }
    },
    onTopbarMenuToggle(event) {
      this.$emit("topbar-menu-toggle", event);
    },
  },
  computed: {
    isShowMenu() {
      return this.$store.getters.isShowMenu;
    },

    isShowAdminMenu() {
      return this.$store.getters.isShowAdminMenu;
    },

    isCanToggleMenu() {
      return this.isShowMenu || this.isShowAdminMenu;
    },

    isAuthorized() {
      return this.$store.getters.isAuthorized;
    },

    userInfoName() {
      return this.$store.getters.getUserName;
    },

    userInfoAvatar() {
      return this.$store.getters.getUserAvatar;
    },

    userNotificationCount() {
      return this.$store.getters.getNotificationCount;
    },

    userNotifications() {
      return this.$store.getters.getNotifications;
    },

    darkTheme() {
      return this.$appState.darkTheme;
    },
  },
};
</script>

<style scoped>
li {
  font-size: 1.4rem;
  display: flex;
  align-items: center;
  cursor: pointer;
  padding: 0.5rem;
  border-radius: 10px;
}

li i {
  font-size: 2rem;
}

li:hover {
  background-color: rgb(235, 235, 235);
}

.avatar {
  width: 32px;
  height: 32px;
  margin-right: 10px;
}
</style>