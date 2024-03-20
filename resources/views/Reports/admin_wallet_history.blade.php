@extends('layouts.master')
@section('styles')
    {{-- Date Picker --}}
        <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />

        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">

@endsection
@section('content')
                    <!-- PAGE-HEADER -->
                    <div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
                        <h1 class="page-title">Wallet History</h1>
                        <div>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/index')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Wallet History</li>
                            </ol>
                        </div> 
                    </div>
                    <!-- PAGE-HEADER END -->

                    <!-- CONTAINER -->
                    <div class="main-container container-fluid">
                        <!-- ROW OPEN -->
                        <div class="row row-cards">
                            <div class="tab-content mb-5">
                                <div class="tab-pane active" id="tab-11">
                                    <div class="card p-0">
                                        <div class="card-body p-4">
                                            <div class="row align-items-center justify-content-end">
                                                    <form name='filter_search' id='filter_search' style="margin-top: 20px;">
                                                            <div class="input-group input-daterange">
                                                                <div class="form-group col-sm" style="padding-top: 29px !important;">
                                                                    <input type="text" name="from_date" id="from_date"
                                                                         class="form-control"
                                                                        placeholder="From Date" />
                                                                </div>&nbsp;&nbsp;
                                                                <div class="input-group-addon" style="padding-top: 29px !important;">to</div> &nbsp;&nbsp;
                                                                <div class="form-group col-sm" style="padding-top: 29px !important;">
                                                                    <input type="text" name="to_date" id="to_date"
                                                                         class="form-control" placeholder="To Date" />
                                                                </div>
                                                                <div class="form-group col-sm d-flex report_btns" style="padding-top: 29px !important;">
                                                                    <button type="button" name="filter" id="filter"
                                                                        class="btn btn-info btn-sm filter">Filter
                                                                    </button>
                                                                    &nbsp;&nbsp;
                                                                    <button type="button" name="export" id="export"
                                                                        class="btn btn-success btn-block">Export All
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <div class="admin_btns d-flex mt-3">
                                                        <a href="{{ asset('admin-commission') }}" class="btn btn-primary text-center">Admin Commission</a>
                                                        <a href="{{ asset('admin-withdrawal') }}" class="btn btn-secondary">Admin Withdrawal</a>
                                                        </div>
                                                <div class="e-table px-5 pb-5 pd-12">
                                                    <div class="table-responsive table-lg">
                                                        <table class="table border-top table-bordered mb-0 text-nowrap incomplete_registration" id="dataTable" 
                                                        style="display: block !important; overflow-x: auto !important;  width: 100% !important;">
                                                            <thead class="border-top">
                                                                <tr>
                                                                    <th class="border-bottom-0">Date</th>
                                                                    <th class="border-bottom-0">Opening Balance</th>
                                                                    <th class="border-bottom-0">Closing Balance</th>
                                                                    <th class="border-bottom-0">Credit Amount</th>
                                                                    <th class="border-bottom-0">Debit Amount</th>
                                                                    <th class="border-bottom-0">Transaction Id</th>
                                                                    <th class="border-bottom-0">Transaction Type</th>
                                                                    <th class="border-bottom-0">Description</th>
                                                                    <th class="border-bottom-0">More Details</th>
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
                                <!-- /.container-fluid -->
                                <div id='response'></div>
                            </div>
                        </div>
                        <!-- ROW CLOSED -->
                    </div>
                    <!-- CONTAINER CLOSED -->

 <!-- Transaction More Details Modal-->
 <div class="modal fade" id="more_details_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Transaction Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-4">
                        <form name='MoreDetails' id='MoreDetails'>
                            <div class="row gy-3">
                                <div style="margin:5%;">
                                    <table class="table table-bordered" cellspacing="0">
                                        <tr>
                                            <th>Transaction Type:</th>
                                            <td><input type="text" class="form-control" id="TransType"
                                                    disabled="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Transaction Id:</th>
                                            <td><input type="text" class="form-control" id="TransId"
                                                    disabled=""></td>
                                        </tr>
                                        <tr>
                                            <th>Opening Balance:</th>
                                            <td><input type="text" class="form-control" id="TransOpeningBal"
                                                    disabled=""></td>
                                        </tr>
                                        <tr>
                                            <th>Closing Balance:</th>
                                            <td><input type="text" class="form-control" id="TransClosingBal"
                                                    disabled=""></td>
                                        </tr>
                                        <tr>
                                            <th>Credit Amount:</th>
                                            <td><input type="text" class="form-control" id="TransCreditAmt"
                                                    disabled=""></td>
                                        </tr>
                                        <tr>
                                            <th>Debit Amount:</th>
                                            <td><input type="text" class="form-control" id="TransAmount"
                                                    disabled="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Date:</th>
                                            <td> <input type="text" class="form-control" id="TranDate"
                                                    disabled="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Description:</th>
                                            <td>
                                                <textarea type="text" class="form-control" id="TransDesc" disabled=""></textarea>
                                            </td>
                                        </tr>

                                        {{-- <tr>
                                            <div class="appendfields">
                                            </div>
                                        </tr> --}}
                                    </table>
                                    <table class="table table-bordered appendfields" cellspacing="0">
                                    </table>
                                </div>

                            </div>
                            <div style="text-align:center; padding:5%">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            </div>
                        </form>


                    </div>

                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
	
    <!-- Datatables Cdn -->
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.6/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

    {{-- Date Picker --}}
        <script src="{{ asset('vendor/moment/moment.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $(".navbar-nav li").removeClass("active"); //this will remove the active class from  
                $('#reports').addClass('active');

                var date = new Date();

                $('.input-daterange').datepicker({
                    todayBtn: 'linked',
                    format: 'yyyy-mm-dd',
                    autoclose: true
                });


                fetch_data();


                function fetch_data(from_date = (new Date()).toISOString().split('T')[0],
                    to_date = (new Date()).toISOString().split('T')[0]) {

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
                            url: '{{ url('api/wallet-history') }}',
                            data: function(d) {
                                d.search = d.search['value'],
                                    d.request_origin = 'web',
                                    d.user_type_id = 1,
                                    d.from_date = from_date,
                                    d.to_date = to_date
                            }

                        },

                        columnDefs: [{

                            targets: 8,
                            render: function(data, type, row, meta) {

                                return '<td class="text-center"><button title="More Details" data-userid="' +
                                    row.id +
                                    '" class="more_details btn" style="color: rgb(30, 50, 250);"><i class="fa fa-arrow-right" aria-hidden="true"></i></button></td>';
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
                                data: 'opening_balance',
                                className: 'opening_balance'
                            },
                            {
                                data: 'closing_balance',
                                className: 'closing_balance'
                            },
                            {
                                data: 'credit_amount',
                                className: 'credit_amount'
                            },
                            {
                                data: 'debit_amount',
                                className: 'debit_amount'
                            },
                            {
                                data: 'transaction_id',
                                className: 'transaction_id'
                            },
                            {
                                data: 'transaction_type',
                                className: 'transaction_type'
                            },
                            {
                                data: 'description',
                                className: 'description'
                            },
                        ]

                    });


                }

                $('#filter').click(function() {
                    // var formFields = $('#filterdate').serialize();
                    // console.log(formFields);
                    var from_date = $('#from_date').val();
                    var to_date = $('#to_date').val();

                    fetch_data(from_date, to_date);

                });

                $('#export').click(function() {
                    var fromDate = $('#from_date').val();
                    var to_date = $('#to_date').val();
                    /*    console.log("From date: " + fromDate);
                       console.log("To date: " + to_date); */
                    $.ajax({
                        url: 'api/wallet-history?download_csv=1&user_type_id=1&from_date=' + fromDate +
                            '&to_date=' + to_date,
                        type: "GET",

                        xhrFields: {
                            responseType: 'blob'
                        },
                        success: function(data) {
                            var a = document.createElement('a');
                            var url = window.URL.createObjectURL(data);
                            a.href = url;
                            a.download = 'myfile.csv';
                            document.body.append(a);
                            a.click();
                            a.remove();
                            window.URL.revokeObjectURL(url);
                        }
                    });
                    /*  document.location.href = 'api/wallet-history?download_csv=1&from_date=' + fromDate +
                         '&to_date=' + to_date; */
                    /* $.ajax({
                        url: 'api/wallet-history?download_csv=1&from_date=' + fromDate +
                            '&to_date=' + to_date,
                        type: 'get'
                    }); */
                });

                //Transaction More Details
                $("#dataTable").on('click', '.more_details', function() {
                    // console.log("yyer");
                    $('.appendfields').empty();
                    var transaction_type = $(this).closest('tr').find('.transaction_type').text();
                    var transaction_id = $(this).closest('tr').find('.transaction_id').text();
                    var created_at = $(this).closest('tr').find('.created_at').text();
                    var opening_balance = $(this).closest('tr').find('.opening_balance').text();
                    var closing_balance = $(this).closest('tr').find('.closing_balance').text();
                    var credit_amount = $(this).closest('tr').find('.credit_amount').text();
                    var debit_amount = $(this).closest('tr').find('.debit_amount').text();
                    var description = $(this).closest('tr').find('.description').text();
                    var Userid = $(this).data('userid');
                    //console.log("Userid: ", Userid);

                    $('#TransType').val(transaction_type);
                    $('#TransId').val(transaction_id);
                    $('#TranDate').val(created_at);
                    $('#TransOpeningBal').val(opening_balance);
                    $('#TransClosingBal').val(closing_balance);
                    $('#TransCreditAmt').val(credit_amount);
                    $('#TransAmount').val(debit_amount);
                    $('#TransDesc').val(description);
                    //$('#billers').value(field);

                    $('#more_details_form').modal('show');

                    $.ajax({
                        url: 'api/wallet-history',
                        type: 'get',
                        data: {
                            'txn_id': transaction_id,
                            'user_type_id': 1
                        },
                        async: false,
                        success: function(data) {
                            // console.log(data);
                            //var fields = '';
                            // console.log("inside details");

                            $.each(data.data.data, function($index, $value) {
                                //console.log("fhd");
                                //  console.log("fname: " + $value);

                                if (transaction_type == 'WALLET_TRANSFER') {
                                    $('.appendfields').append(
                                        '<tr><th colspan="2" class="text-center">Request User</th><tr><th>Name</th><td><input type="text" class="form-control" value="' +
                                        $value.transaction.requester_user.full_name +
                                        '" disabled=""></td></tr><tr><th>Pacpay User Id</th><td><input type="text" class="form-control" value="' +
                                        $value.transaction.requester_user
                                        .pacpay_user_id +
                                        '" disabled=""></td></tr><tr><th>User Type</th><td><input type="text" class="form-control"value="' +
                                        $value.transaction.requester_user.user_type +
                                        '" disabled=""></td></tr></tr><tr><th colspan="2" class="text-center">Sender User</th><tr><th>Name</th><td><input type="text" class="form-control" id="TransId" value="' +
                                        $value.transaction.sender_user.full_name +
                                        '" disabled=""></td></tr><tr><th>Pacpay User Id</th><td><input type="text" class="form-control" value="' +
                                        $value.transaction.sender_user
                                        .pacpay_user_id +
                                        '" disabled=""></td></tr><tr><th>User Type</th><td><input type="text" class="form-control" value="' +
                                        $value.transaction.sender_user.user_type +
                                        '" disabled=""></td></tr></tr>'
                                    );

                                } else if (transaction_type == 'WITHDRAWAL' || (
                                        transaction_type == 'WITHDRAWAL_REFUND')) {
                                    $('.appendfields').append(
                                        '<tr><th colspan="2" class="text-center" bgcolor="56BBF1" style="color:#FFFFFF">' +
                                        $value
                                        .transaction_type +
                                        '</th></tr><tr><th colspan="2" class="text-center">Bank Details</th><tr><th>Name</th><td><input type="text" class="form-control" value="' +
                                        $value.transaction.bank_details.bank_name +
                                        '" disabled=""></td></tr><tr><th>BSB</th><td><input type="text" class="form-control" value="' +
                                        $value.transaction.bank_details
                                        .bsb +
                                        '" disabled=""></td></tr><tr><th>Swift</th><td><input type="text" class="form-control"value="' +
                                        $value.transaction.bank_details.swift +
                                        '" disabled=""></td></tr></tr><tr><th colspan="2" class="text-center">User</th><tr><th>Name</th><td><input type="text" class="form-control" id="TransId" value="' +
                                        $value.transaction.user.full_name +
                                        '" disabled=""></td></tr><tr><th>Pacpay User Id</th><td><input type="text" class="form-control" value="' +
                                        $value.transaction.user
                                        .pacpay_user_id +
                                        '" disabled=""></td></tr><tr><th>User Type</th><td><input type="text" class="form-control" value="' +
                                        $value.transaction.user.user_type +
                                        '" disabled=""></td></tr></tr>'
                                    );

                                } else {

                                }

                            })


                        }
                    });

                    $('#submit_button').attr('data-biller-id', $(this).data('billerid'));
                });



            });
        </script>
    @endsection
