
@extends('layouts.master')

@section('styles')

@endsection

@section('content')
	
                    <!-- PAGE-HEADER -->
                    <div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
                        <h1 class="page-title">Create Promotion Offer</h1>
                        <div>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/index')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Create Promotion Offer</li>
                            </ol>
                        </div>
                    </div>
                    <!-- PAGE-HEADER END -->

                    <!-- CONTAINER -->
                    <div class="main-container container-fluid adduser_container">
                        <!-- ROW-1 -->
                        <div class="row justify-content-center">
                            <div class="col-xl-12 p-0">
                                <form name='addNewVoucher' id='addNewVoucher'>
                                    @csrf
                                    <div class="card">
                                        <div class="card-body">
                                           <div class="row">
                                               <div class="col-xl-6 col-lg-6 col-sm-6">
                                                  <div class="form-group">
                                                    <label class="fw-semibold mt-4">Promotion Name</label>
                                                        <div class="input-group">
                                                            <input type="text" name="promotion_name" class="form-control"
                                                                id="promotion_name" required>
                                                        </div>
                                                  </div>
                                               </div>   
                                               <div class="col-xl-6 col-lg-6 col-sm-6">
                                                <div class="form-group">
                                                    <label class="fw-semibold mt-4">Voucher For</label>
                                                        <select name="voucher_for" id="voucher_for"
                                                            class="select2 form-control custom-select">
                                                            <option value="FUND_REQUEST" selected="selected">FUND_REQUEST
                                                            </option>
                                                            <option value="DEPOSIT">DEPOSIT</option>
                                                            <option value="BILL_PAYMENT">BILL_PAYMENT</option>
                                                            <option value="MERCHANT_PAYMENT">MERCHANT_PAYMENT</option>
                                                        </select>
                                                  </div>
                                              </div>
                                        </div>
                                        <div class="row">
                                                <div class="col-xl-6 col-lg-6 col-sm-6">
                                                    <div class="form-group">
                                                       <label class="fw-semibold">Expiry Date</label>
                                                       <div class="input-group">
                                                           <input type="date" name="expiry_date" class="form-control" id="expiry_date" required style="background-color: white;">                                                
                                                            <div class="input-group-text tx-fixed-white"> <i class="ri-calendar-line"></i> </div>
                                                        </div>
                                                     </div>
                                                </div> 
                                                <div class="col-xl-6 col-lg-6 col-sm-6">
                                                   <div class="form-group">
                                                    <label class="fw-semibold">Min Transaction Amount</label>
                                                        <div class="input-group">
                                                            <input type="text" name="min_txn_amount" class="form-control"
                                                                id="min_txn_amount" required>
                                                        </div>
                                                    </div>
                                               </div>
   
                                            </div>
                                            <div class="row">
                                               <div class="col-xl-6 col-lg-6 col-sm-6">
                                                    <div class="form-group">
                                                            <label>Cashback Type</label>
                                                            <div class="input-group">
                                                                <select name="cashback_type" id="cashback_type"
                                                                    class="select2 form-control custom-select">
                                                                    <option value="FIXED_AMOUNT" selected="selected">FIXED_AMOUNT
                                                                    </option>
                                                                    <option value="PERCENTAGE">PERCENTAGE</option>
                                                                </select>
                                                            </div>
                                                    </div>
                                                </div> 
                                                <div class="col-xl-6 col-lg-6 col-sm-6">
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
                                                </div>    
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-xl-6 col-lg-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Voucher Type</label>
                                                        <div class="input-group">
                                                            <select name="voucher_type" id="voucher_type"
                                                                class="select2 form-control custom-select">
                                                                <option value="INSTANT" selected="selected">INSTANT
                                                                </option>
                                                                <option value="RETURNING">RETURNING</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Reward Upto Max Amount</label>
                                                            <div class="input-group">
                                                                <input type="text" name="reward_upto_max_amount"
                                                                class="form-control" id="reward_upto_max_amount" required>
                                                            </div>
                                                    </div>
                                                </div>   
                                            </div>
                                            <div class="row">
                                               <div class="col-xl-6 col-lg-6 col-sm-6">
                                                    <div class="form-group">
                                                            <label>Voucher Description</label>
                                                            <div class="input-group">
                                                                <input type="text" name="voucher_description"
                                                                class="form-control" id="voucher_description" required>                                                            </div>
                                                            </div>
                                                    </div>    
                                                </div>    
                                        </div>
                                        <div class="card-footer">
                                            <div class="float-end btn-list">
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
    <!-- Date & Time Picker JS -->
    <script src="{{asset('build/assets/libs/flatpickr/flatpickr.min.js')}}"></script>

    <script type="text/javascript">
        // for Date
        flatpickr("#expiry_date", {});


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
                    window.location.reload();

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
@endsection
