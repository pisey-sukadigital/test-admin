const Dashboard = () =>
    import ('./components/Dashboard.vue')
const Active = () =>
    import ('./components/starter-page/Active.vue')
const Inactive = () =>
    import ('./components/starter-page/Inactive.vue')
const Users = () =>
    import ('./components/Users.vue')
const Profile = () =>
    import ('./components/Profile.vue')

const Posts = () =>
    import ('./components/Posts.vue')

const Companys = () =>
    import ('./components/Companys.vue')

const NotFound = () =>
    import ('./components/NotFound.vue')

export const routes = [
    { path: '*', component: NotFound },
    { path: '/', component: Dashboard },
    { path: '/dashboard', component: Dashboard },
    { path: '/starter-page/active', component: Active },
    { path: '/starter-page/inactive', component: Inactive },
    { path: '/users', component: Users },
    { path: '/profile', component: Profile },
    { path: '/posts', component: Posts },
    { path: '/companys', component: Companys }
];