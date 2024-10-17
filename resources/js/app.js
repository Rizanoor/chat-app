import './bootstrap';

import { createApp } from 'vue'
import ChatComponent from './components/ChatComponent.vue';
import ContactComponent from './components/ContactComponent.vue'
import DashboardComponent from './components/DashboardComponent.vue'

const app = createApp({});

app.component('chat-component', ChatComponent);
app.component('contact-component', ContactComponent);
app.component('dashboard-component', DashboardComponent);
app.mount('#app');