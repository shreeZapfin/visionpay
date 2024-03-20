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
    <!-- Country Code -->
    <link href="{{ asset('css/intlTelInput.css') }}" rel="stylesheet">
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
                        <div class="col-xl-6 col-lg-6">
                            <div class="card shadow-none">
                                <div class="card-body p-sm-6">
                                    <div class="text-center mb-4">
                                        <h4 class="mb-1">Two-Factor Authentication is required.</h4>
                                        <hr>
                                        <p>To continue, enter mobile number, you will receive otp.</p>
                                    </div>
                                    <form action="{{ url('submitMobile') }}" id="submitmobile_id"  method="post">
                                        @csrf
                                        <div class="row justify-content-center">
                                            <!-- <div class="col-sm-12"> -->
                                                    <div class="col-xl-12 col-lg-12 col-sm-12">
                                                        <div class="form-group text-center">
                                                            <!-- <label class="fw-semibold">Mobile Number</label> -->
                                                            <div class="input-group mob_inputgroup d-block">
                                                                <input  type="tel" name="mobile_no" class="form-control"
                                                                    id="mobile_no" required>
                                                                    <input hidden id="countrycode" type="tel" name="countrycode">
                                                                    <input hidden id="user_details" name="user_details" value="{{$user}}">
                                                                    <input hidden id="username" name="username" value="{{$username}}">
                                                                    <input hidden id="password" name="password" value="{{$password}}">
                                                                    <input hidden id="device_name" name="device_name" value="{{$device_name}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                            <!-- </div> -->
                                            <div class="col-xl-4">
                                                <div class="d-grid mb-3 mt-3">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>
                                            <div class="col-xl-4">
                                                <div class="d-grid mb-3 mt-3">
                                                    <a href="{{route('login')}}" class="btn btn-secondary">Cancel</a>
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


{{-- country code --}}
    <script src="js/intlTelInput.js"></script>
    <script src="js/utils.js"></script>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
<script>
    $(document).ready(function() {
            $(".navbar-nav li").removeClass("active"); //this will remove the active class from
            //previously active menu item
            $('#home').addClass('active');

            //country code
            var input = document.querySelector("#mobile_no");
            window.intlTelInput(input, {

                utilsScript: "js/utils.js",
                preferredCountries: ["fj"],

            });
         
            var input = document.querySelector("#mobile_no");
            window.intlTelInput(input, {
                separateDialCode: true,
            });

            var iti = window.intlTelInputGlobals.getInstance(input);

            input.addEventListener('input', function() {
                var countrycode = iti.getNumber();
                document.getElementById('countrycode').value = countrycode;
            });

            // var full_number = $(".iti__selected-dial-code").text(); alert(full_number) 

            // input.addEventListener("countrychange", function(e) {
            //    console.log(e.target.value)
                
            // // do something with iti.getSelectedCountryData()
            // });
            
            // input.on("countrychange", function() {
            //     console.log(input.val());
            // });
        });
</script>
	

@endsection
