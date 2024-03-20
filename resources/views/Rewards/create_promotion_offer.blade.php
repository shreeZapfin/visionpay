<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pacpay Admin Panel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
                            <h5 class="m-0 font-weight-bold text-primary">Create Promotion Offer</h5>

                        </div>

                        <div class="card">
                            <div class="card-body">


                                <form name='addNewVoucher' id='addNewVoucher'>
                                    <div class="row">
                                        <div class="col-md-6" style="margin:0 auto; display:block;">
                                            <div class="form-group">
                                                <label>Promotion Name</label>
                                                <div class="input-group">
                                                    <input type="text" name="promotion_name" class="form-control"
                                                        id="promotion_name" required>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Voucher For</label>
                                                <select name="voucher_for" id="voucher_for"
                                                    class="select2 form-control custom-select">
                                                    <option value="FUND_REQUEST" selected="selected">FUND_REQUEST
                                                    </option>
                                                    <option value="DEPOSIT">DEPOSIT</option>
                                                    <option value="BILL_PAYMENT">BILL_PAYMENT</option>
                                                    <option value="MERCHANT_PAYMENT">MERCHANT_PAYMENT</option>
                                                </select>
                                            </div>
                                            <div id="select_to" style="display: none;">
                                                <div class="form-group">
                                                    <label>Select To</label>
                                                    <select class="select2 form-control custom-select" name="user_id"
                                                        id="user_id">

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Expiry Date</label>
                                                <div class="input-group">
                                                    <input type="date" name="expiry_date" class="form-control"
                                                        id="expiry_date" required>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Min Transaction Amount</label>
                                                <div class="input-group">
                                                    <input type="text" name="min_txn_amount" class="form-control"
                                                        id="min_txn_amount" required>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Cashback Type</label>
                                                <select name="cashback_type" id="cashback_type"
                                                    class="select2 form-control custom-select">
                                                    <option value="FIXED_AMOUNT" selected="selected">FIXED_AMOUNT
                                                    </option>
                                                    <option value="PERCENTAGE">PERCENTAGE</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <div id="cashbackAmt">
                                                    <label>Cashback Amount</label>
                                                </div>
                                                <div id="PerchantageAmt" style="display: none;">
                                                    <label>Perchantage Amount</label>
                                                </div>

                                                <div class="input-group">
                                                    <input type="text" name="cashback_amount" class="form-control"
                                                        id="cashback_amount" required>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Voucher Type</label>
                                                <select name="voucher_type" id="voucher_type"
                                                    class="select2 form-control custom-select">
                                                    <option value="INSTANT" selected="selected">INSTANT
                                                    </option>
                                                    <option value="RETURNING">RETURNING</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Reward Upto Max Amount</label>
                                                <div class="input-group">
                                                    <input type="text" name="reward_upto_max_amount"
                                                        class="form-control" id="reward_upto_max_amount" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Voucher Description</label>
                                                <div class="input-group">
                                                    <input type="text" name="voucher_description"
                                                        class="form-control" id="voucher_description" required>
                                                </div>
                                            </div>

                                        </div>

                                        <br><br>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <div id='response'></div>
                                                <div class="col-sm-4"
                                                    style="text-align: center;display: block;margin: 0 auto; padding-top: 30px;">
                                                    <button type="submit" class="btn btn-primary btn-rounded btn-fw"
                                                        style="font-weight:500;">Add</button>

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



    <script type="text/javascript">
        $(document).ready(function() {
            $(".navbar-nav li").removeClass("active");
            $('#rewards').addClass('active');

            $('#cashback_type').on('change', function() {
                if (this.value == 'PERCENTAGE') {
                    $("#PerchantageAmt").show();
                    $("#cashbackAmt").hide();
                } else {
                    $("#PerchantageAmt").hide();
                    $("#cashbackAmt").show();
                }
            });
        });

        $('#voucher_for').on('change', function() {
            if (this.value == 'BILL_PAYMENT') {
                $("#select_to").show();
                $.ajax({
                    // url: 'api/biller',
                    url: '{{ url('api/biller') }}',
                    type: 'get',
                    success: function(data) {
                        //console.log('data');
                        $('#user_id').empty();
                        $('#user_id').append('<option value="" > For All </option>');
                        $.each(data.data.data, function($index, $value) {

                            $('#user_id').append('<option value="' + $value.id + '" >' + $value
                                .biller_name + '</option>');
                        })
                    }
                });

            } else if (this.value == 'MERCHANT_PAYMENT') {
                $("#select_to").show();
                $.ajax({
                    url: 'api/user/search',
                    type: 'get',
                    /*  data: function(d) {
                         d.user_type_id = 4,
                             d.request_origin = 'web',
                             d.is_pending_verification = 0
                     } */
                    data: {
                        'user_type_id': 4,
                        'request_origin': 'web',
                        'is_pending_verification': 0
                    },
                    success: function(data) {
                        // console.log('data');
                        $('#user_id').empty();
                        $('#user_id').append('<option value="" > For All </option>');
                        $.each(data.data, function($index, $value) {

                            $('#user_id').append('<option value="' + $value.id + '" >' +
                                $value.business.business_name + '</option>');
                        })
                    }
                });
            } else {
                $("#select_to").hide();
            }
        });

        var spinner = $('#loader');

        $('#addNewVoucher').on('submit', function(e) {
            e.preventDefault();
            spinner.show();
            var formFields = $('#addNewVoucher').serialize();

            $.ajax({
                url: 'api/promotion',
                type: 'post',
                dataType: 'JSON',
                data: formFields,
                success: function(data) {
                    //alert(JSON.stringify(meta.message));
                    // console.log("ttttt");
                    if (data.error_code == 0) {
                        //  console.log(data);
                        spinner.hide();
                        Swal.fire({
                            title: "" + data.meta.message,
                            icon: 'success',
                            showCloseButton: true
                        })
                    } else {
                        swal(data.meta.message, "error");
                    }

                    $('#addNewVoucher').closest('form').find("input[type=text], textarea").val("");

                },
                error: function(data) {

                    if (data.status === 422) {
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
        });
    </script>
</body>

</html>
