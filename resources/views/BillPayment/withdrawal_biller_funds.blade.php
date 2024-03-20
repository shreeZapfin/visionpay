@extends('layouts.master')
@section('styles')
    {{-- Date Picker --}}
        <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />

@endsection
@section('content')
                    <!-- PAGE-HEADER -->
                    <div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
                        <h1 class="page-title">Biller Withdrawal Funds</h1>
                        <div>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/index')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Biller Withdrawal Funds</li>
                            </ol>
                        </div> 
                    </div>
                    <!-- PAGE-HEADER END -->

                    <!-- CONTAINER -->
                    <div class="main-container container-fluid adduser_container">
                        <!-- ROW-1 -->
                        <div class="row justify-content-center">
                            <div class="col-xl-12 p-0">
                                <form name='biller_funds' id='biller_funds'>
                                    @csrf
                                    <div class="card">
                                        <div class="card-body">
                                           <div class="row">
                                               <div class="col-xl-6 col-lg-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label class="fw-semibold mt-4">Select Biller</label>
                                                        <div class="input-group">
                                                            <select name="biller" id="biller"
                                                                class="select2 form-control custom-select" required>
                                                            </select>
                                                        </div>
                                                    </div>
                                               </div>   
                                               <div class="col-xl-6 col-lg-6 col-sm-6">
                                                <div class="form-group">
                                                    <label class="fw-semibold mt-4">Balance</label>
                                                        <div class="input-group">
                                                            <input type="text" name="balance" class="form-control" id="balance"
                                                            readonly>
                                                        </div>
                                                  </div>
                                              </div>
                                        </div>

                                        <div class="row">
                                                <!-- <div class="col-xl-6 col-lg-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label class="fw-semibold">Biller Balance</label>
                                                            <div class="input-group mob_inputgroup">
                                                                <input type="text" class="form-control" id="billerBalance" required
                                                                    disabled>
                                                            </div>
                                                    </div>
                                                </div> -->
                                                
                                                <div class="col-xl-6 col-lg-6 col-sm-6">
                                                    <div class="form-group">
                                                       <label class="fw-semibold">Amount</label>
                                                       <div class="input-group">
                                                            <input type="text" name="amount" class="form-control"
                                                                id="amount" required>                                               
                                                        </div>
                                                     </div>
                                                </div>  
                                                <div class="col-xl-6 col-lg-6 col-sm-6">
                                                    <div class="form-group">
                                                            <label>Remark</label>
                                                            <div class="input-group">
                                                                <input type="text" name="remark" class="form-control"
                                                                id="remark" required>
                                                            </div>
                                                    </div>
                                                </div>   
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-6 col-lg-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label class="fw-semibold">Transaction Pin</label>
                                                        <div class="input-group">
                                                            <input type="text" name="transaction_pin" 
                                                            id="transaction_pin"
                                                            autocomplete="one-time-code" required inputmode="numeric" maxlength="4">
                                                        </div>
                                                    </div>
                                               </div>
                                               <input type="text" name="pin" id="pin" hidden/>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="float-end btn-list">
                                                <button type="submit" class="btn btn-primary btn-rounded btn-fw"
                                                id='withdrawal_biller_funds_submit_button' data-user-id=""
                                                style="font-weight:500;">Add Funds</button>
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
<script type="text/javascript">
        //Add asterisk in TIN input
        transaction_pin.addEventListener("keyup", function changeChar() {
                    const asterisks = "****";
                    document.getElementById("pin").value = transaction_pin.value;
                    if(transaction_pin.value.length == 4){
                        if (transaction_pin.value.length <= asterisks.length) {
                            let newNumber = asterisks.substring(0, transaction_pin.value.length);
                            transaction_pin.value = newNumber;
                        }
                    }
                    
                });
        $(document).ready(function() {
            $(".navbar-nav li").removeClass("active"); //this will remove the active class from
            //previously active menu item
            $('#bill_payment').addClass('active');


        });

        var BillerId = null;

        //Select Biller
        $.ajax({
            url: 'api/biller',
            type: 'get',
            success: function(data) {
                // console.log('data');

                $('#biller').empty();
                $.each(data.data.data, function($index, $value) {

                    $('#biller').append('</option>' + '<option value="' + $value.id +
                        '" >' +
                        $value
                        .biller_name + '</option>');

                    // console.log("UserId: " + UserId);
                });
                BillerId = $('#biller').val();
                //console.log("BillerName: " + BillerId);
                $.ajax({
                    url: '{{ url('api/biller') }}/' + BillerId,
                    type: 'get',
                    success: function(data) {
                        // console.log('data');
                        $('#balance').val(data.data.user.wallet.balance);
                        //console.log("bal: " + data.data.user.wallet.balance);
                    }
                });
            }
        });




        var spinner = $('#loader');
        $('#biller_funds').on('submit', function(e) {
            e.preventDefault();
            spinner.show();
            /*  // Activate the loading spinner
             $('.loading-spinner').toggleClass('active'); */

            var send_to = $('#biller').val();
            // console.log("send_to: " + send_to);

            var formFields = new FormData(this);

            //console.log(formFields);

            $.ajax({
                url: '{{ url('api/user/withdrawal') }}/' + send_to +
                    '/admin-withdrawal',
                type: 'post',
                dataType: 'JSON',
                data: formFields,
                contentType: false, // The content type used when sending data to the server.
                //cache: false, // To unable request pages to be cached
                processData: false,
                success: function(data) {
                    //alert(JSON.stringify(meta.message));
                    // console.log("ttttt");
                    if (data.error_code == 0) {
                        // console.log(data);
                        spinner.hide();
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
                    if (data.status == 400) {
                            $('#add_funds_form').modal('hide');
                            window.location.reload();
                            spinner.hide();
                            Swal.fire({
                                title: "" + data.responseJSON.meta
                                    .message,
                                icon: 'error',
                                showCloseButton: true
                            })
                        } else
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
