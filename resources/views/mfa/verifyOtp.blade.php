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
    <link rel="stylesheet"
        href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.css') }}">

    <!-- <link href="{{ asset('css/demo.css') }}" rel="stylesheet"> -->
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
	
                <!-- CONTAINER OPEN -->
                <div class="container-lg">
                    <div class="row justify-content-center mt-4 mx-auto">
                        <div class="col-xl-4 col-lg-6">
                            <div class="card shadow-none">
                                <div class="card-body p-sm-6">
                                    <div class="text-center mb-4">
                                        <h4 class="mb-1">Verify OTP</h4>
                                        <hr>
                                        <p>To continue, enter 2FA otp received on your mobile <b>{{$saveUserDetails->mobile_no}} .</b></p>
                                    </div>
                                    <form id="submitmobile_id" name="submitmobile_id"  method="post">
                                        @csrf
                                        <div class="row">
                                            <!-- <div class="col-sm-12"> -->
                                                    <div class="col-xl-12 col-lg-12 col-sm-12">
                                                        <div class="form-group">
                                                                <!-- <label class="fw-semibold">Otp</label> -->
                                                            <div class="input-group">
                                                                <input hidden name="mobile" id="mobile" value="{{$saveUserDetails->mobile_no}}">
                                                                <input  type="text" name="verify_otp" class="form-control"
                                                                    id="verify_otp" required>
                                                                <input hidden id="user_details" name="user_details" value="{{$user_details}}">
                                                                <input hidden id="username" name="username" value="{{$username}}">
                                                                <input hidden id="password" name="password" value="{{$password}}">
                                                                <input hidden id="device_name" name="device_name" value="{{$device_name}}">
                                                            </div>
                                                            @error('verify_otp')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                            <!-- </div> -->
                                            <div class="col-xl-12">
                                                <div class="d-grid mb-3">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.js"></script>
<script>
     $('#submitmobile_id').on('submit', function(e) {
            e.preventDefault();

            var formFields = $('#submitmobile_id').serialize();


            $.ajax({
                url: 'verifyUserOtp',
                type: 'post',
                dataType: 'JSON',
                data: formFields + '&device_name=web',
                success: function(data) {
                    if (data.error_code == 0) {
                        if(data.data == 'index'){
                            window.location.href = data.data;
                        }
                        if(data.data == 'index'){
                            window.location.href = data.data;
                        }
                        if(data.data == 'index'){
                            window.location.href = data.data;
                        }
                        if(data.data == 'index'){
                            window.location.href = data.data;
                        }
                    } else {
                        $("#verify_otp").val('');
                        Swal.fire({     
                            type: 'error',
                            title: 'Please enter correct OTP',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        
                    }
                }
            });
        });
</script>

@endsection
