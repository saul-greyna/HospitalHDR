import { createApp } from 'vue'
import App from './App.vue'
import router from './router/index.js'
import { cookiePlugin } from './composables/useCookies.js'

createApp(App)
    .use(router)
    .use(cookiePlugin) 
    .mount('#app')
