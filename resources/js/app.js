require('./bootstrap');

import { Form, HasError, AlertError } from 'vform'
import VueProgressBar from "vue-progressbar";
import store from './store/index'
import moment from 'moment';
import swal from 'sweetalert2'
import VueRouter from 'vue-router'
import { routes } from './routes';

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
Vue.use(VueRouter);

const VueProgressBarOptoin = {
    color: 'yellow',
    failedColor: "red",
    thickness: "5px",
    transition: {
        speed: "0.2s",
        opacity: "0.6s",
        termination: 300
    },
    autoRevert: true,
    inverse: false
};
Vue.use(VueProgressBar, VueProgressBarOptoin);

Vue.filter('myDate', function(created) {
    return moment(created).format('MMMM Do YYYY, h:mm:ss a');
});

const router = new VueRouter({
    mode: 'history',
    routes
})

const App = () =>
    import ('./components/App.vue')

const app = new Vue({
    el: "#app",
    components: {
        App
    },
    router,
    store
});