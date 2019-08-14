/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
import App from './App.vue';
import VeeValidate from 'vee-validate';

//import BootstrapVue from 'bootstrap-vue';
import Toasted from 'vue-toasted';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import {router} from './_helpers'
import store from './store'
import {Interceptor} from './_helpers';

Vue.use(VueRouter);
//Vue.use(BootstrapVue);
Vue.use(VueSweetalert2);
Vue.use(VeeValidate, {
    fieldsBagName: 'veeFields'
});
Vue.use(Toasted, {
    duration: 2000,
    position: 'top-right'
});

Interceptor.request();

new Vue({
    router,
    store,
    App,
    render: h => h(App)
}).$mount('#app');
