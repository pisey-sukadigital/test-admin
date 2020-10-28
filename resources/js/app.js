require('./bootstrap');

window.Vue = require('vue');

import { HasError, AlertError } from 'vform'
import store from './store/index'
import VueRouter from 'vue-router'
import App from './components/App.vue';
import Breadcrumb from './components/breadcrumb/Breadcrumb.vue';
import MainSidebarContainer from './components/includes/MainSidebarContainer.vue';
import MainFooter from './components/includes/MainFooter.vue';



//Import Vue Filter
require('./filter');

//Import progressbar
require('./progressbar');

//Setup custom events 
require('./customEvents');

Vue.component(HasError.name, HasError, AlertError.name, AlertError)
Vue.use(VueRouter);

//Routes
import { routes } from './routes';

const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
})

const app = new Vue({
    el: "#app",
    components: {
        App,
        Breadcrumb,
        MainSidebarContainer,
        MainFooter
    },
    router,
    store
});