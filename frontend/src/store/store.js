import { createStore } from 'vuex'
import userModule from '@/store/modules/user';
import clientModule from '@/store/modules/clients';
import profileModule from '@/store/modules/profiles';
import router from '@/router'

const WHERE_SHOW_MENU = [
  'Profile'
];

export default createStore({
  modules: {
    user: userModule,
    clients: clientModule,
    profiles: profileModule
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
