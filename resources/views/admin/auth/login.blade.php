<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce Admin Login</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/login-style.css') }}">

</head>

<body class="login-body">
    <!-- Animated background particles -->
    <div class="particles" id="particles"></div>

    <!-- Theme toggle button -->
    <button class="theme-toggle" id="themeToggle">
        <i class="bi" id="themeIcon"></i>
    </button>

    <!-- Login container -->
    <div class="login-container animate__animated animate__fadeIn">
        <div class="login-header">
            <i class="bi bi-shop login-logo"></i>
            <h2>Admin Dashboard</h2>
            <p>Sign in to access your account</p>
        </div>

        <form action="{{ route('authenticate') }}" method="POST">
            @csrf
            <div class="floating-label">
                <input type="email" name="email" class="form-control" id="email" placeholder=" " required>
                <label for="email">Email Address</label>
            </div>

            <div class="floating-label">
                <input type="password" class="form-control" id="password" name="password" placeholder=" " required>
                <label for="password">Password</label>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>
                <a href="#" class="text-white">Forgot password?</a>
            </div>

            <button type="submit" class="btn btn-login">
                <i class="bi bi-box-arrow-in-right me-2"></i>Login
            </button>

            <div class="login-footer mt-4">
                <p>Don't have an account? <a href="#">Contact administrator</a></p>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('admin/js/login.js') }}"></script>
</body>
</html>
