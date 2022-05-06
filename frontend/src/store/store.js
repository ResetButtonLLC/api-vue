import { createStore } from 'vuex'
import userModule from '@/store/modules/user';
import projectModule from '@/store/modules/projects';
import profileModule from '@/store/modules/profiles';
import router from '@/router'

export default createStore({
  modules: {
    user: userModule,
    projects: projectModule,
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
    }
  }
})
