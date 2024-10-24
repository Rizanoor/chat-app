import './bootstrap';

import { createApp } from 'vue'
import ChatComponent from './components/ChatComponent.vue';
import ContactComponent from './components/ContactComponent.vue';
import DashboardComponent from './components/DashboardComponent.vue';
import GroupsComponent from './components/GroupsComponent.vue';
import GroupschatComponent from './components/GroupschatComponent.vue';
import StatusComponent from './components/StatusComponent.vue';
import FindPartnerComponent from './components/FindPartnerComponent.vue';
import IndexComponent from './components/IndexComponent.vue';

const app = createApp({});

app.component('chat-component', ChatComponent);
app.component('contact-component', ContactComponent);
app.component('dashboard-component', DashboardComponent);
app.component('groups-component', GroupsComponent);
app.component('groupschat-component', GroupschatComponent);
app.component('status-component', StatusComponent);
app.component('find-partner-component', FindPartnerComponent);
app.component('index-component', IndexComponent);
app.mount('#app');