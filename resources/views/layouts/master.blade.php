<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">

    <title>Laravel adminlte vue</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div id="app" class="wrapper">
        <!-- Content Header (Page header) -->
        @include('layouts.includes.navbar')
        <!-- /.content-header -->

        <!-- Main Sidebar Container -->
        @include('layouts.includes.main-sidebar-container')
        <!-- /.Main Sidebar Container -->
    
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper pt-2">
            <!-- Content Header (Page header) -->
            @include('layouts.includes.header')
            <!-- /.content-header -->
              
            <!-- Main content -->
            <app></app>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        @include('layouts.includes.control-sidebar')
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        @include('layouts.includes.main-footer')
        <vue-progress-bar></vue-progress-bar>
    
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <script src="{{ mix('js/app.js') }}" defer></script>

</body>
</html>
