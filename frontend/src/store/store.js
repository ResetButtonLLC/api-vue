import { createStore } from 'vuex'
import userModule from '@/store/modules/user';
import projectModule from '@/store/modules/projects';
import categoryModule from '@/store/modules/categories';
import campaignModule from '@/store/modules/campaigns';
import templateModule from '@/store/modules/templates';
import replacementModule from '@/store/modules/replacements';
import router from '@/router'

const WHERE_SHOW_MENU = [
  'Profile'
];

export default createStore({
  modules: {
    user: userModule,
    projects: projectModule,
    categories: categoryModule,
    campaigns: campaignModule,
    templates: templateModule,
    replacements: replacementModule
  },

  actions: {
    error(context, errorText) {
      router.push({
        name: "ErrorPage",
        params: { text: errorText },
      });
    },

    route(context, { name, params }) {
      router.push({
        name: name,
        params: params,
      });
    },


  },

  getters: {
    isShowMenu() {
      return WHERE_SHOW_MENU.includes(router.currentRoute.value.name);
    },
  }
})
