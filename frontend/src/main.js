import { createApp } from 'vue'

import App from './App.vue'
import router from './router'

// Create the Vue application
const app = createApp(App)

// Install router functionality
app.use(router)

// Attach Vue to the page
app.mount('#app')