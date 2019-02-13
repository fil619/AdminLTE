
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
 // import Expenses from './components/Expenses.vue';
require('./bootstrap');

window.Vue = require('vue');

import FullCalendar from 'vue-full-calendar'
import VueRouter from 'vue-router'
import Notifications from 'vue-notification'

Vue.use(FullCalendar)
Vue.use(VueRouter)
Vue.use(Notifications)


let routes = [
    { name: 'dashboard', path: '/dashboard', component: require('./components/Dashboard.vue') },
    { name: 'example', path: '/example', component: require('./components/Example.vue') },
    { name: 'expenses', path: '/expenses', component: require('./components/Expenses.vue') },

]

Vue.component('expenses', require('./components/Expenses.vue'));
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
