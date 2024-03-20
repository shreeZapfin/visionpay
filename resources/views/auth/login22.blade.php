@extends('layouts.custom-master1')

@section('styles')

<title>Pacpay Admin - Login</title>

<!-- Custom fonts for this template-->
<link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
<link
    href="{{ asset('https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i') }} "
    rel="stylesheet">

<!-- Custom styles for this template-->
<link href="{{ asset('css/sb-admin-2.min.css') }} " rel="stylesheet">

<style type="text/css">
    .bg-login-image {
        background: url(img/logoo.jpeg);
        background-size: 70%;
        background-position: center;
        background-repeat: no-repeat;
    }

</style>


@endsection

@section('content')
	
<div class="row">
                <!-- CONTAINER OPEN -->
                <div class="container-lg">
                    <div class="row justify-content-center mt-4 mx-0">
                    <!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
                        <div class="col-xl-4 col-lg-6">
                            <div class="card shadow-none">
                                <div class="card-body p-sm-6">
                                    <div class="text-center mb-4">
                                        <h4 class="mb-1">Welcome Back!</h4>
                                        <p>Sign in to your account to continue.</p>
                                    </div>
                                    <br>
                                    <form method="POST" action="{{ route('login') }}" class="user">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label class="mb-2 fw-500">Email<span class="text-danger ms-1">*</span></label>
                                                    <input class="form-control ms-0 @error('email') is-invalid @enderror"
                                                    id="email" aria-describedby="emailHelp"
                                                    placeholder="Enter Email Address..." name="username"
                                                    value="{{ old('email') }}" required autocomplete="email"
                                                    autofocus>
                                                </div>
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <input type="hidden" value="web" name="device_name">
                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label class="mb-2 fw-500">Password<span class="text-danger ms-1">*</span></label>
                                                    <div >
                                                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                                        id="password" placeholder="Password" name="password" required autocomplete="current-password">
                                                    </div>
                                                </div>
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="d-flex mb-3">
                                                    <div class="form-check d-flex align-items-center">
                                                        <input class="form-check-input" type="checkbox" name="remember"
                                                    id="remember">
                                                        <label class="form-check-label tx-15" for="flexCheckDefault">
                                                            Remember me
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="d-grid mb-3">
                                                    <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                                    <!-- <a href="{{url('index')}}" class="btn btn-primary btn-user"> Login</a> -->
                                                </div>
                                                <div class="ms-auto" style="text-align: center;">
                                                        <a href="{{url('forgot-password')}}" class="tx-primary ms-1 tx-13">Forgot Password?</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- <p class="text-center mt-3 mb-2">Signin with</p>
                                    <div class="d-flex justify-content-center">
                                        <div class="btn-list">
                                            <button class="btn btn-icon bg-primary-transparent rounded-pill border-0" type="button">
                                                <span class="btn-inner--icon"><i class="fa fa-facebook"></i></span>
                                            </button>
                                            <button class="btn btn-icon bg-primary-transparent rounded-pill border-0" type="button">
                                                    <span class="btn-inner--icon"><i class="fa fa-google"></i></span>
                                                </button>
                                            <button class="btn btn-icon bg-primary-transparent rounded-pill border-0" type="button">
                                                    <span class="btn-inner--icon"><i class="fa fa-twitter"></i></span>
                                                </button>
                                            <button class="btn btn-icon bg-primary-transparent rounded-pill border-0" type="button">
                                                    <span class="btn-inner--icon"><i class="fa fa-linkedin"></i></span>
                                            </button>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- CONTAINER CLOSED -->

@endsection

@section('scripts')
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
	

@endsection
