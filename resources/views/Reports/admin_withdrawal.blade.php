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

                    <!-- DataTales Example -->

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5 class="m-0 font-weight-bold text-primary">Withdrawal Wallet History</h5>

                            <br>
                            <form name='filterdate' id='filterdate'>
                                <div class="input-group input-daterange">
                                    <div class="form-group col-sm">
                                        <input type="text" name="from_date" id="from_date" readonly
                                            class="form-control" placeholder="Start Date" />
                                    </div>&nbsp;&nbsp;
                                    <div class="input-group-addon">to</div> &nbsp;&nbsp;
                                    <div class="form-group col-sm">
                                        <input type="text" name="to_date" id="to_date" readonly
                                            class="form-control" placeholder="End Date" />
                                    </div>
                                    <div class="form-group col-sm">
                                        <button type="button" name="filter" id="filter"
                                            class="btn btn-info btn-sm">Filter</button>
                                        <button type="button" name="export" id="export" class="btn btn-block"
                                            style="text-align: center; height : 40px; width: 100px; background:	#006400; color: rgb(255,255,255);">Export
                                            ALL</button>
                                    </div>
                                </div>
                            </form>


                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Date</th>
                                                <th class="text-center">Opening Balance</th>
                                                <th class="text-center">Closing Balance</th>
                                                <th class="text-center">Credit Amount</th>
                                                <th class="text-center">Debit Amount</th><br>
                                                <th class="text-center">Transaction Id</th>
                                                <th class="text-center">Transaction Type</th>
                                                <th class="text-center">Description</th>
                                                <th class="text-center">More Details</th>
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
            </div>
            <!-- End of Content Wrapper -->
        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="{{ asset('#page-top') }}">
            <i class="fas fa-angle-up"></i> </a>

        <!-- Transaction More Details Modal-->
        <div class="modal fade" id="more_details_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Transaction Details</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span> </button>
                    </div>
                    <div class="modal-body">
                        <form name='MoreDetails' id='MoreDetails'>
                            <div class="row">
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



        <script src="{{ asset('vendor/datatables/jquery.dataTables.js') }}"></script>

        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
        <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
        <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>

        <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>

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
                                    d.user_type_id = 8,
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
                        /* ,
                                                dom: 'Bfrtip',
                                                buttons: [{
                                                        extend: 'excelHtml5',
                                                        title: 'Excel',
                                                        text: 'Export to excel'
                                                        //Columns to export
                                                        //exportOptions: {
                                                        //     columns: [0, 1, 2, 3,4,5,6]
                                                        // }
                                                    },
                                                    {
                                                        extend: 'pdfHtml5',
                                                        title: 'PDF',
                                                        text: 'Export to PDF'
                                                        //Columns to export
                                                        //exportOptions: {
                                                        //     columns: [0, 1, 2, 3, 4, 5, 6]
                                                        //  }
                                                    }
                                                ] */

                    });


                }

                $('#filter').click(function() {
                    var from_date = $('#from_date').val();
                    var to_date = $('#to_date').val();
                    /*    console.log("from_date " + from_date);
                       console.log("to_date " + to_date); */

                    fetch_data(from_date, to_date);


                });

                $('#export').click(function() {
                    var fromDate = $('#from_date').val();
                    var to_date = $('#to_date').val();
                    /*   console.log("From date: " + fromDate);
                      console.log("To date: " + to_date); */
                    $.ajax({
                        url: 'api/wallet-history?download_csv=1&user_type_id=6&from_date=' + fromDate +
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
                    // console.log("Userid: ", Userid);

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
                            'user_type_id': 6
                        },
                        async: false,
                        success: function(data) {
                            // console.log(data);

                            $.each(data.data.data, function($index, $value) {
                                // console.log("fhd");
                                // console.log("fname: " + $value);

                                if (transaction_type == 'WITHDRAWAL_CHARGE') {
                                    $('.appendfields').append(
                                        '<tr><th>Amount</th><td><input type="text" class="form-control"  value="' +
                                        $value.transaction.amount +
                                        '" disabled=""></td></tr><tr><th>Status</th><td><input type="text" class="form-control"  value="' +
                                        $value.transaction.status +
                                        '" disabled=""></td></tr><tr><th colspan="2" class="text-center">Agent User</th><tr><th>Name</th><td><input type="text" class="form-control" id="TransId" value="' +
                                        $value.transaction.agent_user.full_name +
                                        '" disabled=""></td></tr><tr><th>Pacpay User Id</th><td><input type="text" class="form-control" value="' +
                                        $value.transaction.agent_user
                                        .pacpay_user_id +
                                        '" disabled=""></td></tr><tr><th>User Type</th><td><input type="text" class="form-control" value="' +
                                        $value.transaction.agent_user.user_type +
                                        '" disabled=""></td></tr></tr><tr><th colspan="2" class="text-center">User</th><tr><th>Name</th><td><input type="text" class="form-control" id="TransId" value="' +
                                        $value.transaction.user.full_name +
                                        '" disabled=""></td></tr><tr><th>Pacpay User Id</th><td><input type="text" class="form-control" value="' +
                                        $value.transaction.user
                                        .pacpay_user_id +
                                        '" disabled=""></td></tr><tr><th>User Type</th><td><input type="text" class="form-control" value="' +
                                        $value.transaction.user.user_type +
                                        '" disabled=""></td></tr></tr>'
                                    );

                                } else if (transaction_type == 'BILL_PAYMENT_CHARGE') {
                                    $('.appendfields').append(
                                        '<tr><th colspan="2" class="text-center">User</th><tr><th>Name</th><td><input type="text" class="form-control" id="TransId" value="' +
                                        $value.transaction.user.full_name +
                                        '" disabled=""></td></tr><tr><th>Pacpay User Id</th><td><input type="text" class="form-control" value="' +
                                        $value.transaction.user
                                        .pacpay_user_id +
                                        '" disabled=""></td></tr><tr><th>User Type</th><td><input type="text" class="form-control" value="' +
                                        $value.transaction.user.user_type +
                                        '" disabled=""></td></tr></tr><tr><th colspan="2" class="text-center">Biller User</th><tr><th>Name</th><td><input type="text" class="form-control" id="TransId" value="' +
                                        $value.transaction.biller_user.full_name +
                                        '" disabled=""></td></tr><tr><th>Pacpay User Id</th><td><input type="text" class="form-control" value="' +
                                        $value.transaction.biller_user
                                        .pacpay_user_id +
                                        '" disabled=""></td></tr><tr><th>User Type</th><td><input type="text" class="form-control" value="' +
                                        $value.transaction.biller_user.user_type +
                                        '" disabled=""></td></tr></tr>'
                                    );

                                    var billerFields = '';


                                    $.each($value.transaction.biller_fields, function(i,
                                        field) {
                                        // console.log("2nd loop" + i +
                                        //     field);
                                        $('.appendfields').append(
                                            '<tr><th>' +
                                            field.name + '</th><td>' +
                                            field
                                            .value + '</td></tr>');

                                    })
                                } else if (transaction_type == 'MERCHANT_PAYMENT_CHARGE' ||
                                    transaction_type == 'P2P_PAYMENT_CHARGE') {
                                    $('.appendfields').append(
                                        '<tr><th>Amount</th><td><input type="text" class="form-control"  value="' +
                                        $value.transaction.amount +
                                        '" disabled=""></td></tr><tr><th>Status</th><td><input type="text" class="form-control"  value="' +
                                        $value.transaction.status +
                                        '" disabled=""></td></tr><tr><th>Request Type</th><td><input type="text" class="form-control"  value="' +
                                        $value.transaction.request_type +
                                        '" disabled=""></td></tr><tr><th>Description</th><td><input type="text" class="form-control"  value="' +
                                        $value.transaction.description +
                                        '" disabled=""></td></tr><tr><th colspan="2" class="text-center">Sender User</th><tr><th>Name</th><td><input type="text" class="form-control" id="TransId" value="' +
                                        $value.transaction.sender_user.full_name +
                                        '" disabled=""></td></tr><tr><th>Pacpay User Id</th><td><input type="text" class="form-control" value="' +
                                        $value.transaction.sender_user
                                        .pacpay_user_id +
                                        '" disabled=""></td></tr><tr><th>User Type</th><td><input type="text" class="form-control" value="' +
                                        $value.transaction.sender_user.user_type +
                                        '" disabled=""></td></tr></tr><tr><th colspan="2" class="text-center">Request User</th><tr><th>Name</th><td><input type="text" class="form-control" id="TransId" value="' +
                                        $value.transaction.requester_user.full_name +
                                        '" disabled=""></td></tr><tr><th>Pacpay User Id</th><td><input type="text" class="form-control" value="' +
                                        $value.transaction.requester_user
                                        .pacpay_user_id +
                                        '" disabled=""></td></tr><tr><th>User Type</th><td><input type="text" class="form-control" value="' +
                                        $value.transaction.requester_user.user_type +
                                        '" disabled=""></td></tr></tr>'
                                    );

                                } else if (transaction_type == 'WITHDRAWAL_CHARGE' ||
                                    transaction_type == 'WITHDRAWAL_CHARGE_REFUND') {
                                    $('.appendfields').append(
                                        '<tr><th colspan="2" class="text-center" bgcolor="56BBF1" style="color:#FFFFFF">' +
                                        $value
                                        .transaction_type +
                                        '</th></tr><tr><th>Amount</th><td><input type="text" class="form-control"  value="' +
                                        $value.transaction.amount +
                                        '" disabled=""></td></tr><tr><th>Status</th><td><input type="text" class="form-control"  value="' +
                                        $value.transaction.status +
                                        '" disabled=""></td></tr><tr><th>Remark</th><td><input type="text" class="form-control"  value="' +
                                        $value.transaction.remark +
                                        '" disabled=""></td></tr><tr><th colspan="2" class="text-center">Bank Details</th><tr><th>Name</th><td><input type="text" class="form-control" id="TransId" value="' +
                                        $value.transaction.bank_details.bank_name +
                                        '" disabled=""></td></tr><tr><th>BSB</th><td><input type="text" class="form-control" value="' +
                                        $value.transaction.bank_details
                                        .bsb +
                                        '" disabled=""></td></tr><tr><th>Swift</th><td><input type="text" class="form-control" value="' +
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
</body>

</html>
