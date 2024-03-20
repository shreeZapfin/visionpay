<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pacpay Admin Panel</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css') }}"
        rel="stylesheet" media="screen" />
    <link href="{{ asset('http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css') }}"
        rel="stylesheet">
    <link rel="stylesheet"
        href="{{ asset('http://fortawesome.github.io/Font-Awesome/3.2.1/assets/font-awesome/css/font-awesome.css') }}">
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="{{ asset('https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i') }}"
        rel="stylesheet">
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet" media="screen" />
    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <link rel="stylesheet"
        href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.css') }}">


    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css" rel="stylesheet" />

    {{-- Date Picker --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />


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
                    <!-- Page Heading -->
                    <h4 style="color: rgb(30, 50, 250);">Biller Details</h4>
                    <!-- DataTales Example -->
                    <div class="card-main row">
                        <div class="col-12 col-sm-12 col-md-12">
                            <div class="table-box">
                                <div style="padding-top: 15px; padding-bottom: 15px;">
                                    <div class="row">

                                        <div>
                                            <div class="row">
                                                <div class="col-12 col-sm-6 col-md-6">
                                                    <label class="text-label">UserName</label>
                                                    <input class="form-control form-control text-input" type="text"
                                                        disabled="" value="{{ $billerDetails->username }}"
                                                        style="border-color: white;">
                                                </div>

                                                <div class="col-12 col-sm-6 col-md-6">
                                                    <label class="text-label">Phone number</label>
                                                    <input class="form-control form-control text-input" type="text"
                                                        disabled="" value="{{ $billerDetails->mobile_no }}"
                                                        style="border-color: white;">
                                                </div>
                                                <div class="col-12 col-sm-6 col-md-6">
                                                    <label class="text-label">Email</label>
                                                    <input class="form-control form-control text-input" type="text"
                                                        disabled="" value="{{ $billerDetails->email }}"
                                                        style="border-color: white;">
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-4 col-md-4">
                                            <div>
                                                <div class="text-center" style="margin-top: 8%;">
                                                    <label class="text-label">
                                                        Balance</label>
                                                    <h3>{{ $billerDetails->wallet->balance }}</h3>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="text-center" style="margin-top: 8%;">
                                                    @if ($billerDetails->account_blocked == 0)
                                                        <button data-userid="  {{ $billerDetails->id }}
                                                            " class="btn-fill btn" type="button"
                                                            id="FreezAccount">Block
                                                            Account</button>
                                                    @else
                                                        <button data-userid="  {{ $billerDetails->id }}
                                                        " class="btn-fill btn" type="button"
                                                            id="UnBlockAccount">UnBlock
                                                            Account</button>
                                                    @endif

                                                    @if ($billerDetails->wallet->blocked_balance <= 0)
                                                        <button data-userid="  {{ $billerDetails->id }}
                                                        " class="btn-inverse btn" type="button"
                                                            id="freezWalletBal">Block
                                                            Wallet</button>
                                                    @else
                                                        <button data-userid="  {{ $billerDetails->id }}
                                                        " class="btn-inverse btn" type="button"
                                                            id="UnBlockWalletBal">UnBlock
                                                            Wallet</button>
                                                        <h5>Block Balance:
                                                            {{ $billerDetails->wallet->blocked_balance }}</h5>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div> <br />


                                <div class="col-6 col-sm-6 col-md-6">
                                    <h4 class="text-label" style="color: rgb(30, 50, 250);">Payment Charge
                                        Package</h4>

                                    <table class="table table-bordered" cellspacing="0">
                                        <tr>
                                            <th>Package type</th>
                                            <th>Package name</th>
                                            <th>Edit</th>
                                        </tr>


                                        @foreach ($billerDetails->paymentChargePackage as $package)
                                            <tr>
                                                <td>{{ $package->package_type }} </td>
                                                <td>{{ $package->package_name }} </td>
                                                <td> <button data-packagetype="  {{ $package->package_type }}
                                            " class="btn-fill btn package_class" type="submit" id="submit_button"
                                                        title="Edit"><i class="fa fa-edit fa-lg"></i></button></td>
                                            </tr>
                                        @endforeach

                                    </table>

                                </div>

                                <br />







                            </div>
                            <!-- /.container-fluid -->
                            <div id='response'></div>
                        </div>
                        <!-- End of Main Content -->

                        <!-- Footer -->
                        {{-- <footer class="sticky-footer bg-white">
                            <div class="container my-auto">
                                <div class="copyright text-center my-auto">
                                    <span>Copyright &copy; Pacpay 2021</span>
                                </div>
                            </div>
                        </footer> --}}
                        <!-- End of Footer -->
                    </div>
                    <!-- End of Content Wrapper -->
                </div>
                <!-- End of Page Wrapper -->

                <!-- Scroll to Top Button-->
                <a class="scroll-to-top rounded" href="{{ asset('#page-top') }}">
                    <i class="fas fa-angle-up"></i> </a>



                {{-- Update Payment Charge Package --}}
                <div class="modal fade" id="update_payment_charge_package" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Payment Charge Package</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span> </button>
                            </div>
                            <div class="modal-body">
                                <form name='updatePaymentChargePackage' id='updatePaymentChargePackage'>
                                    <div class="row">
                                        <div class="col-md-6" style="margin:0 auto; display:block;">
                                            <div class="form-group">
                                                <label>Select Package Type</label>
                                                <select class="select2 form-control custom-select"
                                                    name="payment_charge_package_id" id="payment_charge_package_id"
                                                    required>
                                                </select>
                                            </div>

                                        </div>

                                        <br><br>

                                    </div>
                                    <div id="response" style="text-align:center">
                                        <button type="submit" class="btn btn-primary btn-rounded btn-fw"
                                            id='submit_button' data-package-id=""
                                            style="font-weight:500;">Update</button>
                                        <button class="btn btn-secondary" type="button"
                                            data-dismiss="modal">Cancel</button>
                                    </div>
                                </form>


                            </div>

                            <div class="modal-footer">
                                <div id='response'></div>
                            </div>
                        </div>
                    </div>
                </div>

                <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
                {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"
                        integ0rity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> --}}
                <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.js"></script>
                <script src="{{ asset('vendor/datatables/jquery.dataTables.js') }}"></script>

                <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
                <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
                <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
                <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
                <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>

                <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>

                {{-- Date Picker --}}
                <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>


                <script type="text/javascript">
                    $(document).ready(function() {

                        $(".navbar-nav li").removeClass("active"); //this will remove the active class from
                        //previously active menu item
                        $('#bill_payment').addClass('active');

                        var date = new Date();

                        $('.input-daterange').datepicker({
                            todayBtn: 'linked',
                            format: 'yyyy-mm-dd',
                            autoclose: true
                        });
                        userId = <?php echo json_encode($billerDetails); ?>.id;;
                        console.log(userId);

                        //Block/Freez Account
                        $('#FreezAccount').on('click', function(d) {
                            //d.preventDefault();

                            var UserId = $(this).data('userid');
                            console.log("UserId: " + UserId);
                            $.ajax({
                                url: '{{ url('api/admin/user') }}/' + UserId +
                                    '/account-block',
                                type: 'patch',
                                dataType: 'JSON',
                                data: {
                                    'account_blocked': 1
                                },

                                success: function(data) {
                                    if (data.error_code == 0) {
                                        console.log(data);
                                        console.log("Msg: " + data.meta.message);
                                        //  location.reload();
                                        Swal.fire({
                                            title: "" + data.meta.message,
                                            icon: 'success',
                                            showCloseButton: true
                                        }).then(okay => {
                                            if (okay) {
                                                window.location.reload();
                                            }
                                        });
                                        /*, function() {
                                                                            location.reload();
                                                                        }*/
                                    } else {
                                        swal(data.meta.message, "error");
                                    }

                                },

                                error: function(data) {

                                    if (data.status === 422) {
                                        var errors = $.parseJSON(data.responseText);
                                        $.each(errors, function(key, value) {
                                            // console.log(key+ " " +value);
                                            $('#response').addClass(
                                                "alert alert-danger");

                                            if ($.isPlainObject(value)) {
                                                $.each(value, function(key, value) {
                                                    console.log(key + " " +
                                                        value);
                                                    $('#response').show()
                                                        .append(value +
                                                            "<br/>");

                                                });
                                            } else {
                                                $('#response').show().append(value +
                                                    "<br/>"
                                                ); //this is my div with messages
                                            }
                                        });
                                    }

                                }
                            });

                        });
                        //UnBlock Account
                        $('#UnBlockAccount').on('click', function(d) {
                            //d.preventDefault();

                            var UserId = $(this).data('userid');
                            console.log("UserId: " + UserId);
                            $.ajax({
                                url: '{{ url('api/admin/user') }}/' + UserId +
                                    '/account-block',
                                type: 'patch',
                                dataType: 'JSON',
                                data: {
                                    'account_blocked': 0
                                },

                                success: function(data) {
                                    if (data.error_code == 0) {
                                        console.log(data);
                                        console.log("Msg: " + data.meta.message);
                                        // location.reload();
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

                                },

                                error: function(data) {

                                    if (data.status === 422) {
                                        var errors = $.parseJSON(data.responseText);
                                        $.each(errors, function(key, value) {
                                            // console.log(key+ " " +value);
                                            $('#response').addClass(
                                                "alert alert-danger");

                                            if ($.isPlainObject(value)) {
                                                $.each(value, function(key, value) {
                                                    console.log(key + " " +
                                                        value);
                                                    $('#response').show()
                                                        .append(value +
                                                            "<br/>");

                                                });
                                            } else {
                                                $('#response').show().append(value +
                                                    "<br/>"
                                                ); //this is my div with messages
                                            }
                                        });
                                    }

                                }
                            });

                        });


                        //Block/Freez Transaction
                        $('#freezWalletBal').on('click', function(d) {
                            var UserId = $(this).data('userid');
                            console.log("UserId: " + UserId);
                            Swal.fire({
                                title: "Enter Amount",
                                text: "",
                                input: 'text',
                                showCancelButton: true
                            }).then((result) => {
                                if (result.value) {
                                    console.log("Result: " + result.value);
                                    $.ajax({
                                        url: '{{ url('api/admin/user') }}/' + UserId +
                                            '/wallet-balance-block',
                                        //url: 'api/admin/user/' + UserId + '/wallet-balance-block',
                                        type: 'patch',
                                        dataType: 'JSON',
                                        data: {
                                            amount: result.value
                                        },
                                        success: function(data) {
                                            //alert(JSON.stringify(meta.message));
                                            console.log("ttttt");
                                            if (data.error_code == 0) {
                                                console.log(data);
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


                                        },
                                        error: function(data) {

                                            if (data.status === 422) {
                                                var errors = $.parseJSON(data.responseText);
                                                $.each(errors, function(key, value) {
                                                    // console.log(key+ " " +value);
                                                    $('#response').addClass(
                                                        "alert alert-danger");

                                                    if ($.isPlainObject(value)) {
                                                        $.each(value, function(key, value) {
                                                            console.log(key + " " +
                                                                value);
                                                            $('#response').show()
                                                                .append(value +
                                                                    "<br/>");

                                                        });
                                                    } else {
                                                        $('#response').show().append(value +
                                                            "<br/>"
                                                        ); //this is my div with messages
                                                    }
                                                });
                                            }

                                        }

                                    });
                                }
                            });

                        });
                        //UnBlock Transaction
                        $('#UnBlockWalletBal').on('click', function(d) {
                            //d.preventDefault();

                            var UserId = $(this).data('userid');
                            console.log("UserId: " + UserId);
                            $.ajax({
                                url: '{{ url('api/admin/user') }}/' + UserId +
                                    '/wallet-balance-block',
                                type: 'patch',
                                dataType: 'JSON',
                                data: {
                                    'amount': 0
                                },

                                success: function(data) {
                                    if (data.error_code == 0) {
                                        console.log(data);
                                        console.log("Msg: " + data.meta.message);
                                        //location.reload();
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

                                },

                                error: function(data) {

                                    if (data.status === 422) {
                                        var errors = $.parseJSON(data.responseText);
                                        $.each(errors, function(key, value) {
                                            // console.log(key+ " " +value);
                                            $('#response').addClass(
                                                "alert alert-danger");

                                            if ($.isPlainObject(value)) {
                                                $.each(value, function(key, value) {
                                                    console.log(key + " " +
                                                        value);
                                                    $('#response').show()
                                                        .append(value +
                                                            "<br/>");

                                                });
                                            } else {
                                                $('#response').show().append(value +
                                                    "<br/>"
                                                ); //this is my div with messages
                                            }
                                        });
                                    }

                                }
                            });

                        });



                        //Edit Package
                        $(".package_class").on('click', function() {
                            console.log("inside edit package");
                            var packageType = $(this).data('packagetype');

                            console.log(packageType);
                            $.ajax({
                                url: '{{ url('api/payment-charge-package') }}',
                                type: 'get',
                                data: {
                                    'package_type': packageType,
                                    'request_origin': 'web'
                                },
                                success: function(data) {
                                    console.log('data');
                                    $('#payment_charge_package_id').empty();
                                    $.each(data.data, function($index, $value) {

                                        $('#payment_charge_package_id').append('<option value="' +
                                            $value
                                            .id + '" >' + $value
                                            .package_name + '</option>');
                                    })
                                }
                            });
                            $('#update_payment_charge_package').modal('show');

                        });
                        $('#updatePaymentChargePackage').on('submit', function(e) {
                            console.log("gdg");
                            e.preventDefault();
                            var formFields = $('#updatePaymentChargePackage').serialize();
                            console.log("Fields: " + formFields);
                            $.ajax({
                                url: '{{ url('api/user') }}/' + userId,
                                type: 'patch',
                                dataType: 'JSON',
                                data: formFields,
                                success: function(data) {
                                    //alert(JSON.stringify(meta.message));
                                    console.log("ttttt");
                                    if (data.error_code == 0) {
                                        console.log(data);
                                        $('#update_payment_charge_package').modal('hide');
                                        //location.reload();
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

                                    $('#updatePaymentChargePackage').closest('form').find(
                                        "input[type=text], textarea").val(
                                        "");

                                },
                                error: function(data) {

                                    if (data.status === 422) {
                                        var errors = $.parseJSON(data.responseText);
                                        $.each(errors, function(key, value) {
                                            // console.log(key+ " " +value);
                                            $('#response').addClass(
                                                "alert alert-danger");

                                            if ($.isPlainObject(value)) {
                                                $.each(value, function(key, value) {
                                                    console.log(key + " " +
                                                        value);
                                                    $('#response').show()
                                                        .append(value +
                                                            "<br/>");

                                                });
                                            } else {
                                                $('#response').show().append(value +
                                                    "<br/>"
                                                ); //this is my div with messages
                                            }
                                        });
                                    }

                                }



                            });
                        });


                    });
                </script>

</body>

</html>
