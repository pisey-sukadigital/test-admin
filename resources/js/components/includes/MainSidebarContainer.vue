<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <router-link to="/" class="point">
            <div class="text-center">
                <img :src="'/img/logo/logotext.png'" width="250px" alt="Logo" class="brand-image"
            style="opacity: .8">
            </div>
        </router-link>
        
        <!-- Sidebar -->
        <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            
            <li class="nav-item">
                <router-link to="/dashboard" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
                </router-link>
            </li>

            <li class="nav-item has-treeview" 
                v-bind:class="{'menu-open': subIsActive([
                '/player/create','/player/list'
                ]) }">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p> Account Management <i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview" 
                v-bind:style="{ display: subIsActive([
                '/player/create','/player/list'
                ]) ? 'block' : 'none'}">
                    <li class="nav-item">
                        <router-link to="/player/create" class="nav-link pl-5">
                            <p>Add Player</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/player/list" class="nav-link pl-5">
                            <p>Player List</p>
                        </router-link>
                    </li>
                </ul>
            </li>

            <li class="nav-item has-treeview"
                 v-bind:class="{ 'menu-open': subIsActive([
                '/referral/list','/referral/history','/referral/transaction'
                ]) }">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p> Referral <i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview"
                v-bind:style="{ display: subIsActive([
                 '/referral/list','/referral/history','/referral/transaction'
                ]) ? 'block' : 'none'}">
                    <li class="nav-item">
                        <router-link to="/referral/list" class="nav-link pl-5">
                            <p>Referral Name</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/referral/history" class="nav-link pl-5">
                            <p>History</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/referral/transaction" class="nav-link pl-5">
                            <p>Transaction</p>
                        </router-link>
                    </li>
                </ul>
            </li>

            <li class="nav-item has-treeview" 
                v-bind:class="{ 'menu-open': subIsActive([
                '/rakeback/limit','/rakeback/history','/rakeback/running-bet'
                ]) }">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p> RakeBack <i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview"
                v-bind:style="{ display: subIsActive([
                '/rakeback/limit','/rakeback/history','/rakeback/running-bet'
                ]) ? 'block' : 'none'}">
                    <li class="nav-item">
                        <router-link to="/rakeback/limit" class="nav-link pl-5">
                            <p>RakeBack Limit</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/rakeback/history" class="nav-link pl-5">
                            <p>History</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/rakeback/running-bet" class="nav-link pl-5">
                            <p>Running Bet</p>
                        </router-link>
                    </li>
                </ul>
            </li>

            <li class="nav-item has-treeview"
                v-bind:class="{ 'menu-open': subIsActive([
                '/report/player/transaction','/report/player/running-bet',
                '/report/player/winlost','/report/player/daily',
                '/report/player/month','/report/player/history-coin',
                '/report/player/history-coin','/report/player/history-operator',
                '/report/player/jackport','/report/player/bonus'
                ]) }">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p> Report <i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview"
                v-bind:style="{ display: subIsActive([
                '/report/player/transaction','/report/player/running-bet',
                '/report/player/winlost','/report/player/daily',
                '/report/player/month','/report/player/history-coin',
                '/report/player/history-coin','/report/player/history-operator',
                '/report/player/jackport','/report/player/bonus'
                ]) ? 'block' : 'none'}">
                    <li class="nav-item">
                        <router-link to="/report/player/transaction" class="nav-link pl-5">
                            <p>Player Transaction</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/report/player/running-bet" class="nav-link pl-5">
                            <p>Running Bet</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/report/player/winlost" class="nav-link pl-5">
                            <p>Win \ Lose</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/report/player/daily" class="nav-link pl-5">
                            <p>Daily Player Report Bet</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/report/player/month" class="nav-link pl-5">
                            <p>Monthly Report </p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/report/player/history-coin" class="nav-link pl-5">
                            <p>Histry Coin</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/report/player/history-operator" class="nav-link pl-5">
                            <p>Histry Operator</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/report/player/jackport" class="nav-link pl-5">
                            <p>Jackport</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/report/player/bonus" class="nav-link pl-5">
                            <p>Bonus</p>
                        </router-link>
                    </li>
                </ul>
            </li>

            <li class="nav-item has-treeview"
                v-bind:class="{ 'menu-open': subIsActive([
                '/tools/memo','/tools/online','/tools/game','/tools/statistic'
                ]) }">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p> Tools <i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview"
                v-bind:style="{ display: subIsActive([
                 '/tools/memo','/tools/online','/tools/game','/tools/statistic'
                ]) ? 'block' : 'none'}">
                    <li class="nav-item">
                        <router-link to="/tools/memo" class="nav-link pl-5">
                            <p>Memo</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/tools/online" class="nav-link pl-5">
                            <p>Online List</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/tools/game" class="nav-link pl-5">
                            <p>Game Control</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/tools/statistic" class="nav-link pl-5">
                            <p>Statistic</p>
                        </router-link>
                    </li>
                </ul>
            </li>

            <li class="nav-item has-treeview"
                v-bind:class="{ 'menu-open': subIsActive([
                '/log/agent','/log/player','/log/downline'
                ]) }">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p> Log <i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview"
                 v-bind:style="{ display: subIsActive([
                '/log/agent','/log/player','/log/downline'
                ]) ? 'block' : 'none'}">
                    <li class="nav-item">
                        <router-link to="/log/agent" class="nav-link">
                            <p>Agent Log</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/log/player" class="nav-link">
                            <p>Player Log</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/log/downline" class="nav-link">
                            <p>Downline Log</p>
                        </router-link>
                    </li>
                </ul>
            </li>

             <li class="nav-item has-treeview">
                <router-link to="/users" class="nav-link">
                    <p>users</p>
                </router-link>
            </li>

            <li class="nav-item has-treeview">
                <router-link to="/posts" class="nav-link">
                    <p>posts</p>
                </router-link>
            </li>

            <li class="nav-item has-treeview">
                <router-link to="/companys" class="nav-link">
                    <p>Companys</p>
                </router-link>
            </li>
                
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</template>

<script>
    export default {
        name: 'MainSidebarContainer',
        mounted() {
           
        },
        methods: {
            subIsActive(input) {
                const paths = Array.isArray(input) ? input : [input]
                return paths.some(path => {  
                return this.$route.path.indexOf(path) === 0 // current path starts with this path string
                })
            }
        }
    }
</script>