require('./bootstrap');

import Vue from 'vue'
import { Form, HasError, AlertError } from 'vform'
import store from './store/index'
import swal from 'sweetalert2'
import VueRouter from 'vue-router'
import { routes } from './routes';
import App from './components/App.vue';
import Breadcrumb from './components/includes/Breadcrumb.vue';
import MainSidebarContainer from './components/includes/MainSidebarContainer.vue';
import MainFooter from './components/includes/MainFooter.vue';
import Navbar from './components/includes/Navbar.vue';

window.Vue = require('vue');
window.Form = Form;
window.swal = swal;
window.Fire = new Vue();

const toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', swal.stopTimer)
        toast.addEventListener('mouseleave', swal.resumeTimer)
    }
})

window.toast = toast;

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component('pagination', require('laravel-vue-pagination'));

// Vue.component('select-company', require('./components/company/SelectCompany.vue'))

Vue.use(VueRouter);

//Import progressbar
require('./progressbar');

//Import Vue Filter
require('./filter');

const router = new VueRouter({
    mode: 'history',
    routes
})

const app = new Vue({
    el: "#app",
    components: {
        App,
        Breadcrumb,
        MainSidebarContainer,
        MainFooter,
        Navbar
    },
    router,
    store
});