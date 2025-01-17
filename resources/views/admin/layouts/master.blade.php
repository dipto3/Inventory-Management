{{-- @extends('admin.layouts.master')
@section('admin.content')
@endsection --}}

<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>
    <meta charset="utf-8" />
    <title>Dashboard </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    @include('admin.partials.assets.css')

</head>

<body>
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
