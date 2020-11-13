<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token()}}">
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">
    <title>Laravel adminlte vue</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
    <div id="app" class="wrapper">
        <!-- Content Header (Page header) -->
        <navbar :user="{{ Auth::user() }}"></navbar>
        <!-- /.content-header -->

        <!-- Main Sidebar Container -->
        <main-sidebar-container :permissions="{{ json_encode(Auth::user()->allPermissions, true) }}"></main-sidebar-container>
        <!-- /.Main Sidebar Container -->
    
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper pt-2">
            <!-- Content Header (Page header) -->
            <breadcrumb></breadcrumb>
            <!-- /.content-header -->
            
            <!-- Main content -->
            
            <app></app>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <main-footer></main-footer>
        <!-- ./Main Footer -->

        <vue-progress-bar></vue-progress-bar>

    </div>
    <!-- ./wrapper -->
    <script>
        @auth
            window.Permissions = {!! json_encode(Auth::user()->allPermissions, true) !!};
        @else
            window.Permissions = [];
        @endauth
    </script> 

    <!-- REQUIRED SCRIPTS -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    
</body>
</html>