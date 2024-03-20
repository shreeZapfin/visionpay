
@extends('layouts.master')

@section('styles')

        <link rel="stylesheet" href="{{asset('build/assets/libs/quill/quill.snow.css')}}">
        <link rel="stylesheet" href="{{asset('build/assets/libs/quill/quill.bubble.css')}}">

        <!-- Filepond CSS -->
        <link rel="stylesheet" href="{{asset('build/assets/libs/filepond/filepond.min.css')}}">
        <link rel="stylesheet" href="{{asset('build/assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css')}}">
        <link rel="stylesheet" href="{{asset('build/assets/libs/filepond-plugin-image-edit/filepond-plugin-image-edit.min.css')}}">

            <!-- Country Code -->
        <link href="{{ asset('css/intlTelInput.css') }}" rel="stylesheet">
        <link href="{{ asset('css/demo.css') }}" rel="stylesheet">

@endsection

@section('content')
	
                    <!-- PAGE-HEADER -->
                    <div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
                        <h1 class="page-title">Add New Merchant</h1>
                        <div>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/index')}}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{url('/users')}}">Users</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add Merchant</li>
                            </ol>
                        </div>
                    </div>
                    <!-- PAGE-HEADER END -->

                    <!-- CONTAINER -->
                    <div class="main-container container-fluid adduser_container">
                        <!-- ROW-1 -->
                        <div class="row justify-content-center">
                            <div class="col-xl-12 p-0">
                                <form name='add_user_form' id='add_user_form'>
                                    @csrf
                                    <div class="card">
                                        <!-- <div class="card-header">
                                            <div class="card-title">Add New User</div>
                                        </div> -->
                                        <div class="card-body">
                                           <div class="row">
                                               <div class="col-xl-6 col-lg-6 col-sm-6">
                                                  <div class="form-group">
                                                    <label class="fw-semibold mt-4">First Name</label>
                                                    <div class="input-group">
                                                    <input type="text" name="first_name" class="form-control"
                                                                id="first_name" required>
                                                    </div>
                                                  </div>
                                               </div>   
                                               <div class="col-xl-6 col-lg-6 col-sm-6">
                                                <div class="form-group">
                                                    <label class="fw-semibold mt-4">Last Name</label>
                                                    <div class="input-group">
                                                        <input type="text" name="last_name" class="form-control"
                                                                id="last_name" required>
                                                    </div>
                                                  </div>
                                              </div>
                                        </div>

                                        <div class="row">
                                               <div class="col-xl-6 col-lg-6 col-sm-6">
                                                 <div class="form-group">
                                                   <label class="fw-semibold">Mobile Number</label>
                                                   <div class="input-group mob_inputgroup">
                                                      <input  type="text" name="mobile_no" class="form-control"
                                                        id="mobile_no" required>
                                                   </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-xl-6 col-lg-6 col-sm-6">
                                                    <div class="form-group">
                                                       <label class="fw-semibold">Email</label>
                                                       <div class="input-group">
                                                            <input type="email" name="email" class="form-control"
                                                                    id="email" required>                                                       
                                                        </div>
                                                     </div>
                                                </div>    
                                            </div>
                                            <div class="row">
                                               <div class="col-xl-12 col-lg-12 col-sm-12">
                                                   <div class="form-group">
                                                    <label class="fw-semibold">Username</label>
                                                    <div class="input-group">
                                                    <input type="text" name="username" class="form-control"
                                                                    id="username" value="$" pattern="^[$].{4,}"
                                                                    title="Must start with $ sign followed by at least 8 or more characters"
                                                                    required>
                                                    </div>
                                                    </div>
                                               </div>
                                            </div>

                                            <div class="row">
                                               <div class="col-xl-6 col-lg-6 col-sm-6">
                                                    <div class="form-group">
                                                            <label>Create Password</label>
                                                            <div class="input-group">
                                                                <input type="password" name="password" class="form-control"
                                                                    id="password" required>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">
                                                                        <i class="far bi-eye" id="toggleNewPassword"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>    

                                                <div class="col-xl-6 col-lg-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Confirm Password</label>
                                                        <div class="input-group">
                                                            <input type="password" name="password_confirmation"
                                                                    class="form-control" id="password_confirmation" required>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">
                                                                    <i class="far bi-eye" id="toggleConfirmPassword"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>   

                                            </div>
                                            <div class="row">
                                               <div class="col-xl-6 col-lg-6 col-sm-6">
                                                    <div class="form-group">
                                                            <label class="fw-semibold" for="date_of_birth">Date Of Birth</label>
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" name="date_of_birth" id="date_of_birth" placeholder="Choose date">
                                                                        <div class="input-group-text tx-fixed-white"> <i class="ri-calendar-line"></i> </div>
                                                                    </div>
                                                                </div>
                                                    </div>
                                               </div>    
                                               <div class="col-xl-6 col-lg-6 col-sm-6">
                                                    <div class="form-group">
                                                            <label>Gender</label>
                                                            <div class="input-group">
                                                                {{-- <input type="text" name="gender" class="form-control" id="gender" required> --}}
                                                                <select name="gender" id="gender"
                                                                    class="select2 form-control custom-select" required>
                                                                    <option value="">Select Gender</option>
                                                                    <option value="MALE" selected="selected">MALE</option>
                                                                    <option value="FEMALE">FEMALE</option>
                                                                </select>
                                                            </div>
                                                    </div>
                                                </div>    
                                            </div>    

                                            <div class="row">
                                               <div class="col-xl-12 col-lg-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Address</label>
                                                        <div class="input-group">
                                                            <input type="text" name="address" class="form-control"
                                                                id="address" required>

                                                        </div>
                                                    </div>
                                                 </div> 
                                            </div>

                                            <div class="row">
                                               <div class="col-xl-6 col-lg-6 col-sm-6">
                                                    
                                                    <div class="form-group">
                                                        <label>Country</label>
                                                        <select name="selectcountry" id="selectcountry"
                                                            class="select2 form-control custom-select" required>

                                                        </select>
                                                    </div>
                                               </div>    
                                               <div class="col-xl-6 col-lg-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label>City</label>
                                                        <select class="select2 form-control custom-select" name="city_id"
                                                            id="city_id" required>
                                                        </select>
                                                    </div>
                                                </div>  
                                                <div class="col-xl-6 col-lg-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Business Name</label>
                                                        <input type="text" name="business_name" class="form-control"
                                                        id="business_name" required>
                                                    </div>
                                                </div>  
                                                <div class="col-xl-6 col-lg-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Company TIN Number</label>
                                                        <input type="text" name="company_tin_no" class="form-control"
                                                        id="company_tin_no" minlength="9" maxlength="9" required>
                                                    </div>
                                                </div>  
                                                <div class="col-xl-6 col-lg-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Select Merchant Type</label>
                                                        <select class="select2 form-control custom-select"
                                                        name="merchant_category_id" id="merchant_category_id" required>
                                                        </select>
                                                    </div>
                                                </div>  
                                                <div class="col-xl-6 col-lg-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Select Business Type</label>
                                                        <select class="select2 form-control custom-select"
                                                            name="business_type_id" id="business_type_id" required>
                                                        </select>
                                                    </div>
                                                </div>  
                                            </div>    
                                                {{-- <div class="form-group">
                                                        <label>KYC Document(Voter ID/ Passport/Driving License)</label>
                                                            <div class="input-group">
                                                                <input type="file" name="kyc_document_image" class="form-control" id="kyc_document_image" required>
                                                            </div>
                                                </div> 
                                                <div class="form-group">
                                                    <label>Selfie</label>
                                                        <div class="input-group">
                                                            <input type="file" name="selfie_image" class="form-control" id="selfie_image" required>
                                                        </div>
                                                </div> --}}
                                        </div>
                                        <div class="card-footer">
                                            <div class="float-end btn-list">
                                                <a href="javascript:void(0);" class="btn btn-light">Discard</a>
                                                <button type="submit" class="btn btn-primary btn-rounded btn-fw"
                                                            style="font-weight:500;">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div id='response'></div>
                            </div>
                        </div>
                        <!-- ROW-1 CLOSED -->
                    </div>
                    <!-- CONTAINER CLOSED -->
