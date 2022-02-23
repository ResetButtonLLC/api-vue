import 'primevue/resources/primevue.min.css';
import 'primeflex/primeflex.css';
import 'primeicons/primeicons.css';
import 'prismjs/themes/prism-coy.css';
import './assets/styles/layout.scss';
import './assets/themes/lara-light-indigo/theme.css';

import { createApp, reactive } from 'vue';
import App from './views/layout/App.vue';
import store from './store/store'
import router from './router';
import PrimeVue from 'primevue/config';
import ConfirmationService from 'primevue/confirmationservice';
import ToastService from 'primevue/toastservice';
import theme from "@/components/themeComponents";

const app = createApp(App)
    .use(store)
    .use(router)
    .use(PrimeVue, { ripple: true, inputStyle: 'outlined' })
    .use(ConfirmationService)
    .use(ToastService);

app.config.globalProperties.$appState = reactive({theme: 'lara-light-indigo', darkTheme: false});

for (let name in theme.directives) {
    app.directive(name, theme.directives[name])
}
for (let name in theme.components) {
    app.component(name, theme.components[name])
}

app.mount('#app');