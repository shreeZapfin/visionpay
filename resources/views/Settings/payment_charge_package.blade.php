@extends('layouts.master')
@section('styles')
@endsection
@section('content')
                    <!-- PAGE-HEADER -->
                    <div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
                        <h1 class="page-title">Payment Charge Package</h1>
                        <div>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/index')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Payment Charge Package</li>
                            </ol>
                        </div> 
                    </div>
                    <!-- PAGE-HEADER END -->

                    <!-- CONTAINER -->
                    <div class="main-container container-fluid">
                        <!-- ROW OPEN -->
                        <div class="row row-cards">
                            <div class="col-xl-12">
                                <div class="card p-0">
                                    <div class="row align-items-center">
                                            <form name='filter_search' id='filter_search' style="margin-top: 20px;">
                                                <div class="input-group">
                                                    <div class="form-group col-sm">
                                                        <label>Package Type</label>
                                                        <select name="package_type" id="package_type"
                                                            class="select2 form-control custom-select">
                                                            <option value="" selected="selected">Select Package Type</option>
                                                            <option value="MERCHANT_PAYMENT">Merchant Payment</option>
                                                            <option value="P2P_PAYMENT">P2P Payment</option>
                                                            <option value="BILL_PAYMENT">Bill Payment</option>
                                                        </select>
                                                    </div> &nbsp;&nbsp;
                                                    <button type="button" name="filter" id="filter" class="btn border"
                                                        style="text-align: center; margin-top:30px; height : 35px; width: 80px;border-top-right-radius: 0.3rem;border-bottom-right-radius: 0.3rem;     margin-right: 9px;">
                                                        <i class="bi bi-search text-muted"></i></button>
                                                    <div class="input-group col-sm justify-content-end pb-3">
                                                        <button type="button" class="btn-fill btn btn-secondary" id='submit_button'
                                                        style="text-align: center; margin-top:30px; height : 35px;border-top-left-radius: 0.3rem; border-bottom-left-radius: 0.3rem;border-top-right-radius: 0.3rem;border-bottom-right-radius: 0.3rem;     margin-right: 9px;">Create Package</button>
                                                    </div>
                                                </div>
                                            </form>
                                        <div class="card-body p-4">
                                            <div class="row align-items-center justify-content-end">
                                                <div class="e-table px-5 pb-5 pd-12">
                                                    <div class="table-responsive table-lg">
                                                        <table class="table border-top table-bordered mb-0 text-nowrap" id="dataTable" style="width:100%;">
                                                            <thead class="border-top">
                                                                <tr>
                                                                    <th class="border-bottom-0 ">Date</th>
                                                                    <th class="border-bottom-0 ">Package Name</th>
                                                                    <th class="border-bottom-0 ">Package Type</th>
                                                                    <th class="border-bottom-0 ">Max Charge</th>
                                                                    <th class="border-bottom-0 ">Min Charge</th>
                                                                    <th class="border-bottom-0 ">Percentage Charge</th>
                                                                    <th class="border-bottom-0">Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody></tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ROW CLOSED -->
                    </div>
                    <!-- CONTAINER CLOSED -->
                    
                        <!-- Create Payment Charge Package -->
        <div class="modal fade" id="create_package_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">Create Payment Charge Package</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-4">
                        <form name='createPackage' id='createPackage'>
                            <div class="row gy-3">
                                    <div class="col-xl-12">
                                        <label> Package Name</label>
                                            <input type="text" name="package_name" class="form-control" id="package_name"
                                                required>
                                    </div>
                                    <div class="col-xl-12">
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
                                        <div class="col-xl-12">
                                            <label>Max Charge</label>
                                                <input type="text" name="payment_charges[max_charge]"
                                                    class="form-control" id="max_charge" required>
                                        </div>
                                        <div class="col-xl-12">
                                            <label>Min Charge</label>
                                                <input type="text" name="payment_charges[min_charge]"
                                                    class="form-control" id="min_charge" required>
                                        </div>
                                        <div class="col-xl-12">
                                            <label>Percentage Charge</label>
                                                <input type="text" name="payment_charges[percentage_charge]"
                                                    class="form-control" id="percentage_charge" required>
                                        </div>
                                    </div>
                            </div>
                            <div id='response'></div>
                            <div class="text-center px-4 py-4">
                                <button type="submit" class="btn btn-primary btn-rounded btn-fw" id='submit_button'
                                    data-user-id="" style="font-weight:500;">Add</button>
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal" id="cancel_btn">Cancel</button>
                            </div>
                        </form>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body px-4">
                    <form name='updatePaymentChargePackage' id='updatePaymentChargePackage'>
                        <div class="row gy-3">
                                <div class="col-xl-12">
                                    <label> Package Name</label>
                                        <input type="text" name="package_name" class="form-control"
                                            id="packageName" required>
                                </div>
                                <div>
                                    <h6><b>Payment Charges</b></h6>
                                    <div class="col-xl-12">
                                        <label>Max Charge</label>
                                            <input type="text" name="payment_charges[max_charge]"
                                                class="form-control" id="maxCharge" required>
                                    </div>
                                    <div class="col-xl-12">
                                        <label>Min Charge</label>
                                            <input type="text" name="payment_charges[min_charge]"
                                                class="form-control" id="minCharge" required>
                                    </div>
                                    <div class="col-xl-12">
                                        <label>Percentage Charge</label>
                                            <input type="text" name="payment_charges[percentage_charge]"
                                                class="form-control" id="percentageCharge" required>
                                    </div>
                                </div>
                        </div>
                        <div id="response" class="text-center px-4 py-4">
                            <button type="submit" class="btn btn-primary btn-rounded btn-fw" id='submit_button'
                                data-package-id="" style="font-weight:500;">Update</button>
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal" id="cancel_btn">Cancel</button>
                        </div>
                    </form>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body px-4">
                    <form name='updateDefaultPackageType' id='updateDefaultPackageType'>
                        <div class="row py-3">
                                <div class="col-xl-12">
                                    Set <input type="text" name="package_type" class="form-control"
                                        id="packageType" readonly> as default?
                                </div>
                        </div>
                        <div id="response" class="text-center px-4 py-4">
                            <button type="submit" class="btn btn-primary btn-rounded btn-fw" id='submit_button'
                                data-package-id="" style="font-weight:500;">Set</button>
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal" id="cancel_btn">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
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
                                return '<td class="text-center"><div class="d-flex"><div title="Default Package"><i class="bi bi-check" style="color: #db555d;font-size: 20px;" aria-hidden="true"></i></div><button data-packageid= "' +
                                    row.id +
                                    '"  class="update_promotion btn-fill-approve btn btn-primary">Update</button></div></td>';

                            } else {
                                return '<td class="text-center"><button data-packageid= "' +
                                    row
                                    .id +
                                    '"  class="set_default_package btn-package-type btn btn-warning" >Set as Default</button>&nbsp;&nbsp;<button data-packageid= "' +
                                    row
                                    .id +
                                    '"  class="update_promotion btn-fill-approve btn btn-primary" >Update</button> </td>';
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
@endsection