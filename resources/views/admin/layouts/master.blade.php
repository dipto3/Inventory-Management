<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>E-Commerce Admin Dashboard</title>
    @include('admin.partials.assets.css')
</head>

<body>
    <div class="">
        <!-- Sidebar -->
        @include('admin.partials.sidebar')

        <!-- Main Content -->
        <div class="main-content" id="main-content">
            <!-- Top Navigation with custom dropdown -->
            @include('admin.partials.header')

            <!-- Main Content Body -->
            <div class="container-fluid">
                @yield('admin.content')
            </div>
        </div>
    </div>

    @include('admin.partials.assets.js')
</body>

</html>
