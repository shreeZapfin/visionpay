<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pacpay Admin Panel</title>


    <!-- Country Code -->
    <link href="{{ asset('css/intlTelInput.css') }}" rel="stylesheet">
    <link href="{{ asset('css/demo.css') }}" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        {{-- <x- sidebar /> --}}
        @include('sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                {{-- <x- header /> --}}
                @include('header')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5 class="m-0 font-weight-bold text-primary">Add New Agent</h5>
                        </div>

                        <div class="card">
                            <div class="card-body">


                                <form name='add_user_form' id='add_user_form'>
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6" style="margin:0 auto; display:block;">
                                            <div class="form-group">
                                                <label>Mobile Number</label>
                                                <div class="input-group">
                                                    <input type="text" name="mobile_no" class="form-control"
                                                        id="mobile_no" required>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <div class="input-group">
                                                    <input type="email" name="email" class="form-control"
                                                        id="email" required>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Username</label>
                                                <div class="input-group">
                                                    <input type="text" name="username" class="form-control"
                                                        id="username" value="$" pattern="^[$].{4,}"
                                                        title="Must start with $ sign followed by at least 8 or more characters"
                                                        required>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <div class="input-group">
                                                    <input type="text" name="first_name" class="form-control"
                                                        id="first_name" required>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <div class="input-group">
                                                    <input type="text" name="last_name" class="form-control"
                                                        id="last_name" required>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Create Password</label>
                                                <div class="input-group">
                                                    <input type="password" name="password" class="form-control"
                                                        id="password" required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="far fa-eye" id="toggleNewPassword"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Confirm Password</label>
                                                <div class="input-group">
                                                    <input type="password" name="password_confirmation"
                                                        class="form-control" id="password_confirmation" required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="far fa-eye" id="toggleConfirmPassword"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Date of Birth</label>
                                                <div class="input-group">
                                                    <input type="date" name="date_of_birth" class="form-control"
                                                        id="date_of_birth" required>

                                                </div>
                                            </div>
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
                                            <div class="form-group">
                                                <label>Address</label>
                                                <div class="input-group">
                                                    <input type="text" name="address" class="form-control"
                                                        id="address" required>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Country</label>
                                                <select name="selectcountry" id="selectcountry"
                                                    class="select2 form-control custom-select" required>

                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>City</label>
                                                <select class="select2 form-control custom-select" name="city_id"
                                                    id="city_id" required>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Business Name</label>
                                                <div class="input-group">
                                                    <input type="text" name="business_name" class="form-control"
                                                        id="business_name" required>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Company Tin Number</label>
                                                <div class="input-group">
                                                    <input type="text" name="company_tin_no" class="form-control"
                                                        id="company_tin_no" minlength="9" maxlength="9" required>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Select Merchant Type</label>
                                                <select class="select2 form-control custom-select"
                                                    name="merchant_category_id" id="merchant_category_id" required>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Select Business Type</label>
                                                <select class="select2 form-control custom-select"
                                                    name="business_type_id" id="business_type_id" required>
                                                </select>
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
                                        <br><br>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <div class="col-sm-4"
                                                    style="text-align: center;display: block;margin: 0 auto; padding-top: 30px;">
                                                    <button type="submit" class="btn btn-primary btn-rounded btn-fw"
                                                        style="font-weight:500;">Submit</button>
                                                </div>

                                            </div>
                                        </div>


                                    </div>
                                </form>

                                <div id='response'></div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Pacpay 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
            <div id="loader"></div>
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="{{ asset('#page-top') }}">
        <i class="fas fa-angle-up"></i> </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span> </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ asset('login') }}">Logout</a>
                </div>
            </div>
        </div>
    </div>



    {{-- country code --}}
    <script src="js/intlTelInput.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            $(".navbar-nav li").removeClass("active"); //this will remove the active class from
            //previously active menu item
            $('#admin').addClass('active');



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

        });

        var spinner = $('#loader');
        $('#add_user_form').on('submit', function(e) {
            e.preventDefault();
            spinner.show();


            var formFields = $('#add_user_form').serialize();

            $.ajax({
                url: 'api/user',
                type: 'post',
                dataType: 'JSON',
                data: formFields + '&user_type_id=3&device_name=web',
                success: function(data) {
                    if (data.error_code == 0) {
                        // console.log(data);
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
                    // $('#add_user_form').val('');


                },
                error: function(data) {
                    //console.log("Inside function");
                    if (data.status === 422) {
                        // console.log("Inside Condition");
                        var errors = $.parseJSON(data.responseText);
                        $.each(errors, function(key, value) {
                            // console.log(key+ " " +value);
                            $('#response').addClass("alert alert-danger");

                            if ($.isPlainObject(value)) {
                                $.each(value, function(key, value) {
                                    // console.log(key + " " + value);
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
            $('#add_user_form').val('');


        });

        //Select Country
        $.ajax({
            url: 'api/country',
            type: 'get',
            success: function(data) {
                //console.log('data');
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
        //Select City based on Country
        $('#selectcountry').on('change', function() {
            $.ajax({
                url: 'api/city',
                type: 'get',
                data: {
                    'country_id': $('#selectcountry').val()
                },
                success: function(data) {
                    // console.log('data');
                    $('#city_id').empty();
                    $.each(data.data, function($index, $value) {

                        $('#city_id').append('<option value="' + $value.id + '" >' + $value
                            .city_name + '</option>');
                    })
                }
            });

        });

        //Select Merchant Type
        $.ajax({
            url: 'api/user/merchant-types',
            type: 'get',

            success: function(data) {
                //  console.log('data');
                $('#merchant_category_id').empty();
                $.each(data.data, function($index, $value) {

                    $('#merchant_category_id').append('<option value="' + $value.id + '" >' + $value
                        .category_name + '</option>');
                })
            }
        });

        //Select Business Type
        $.ajax({
            url: 'api/user/business-types',
            type: 'get',

            success: function(data) {
                //console.log('data');
                $('#business_type_id').empty();
                $.each(data.data, function($index, $value) {

                    $('#business_type_id').append('<option value="' + $value.id + '" >' + $value
                        .business_type + '</option>');
                })
            }
        });
    </script>


</body>

</html>
