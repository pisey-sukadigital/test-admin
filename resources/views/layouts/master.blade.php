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
<body class="hold-transition sidebar-mini">
    <div id="app" class="wrapper">
        <!-- Content Header (Page header) -->
            {{--  <navbar></navbar>  --}}
        @include('layouts.includes.navbar')
        <!-- /.content-header -->

        <!-- Main Sidebar Container -->
            {{--  <main-sidebar-container></main-sidebar-container>  --}}
        @include('layouts.includes.main-sidebar-container')
        <!-- /.Main Sidebar Container -->
    
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper pt-2">
            <!-- Content Header (Page header) -->
            {{--  <header-page></header-page>  --}}
            @include('layouts.includes.header')
            <!-- /.content-header -->

            {{--  <div id="app">  --}}
                <app></app>
            {{--  </div>  --}}
            
            <!-- Main content -->
                {{--  <router-view></router-view>  --}}
            <!-- /.content -->

            {{--  <app></app>  --}}

        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        {{--  <control-sidebar></control-sidebar>  --}}
        @include('layouts.includes.control-sidebar')
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        {{--  <main-footer></main-footer>  --}}
        @include('layouts.includes.main-footer')

        <vue-progress-bar></vue-progress-bar>
    
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <script src="{{ mix('js/app.js') }}" defer></script>

</body>
</html>
