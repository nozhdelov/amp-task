import './bootstrap';

import { createApp } from 'vue'


import App from './components/App.vue';
import ChartComponent  from './components/Chart.vue';
import CustomSelector  from './components/CustomSelector.vue';
import NotificationControls  from './components/NotificationControls.vue';
import MessageBox  from './components/MessageBox.vue';

window.vueApp =  createApp(App);

vueApp.component('chart', ChartComponent);
vueApp.component('custom-selector', CustomSelector);
vueApp.component('notification-controls', NotificationControls);
vueApp.component('message-box', MessageBox);

window.vm = vueApp.mount('#vueApp');