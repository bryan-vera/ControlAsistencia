/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import { Datetime } from 'vue-datetime'
import 'vue-datetime/dist/vue-datetime.css'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import { Settings } from 'luxon'
import VueSwal from 'vue-swal'
// If you don't need the styles, do not connect
// import 'sweetalert2/dist/sweetalert2.min.css';

// window.Swal = swal;

Settings.defaultLocale = 'es'
    // Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
// import 'resources/css/app.css'

Vue.use(VueSwal);
Vue.component('datetime', Datetime);
Vue.use(Vuetify)
    // Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
    // Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)
    // Use v-calendar & v-date-picker components
    // Vue.use(VCalendar, {
    //     componentPrefix: 'vc-calendar', // Use <vc-calendar /> instead of <v-calendar />
    // });
window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});