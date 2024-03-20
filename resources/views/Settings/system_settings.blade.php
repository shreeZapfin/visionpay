@extends('layouts.master')
@section('styles')
@endsection
@section('content')
                    <!-- PAGE-HEADER -->
                    <div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
                        <h1 class="page-title">System Settings</h1>
                        <div>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/index')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">System Settings</li>
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
                                            <div class="input-group">
                                                <div class="input-group col-sm justify-content-end pb-3">
                                                    <button type="submit" class="btn-fill btn btn-primary" id='system_setting'>Update</button>
                                                </div>
                                            </div>
                                            <div class="e-table px-5 pb-5 pd-12">
                                                <h3 class="card-title pb-2 text-center">Withdrawal Commission Tiers(Range)</h3>
                                                <div class="table-responsive table-lg">
                                                    <form>
                                                        <table class="table border text-nowrap text-md-nowrap table-striped table-bordered mb-0">
                                                            <thead>
                                                                <tr>
                                                                <th>Min Withdrawal Amount</th>
                                                                <th>Max Withdrawal Amount</th>
                                                                <th>Commission Withdrawal Amount</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            {{-- {{ dd($systemsettings) }} --}}
                                                                @if ($systemsettings)
                                                                    @foreach ($systemsettings->withdrawal_commission_tiers['withdrawal_ranges'] as $key => $value)
                                                                        <tr>
                                                                            <td>{{ $value['min_range'] }}
                                                                            </td>
                                                                            <td>{{ $value['max_range'] }}
                                                                            </td>
                                                                            <td>{{ $value['commission'] }}
                                                                            </td>
                                                                        </tr>   
                                                                    @endforeach
                                                                @endif
                                                            </tbody>
                                                        </table>
                                                    </form>    
                                                </div>
                                            </div>
                                            <div class="e-table px-5 pb-5 pd-12">
                                                <h3 class="card-title pb-2 text-center"> Withdrawal Charges</h3>
                                                <div class="table-responsive table-lg">
                                                    <form>
                                                        <table class="table border text-nowrap text-md-nowrap table-striped table-bordered mb-0">
                                                            @if ($systemsettings)
                                                                @foreach ($systemsettings->withdrawal_charges as $key => $value)   
                                                                    <thead>
                                                                        <th><b>{{ $key }}</b></th>
                                                                        <tr>
                                                                        <th>Min Withdrawal Charge</th>
                                                                        <th>Max Withdrawal Charge</th>
                                                                        <th>Withdrawal Charge(Percentage Charge)</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @if ($systemsettings)
                                                                            @foreach ($systemsettings->withdrawal_charges as $key => $value)                                                                        <tr>
                                                                                    <td>{{ $value['min_charge'] }}
                                                                                    </td>
                                                                                    <td>{{ $value['max_charge'] }}
                                                                                    </td>
                                                                                    <td>{{ $value['percentage_charge'] }}
                                                                                    </td>
                                                                                </tr>   
                                                                            @endforeach
                                                                        @endif
                                                                    </tbody>
                                                                @endforeach
                                                            @endif
                                                        </table>
                                                    </form>    
                                                </div>
                                            </div>

                                            <div class="e-table px-5 pb-5 pd-12">
                                                <div class="table-responsive table-lg">
                                                    <form>
                                                        <table class="table border text-nowrap text-md-nowrap table-striped table-bordered mb-0">
                                                                    <thead>
                                                                        <tr>
                                                                        <th>Monthly Customer Deposit Limit</th>
                                                                        <th>Monthly Merchant Deposit Limit</th>
                                                                        <th>Agent Deposit Commission</th>
                                                                        <th>Daily Withdrawal Limit</th>
                                                                        <th>Min Withdrawal Limit</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>{{ $systemsettings->monthly_customer_deposit_limit }}</td>
                                                                            <td>{{ $systemsettings->monthly_merchant_deposit_limit }}</td>
                                                                            <td>{{ $systemsettings->agent_deposit_commission }}</td>
                                                                            <td>{{ $systemsettings->daily_withdrawal_limit }}</td>
                                                                            <td>{{ $systemsettings->min_withdrawal_limit }}</td>
                                                                        </tr>
                                                                    </tbody>
                                                        </table>
                                                    </form>    
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
                    
                                <!-- Update Promotion Modal-->
            <div class="modal fade" id="update_system_setting" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit System Settings</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                        </div>
                        <div class="modal-body px-4">
                            {{-- <form name='WithdrawalRanges' id='WithdrawalRanges'>
                                <div class="row gy-3">
                                        <div class="col-xl-12">
                                            <label>Max Range</label>
                                                <input type="text" name="max_range" class="form-control"
                                                    id="maxCharge" required>
                                        </div>
                                        <div class="col-xl-12">
                                            <label>Min Range</label>
                                                <input type="text" name="min_range" class="form-control"
                                                    id="minCharge" required>
                                        </div>
                                        <div class="col-xl-12">
                                            <label>Percentage Range</label>
                                                <input type="text" name="commission" class="form-control"
                                                    id="percentageCharge" required>
                                        </div>
                                </div>
                                <div id="response" class="text-center px-4 py-4">
                                    <button type="submit" class="btn btn-primary btn-rounded btn-fw" id='submit_button'
                                        data-package-id="" style="font-weight:500;">Update</button>
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal" id="cancel_btn">Cancel</button>
                                 </div>
                            </form> --}}
                            <form id="sys_settings">
                                <br />
                                <table class="table table-bordered" cellspacing="0">
                                    <tr>
                                        <th colspan="3" class="text-label"
                                            style="margin-top:2%; ; text-align:center;">
                                            Withdrawal Commission Tiers
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Min</th>
                                        <th>Max</th>
                                        <th>Commission</th>
                                    </tr>
                                    {{-- {{ dd($systemsettings) }} --}}
                                    @if ($systemsettings)
                                        @foreach ($systemsettings->withdrawal_commission_tiers['withdrawal_ranges'] as $key => $value)
                                            <tr>
                                                <td><input type="text"
                                                        name="withdrawal_ranges[{{ $key }}][min_range]"
                                                        class="form-control" id="min_range"
                                                        value="{{ $value['min_range'] }}" required>
                                                </td>
                                                <td><input type="text"
                                                        name="withdrawal_ranges[{{ $key }}][max_range]"
                                                        class="form-control" id="max_range"
                                                        value="{{ $value['max_range'] }}" required>
                                                </td>
                                                <td><input type="text"
                                                        name="withdrawal_ranges[{{ $key }}][commission]"
                                                        class="form-control" id="commission"
                                                        value="{{ $value['commission'] }}" required>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif

                                </table>
                                <table class="table table-bordered" cellspacing="0">
                                    <tr>
                                        <th colspan="3" class="text-label"
                                            style="margin-top:2%; ; text-align:center;">
                                            Withdrawal Charges
                                        </th>
                                    </tr>
                                    @if ($systemsettings)
                                        @foreach ($systemsettings->withdrawal_charges as $key => $value)
                                            <th colspan="3" class="text-label" style="margin-top:2%; ">
                                                {{ $key }}
                                            </th>
                                            <tr>
                                                <th>Min</th>
                                                <th>Max</th>
                                                <th>Charge(Percentage Charge)</th>
                                            </tr>
                                            <tr>
                                                <td><input type="text" name=" {{ $key }}[min_charge]"
                                                        class="form-control" id="min_charge"
                                                        value="{{ $value['min_charge'] }}" required>
                                                </td>
                                                <td><input type="text" name=" {{ $key }}[max_charge]"
                                                        class="form-control" id="max_charge"
                                                        value="{{ $value['max_charge'] }}" required>
                                                </td>
                                                <td><input type="text"
                                                        name=" {{ $key }}[percentage_charge]"
                                                        class="form-control" id="percentage_charge"
                                                        value="{{ $value['percentage_charge'] }}" required>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif

                                </table>

                                <table class="table table-bordered" cellspacing="0">
                                    <tr>
                                        <th class="text-label" style="margin-top:2%; ">
                                            Monthly Customer Deposit Limit
                                        </th>
                                        <td><input type="text" name="monthly_customer_deposit_limit"
                                                class="form-control" id="monthly_customer_deposit_limit"
                                                value="{{ $systemsettings->monthly_customer_deposit_limit }}"
                                                required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-label" style="margin-top:2%; ">
                                            Monthly Merchant Deposit Limit
                                        </th>
                                        <td><input type="text" name="monthly_merchant_deposit_limit"
                                                class="form-control" id="monthly_merchant_deposit_limit"
                                                value="{{ $systemsettings->monthly_merchant_deposit_limit }}"
                                                required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-label" style="margin-top:2%; ">
                                            Agent Deposit Commission
                                        </th>
                                        <td><input type="text" name="agent_deposit_commission"
                                                class="form-control" id="agent_deposit_commission"
                                                value="{{ $systemsettings->agent_deposit_commission }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-label" style="margin-top:2%; ">
                                            Daily Withdrawal Limit
                                        </th>
                                        <td><input type="text" name="daily_withdrawal_limit" class="form-control"
                                                id="daily_withdrawal_limit"
                                                value="{{ $systemsettings->daily_withdrawal_limit }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-label" style="margin-top:2%; ">
                                            Min Withdrawal Limit
                                        </th>
                                        <td><input type="text" name="min_withdrawal_limit" class="form-control"
                                                id="min_withdrawal_limit"
                                                value="{{ $systemsettings->min_withdrawal_limit }}" required>
                                        </td>
                                    </tr>
                                </table>
                                <div id='response'></div>
                                <div class="text-center px-4 py-4">
                                    <button type="submit" class="btn btn-primary btn-rounded btn-fw"
                                        id='submit_button' data-user-id="" style="font-weight:500;">Update</button>
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
                    var spinner = $('#loader');

                    //Update Monthly Customer Deposit Limit
                    $(".customer_deposit_class").on('click', function() {
                        var CusDepositLimit = $(this).data('customerdepositlimit');
                        console.log(CusDepositLimit);

                        Swal.fire({
                            title: "Monthly Customer Deposit Limit",
                            text: "",
                            input: 'text',
                            inputValue: CusDepositLimit,
                            showCancelButton: true
                        }).then((result) => {
                            if (result.value) {
                                console.log("Result: " + result.value);
                                $.ajax({
                                    url: 'api/system-settings',
                                    type: 'patch',
                                    dataType: 'JSON',
                                    data: {
                                        monthly_customer_deposit_limit: result.value
                                    },
                                    success: function(data) {
                                        //alert(JSON.stringify(meta.message));
                                        console.log("ttttt");
                                        if (data.error_code == 0) {
                                            console.log(data);

                                            window.location.reload();
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

                    //Update System Settings
                    $("#system_setting").on('click', function() {
                        $('#update_system_setting').modal('show');
                    });
                    $('#sys_settings').on('submit', function(e) {
                        e.preventDefault();
                        spinner.show();

                        var formFields = $('#sys_settings').serialize();


                        $.ajax({
                            url: 'api/system-settings',
                            type: 'patch',
                            dataType: 'JSON',
                            data: formFields,
                            success: function(data) {
                                //alert(JSON.stringify(meta.message));
                                console.log("ttttt");
                                if (data.error_code == 0) {
                                    console.log(data);
                                    spinner.hide();
                                    $('#update_system_setting').modal('hide');
                                    $('#dataTable').DataTable().ajax.reload();
                                    Swal.fire({
                                        title: "" + data.meta.message,
                                        icon: 'success',
                                        showCloseButton: true
                                    }).then(okay => {
                                        if (okay) {
                                        $('#update_system_setting').modal('hide');
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
