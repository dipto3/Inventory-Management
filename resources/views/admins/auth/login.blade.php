<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Login - Pos admin</title>

    @include('admin.partials.assets.css')
</head>

<body class="account-page">


    <div class="main-wrapper">
        <div class="account-content">
            <div class="login-wrapper login-new">
                <div class="container">
                    <div class="login-content user-login">
                        <div class="login-logo">
                            <img src="https://dreamspos.dreamstechnologies.com/html/template/assets/img/logo.png"
                                alt="img">
                            <a href="" class="login-logo logo-white">
                                <img src="https://dreamspos.dreamstechnologies.com/html/template/assets/img/logo-white.png"
                                    alt>
                            </a>
                        </div>
                        <form action="{{ route('authenticate') }}" method="POST">
                            @csrf
                            <div class="login-userset">
                                <div class="login-userheading">
                                    <h3>Sign In</h3>
                                    <h4>Access the Dreamspos panel using your email and passcode.</h4>
                                </div>
                                <div class="form-login">
                                    <label class="form-label">Email Address</label>
                                    <div class="form-addons">
                                        <input type="text" class="form-control" name="email">

                                        <img src="https://dreamspos.dreamstechnologies.com/html/template/assets/img/icons/mail.svg"
                                            alt="img">
                                    </div>
                                </div>
                                <div class="form-login">
                                    <label>Password</label>
                                    <div class="pass-group">
                                        <input type="password" class="pass-input" name="password">
                                        <span class="fas toggle-password fa-eye-slash"></span>
                                    </div>
                                </div>
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-login authentication-check">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="custom-control custom-checkbox">
                                                <label class="checkboxs ps-4 mb-0 pb-0 line-height-1">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>Remember me
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-6 text-end">
                                            <a class="forgot-link" href="">Forgot
                                                Password?</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-login">
                                    <button class="btn btn-login" type="submit">Sign In</button>
                                </div>
                                {{-- <div class="signinform">
                                    <h4>New on our platform?<a
                                            href=""
                                            class="hover-a"> Create an account</a></h4>
                                </div> --}}
                                {{-- <div class="form-setlogin or-text">
                                    <h4>OR</h4>
                                </div>
                                <div class="form-sociallink">
                                    <ul class="d-flex">
                                        <li>
                                            <a href="javascript:void(0);" class="facebook-logo">
                                                <img src="https://dreamspos.dreamstechnologies.com/html/template/assets/img/icons/facebook-logo.svg"
                                                    alt="Facebook">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">
                                                <img src="https://dreamspos.dreamstechnologies.com/html/template/assets/img/icons/google.png"
                                                    alt="Google">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="apple-logo">
                                                <img src="https://dreamspos.dreamstechnologies.com/html/template/assets/img/icons/apple-logo.svg"
                                                    alt="Apple">
                                            </a>
                                        </li>
                                    </ul>
                                </div> --}}
                            </div>
                        </form>
                    </div>
                    <div class="my-4 d-flex justify-content-center align-items-center copyright-text">
                        {{-- <p>Copyright &copy; 2024 Inventory-Management. All rights reserved</p> --}}
                        <p>Developed By Dipto</p>
                    </div>
                </div>
            </div>
        </div>
    </div>



    @include('admin.partials.assets.js')
</body>

</html>
