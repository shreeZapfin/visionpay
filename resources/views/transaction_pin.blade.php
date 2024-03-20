<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pacpay Admin Panel</title>

</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        {{-- <x- sidebar /> --}}
        @include('sidebar')
        <!-- End of Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                {{-- <x- header /> --}}
                @include('header')
                <!-- End of Topbar -->
                <div class="container-fluid">

                    <!-- Outer Row -->
                    <div class="row justify-content-center">

                        <div class="col-xl-10 col-lg-12 col-md-9">

                            <div class="card o-hidden border-0 shadow-lg my-5">
                                <div class="card-body p-0">
                                    <!-- Nested Row within Card Body -->
                                    <div class="row">
                                        {{-- <div class="col-lg-6 d-none d-lg-block bg-password-image"></div> --}}
                                        <div class="col-lg-6" id="receive_otp">
                                            <div class="p-5">
                                                <div class="text-center">
                                                    <h1 class="h4 text-gray-900 mb-2">Transaction Pin</h1>
                                                    <br />
                                                </div>
                                                <form name='send_otp' id='send_otp'>
                                                    <div class="form-group">
                                                        <label>Receive OTP On?</label>
                                                        <div class="input-group">
                                                            <select name="auth_type" id="auth_type"
                                                                class="select2 form-control custom-select">
                                                                <option value="" selected="selected">Select Type
                                                                </option>
                                                                <option value="mobile">Mobile</option>
                                                                <option value="email">Email</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div id="recive_otp_on_mobile" style="display: none;">
                                                        <div class="form-group">
                                                            <label>Mobile Number</label>
                                                            <div class="input-group">
                                                                <input type="text" name="mobile_no"
                                                                    class="form-control" id="mobile_no"
                                                                    placeholder="Enter Mobile Number">

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="receive_otp_option" style="display: none;">
                                                        <div class="form-group">
                                                            <label>Email</label>
                                                            <div class="input-group">
                                                                <input type="email" name="email"
                                                                    class="form-control" id="email"
                                                                    aria-describedby="emailHelp"
                                                                    placeholder="Enter Email Address">

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        style="text-align: center;display: block;margin: 0 auto; padding-top: 30px;">
                                                        <button type="submit"
                                                            class="btn btn-primary btn-rounded btn-fw"
                                                            style="font-weight:500;">Reset Pin</button>

                                                    </div>
                                                    <div class='response'></div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-lg-6" id="change_pin" style="display: none;">
                                            <div class="p-5">
                                                <div class="text-center">
                                                    <h1 class="h4 text-gray-900 mb-2">Change Transaction Pin</h1>
                                                    <br />
                                                </div>
                                                <form name='change_trans_pin' id='change_trans_pin'>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Enter Transaction Pin</label>
                                                        <div class="input-group">
                                                            <input type="password" name="transaction_pin"
                                                                class="form-control" id="transaction_pin" maxlength="4"
                                                                required>

                                                            <div class="input-group-append">
                                                                <span class="input-group-text">
                                                                    <i class="far fa-eye" id="toggleNewPassword"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Confirm Transaction Pin</label>
                                                        <div class="input-group">
                                                            <input type="password" name="transaction_pin_confirmation"
                                                                class="form-control" id="transaction_pin_confirmation"
                                                                maxlength="4" required>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">
                                                                    <i class="far fa-eye"
                                                                        id="toggleConfirmPassword"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        style="text-align: center;display: block;margin: 0 auto; padding-top: 30px;">
                                                        <button type="submit"
                                                            class="btn btn-primary btn-rounded btn-fw"
                                                            style="font-weight:500;">Reset Password</button>

                                                    </div>
                                                    <div class='response'></div>
                                                </form>

                                            </div>
                                        </div>

                                        <div class="col-md-6" style="margin: auto;width: 50%;padding: 10px;">
                                            <img src="img/change-password.png" width="70%"
                                                style="margin:0 auto; display:block;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
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
            <div id="loader"></div>
        </div>
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="{{ asset('#page-top') }}">
        <i class="fas fa-angle-up"></i> </a>


    <script type="text/javascript">
        $(document).ready(function() {
            $(".navbar-nav li").removeClass("active"); //this will remove the active class from
            //previously active menu item
            // $('#home').addClass('active');


        });
        var spinner = $('#loader');

        $('#auth_type').on('change', function() {
            if (this.value == 'email') {
                $("#receive_otp_option").show();
                $("#recive_otp_on_mobile").hide();
                $("#mobile_no").val("");
            } else if (this.value == 'mobile') {
                $("#receive_otp_option").hide();
                $("#recive_otp_on_mobile").show();
                $("#email").val("");
            }
        });

        var OTP = null;
        var MobNo = null;

        //Forget Password
        $('#send_otp').on('submit', function(e) {
            e.preventDefault();
            spinner.show();



            var MobileNo = $('#mobile_no').val();
            // console.log("MobileNo: " + MobileNo);

            var auth_type = $('#auth_type').val();
            // console.log("auth_type: " + auth_type);

            var email = $('#email').val();
            // console.log("email: " + email);

            MobNo = $('#mobile_no').val();

            var formFields;
            if ($('#auth_type').val() == 'email')
                formFields = 'email=' + $('#email').val() + '&otp_for=USR_PWD&auth_type=email';
            else
                formFields = 'mobile_no=' + $('#mobile_no').val() + '&otp_for=USR_PWD&auth_type=mobile';



            $.ajax({
                url: 'api/otp/send',
                type: 'post',
                dataType: 'JSON',
                data: formFields,
                success: function(data) {
                    //   console.log("ttttt");
                    if (data.error_code == 0) {
                        // console.log(data);
                        spinner.hide();
                        Swal.fire({
                            title: "" + data.meta
                                .message,
                            icon: 'success',
                            showCloseButton: true
                        }).then(okay => {
                            if (okay) {
                                Swal.fire({
                                    title: "Enter OTP send on registered Mobile No./ Email",
                                    text: "",
                                    input: 'text',
                                    inputAttributes: {
                                        maxlength: 6
                                    },
                                    showCancelButton: true
                                }).then((result) => {
                                    if (result.value) {
                                        //console.log("Result: " + result.value);
                                        OTP = result.value;
                                        var formField;
                                        if ($('#auth_type').val() == 'email')
                                            formField = 'email=' + $('#email').val() +
                                            '&otp_for=USR_VER&auth_type=email&otp=' +
                                            result.value;
                                        else
                                            formField = 'mobile_no=' + $('#mobile_no')
                                            .val() +
                                            '&otp_for=USR_VER&auth_type=mobile&otp=' +
                                            result.value;
                                        $.ajax({
                                            url: '{{ url('api/otp/verify') }}',
                                            type: 'post',
                                            dataType: 'JSON',
                                            data: formField,
                                            success: function(data) {
                                                //alert(JSON.stringify(meta.message));
                                                // console.log("ttttt");
                                                if (data.error_code == 0) {
                                                    //console.log(data);

                                                    Swal.fire({
                                                        title: "" +
                                                            data
                                                            .meta
                                                            .message,
                                                        icon: 'success',
                                                        showCloseButton: true
                                                    }).then(okay => {
                                                        if (okay) {
                                                            $("#receive_otp")
                                                                .hide();
                                                            $("#change_pin")
                                                                .show();
                                                        }
                                                    });
                                                } else {
                                                    swal(data.meta.message,
                                                        "error");
                                                }


                                            },
                                            error: function(data) {
                                                if (data.status == 500) {
                                                    //console.log(data);
                                                    spinner.hide();
                                                    Swal.fire({
                                                        title: "" +
                                                            data
                                                            .responseJSON
                                                            .meta
                                                            .message,
                                                        icon: 'error',
                                                        showCloseButton: true
                                                    }).then(okay => {
                                                        if (okay) {
                                                            window
                                                                .location
                                                                .reload();
                                                        }
                                                    });
                                                } else
                                                if (data.status === 422) {
                                                    var errors = $
                                                        .parseJSON(data
                                                            .responseText);
                                                    $.each(errors, function(
                                                        key, value
                                                    ) {
                                                        // console.log(key+ " " +value);
                                                        $('.response')
                                                            .addClass(
                                                                "alert alert-danger"
                                                            );

                                                        if ($
                                                            .isPlainObject(
                                                                value
                                                            )) {
                                                            $.each(value,
                                                                function(
                                                                    key,
                                                                    value
                                                                ) {
                                                                    // console
                                                                    //     .log(
                                                                    //         key +
                                                                    //         " " +
                                                                    //         value
                                                                    //     );
                                                                    $('.response')
                                                                        .show()
                                                                        .append(
                                                                            value +
                                                                            "<br/>"
                                                                        );

                                                                }
                                                            );
                                                        } else {
                                                            $('.response')
                                                                .show()
                                                                .append(
                                                                    value +
                                                                    "<br/>"
                                                                ); //this is my div with messages
                                                        }
                                                    });
                                                }

                                            }

                                        });
                                    }
                                });
                            }
                        });
                    } else {
                        /* swal(data.meta.message, "error");
                        spinner.hide(); */


                    }
                    spinner.hide();
                },
                error: function(data) {
                    //  console.log(data);
                    if (data.status == 500) {
                        //  console.log(data);
                        spinner.hide();
                        Swal.fire({
                            title: "" + data.responseJSON.meta
                                .message,
                            icon: 'error',
                            showCloseButton: true
                        }).then(okay => {
                            if (okay) {
                                window.location
                                    .reload();
                            }
                        });
                    } else
                    if (data.status === 422) {
                        var errors = $.parseJSON(data
                            .responseText);
                        $.each(errors, function(key, value) {
                            // console.log(key+ " " +value);
                            $('.response').addClass(
                                "alert alert-danger"
                            );

                            if ($.isPlainObject(
                                    value)) {
                                $.each(value, function(
                                    key, value
                                ) {
                                    // console.log(key + " " + value);
                                    $('.response').show().append(value + "<br/>");
                                    spinner.hide();
                                });
                            } else {
                                $('.response').show().append(value +
                                    "<br/>"); //this is my div with messages
                                spinner.hide();
                            }
                        });
                    }

                }



            });


        });

        //toggler onclick
        $("#toggleNewPassword").on('click', function() {

            var y = document.getElementById("transaction_pin");
            if (y.type === "password") {
                y.type = "text";
            } else {
                y.type = "password";
            }

        });
        $("#toggleConfirmPassword").on('click', function() {

            var z = document.getElementById("transaction_pin_confirmation");
            if (z.type === "password") {
                z.type = "text";
            } else {
                z.type = "password";
            }
        });
        $('#change_trans_pin').on('submit', function(e) {
            e.preventDefault();
            spinner.show();

            var formFields = $('#change_trans_pin').serialize();

            // console.log("formFields: " + formFields);
            // console.log("OTP:   " + OTP);
            // console.log("MobNo:   " + MobNo);

            $.ajax({
                url: 'api/user/change-transaction-pin',
                type: 'post',
                dataType: 'JSON',
                data: formFields + '&otp=' + OTP,
                success: function(data) {
                    // console.log("ttttt");
                    if (data.error_code == 0) {
                        // console.log(data);
                        spinner.hide();
                        Swal.fire({
                            title: "" + data.meta
                                .message,
                            icon: 'success',
                            showCloseButton: true
                        }).then(okay => {
                            if (okay) {
                                window.location.reload();
                            }
                        });
                    } else {
                        /* swal(data.meta.message, "error");
                        spinner.hide(); */


                    }
                    spinner.hide();

                },
                error: function(data) {
                    //console.log(data);
                    if (data.status == 500) {
                        // console.log(data);
                        spinner.hide();
                        Swal.fire({
                            title: "" + data.responseJSON.meta
                                .message,
                            icon: 'error',
                            showCloseButton: true
                        }).then(okay => {
                            if (okay) {
                                window.location
                                    .reload();
                            }
                        });
                    } else
                    if (data.status == 400) {
                        //  console.log(data);
                        spinner.hide();
                        Swal.fire({
                            title: "" + data.responseJSON.meta
                                .message,
                            icon: 'error',
                            showCloseButton: true
                        }).then(okay => {
                            if (okay) {
                                window.location
                                    .reload();
                            }
                        });
                    } else
                    if (data.status === 422) {
                        var errors = $.parseJSON(data
                            .responseText);
                        $.each(errors, function(key, value) {
                            // console.log(key+ " " +value);
                            $('.response').addClass(
                                "alert alert-danger"
                            );

                            if ($.isPlainObject(
                                    value)) {
                                $.each(value, function(
                                    key, value
                                ) {
                                    //console.log(key + " " + value);
                                    $('.response').show().append(value + "<br/>");
                                    spinner.hide();
                                });
                            } else {
                                $('.response').show().append(value +
                                    "<br/>"); //this is my div with messages
                                spinner.hide();
                            }
                        });
                    }

                }



            });


        });
    </script>
</body>

</html>