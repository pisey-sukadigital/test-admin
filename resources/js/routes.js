import App from './components/App.vue';
import Dashboard from './components/Dashboard.vue';
import Active from './components/starter-page/Active.vue';
import Inactive from './components/starter-page/Inactive.vue';
import Users from './components/Users.vue';
import Profile from './components/Profile.vue';
import Posts from './components/Posts.vue';
import Companys from "./components/Companys.vue";
import NotFound from './components/NotFound.vue';

export const routes = [{
        path: '*', component: NotFound
    },{
        path: '/', component: Dashboard
    },{
        path: '/dashboard', component: Dashboard
    },{
        path: '/starter-page/active', component: Active
    },{
        path: '/starter-page/inactive', component: Inactive
    },{
        path: '/users', component: Users
    },{
        path: '/profile', component: Profile
    },{
        path: '/posts', component: Posts
    },{
        path: '/companys', component: Companys
    }
]