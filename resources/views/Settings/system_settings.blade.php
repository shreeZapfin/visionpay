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
                            <h5 class="m-0 font-weight-bold text-primary">System Settings</h5>
                            <button type="submit" class="btn-fill btn" id='system_setting'
                                style="float:right; margin-top: -20px;">Update</button>
                        </div>

                        <div style="padding: 3%;">
                            <form>
                                <br />
                                <table class="table table-bordered" cellspacing="0" style="text-align: center">
                                    <tr>
                                        <th colspan="3" class="text-label"
                                            style="margin-top:2%; color:blue; text-align:center;">
                                            Withdrawal Commission Tiers(Range)
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Min Withdrawal Amount</th>
                                        <th>Max Withdrawal Amount</th>
                                        <th>Commission Withdrawal Amount</th>
                                    </tr>
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

                                </table>
                                <table class="table table-bordered" cellspacing=" 0">
                                    <tr>
                                        <th colspan="3" class="text-label"
                                            style="margin-top:2%; color:blue; text-align:center;">
                                            Withdrawal Charges
                                        </th>
                                    </tr>
                                    @if ($systemsettings)
                                        @foreach ($systemsettings->withdrawal_charges as $key => $value)
                                            <th colspan="3" class="text-label" style="margin-top:2%; color:blue">
                                                {{ $key }}
                                            </th>
                                            <tr style="text-align: center">
                                                <th>Min Withdrawal Charge</th>
                                                <th>Max Withdrawal Charge</th>
                                                <th>Withdrawal Charge(Percentage Charge)</th>
                                            </tr>
                                            <tr style="text-align: center">
                                                <td>{{ $value['min_charge'] }}
                                                </td>
                                                <td>{{ $value['max_charge'] }}
                                                </td>
                                                <td>{{ $value['percentage_charge'] }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif

                                </table>

                                <table class="table table-bordered" cellspacing="0">
                                    <tr>
                                        <th class="text-label" style="margin-top:2%; color:blue">
                                            Monthly Customer Deposit Limit
                                        </th>
                                        <td style="text-align: center">
                                            {{ $systemsettings->monthly_customer_deposit_limit }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-label" style="margin-top:2%; color:blue">
                                            Monthly Merchant Deposit Limit
                                        </th>
                                        <td style="text-align: center">
                                            {{ $systemsettings->monthly_merchant_deposit_limit }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-label" style="margin-top:2%; color:blue">
                                            Agent Deposit Commission
                                        </th>
                                        <td style="text-align: center">
                                            {{ $systemsettings->agent_deposit_commission }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-label" style="margin-top:2%; color:blue">
                                            Daily Withdrawal Limit
                                        </th>
                                        <td style="text-align: center">{{ $systemsettings->daily_withdrawal_limit }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-label" style="margin-top:2%; color:blue">
                                            Min Withdrawal Limit
                                        </th>
                                        <td style="text-align: center">{{ $systemsettings->min_withdrawal_limit }}
                                        </td>
                                    </tr>
                                </table>
                            </form>


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

            <!-- Update Promotion Modal-->
            <div class="modal fade" id="update_system_setting" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit System Settings</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span> </button>
                        </div>
                        <div class="modal-body">
                            {{-- <form name='WithdrawalRanges' id='WithdrawalRanges'>
                                <div class="row">
                                    <div class="col-md-6" style="margin:0 auto; display:block;">

                                        <div class="form-group">
                                            <label>Max Range</label>
                                            <div class="input-group">
                                                <input type="text" name="max_range" class="form-control"
                                                    id="maxCharge" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Min Range</label>
                                            <div class="input-group">
                                                <input type="text" name="min_range" class="form-control"
                                                    id="minCharge" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Percentage Range</label>
                                            <div class="input-group">
                                                <input type="text" name="commission" class="form-control"
                                                    id="percentageCharge" required>
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
                            </form> --}}
                            <form id="sys_settings">
                                <br />
                                <table class="table table-bordered" cellspacing="0">
                                    <tr>
                                        <th colspan="3" class="text-label"
                                            style="margin-top:2%; color:blue; text-align:center;">
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
                                            style="margin-top:2%; color:blue; text-align:center;">
                                            Withdrawal Charges
                                        </th>
                                    </tr>
                                    @if ($systemsettings)
                                        @foreach ($systemsettings->withdrawal_charges as $key => $value)
                                            <th colspan="3" class="text-label" style="margin-top:2%; color:blue">
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
                                        <th class="text-label" style="margin-top:2%; color:blue">
                                            Monthly Customer Deposit Limit
                                        </th>
                                        <td><input type="text" name="monthly_customer_deposit_limit"
                                                class="form-control" id="monthly_customer_deposit_limit"
                                                value="{{ $systemsettings->monthly_customer_deposit_limit }}"
                                                required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-label" style="margin-top:2%; color:blue">
                                            Monthly Merchant Deposit Limit
                                        </th>
                                        <td><input type="text" name="monthly_merchant_deposit_limit"
                                                class="form-control" id="monthly_merchant_deposit_limit"
                                                value="{{ $systemsettings->monthly_merchant_deposit_limit }}"
                                                required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-label" style="margin-top:2%; color:blue">
                                            Agent Deposit Commission
                                        </th>
                                        <td><input type="text" name="agent_deposit_commission"
                                                class="form-control" id="agent_deposit_commission"
                                                value="{{ $systemsettings->agent_deposit_commission }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-label" style="margin-top:2%; color:blue">
                                            Daily Withdrawal Limit
                                        </th>
                                        <td><input type="text" name="daily_withdrawal_limit" class="form-control"
                                                id="daily_withdrawal_limit"
                                                value="{{ $systemsettings->daily_withdrawal_limit }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-label" style="margin-top:2%; color:blue">
                                            Min Withdrawal Limit
                                        </th>
                                        <td><input type="text" name="min_withdrawal_limit" class="form-control"
                                                id="min_withdrawal_limit"
                                                value="{{ $systemsettings->min_withdrawal_limit }}" required>
                                        </td>
                                    </tr>
                                </table>
                                <div id='response'></div>
                                <div style="text-align:center">
                                    <button type="submit" class="btn btn-primary btn-rounded btn-fw"
                                        id='submit_button' data-user-id="" style="font-weight:500;">Update</button>
                                    <button class="btn btn-secondary" type="button"
                                        data-dismiss="modal">Cancel</button>
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
                                    $('#scheme_edit_form').modal('hide');
                                    $('#dataTable').DataTable().ajax.reload();
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
