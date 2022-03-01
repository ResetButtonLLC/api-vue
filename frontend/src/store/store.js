import { createStore } from 'vuex'
import userModule from '@/store/modules/user';
import clientModule from '@/store/modules/clients';
import router from '@/router'

export default createStore({
  modules: {
    user: userModule,
    clients: clientModule,
  },

  actions: {
    error(context, errorText) {
      router.push({
        name: "ErrorPage",
        params: { text: errorText },
      });
    }
  }
})
