<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pacpay Admin Panel</title>


    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet" media="screen" />

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
                            <h5 class="m-0 font-weight-bold text-primary">Payment Charge Package</h5>
                            <button type="submit" class="btn-fill btn" id='submit_button'
                                style="float:right; margin-top: -20px;">Create Package</button>
                        </div>
                        <form name='filter_search' id='filter_search' style="margin-top: 20px;">
                            <div class="col-12 col-sm-6 col-md-6 input-group input-daterange">
                                <div class="form-group">
                                    <label>Package Type</label>
                                    <select name="package_type" id="package_type"
                                        class="select2 form-control custom-select">
                                        <option value="" selected="selected">Select Package Type</option>
                                        <option value="MERCHANT_PAYMENT">Merchant Payment</option>
                                        <option value="P2P_PAYMENT">P2P Payment</option>
                                        <option value="BILL_PAYMENT">Bill Payment</option>
                                    </select>
                                </div>
                                &nbsp;&nbsp;
                                <div class="form-group">
                                    <button type="button" name="filter" id="filter" class="btn btn-info btn-sm"
                                        style="text-align: center; height : 40px; width: 80px;">Filter</button>
                                </div>
                                {{-- &nbsp;&nbsp; --}}

                            </div>
                        </form>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">Package Name</th>
                                            <th class="text-center">Package Type</th>
                                            <th class="text-center">Max Charge</th>
                                            <th class="text-center">Min Charge</th>
                                            <th class="text-center">Percentage Charge</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                    </tbody>
                                </table>
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

    <!-- Create Payment Charge Package -->
    <div class="modal fade" id="create_package_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Create Payment Charge Package</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span> </button>
                </div>
                <div class="modal-body">
                    <form name='createPackage' id='createPackage'>
                        <div class="row">
                            <div class="col-md-6" style="margin:0 auto; display:block;">
                                <div class="form-group">
                                    <label> Package Name</label>
                                    <div class="input-group">
                                        <input type="text" name="package_name" class="form-control" id="package_name"
                                            required>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Package Type</label>
                                    <select name="package_type" id="package_type"
                                        class="select2 form-control custom-select">
                                        <option value="MERCHANT_PAYMENT" selected="selected">Merchant Payment</option>
                                        <option value="P2P_PAYMENT">P2P Payment</option>
                                        <option value="BILL_PAYMENT">Bill Payment</option>
                                    </select>
                                </div>
                                <div>
                                    <h6><b>Payment Charges</b></h6>
                                    <div class="form-group">
                                        <label>Max Charge</label>
                                        <div class="input-group">
                                            <input type="text" name="payment_charges[max_charge]"
                                                class="form-control" id="max_charge" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Min Charge</label>
                                        <div class="input-group">
                                            <input type="text" name="payment_charges[min_charge]"
                                                class="form-control" id="min_charge" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Percentage Charge</label>
                                        <div class="input-group">
                                            <input type="text" name="payment_charges[percentage_charge]"
                                                class="form-control" id="percentage_charge" required>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <br><br>
                        </div>
                        <div id='response'></div>
                        <div style="text-align:center">
                            <button type="submit" class="btn btn-primary btn-rounded btn-fw" id='submit_button'
                                data-user-id="" style="font-weight:500;">Add</button>
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        </div>

                    </form>


                </div>

                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

    <!-- Update Promotion Modal-->
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
                                    <label> Package Name</label>
                                    <div class="input-group">
                                        <input type="text" name="package_name" class="form-control"
                                            id="packageName" required>

                                    </div>
                                </div>
                                <div>
                                    <h6><b>Payment Charges</b></h6>
                                    <div class="form-group">
                                        <label>Max Charge</label>
                                        <div class="input-group">
                                            <input type="text" name="payment_charges[max_charge]"
                                                class="form-control" id="maxCharge" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Min Charge</label>
                                        <div class="input-group">
                                            <input type="text" name="payment_charges[min_charge]"
                                                class="form-control" id="minCharge" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Percentage Charge</label>
                                        <div class="input-group">
                                            <input type="text" name="payment_charges[percentage_charge]"
                                                class="form-control" id="percentageCharge" required>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <br><br>

                        </div>
                        <div id="response" style="text-align:center">
                            <button type="submit" class="btn btn-primary btn-rounded btn-fw" id='submit_button'
                                data-package-id="" style="font-weight:500;">Update</button>
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>


                </div>

                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

    <!-- Set Default Package -->
    <div class="modal fade" id="set_default_package" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Payment Charge Package</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span> </button>
                </div>
                <div class="modal-body">
                    <form name='updateDefaultPackageType' id='updateDefaultPackageType'>
                        <div class="row">
                            <div class="col-md-6" style="margin:0 auto; display:block;">
                                <div class="form-group">
                                    Set <input type="text" name="package_type" class="form-control"
                                        id="packageType" readonly> as default?
                                </div>

                            </div>

                            <br><br>

                        </div>
                        <div id="response" style="text-align:center">
                            <button type="submit" class="btn btn-primary btn-rounded btn-fw" id='submit_button'
                                data-package-id="" style="font-weight:500;">Set</button>
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>


                </div>

                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('vendor/datatables/jquery.dataTables.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".navbar-nav li").removeClass("active"); //this will remove the active class from  
            //previously active menu item 
            $('#setting').addClass('active');

            fetch_data();

            function fetch_data(package_type) {
                $('#dataTable').DataTable().clear().destroy();

                $('#dataTable').DataTable({
                    "lengthMenu": [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ],
                    "processing": true,
                    "serverSide": true,
                    "searching": false,
                    "ajax": {
                        url: '{{ url('api/payment-charge-package') }}',
                        data: function(d) {
                            d.package_type = package_type,
                                d.request_origin = 'web'
                        }

                    },
                    columnDefs: [{
                        targets: 6,
                        data: "is_default",
                        render: function(data, type, row, meta) {
                            // console.log(data + " " + type + " " + row + " " + meta);
                            if (data == 1) {
                                // console.log("inside if statement");
                                return '<td class="text-center"><div title="Default Package" style="color: rgb(0,128,0); border: none; background: none; text-align: center;  width="100px";"><i class="fa fa-check" aria-hidden="true"></i></div> <button data-packageid= "' +
                                    row
                                    .id +
                                    '"  class="update_promotion btn-fill-approve btn" style="width: 80px;" >Update</button> </td>';

                            } else {
                                return '<td class="text-center"><button data-packageid= "' +
                                    row
                                    .id +
                                    '"  class="set_default_package btn-package-type btn" style="background-color: #DDA0DD; color: black; width: 80px;" >Set as Default</button>&nbsp;&nbsp;<button data-packageid= "' +
                                    row
                                    .id +
                                    '"  class="update_promotion btn-fill-approve btn" style="width: 80px;" >Update</button> </td>';
                            }

                        }
                    }],
                    "columns": [{
                            data: 'created_at',
                            className: "created_at",
                            render: function(data, type, row, meta) {
                                return moment.utc(data).local().format('DD/MM/YYYY HH:mm a');
                            }
                        },
                        {
                            data: 'package_name',
                            className: "package_name"
                        },
                        {
                            data: 'package_type',
                            className: "package_type"
                        },
                        {
                            data: 'charges.payment_charges.max_charge',
                            className: "max_charge"
                        },
                        {
                            data: 'charges.payment_charges.min_charge',
                            className: "min_charge"
                        },
                        {
                            data: 'charges.payment_charges.percentage_charge',
                            className: "percentage_charge",
                        }

                    ]

                });


            }

            //Filter Button
            $('#filter').click(function() {
                var package_type = $('#package_type').val();


                fetch_data(package_type);
            });

            var spinner = $('#loader');

            //Create Payment Charge Package
            $("#submit_button").on('click', function() {
                $('#create_package_form').modal('show');
            });
            $('#createPackage').on('submit', function(e) {
                e.preventDefault();
                spinner.show();
                var formFields = $('#createPackage').serialize();


                $.ajax({
                    url: 'api/payment-charge-package',
                    type: 'post',
                    dataType: 'JSON',
                    data: formFields,
                    success: function(data) {
                        //alert(JSON.stringify(meta.message));

                        //console.log("ttttt");
                        if (data.error_code == 0) {
                            //console.log(data);
                            spinner.hide();
                            $('#create_package_form').modal('hide');
                            $('#dataTable').DataTable().ajax.reload();
                            Swal.fire({
                                title: "" + data.meta.message,
                                icon: 'success',
                                showCloseButton: true
                            })
                        } else {
                            swal(data.meta.message, "error");
                        }

                        $('#createPackage').closest('form').find(
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
                                        // console.log(key + " " +
                                        //     value);
                                        $('#response').show()
                                            .append(value +
                                                "<br/>");
                                        spinner.hide();
                                    });
                                } else {
                                    $('#response').show().append(value +
                                        "<br/>"
                                    ); //this is my div with messages
                                    spinner.hide();
                                }
                            });
                        }

                    }



                });
            });

            //Fetch Promotion Details
            $("#dataTable").on('click', '.update_promotion', function() {
                var packageName = $(this).closest('tr').find('.package_name').text();
                var maxCharge = $(this).closest('tr').find('.max_charge').text();
                var minCharge = $(this).closest('tr').find('.min_charge').text();
                var percentageCharge = $(this).closest('tr').find('.percentage_charge').text();

                $('#packageName').val(packageName);
                $('#maxCharge').val(maxCharge);
                $('#minCharge').val(minCharge);
                $('#percentageCharge').val(percentageCharge);

                $('#update_payment_charge_package').modal('show');


                $('#submit_button').attr('data-package-id', $(this).data('packageid'));
            });

            $('#updatePaymentChargePackage').on('submit', function(e) {
                //console.log("gdg");
                e.preventDefault();
                spinner.show();

                var formFields = $('#updatePaymentChargePackage').serialize();
                // console.log("Fields: " + formFields);
                var PackageId = $('#submit_button').data('package-id');
                // console.log("Voucher Id: " + PackageId);

                $.ajax({
                    url: 'api/payment-charge-package/' + PackageId,
                    type: 'patch',
                    dataType: 'JSON',
                    data: formFields,
                    success: function(data) {
                        //alert(JSON.stringify(meta.message));
                        // console.log("ttttt");
                        if (data.error_code == 0) {
                            //console.log(data);
                            spinner.hide();
                            $('#update_payment_charge_package').modal('hide');
                            $('#dataTable').DataTable().ajax.reload();
                            Swal.fire({
                                title: "" + data.meta.message,
                                icon: 'success',
                                showCloseButton: true
                            })
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
                                        // console.log(key + " " +
                                        //     value);
                                        $('#response').show()
                                            .append(value +
                                                "<br/>");
                                        spinner.hide();
                                    });
                                } else {
                                    $('#response').show().append(value +
                                        "<br/>"
                                    ); //this is my div with messages
                                    spinner.hide();
                                }
                            });
                        }

                    }



                });
            });


            //Set Default Package
            $("#dataTable").on('click', '.set_default_package', function() {
                var packageType = $(this).closest('tr').find('.package_type').text();
                // console.log("packageType " + packageType);
                $('#packageType').val(packageType);

                $('#set_default_package').modal('show');


                $('#submit_button').attr('data-package-id', $(this).data('packageid'));
            });

            $('#updateDefaultPackageType').on('submit', function(e) {
                // console.log("gdg");
                e.preventDefault();
                spinner.show();

                var formFields = $('#updateDefaultPackageType').serialize();
                // console.log("Fields: " + formFields);
                var PackageId = $('#submit_button').data('package-id');
                //console.log("Voucher Id: " + PackageId);

                $.ajax({
                    url: 'api/payment-charge-package/' + PackageId + '/set-default',
                    type: 'patch',
                    dataType: 'JSON',
                    data: formFields,
                    success: function(data) {
                        //alert(JSON.stringify(meta.message));
                        // console.log("ttttt");
                        if (data.error_code == 0) {
                            //  console.log(data);
                            spinner.hide();
                            $('#set_default_package').modal('hide');
                            $('#dataTable').DataTable().ajax.reload();
                            Swal.fire({
                                title: "" + data.meta.message,
                                icon: 'success',
                                showCloseButton: true
                            })
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
                                        // console.log(key + " " +
                                        //     value);
                                        $('#response').show()
                                            .append(value +
                                                "<br/>");
                                        spinner.hide();
                                    });
                                } else {
                                    $('#response').show().append(value +
                                        "<br/>"
                                    ); //this is my div with messages
                                    spinner.hide();
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
