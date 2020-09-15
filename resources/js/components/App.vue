<template>
    <!-- Main content -->
        <router-view></router-view>
    <!-- /.content -->

</template>
<script>
    // import Navbar from './includes/navbar.vue'
    export default {
        mounted() {
            console.log(this.$route);
            // console.log(parent_msg);
        }
    }
</script>