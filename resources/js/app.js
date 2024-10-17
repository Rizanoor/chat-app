import './bootstrap';

import { createApp } from 'vue'
import ChatComponent from './components/ChatComponent.vue';
import ContactComponent from './components/ContactComponent.vue'

const app = createApp({});

app.component('chat-component', ChatComponent);
app.component('contact-component', ContactComponent);
app.mount('#app');