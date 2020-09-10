<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Laravel adminlte vue</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
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
            {{--  @include('layouts.includes.header')  --}}
            <!-- /.content-header -->

            <!-- Main content -->
                <router-view></router-view>
            <!-- /.content -->
        
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        @include('layouts.includes.control-sidebar')
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        @include('layouts.includes.main-footer')
    
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
