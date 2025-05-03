<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopEasy - Your One-Stop Shopping Destination</title>
    @include('frontend.partials.assets.css')
</head>

<body>
    <!-- Top Bar -->
    @include('frontend.partials.header')
    @yield('frontend.content')
    <!-- Footer -->
    @include('frontend.partials.footer')
    <!-- Back to Top Button -->
    <a href="#" class="back-to-top">
        <i class="fas fa-arrow-up"></i>
    </a>
    @include('frontend.partials.assets.js')
</body>

</html>