@endsection

@section('scripts')

        <!-- Quill Editor JS -->
        <script src="{{asset('build/assets/libs/quill/quill.min.js')}}"></script>

        <!-- Color Picker JS -->
        <script src="{{asset('build/assets/libs/@simonwep/pickr/pickr.es5.min.js')}}"></script>
	
	    <!-- Filepond JS -->
        <script src="{{asset('build/assets/libs/filepond/filepond.min.js')}}"></script>
        <script src="{{asset('build/assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js')}}"></script>
        <script src="{{asset('build/assets/libs/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js')}}"></script>
        <script src="{{asset('build/assets/libs/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js')}}"></script>
        <script src="{{asset('build/assets/libs/filepond-plugin-file-encode/filepond-plugin-file-encode.min.j')}}s"></script>
        <script src="{{asset('build/assets/libs/filepond-plugin-image-edit/filepond-plugin-image-edit.min.js')}}"></script>
        <script src="{{asset('build/assets/libs/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.min.js')}}"></script>
        <script src="{{asset('build/assets/libs/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.min.js')}}"></script>
        <script src="{{asset('build/assets/libs/filepond-plugin-image-crop/filepond-plugin-image-crop.min.js')}}"></script>
        <script src="{{asset('build/assets/libs/filepond-plugin-image-resize/filepond-plugin-image-resize.min.js')}}"></script>
        <script src="{{asset('build/assets/libs/filepond-plugin-image-transform/filepond-plugin-image-transform.min.js')}}"></script>

        <!-- Date & Time Picker JS -->
        <script src="{{asset('build/assets/libs/flatpickr/flatpickr.min.js')}}"></script>

        <!-- Internal Add Products JS -->
        @vite('resources/assets/js/add-products.js')

        {{-- country code --}}
    <script src="js/intlTelInput.js"></script>
    <script src="js/utils.js"></script>


    <script type="text/javascript">
        // for date of birth
        flatpickr("#date_of_birth", {});

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

            //Show Password
            $("#toggleNewPassword").on('click', function() {

                var y = document.getElementById("password");
                if (y.type === "password") {
                    y.type = "text";
                } else {
                    y.type = "password";
                }

            });
            $("#toggleConfirmPassword").on('click', function() {

                var z = document.getElementById("password_confirmation");
                if (z.type === "password") {
                    z.type = "text";
                } else {
                    z.type = "password";
                }
            });


            //Select Country
            $.ajax({
                url: 'api/country',
                type: 'get',
                success: function(data) {
                    console.log('data');
                    $('#selectcountry').empty();
                    $("#selectcountry").append(new Option("Select Country", ""));
                    $.each(data.data, function($index, $value) {

                        $('#selectcountry').append('</option>' + '<option value="' + $value.id +
                            '" >' +
                            $value
                            .country_name + '</option>');
                    })
                }
            });
            //Select City Based on Country id 
            $('#selectcountry').on('change', function() {
                $.ajax({
                    url: 'api/city',
                    type: 'get',
                    data: {
                        'country_id': $('#selectcountry').val()
                    },
                    success: function(data) {
                        console.log('data');
                        $('#city_id').empty();
                        $.each(data.data, function($index, $value) {

                            $('#city_id').append('<option value="' + $value.id + '" >' +
                                $value
                                .city_name + '</option>');
                        })
                    }
                });

            });

        });

        var spinner = $('#loader');
        $('#add_user_form').on('submit', function(e) {
            e.preventDefault();
            spinner.show();
            /*  var password = Math.floor(10000000 + Math.random() * 90000000);
             var password_confirmation = password; */

            var formFields = $('#add_user_form').serialize();
            /* console.log("Password: " + password);
            console.log("password_confirmation: " + password_confirmation); */


            $.ajax({
                url: 'api/user',
                type: 'post',
                dataType: 'JSON',
                data: formFields + '&user_type_id=4&device_name=web',
                success: function(data) {
                    // alert(JSON.stringify(data));
                    if (data.error_code == 0) {
                        console.log(data);
                        spinner.hide();
                        Swal.fire({
                            title: "" + data.meta.message,
                            icon: 'success',
                            showCloseButton: true
                        }).then(okay => {
                            if (okay) {
                                window.location.reload();
                            }
                        });
                    } else {
                        swal(data.meta.message, "error");
                    }

                    $('#add_user_form').closest('form').find("input[type=text], textarea").val("");
                    //$('#add_user_form').val('');

                },
                error: function(data) {
                    console.log("Inside function");
                    if (data.status === 422) {
                        console.log("Inside Condition");
                        var errors = $.parseJSON(data.responseText);
                        $.each(errors, function(key, value) {
                            // console.log(key+ " " +value);
                            $('#response').addClass("alert alert-danger");

                            if ($.isPlainObject(value)) {
                                $.each(value, function(key, value) {
                                    console.log(key + " " + value);
                                    $('#response').show().append(value + "<br/>");
                                    spinner.hide();
                                });
                            } else {
                                $('#response').show().append(value +
                                    "<br/>"); //this is my div with messages
                                spinner.hide();
                            }
                        });
                    }

                }

            });




        });



        //Get Merchant type
        $.ajax({
            url: 'api/user/merchant-types',
            type: 'get',

            success: function(data) {
                console.log('data');
                $('#merchant_category_id').empty();
                $.each(data.data, function($index, $value) {

                    $('#merchant_category_id').append('<option value="' + $value.id + '" >' + $value
                        .category_name + '</option>');
                })
            }
        });

        //Get Business Type
        $.ajax({
            url: 'api/user/business-types',
            type: 'get',

            success: function(data) {
                console.log('data');
                $('#business_type_id').empty();
                $.each(data.data, function($index, $value) {

                    $('#business_type_id').append('<option value="' + $value.id + '" >' + $value
                        .business_type + '</option>');
                })
            }
        });
    </script>

@endsection
