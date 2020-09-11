/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import { Form, HasError, AlertError } from 'vform'

window.Form = Form;

import store from './store/index'

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

import VueRouter from 'vue-router'
import Dashboard from './components/Dashboard.vue';
import Active from './components/starter-page/Active.vue';
import Inactive from './components/starter-page/Inactive.vue';
import Users from './components/Users.vue';
import Profile from './components/Profile.vue';
import Posts from './components/Posts.vue';
import Companys from './components/Companys.vue';

import NotFoundComponent from './components/NotFoundComponent.vue';



Vue.use(VueRouter)

const routes = [{
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
    // routes: [{
    //         path: '*',
    //         component: NotFoundComponent
    //     }]
    routes // short for `routes: routes`
})

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
    store
});