<template>
  <div :class="containerClass" v-if="!isLoginProcess">
    <AppTopBar @menu-toggle="onMenuToggle" />

    <div class="layout-sidebar">
      <AppMenu v-if="isShowMenu" @menuitem-click="onMenuItemClick" @hideMenu="$emit('hideMenu')" />
      <AppAdminMenu v-if="isShowAdminMenu" @menuitem-click="onMenuItemClick" @hideMenu="$emit('hideMenu')" />
    </div>

    <div class="layout-main-container">
      <div class="layout-main">
        <Toast />
        <router-view :key="$route.fullPath" @hideMenu="hideMenu" />
      </div>
      <AppFooter />
    </div>

    <transition name="layout-mask">
      <div class="layout-mask p-component-overlay" v-if="mobileMenuActive" @click="hideMenu"></div>
    </transition>
  </div>

  <div v-else class="loading">
    <div>
      <h1>Подождите. Происходит авторизация.</h1>
      <i class="pi pi-spin pi-spinner" style="font-size: 3rem"></i>
    </div>
  </div>
</template>

<script>
import AppTopBar from "./AppTopbar.vue";
import AppFooter from "./AppFooter.vue";
import AppMenu from "./AppMenu.vue";
import AppAdminMenu from "./AppAdminMenu.vue";

export default {
  created() {
    this.$store.dispatch("updateUserInfo");
    this.$store.dispatch("loadProjects");
  },

  data() {
    return {
      layoutMode: "static",
      staticMenuInactive: false,
      overlayMenuActive: false,
      mobileMenuActive: false,
    };
  },
  watch: {
    $route() {
      this.menuActive = false;
      this.$toast.removeAllGroups();
    },
  },
  methods: {
    hideMenu() {
      this.overlayMenuActive = false;
      this.mobileMenuActive = false;
    },
    onMenuToggle() {
      this.menuClick = true;

      if (this.isDesktop()) {
        if (this.layoutMode === "overlay") {
          if (this.mobileMenuActive === true) {
            this.overlayMenuActive = true;
          }

          this.overlayMenuActive = !this.overlayMenuActive;
          this.mobileMenuActive = false;
        } else if (this.layoutMode === "static") {
          this.staticMenuInactive = !this.staticMenuInactive;
        }
      } else {
        this.mobileMenuActive = !this.mobileMenuActive;
      }

      event.preventDefault();
    },

    onMenuItemClick(event) {
      if (event.item && !event.item.items) {
        this.overlayMenuActive = false;
        this.mobileMenuActive = false;
      }
    },
    onLayoutChange(layoutMode) {
      this.layoutMode = layoutMode;
    },
    addClass(element, className) {
      if (element.classList) element.classList.add(className);
      else element.className += " " + className;
    },
    removeClass(element, className) {
      if (element.classList) element.classList.remove(className);
      else
        element.className = element.className.replace(
          new RegExp(
            "(^|\\b)" + className.split(" ").join("|") + "(\\b|$)",
            "gi"
          ),
          " "
        );
    },
    isDesktop() {
      return window.innerWidth >= 992;
    },
    isSidebarVisible() {
      if (this.isDesktop()) {
        if (this.layoutMode === "static") return !this.staticMenuInactive;
        else if (this.layoutMode === "overlay") return this.overlayMenuActive;
      }

      return true;
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

    isLoginProcess() {
      return this.$store.getters.isLoginProcess;
    },

    isAuthorized() {
      return this.$store.getters.isAuthorized;
    },

    containerClass() {
      return [
        "layout-wrapper",
        {
          "layout-overlay": this.layoutMode === "overlay",
          "layout-static": this.layoutMode === "static",
          "layout-static-sidebar-inactive":
            !this.isAuthorized ||
            !this.isCanToggleMenu ||
            (this.staticMenuInactive && this.layoutMode === "static"),
          "layout-overlay-sidebar-active":
            this.overlayMenuActive && this.layoutMode === "overlay",
          "layout-mobile-sidebar-active": this.mobileMenuActive,
          "p-input-filled": this.$primevue.config.inputStyle === "filled",
          "p-ripple-disabled": this.$primevue.config.ripple === false,
          "layout-theme-light": this.$appState.theme.startsWith("saga"),
        },
      ];
    },
    logo() {
      return this.$appState.darkTheme
        ? "images/logo-white.svg"
        : "images/logo.svg";
    },
  },
  beforeUpdate() {
    if (this.mobileMenuActive)
      this.addClass(document.body, "body-overflow-hidden");
    else this.removeClass(document.body, "body-overflow-hidden");
  },
  components: {
    AppTopBar: AppTopBar,
    AppFooter: AppFooter,
    AppMenu,
    AppAdminMenu
  },
};
</script>

<style lang="scss">
@import "../../assets/styles/app";

.loading {
  display: flex;
  text-align: center;
  justify-content: center;
  height: 100vh;
  align-items: center;
}

.p-tooltip {
  max-width: 30rem;
}
</style>

<style>
.switch {
  flex: 1;
  display: flex;
}

.switch label {
  align-self: center;
  margin-left: 10px;
}

.savebtn {
  display: flex;
  justify-content: center;
}

.infobox {
  display: flex;
  align-items: center;
  width: 100%;
}

.infobox i {
  font-size: 1.4rem;
  color: var(--blue-400);
}

.infobox .p-float-label {
  flex: 1;
  margin-right: 10px;
}
</style>