
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
 // import Expenses from './components/Expenses.vue';
require('./bootstrap');

window.Vue = require('vue');


import 'vue-material/dist/vue-material.min.css';
import 'vue-material/dist/theme/default.css';

import VueMaterial from 'vue-material'
import FullCalendar from 'vue-full-calendar'
import VueRouter from 'vue-router'
import Notifications from 'vue-notification'

Vue.use(VueMaterial)
Vue.use(FullCalendar)
Vue.use(VueRouter)
Vue.use(Notifications)


let routes = [
    { name: 'dashboard', path: '/dashboard', component: require('./components/Dashboard.vue') },
    { name: 'calendar', path: '/calendar', component: require('./components/Calendar.vue') },
    { name: 'expenses', path: '/expenses', component: require('./components/Expenses.vue') },

]

Vue.component('notification', require('./components/Notification.vue'));

const router = new VueRouter({
  mode: 'history',
  routes // short for `routes: routes`
})

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
  el: '#app',
  router
});
