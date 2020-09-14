<template>

    <!-- Content Header (Page header) -->
        <!-- @include('layouts.includes.navbar') -->
        <!-- /.content-header -->

        <!-- Main Sidebar Container -->
        <!-- @include('layouts.includes.main-sidebar-container') -->
        <!-- /.Main Sidebar Container -->
    
        <!-- Content Wrapper. Contains page content -->
        <!-- <div class="content-wrapper pt-2"> -->
            <!-- Content Header (Page header) -->
            <!-- @include('layouts.includes.header') -->
            <!-- /.content-header -->

            <!-- Main content -->
             <router-view></router-view>
            <!-- /.content -->

        <!-- </div> -->
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <!-- @include('layouts.includes.control-sidebar') -->
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <!-- @include('layouts.includes.main-footer') -->
   
</template>
<script>
    export default {}
</script>