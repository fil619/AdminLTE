
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
import 'vuetify/dist/vuetify.min.css';

import VueMaterial from 'vue-material'
import FullCalendar from 'vue-full-calendar'
import VueRouter from 'vue-router'
import Notifications from 'vue-notification'
import Vuelidate from 'vuelidate'
import Vuetify from 'vuetify'
import VueNativeNotification from 'vue-native-notification'


Vue.use(Vuelidate)
Vue.use(VueMaterial)
Vue.use(FullCalendar)
Vue.use(VueRouter)
Vue.use(Notifications)
Vue.use(Vuetify)
Vue.use(VueNativeNotification, {
  requestOnNotify: true
})

let routes = [
    { name: 'dashboard', path: '/dashboard', component: require('./components/Dashboard.vue') },
    { name: 'calendar', path: '/calendar', component: require('./components/Calendar.vue') },
    { name: 'directexpenses', path: '/directexpenses', component: require('./components/Expenses/DirectExpenses.vue') },
    { name: 'expenses', path: '/expenses', component: require('./components/Expenses/InExpenses.vue') },
    { name: 'ExpScreen', path: '/ExpScreen', component: require('./components/Expenses/ExpScreen.vue') },
    { name: 'DisplayExpenses', path: '/DisplayExpenses', component: require('./components/Expenses/DisplayExpenses.vue') },
    { name: 'Ledgers', path: '/Ledgers', component: require('./components/Ledgers.vue') },
    { name: 'liabilities', path: '/liabilities', component: require('./components/BalanceSheet/Liabilities.vue') },
    { name: 'assets', path: '/assets', component: require('./components/BalanceSheet/Assets.vue') },
    { name: 'DisplayBalance', path: '/DisplayBalance', component: require('./components/BalanceSheet/DisplayBalance.vue') },
    { name: 'profitloss', path: '/profitloss', component: require('./components/Profitloss.vue') },
    { name: 'createusers', path: '/createusers', component: require('./components/User/Create.vue') },
    { name: 'editusers', path: '/editusers', component: require('./components/User/Edit.vue') },
    { name: 'Attendance', path: '/Attendance', component: require('./components/User/Attendance.vue') },

]

Vue.component('notification', require('./components/Notification.vue'));
Vue.component('DispDirect', require('./components/Expenses/DispDirect.vue'));
Vue.component('DispInDirect', require('./components/Expenses/DispInDirect.vue'));
Vue.component('Calendar', require('./components/Calendar.vue'));
Vue.component('Depriciation', require('./components/BalanceSheet/Depriciation.vue'));


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
