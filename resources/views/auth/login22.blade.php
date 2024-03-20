@extends('layouts.app')

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pacpay Admin - Login</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="{{ asset('https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i') }} "
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }} " rel="stylesheet">
</head>

<style type="text/css">
    .bg-login-image {
        background: url(img/logoo.jpeg);
        background-size: 70%;
        background-position: center;
        background-repeat: no-repeat;
    }

</style>

<body style="background: url(img/background.jpeg);">


    <div class="container" style="text-align: center;">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row" style="background-color: #F7F7F7;">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4"><b>Welcome
                                                Back!</b></h1>
                                        {{-- <img src="img/logoo.jpeg" alt="PacpayLogo"> --}}
                                    </div>
                                    <br>
                                    <form method="POST" action="{{ route('login') }}" class="user">
                                        @csrf
                                        <div class="form-group">

                                            <div class="input-group">
                                                <input type="email"
                                                    class="form-control form-control-user @error('email') is-invalid @enderror"
                                                    id="email" aria-describedby="emailHelp"
                                                    placeholder="Enter Email Address..." name="username"
                                                    value="{{ old('email') }}" required autocomplete="email"
                                                    autofocus>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-fw fa-user"></i>
                                                    </span>
                                                </div>
                                            </div>


                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <input type="hidden" value="web" name="device_name">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="password"
                                                    class="form-control form-control-user @error('password') is-invalid @enderror"
                                                    id="password" placeholder="Password" name="password" required
                                                    autocomplete="current-password">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="far fa-eye" id="togglePassword"></i>
                                                    </span>
                                                </div>
                                            </div>


                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" name="remember"
                                                    id="remember">
                                                <label class="custom-control-label" for="remember">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        {{-- <a href="{{ asset('index') }} " class="btn btn-primary btn-user btn-block">
                                            {{ __('Login') }}                                        </a> --}}

                                        <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>

                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="{{ asset('forgot-password') }} ">Forgot
                                            Password?</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script>
        $(document).ready(function() {

            //toggler onclick
            $("#togglePassword").on('click', function() {
                var x = document.getElementById("password");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            });

        })
    </script>
</body>

</html>
