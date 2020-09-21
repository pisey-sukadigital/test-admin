require('./bootstrap');

window.Vue = require('vue');

import { Form, HasError, AlertError } from 'vform'
import VueProgressBar from "vue-progressbar";
import store from './store/index'
import moment from 'moment';
import swal from 'sweetalert2'
import VueRouter from 'vue-router'
import App from './components/App.vue';
import Dashboard from './components/Dashboard.vue';
import Active from './components/starter-page/Active.vue';
import Inactive from './components/starter-page/Inactive.vue';
import Users from './components/Users.vue';
import Profile from './components/Profile.vue';

// import Posts from './components/Posts.vue';
const Posts = () =>
    import ('./components/Posts.vue')

import Companys from "./components/Companys.vue";
import NotFound from './components/NotFound.vue';

window.Form = Form;
window.swal = swal;

window.Fire = new Vue();

const toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', swal.stopTimer)
        toast.addEventListener('mouseleave', swal.resumeTimer)
    }
})

window.toast = toast;

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component('pagination', require('laravel-vue-pagination'));

Vue.use(VueRouter);
Vue.use(VueProgressBar, {
    color: 'yellow',
    failedColor: "#874b4b",
    thickness: "5px",
    transition: {
        speed: "0.2s",
        opacity: "0.6s",
        termination: 300
    },
    autoRevert: true,
    inverse: false
});


const routes = [{
        path: '*',
        component: NotFound
    },
    {
        path: '/',
        component: Dashboard
    },
    {
        path: '/dashboard',
        component: Dashboard
    },
    {
        path: '/starter-page/active',
        component: Active
    },
    {
        path: '/starter-page/inactive',
        component: Inactive
    },
    {
        path: '/users',
        component: Users
    },
    {
        path: '/profile',
        component: Profile
    },
    {
        path: '/posts',
        component: Posts
    },
    {
        path: '/companys',
        component: Companys
    }
]

const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
})

Vue.filter('myDate', function(created) {
    return moment(created).format('MMMM Do YYYY, h:mm:ss a');
});

const app = new Vue({
    el: "#app",
    components: {
        App
    },
    router,
    store
});