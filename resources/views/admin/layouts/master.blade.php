{{-- @extends('admin.layouts.master')
@section('admin.content')
@endsection --}}

<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-theme="default" data-theme-colors="default">

<head>
    <meta charset="utf-8" />
    <title>Dashboard </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('admin.partials.assets.css')

</head>

<body class="dark-mode">
    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('admin.partials.header')
        <!-- ========== App Menu ========== -->
        @include('admin.partials.sidebar')
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay -->
        <div class="vertical-overlay"></div>
        <!-- Start right Content here -->
        @yield('admin.content')
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->
    <!--preloader-->

    @include('admin.partials.assets.js')

</body>

</html>
