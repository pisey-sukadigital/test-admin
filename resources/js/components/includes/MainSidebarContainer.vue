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

                <li v-for="item in items" :key="item.id" class="nav-item has-treeview"
                    v-bind:class="{'menu-open': subIsActive( item.children_link )}">

                    <a v-if="item.link == '#'"  href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        {{ item.display }} 
                        <i v-if="item.children && item.children.length > 0" class="right fas fa-angle-left"></i>
                    </a>

                    <router-link v-if="item.link != '#' && getPemission(item.name)" :to="{ path: item.link }" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{ item.display }}
                            <i v-if="item.children && item.children.length > 0" class="right fas fa-angle-left"></i>
                        </p>
                    </router-link>

                    <ul v-if="item.children && item.children.length > 0" class="nav nav-treeview"
                        v-bind:style="{ display: subIsActive( item.children_link ) ? 'block' : 'none'}">

                        <li v-for="children in item.children" :key="children.id" v-if="getPemission(children.name)" class="nav-item">
                            <router-link :to="{ path: children.link }" class="nav-link pl-5">
                                {{ children.display }}
                            </router-link>
                        </li>
                    </ul>
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
        props: ['permissions'],
        data() {
            return {
                url: "/api/modules/all",
                body: this.permissions,
                items:[]
            }
        },
        mounted() {
           this.fetchDatas();
        },

        methods: {
            subIsActive(input) {
                if(input == ""){ return false; }
                const paths = Array.isArray(input) ? input : [input]
                return paths.some(path => {  
                    return this.$route.path.indexOf(path) === 0 ; 
                })
            },
            getPemission(link){
                this.permissions.indexOf(link);
                return true;
            },
            fetchDatas() {
                axios.get(window.location.origin + this.url)
                    .then(response => {
                        this.items = response.data.data;
                    }).catch(err => {
                        console.log("error select-all-role"); 
                });
            }
        }
    }
</script>