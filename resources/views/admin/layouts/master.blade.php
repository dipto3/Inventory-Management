<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="POS - Bootstrap Admin Template">
    <meta name="keywords"
        content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>Dreams Pos Admin Template</title>

    @include('admin.partials.assets.css')

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <style>
        /* Custom Toastr styling */
        #toast-container {
            font-family: 'Arial', sans-serif;
            position: fixed;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            max-width: 600px; /* Increased max-width */
            padding: 0 20px 20px;
            box-sizing: border-box;
        }
        #toast-container > div {
            opacity: 1;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
            border-radius: 4px 4px 0 0;
            width: 100%; /* Set to 100% to use full container width */
            max-width: none; /* Remove max-width constraint */
            text-align: center;
            padding: 15px 20px;
            margin-bottom: 0;
            font-size: 16px; /* Slightly larger font size */
        }
        #toast-container > .toast-success {
            background-color: #4CAF50;
        }
        #toast-container > .toast-error {
            background-color: #F44336;
        }
        #toast-container > .toast-info {
            background-color: #2196F3;
        }
        #toast-container > .toast-warning {
            background-color: #FFC107;
        }
    </style>
</head>

<body>
    <main>
        @yield('content')
    </main>
    <!-- <div id="global-loader">
        <div class="whirly-loader"> </div>
    </div> -->

    <div class="main-wrapper">

        @include('admin.partials.header')


        @include('admin.partials.sidebar')

        @yield('admin.content')

    </div>
    @include('admin.partials.assets.js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        console.log('Toastr loaded:', typeof toastr !== 'undefined');
        console.log('jQuery loaded:', typeof jQuery !== 'undefined');
    </script>
    <script>
        // Toastr configuration
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": null, // We're using custom positioning
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        // Display Toastr messages
        @if(session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if(session('error'))
            toastr.error("{{ session('error') }}");
        @endif

        @if(session('info'))
            toastr.info("{{ session('info') }}");
        @endif

        @if(session('warning'))
            toastr.warning("{{ session('warning') }}");
        @endif

        // Display validation errors
        @if($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif
    </script>
    @yield('scripts')
</body>

</html>
