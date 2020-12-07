<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <router-link to="/" class="point">
            <div class="text-center">
                <img :src="'/img/logo/logotext.png'" width="250px" alt="Logo" class="brand-image"
            style="opacity: .8">
            </div>
        </router-link>
        
        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">               

                    <li v-for="item in items" :key="item.id" class="nav-item has-treeview"
                        v-bind:class="{'menu-open': subIsActive( item.children_link )}">

                        <template v-if="item.is_active == '1'">

                            <a v-if="item.link == '#' && getPemission(item.name)" href="#" class="nav-link">
                                <i class="nav-icon" v-bind:class="item.symbol"></i>
                                {{ item.display }} 
                                <i v-if="item.children && item.children.length > 0" class="right fas fa-angle-left"></i>
                            </a>

                            <router-link v-if="item.link != '#' && getPemission(item.name)" :to="{ path: item.link }" 
                            v-bind:class="{ 'nav-link': true }">
                                <i class="nav-icon" v-bind:class="item.symbol"></i>
                                <p>
                                    {{ item.display }} 
                                    <i v-if="item.children && item.children.length > 0" class="right fas fa-angle-left"></i>
                                </p>
                            </router-link>

                            <ul v-if="item.children && item.children.length > 0" class="nav nav-treeview"
                                v-bind:style="{ display: subIsActive( item.children_link ) ? 'block' : 'none'}">

                                <template v-for="children in item.children" >
                                    <li :key="children.id" v-if="getPemission(children.name) && children.is_active == '1'" class="nav-item"
                                    v-bind:class="{'nav-link router-link-exact-active router-link-active': subIsSelect( children.name )}">
                                        <router-link :to="{ path: children.link }" class="nav-link">
                                            <i class="nav-icon" v-bind:class="children.symbol"></i>
                                            {{ children.display }} 
                                        </router-link>
                                    </li>
                                 </template>
                            </ul>

                        </template>


                    </li>
                </ul>
            </nav>
        </div>
    </aside>
</template>

<script>
    import EventBus from '../../event-bus.js'
    export default {
        name: 'MainSidebarContainer',
        props: ['permissions'],
        data() {
            return {
                url: "/api/modules",
                body: this.permissions,
                items:[]
            }
        },
        mounted() {
           this.fetchDatas();

            EventBus.$on('reload-main-sidebar', function (data) {
                // this.$forceUpdate();
                // axios.get(window.location.origin + "/api/modules")
                //         .then(response => {
                //             this.items = response.data.data;
                //             // location.reload();
                //             toast.fire({
                //                 icon: 'success',
                //                 title: 'modual create successfully'
                //             });
                //         });
            });
        },

        methods: {
            
            subIsActive(input) {
                if(input == ""){ return false; }
                const paths = Array.isArray(input) ? input : [input];
               
                return paths.some(path => {  
                    return this.$route.path.indexOf(path) === 0 ; 
                })
            },
            subIsSelect(subMenu){
                return this.$route.path.includes("/"+subMenu);
            },
            getPemission(link){
                return (parseInt(this.permissions.indexOf(link)) >= 0);
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