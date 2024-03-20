@extends('layouts.master')
@section('styles')
<style>
    .voucher_description{
        width: 150px !important;
        border:1px solid red;
    }
</style>
@endsection
@section('content')
                    <!-- PAGE-HEADER -->
                    <div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
                        <h1 class="page-title">Incomplete Registration</h1>
                        <div>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/index')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Incomplete Registration</li>
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
                                    <div class="card-body p-4">
                                        <div class="row align-items-center">
                                            <form name='filter_search' id='filter_search' style="margin-top: 20px;">
                                                    <div class="input-group">
                                                        <div class="form-group col-sm">
                                                            <label>Voucher For</label>
                                                            <select name="voucher_for" id="voucher_for"
                                                                class="select2 form-control custom-select">
                                                                <option value="" selected="selected">Select Vocher For</option>
                                                                <option value="MERCHANT_PAYMENT">Merchant Payment</option>
                                                                <option value="FUND_REQUEST">Fund Request</option>
                                                                <option value="BILL_PAYMENT">Bill Payment</option>
                                                                <option value="DEPOSIT">Deposit</option>
                                                            </select>
                                                        </div> &nbsp;&nbsp;
                                                        <div class="form-group col-sm">
                                                        <label>Status</label>
                                                            <select name="is_active" id="is_active" class="select2 form-control custom-select">
                                                                <option value="" selected="selected">Select Status</option>
                                                                <option value="true">Active</option>
                                                                <option value="false">Expired</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-sm d-flex report_btns" style="padding-top: 29px !important;">
                                                                    <button type="button" name="filter" id="filter"
                                                                        class="btn btn-info btn-sm filter">Filter
                                                                    </button>
                                                            </div>
                                                    </div>
                                                </form>
                                            <div class="e-table px-5 pb-5 pd-12">
                                                <div class="table-responsive table-lg">
                                                    <table class="table border-top table-bordered mb-0 text-nowrap allvouchers_dtable" id="dataTable" style="width:100%;">
                                                        <thead class="border-top">
                                                            <tr>
                                                                <th class="border-bottom-0">Date</th>
                                                                <th class="border-bottom-0">Promotion Name</th>
                                                                <th class="border-bottom-0">Voucher For</th>
                                                                <th class="border-bottom-0">Expiry Date</th>
                                                                <th class="border-bottom-0">Min Transaction<br>Amount</th>
                                                                <th class="border-bottom-0">Cashback<br>Amount</th>
                                                                <th class="border-bottom-0">Voucher<br>Description</th>
                                                                <th class="border-bottom-0 ">Code</th>
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
                                <!-- /.container-fluid -->
                                <div id='response'></div>
                            </div>
                        </div>
                        <!-- ROW CLOSED -->
                    </div>
                    <!-- CONTAINER CLOSED -->
   
                        <!-- Update Promotion Modal-->
    <div class="modal fade" id="update_promotion_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit bank details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4">
                    <form name='updateVoucher' id='updateVoucher'>
                        <div class="row gy-3">
                                <div class="col-xl-12">
                                    <label>Promotion Name</label>
                                        <input type="text" name="promotion_name" class="form-control"
                                            id="promotion_name" required>
                                </div>
                                <div class="col-xl-12">
                                    <label>Expiry Date</label>
                                        <input type="date" name="expiry_date" class="form-control"
                                            id="expiry_date" required>
                                </div>
                                <div class="col-xl-12">
                                    <label>Min Transaction Amount</label>
                                        <input type="text" name="min_txn_amount" class="form-control"
                                            id="min_txn_amount" required>
                                </div>

                                <div class="col-xl-12">
                                    <label>Cashback Amount</label>
                                        <input type="text" name="cashback_amount" class="form-control"
                                            id="cashback_amount" required>
                                </div>
                                <div class="col-xl-12">
                                    <label>Voucher Description</label>
                                        <input type="text" name="voucher_description" class="form-control"
                                            id="voucher_description" required>
                                </div>
                                {{-- <div class="col-xl-12">
                                    <label>Status</label>
                                    <select name="is_active" id="is_active" class="select2 form-control custom-select">
                                        <option value=true selected="selected">Active</option>
                                        <option value=false>Expired</option>
                                    </select>
                                </div> --}}
                        </div>
                        <div id="response" class="px-4 py-4 text-center">
                            <button type="submit" class="btn btn-primary btn-rounded btn-fw" id='submit_button'
                                data-voucher-id="" style="font-weight:500;">Update</button>
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


 <!-- Transaction More Details Modal-->
 <div class="modal fade" id="more_details_form" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Voucher Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form name='MoreDetails' id='MoreDetails'>
                        <div class="row">
                            <div style="margin:5%;">
                                <table class="table table-bordered" cellspacing="0">
                                    <tr>
                                        <th>Promotion Name:</th>
                                        <td><input type="text" class="form-control" id="VoucherName"
                                                disabled="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Date:</th>
                                        <td><input type="text" class="form-control" id="VoucherDate"
                                                disabled=""></td>
                                    </tr>
                                    <tr>
                                        <th>Voucher For:</th>
                                        <td><input type="text" class="form-control" id="VoucherFor"
                                                disabled="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Expiry Date:</th>
                                        <td><input type="text" class="form-control" id="VoucherExpDate"
                                                disabled="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Min Transaction Amount:</th>
                                        <td><input type="text" class="form-control" id="VoucherMinTransAmt"
                                                disabled="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Cashback Amount:</th>
                                        <td><input type="text" class="form-control" id="VoucherCashbackAmt"
                                                disabled="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Code:</th>
                                        <td>
                                            <input type="text" class="form-control" id="VoucherCode"
                                                disabled="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Description:</th>
                                        <td>
                                            <textarea type="text" class="form-control" id="VoucherDesc" disabled=""></textarea>
                                        </td>
                                    </tr>

                                </table>
                                <table class="table table-bordered appendfields" cellspacing="0" cellpadding="0"
                                    style="padding: 0%; border-collapse:collapse;">
                                </table>
                                <br />
                                {{-- <h4>Voucher Used By:</h4>
                                <table class="table table-bordered appendUserList" cellspacing="0">
                                </table> --}}
                            </div>

                        </div>
                        <div class="px-4 py-4 text-center">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
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
            $('#rewards').addClass('active');

            fetch_data();

            function fetch_data(voucher_for, is_active) {
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
                        url: '{{ url('api/promotion') }}',
                        data: function(d) {
                            d.voucher_for = voucher_for,
                                d.is_active = is_active,
                                d.request_origin = 'web'
                        }

                    },
                    columnDefs: [{
                        targets: 8,
                        render: function(data, type, row, meta) {

                            if (row.voucher.data.is_active == 1) {
                                return '<td class="text-center"><button title="Disable Voucher" data-promotionid= "' +
                                    row
                                    .id +
                                    '"  class="btn disable_voucher btn-block btn btn-secondary">Disable </button><button data-voucherid= "' +
                                    row
                                    .id +
                                    '"  class="update_promotion btn-fill-approve btn btn-block btn btn-primary" style="width: 80px;" >Update</button><a class="btn btn-default mt-2"  title="View More details" href="{{ url('voucher-detail') }}/' +
                                    row
                                    .id +
                                    '" " style="width: 80px; background:#BD31B8; color: rgb(255,255,255);">View</a></td>';

                            } else {
                                return '<td class="text-center"><button title="Enable Voucher" data-promotionid= "' +
                                    row
                                    .id +
                                    '"  class="btn enable_voucher btn-fill-approve btn-block btn btn-success">Enable</button><button data-voucherid= "' +
                                    row
                                    .id +
                                    '"  class="update_promotion btn-fill-approve btn btn-block btn btn-primary" style="width: 80px;" >Update</button><a class="btn btn-default mt-2"  title="View More details" href="{{ url('voucher-detail') }}/' +
                                    row
                                    .id +
                                    '" style="width: 80px; background:#BD31B8; color: rgb(255,255,255);">View</a></td>';

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
                            data: 'promotion_name',
                            className: "promotion_name",
                        },
                        {
                            data: 'voucher.data.voucher_for',
                            className: "voucher_for",
                        },
                        {
                            data: 'voucher.expires_at',
                            className: "expires_at",
                            render: function(data, type, row, meta) {
                                return moment.utc(data).local().format('DD/MM/YYYY HH:mm a');
                            }
                        },
                        {
                            data: 'voucher.data.min_txn_amount',
                            className: "min_txn_amount",
                        },
                        {
                            data: 'voucher.data.cashback_amount',
                            className: "cashback_amount",
                        },
                        {
                            data: 'voucher.data.voucher_description',
                            className: "voucher_description",
                        },
                        {
                            data: 'voucher.code',
                            className: "voucher_code",
                        }
                    ]

                });


            }

            //Filter Button
            $('#filter').click(function() {
                var voucher_for = $('#voucher_for').val();
                var is_active = $('#is_active').val();


                fetch_data(voucher_for, is_active);
            });

            //Fetch Promotion Details
            $("#dataTable").on('click', '.update_promotion', function() {
                var promotion_name = $(this).closest('tr').find('.promotion_name').text();
                var expires_at = $(this).closest('tr').find('.expires_at').text();
                var min_txn_amount = $(this).closest('tr').find('.min_txn_amount').text();
                //var cashback_type = $(this).closest('tr').find('.cashback_type').text();
                var cashback_amount = $(this).closest('tr').find('.cashback_amount').text();
                var voucher_description = $(this).closest('tr').find('.voucher_description').text();
                //var is_active = $(this).closest('tr').find('.is_active').text();

                $('#promotion_name').val(promotion_name);
                $('#expiry_date').val(expires_at);
                $('#min_txn_amount').val(min_txn_amount);
                // $('#cashback_type').val(cashback_type);
                $('#cashback_amount').val(cashback_amount);
                $('#voucher_description').val(voucher_description);
                //$('#is_active').val(is_active);

                $('#update_promotion_form').modal('show');


                $('#submit_button').attr('data-voucher-id', $(this).data('voucherid'));
            });
            $('#updateVoucher').on('submit', function(e) {
                //  console.log("gdg");
                e.preventDefault();


                var formFields = $('#updateVoucher').serialize();
                //console.log("Fields: " + formFields);
                var VoucherId = $('#submit_button').data('voucher-id');
                //console.log("Voucher Id: " + VoucherId);

                $.ajax({
                    url: 'api/promotion/' + VoucherId,
                    type: 'patch',
                    dataType: 'JSON',
                    data: formFields,
                    success: function(data) {
                        //alert(JSON.stringify(meta.message));
                        // console.log("ttttt");
                        if (data.error_code == 0) {
                            // console.log(data);
                            $('#update_promotion_form').modal('hide');
                            $('#dataTable').DataTable().ajax.reload();
                            Swal.fire({
                                title: "" + data.meta.message,
                                icon: 'success',
                                showCloseButton: true
                            })
                        } else {
                            swal(data.meta.message, "error");
                        }

                        $('#updateVoucher').closest('form').find(
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

            //Disable Voucher
            $("#dataTable").on('click', '.disable_voucher', function() {
                //d.preventDefault();

                var PromotionId = $(this).data('promotionid');
                //  console.log("PromotionId: " + PromotionId);

                Swal.fire({
                    title: "Do you want to Disable this Voucher?",
                    text: "",
                    showCancelButton: true
                }).then((result) => {
                    if (result.value) {
                        // console.log("Result: " + result.value);
                        $.ajax({
                            url: '{{ url('api/promotion') }}/' + PromotionId,
                            type: 'patch',
                            dataType: 'JSON',
                            data: {
                                'is_active': 0
                            },
                            success: function(data) {
                                //alert(JSON.stringify(meta.message));
                                // console.log("ttttt");
                                if (data.error_code == 0) {
                                    // console.log(data);

                                    $('#dataTable').DataTable().ajax.reload();
                                    Swal.fire({
                                        title: "" + data.meta.message,
                                        icon: 'success',
                                        showCloseButton: true
                                    })
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
                                                // console.log(key + " " +
                                                //     value);
                                                $('#response').show()
                                                    .append(value +
                                                        "<br/>");

                                                alert("Error:" +
                                                    value);
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
            //Enable Voucher
            $("#dataTable").on('click', '.enable_voucher', function() {
                var PromotionId = $(this).data('promotionid');
                // console.log("PromotionId: " + PromotionId);

                Swal.fire({
                    title: "Do you want to Enable this Voucher?",
                    text: "",
                    showCancelButton: true
                }).then((result) => {
                    if (result.value) {
                        // console.log("Result: " + result.value);
                        $.ajax({
                            url: '{{ url('api/promotion') }}/' + PromotionId,
                            type: 'patch',
                            dataType: 'JSON',
                            data: {
                                'is_active': 1
                            },
                            success: function(data) {
                                //alert(JSON.stringify(meta.message));
                                // console.log("ttttt");
                                if (data.error_code == 0) {
                                    // console.log(data);

                                    $('#dataTable').DataTable().ajax.reload();
                                    Swal.fire({
                                        title: "" + data.meta.message,
                                        icon: 'success',
                                        showCloseButton: true
                                    })
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
                                                // console.log(key + " " +
                                                //     value);
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

            //Transaction More Details
            $("#dataTable").on('click', '.more_details', function() {
                //console.log($(this));
                var VoucherId = $(this).data('voucherid');
                // console.log("VoucherId: " + VoucherId);

                $('.appendUserList').empty();
                $('.appendfields').empty();
                var created_at = $(this).closest('tr').find('.created_at').text();
                var promotion_name = $(this).closest('tr').find('.promotion_name').text();
                var voucher_for = $(this).closest('tr').find('.voucher_for').text();
                var expires_at = $(this).closest('tr').find('.expires_at').text();
                var min_txn_amount = $(this).closest('tr').find('.min_txn_amount').text();
                var cashback_amount = $(this).closest('tr').find('.cashback_amount').text();
                var voucher_description = $(this).closest('tr').find('.voucher_description').text();
                var voucher_code = $(this).closest('tr').find('.voucher_code').text();

                $('#VoucherName').val(promotion_name);
                $('#VoucherDate').val(created_at);
                $('#VoucherFor').val(voucher_for);
                $('#VoucherExpDate').val(expires_at);
                $('#VoucherMinTransAmt').val(min_txn_amount);
                $('#VoucherCashbackAmt').val(cashback_amount);
                $('#VoucherDesc').val(voucher_description);
                $('#VoucherCode').val(voucher_code);

                /*  $('#more_details_form').modal('show'); */

                $.ajax({
                    url: 'api/promotion',
                    type: 'get',
                    data: {
                        'voucher_id': VoucherId
                    },
                    async: false,
                    success: function(data) {
                        //console.log(data);

                        $.each(data.data.data, function($index, $value) {
                            // console.log("fhd");
                            // console.log("fname: " + $value);

                            if (voucher_for == 'FUND_REQUEST') {
                                $('.appendfields').append(
                                    '<tr><th>Transaction Type: </th><td>' + $value
                                    .promotion_transaction_type +
                                    '</tr><tr><th>Cashback Type: </th><td>' +
                                    $value.voucher.data.cashback_type +
                                    '</td></tr><tr><th>Voucher Type: </th><td>' +
                                    $value.voucher.data.voucher_type +
                                    '</td></tr></tr>'
                                );

                            } else {

                            }

                        })


                    }
                });

                //Voucher list used by user
                /*   $.ajax({
                      url: 'api/user/search',
                      type: 'get',
                      data: {
                          'voucher_id': VoucherId
                      },
                      async: false,
                      success: function(data) {
                          console.log(data);

                          $.each(data.data.data, function($index, $value) {
                              console.log("fhd");
                              console.log("fname: " + $value);

                              $('.appendUserList').append(
                                  '<tr><th>Name: </th><td><input type="text" class="form-control"  value="' +
                                  $value.full_name +
                                  '" disabled=""></td></tr><tr><th>User Type</th><td><input type="text" class="form-control"  value="' +
                                  $value.user_type +
                                  '" disabled=""></td></tr><tr><th>Mobile Number: </th><td><input type="text" class="form-control"  value="' +
                                  $value.mobile_no +
                                  '" disabled=""></td></tr></tr>'
                              );


                          })


                      }
                  }); */

            });

        });
    </script>


@endsection
