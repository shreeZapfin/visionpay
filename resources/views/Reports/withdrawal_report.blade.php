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
                        <h1 class="page-title">Withdrawal Report</h1>
                        <div>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/index')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Withdrawal Report</li>
                            </ol>
                        </div> 
                    </div>
                    <!-- PAGE-HEADER END -->

                    <!-- CONTAINER -->
                    <div class="main-container container-fluid">
                        <!-- ROW OPEN -->
                        <div class="row row-cards">
                            <div class="tab-content mb-5">
                                <div class="tab-pane active exprtbtns" id="tab-11">
                                    <div class="card p-0">
                                        <div class="card-body p-4">
                                            <div class="row align-items-center justify-content-end">
                                            <form name='filter_search' id='filter_search' style="margin-top: 20px;">
                                                            <div class="input-group input-daterange">
                                                                <div class="form-group col-sm">
                                                                    <label>Select Status</label>
                                                                    <select name="status" id="status" class="select2 form-control custom-select">
                                                                        <option value="BANK_WITHDRAWAL_REQUEST" selected="selected">Bank Withdrawal
                                                                            Request</option>
                                                                        <option value="">All Request</option>
                                                                        <option value="INITIATED_BY_AGENT">Initiated By Agent</option>
                                                                        <option value="ADMIN_WITHDRAWAL">Admin Withdrawal</option>
                                                                    </select>
                                                                </div> &nbsp;&nbsp;
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
                                                                </div>
                                                            </div>
                                                        </form>
                                                <div class="e-table px-5 pb-5 pd-12">
                                                    <div class="table-responsive table-lg">
                                                        <table class="table border-top table-bordered mb-0 text-nowrap incomplete_registration1" id="dataTable" 
                                                        style="width: 100% !important;">
                                                            <thead class="border-top">
                                                                <tr>
                                                                    <th class="border-bottom-0">Date</th>
                                                                    <th class="border-bottom-0">Withdrawal ID</th>
                                                                    <th class="border-bottom-0">Amount</th>
                                                                    <th class="border-bottom-0">Status</th>
                                                                    <th class="border-bottom-0">Expired At</th>
                                                                    <th class="border-bottom-0">Action</th>
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

                    
                    <!-- Paid Withdrawal -->
        <div class="modal fade" id="paid_Withdrawal_form" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">Paid Withdrawal</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-3">
                        <form name='paidWithdrawal' id='paidWithdrawal'>
                            <div class="row gy-3">
                                    <div class="col-xl-12">
                                        <label>Bank Reference No.</label>
                                        <input type="text" name="bank_reference_no" class="form-control"
                                                id="bank_reference_no" required>
                                    </div>
                                    <div class="col-xl-12">
                                        <label>Remark</label>
                                        <input type="text" name="remark" class="form-control" id="remark"
                                                required>
                                    </div>
                            </div>
                            <div id='response'></div>
                            <div class="text-center px-4 py-4">
                                <button type="submit" class="btn btn-primary btn-rounded btn-fw" id='submit_button'
                                    data-withdrawal-id="" style="font-weight:500;">Submit</button>
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
                        <h5 class="modal-title" id="exampleModalLabel">Withdrawal Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-3">
                        <form class="MoreDetails" name='MoreDetails' id='MoreDetails'>
                            <div class="row gy-3">
                                <div>
                                    <table class="table table-bordered" cellspacing="0">
                                        <tr>
                                            <th  style="width:178px !important">Status:</th>
                                            <td><input type="text" class="form-control" id="WithStatus"
                                                    disabled="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Withdrawal Id:</th>
                                            <td><input type="text" class="form-control" id="WidthId"
                                                    disabled=""></td>
                                        </tr>
                                        <tr>
                                            <th>Date:</th>
                                            <td><input type="text" class="form-control" id="WithDate"
                                                    disabled="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Amount:</th>
                                            <td><input type="text" class="form-control" id="WithAmount"
                                                    disabled="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Expires At:</th>
                                            <td><input type="text" class="form-control" id="WithExpAt"
                                                    disabled="">
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
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>

                            </div>
                        </form>
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
                    to_date = (new Date()).toISOString().split('T')[0], status) {
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
                            url: '{{ url('api/user/withdrawal') }}',
                            data: function(d) {
                                d.search = d.search['value'],
                                    d.request_origin = 'web',
                                    d.from_date = from_date,
                                    d.to_date = to_date,
                                    d.status = status
                            }

                        },
                        columnDefs: [{
                            targets: 5,
                            render: function(data, type, row, meta) {
                                if (row.status == "BANK_WITHDRAWAL_REQUEST" && row.remark == null) {
                                    return '<td class="text-center d-flex justify-content-center"><button title="Paid Withdrawal" data-withdrawalid= "' +
                                        row
                                        .withdrawal_id +
                                        '" class="paid_withdrawal btn  px-2 mx-2">Paid</button><button title="Failed Withdrawal" data-withdrawalid= "' +
                                        row.withdrawal_id +
                                        '" class="failed_withdrawal btn  px-2 mx-2">Failed</button><button title="More Details" data-userid="' +
                                        row.id +
                                        '" class="more_details btn"><i class="bi bi-three-dots-vertical" aria-hidden="true"></i></button></td>';
                                } else {
                                    return '<td class="text-center"><button title="More Details" data-userid="' +
                                        row.id +
                                        '" class="more_details btn  px-2 mx-2"><i class="bi bi-three-dots-vertical" aria-hidden="true"></i></button></td>';
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
                                data: 'withdrawal_id',
                                className: "withdrawal_id",
                            },
                            {
                                data: 'amount',
                                className: "amount",
                            },
                            {
                                data: 'status',
                                className: "status",
                            },
                            {
                                data: 'expires_at',
                                className: "expires_at",
                                render: function(data, type, row, meta) {
                                    return moment.utc(data).local().format('DD/MM/YYYY HH:mm a');
                                }
                            }
                        ],
                        dom: 'Bfrtip',
                        buttons: [{
                                extend: 'excelHtml5',
                                title: 'Excel',
                                text: 'Excel',
                                //Columns to export
                                //exportOptions: {
                                //     columns: [0, 1, 2, 3,4,5,6]
                                // }
                            },
                            {
                                extend: 'pdfHtml5',
                                title: 'PDF',
                                text: 'PDF'
                                //Columns to export
                                //exportOptions: {
                                //     columns: [0, 1, 2, 3, 4, 5, 6]
                                //  }
                            }
                        ]

                    });

                }

                $('#filter').click(function() {
                    // var formFields = $('#filterdate').serialize();
                    // console.log(formFields);
                    var from_date = $('#from_date').val();
                    var to_date = $('#to_date').val();
                    var status = $('#status').val();
                    // console.log("from_date " + from_date);
                    // console.log("to_date " + to_date);
                    // console.log("status " + status);


                    fetch_data(from_date, to_date, status);


                });

                //More Details
                $("#dataTable").on('click', '.more_details', function() {
                    // console.log("yyer");
                    $('.appendfields').empty();
                    var status = $(this).closest('tr').find('.status').text();
                    var withdrawal_id = $(this).closest('tr').find('.withdrawal_id').text();
                    var created_at = $(this).closest('tr').find('.created_at').text();
                    var amount = $(this).closest('tr').find('.amount').text();
                    var expires_at = $(this).closest('tr').find('.expires_at').text();
                    var Userid = $(this).data('userid');
                    // console.log("Userid: ", Userid);

                    $('#WithStatus').val(status);
                    $('#WidthId').val(withdrawal_id);
                    $('#WithDate').val(created_at);
                    $('#WithAmount').val(amount);
                    $('#WithExpAt').val(expires_at);
                    //$('#billers').value(field);

                    $('#more_details_form').modal('show');

                    $.ajax({
                        url: 'api/user/withdrawal',
                        type: 'get',
                        data: {
                            'status': status
                        },
                        async: false,
                        success: function(data) {
                            // console.log(data);
                            //var fields = '';
                            // console.log("inside details");

                            $.each(data.data, function($index, $value) {
                                // console.log("fhd");
                                // console.log("fname: " + $value);

                                if (status == 'ACCEPTED_BY_USER' || (status ==
                                        'INITIATED_BY_AGENT')) {
                                    $('.appendfields').append(
                                        '<tr><th colspan="2" class="text-center">Agent User</th><tr><th>Name</th><td><input type="text" class="form-control" value="' +
                                        $value.agent_user.full_name +
                                        '" disabled=""></td></tr><tr><th>Pacpay User Id</th><td><input type="text" class="form-control" value="' +
                                        $value.agent_user
                                        .pacpay_user_id +
                                        '" disabled=""></td></tr><tr><th>User Type</th><td><input type="text" class="form-control"value="' +
                                        $value.agent_user.user_type +
                                        '" disabled=""></td></tr></tr><tr><th colspan="2" class="text-center">User</th><tr><th>Name</th><td><input type="text" class="form-control" id="TransId" value="' +
                                        $value.user.full_name +
                                        '" disabled=""></td></tr><tr><th>Pacpay User Id</th><td><input type="text" class="form-control" value="' +
                                        $value.user
                                        .pacpay_user_id +
                                        '" disabled=""></td></tr><tr><th>User Type</th><td><input type="text" class="form-control" value="' +
                                        $value.user.user_type +
                                        '" disabled=""></td></tr></tr>'
                                    );

                                } else if (status == 'BANK_WITHDRAWAL_PAID' || (
                                        status == 'BANK_WITHDRAWAL_REQUEST') || (
                                        status == 'BANK_WITHDRAWAL_FAILED')) {
                                    $('.appendfields').append(
                                        '<tr><th>Remark: </th><th>' +
                                        $value
                                        .remark +
                                        '</th></tr><tr><th colspan="2" class="text-center">Bank Details</th><tr><th>Name</th><td><input type="text" class="form-control" value="' +
                                        $value.bank_details.bank_name +
                                        '" disabled=""></td></tr><tr><th>BSB</th><td><input type="text" class="form-control" value="' +
                                        $value.bank_details
                                        .bsb +
                                        '" disabled=""></td></tr><tr><th>Swift</th><td><input type="text" class="form-control"value="' +
                                        $value.bank_details.swift +
                                        '" disabled=""></td></tr><tr><th>Account No.</th><td><input type="text" class="form-control" value="' +
                                        $value.bank_details.bank_account_no +
                                        '" disabled=""></td></tr><tr><th>Account Name</th><td><input type="text" class="form-control" value="' +
                                        $value.bank_details.bank_account_name +
                                        '" disabled=""></td></tr><tr><th>Reference No.</th><td><input type="text" class="form-control" value="' +
                                        $value.bank_details.bank_reference_no +
                                        '" disabled=""></td></tr></tr><tr><th colspan="2" class="text-center">User</th><tr><th>Name</th><td><input type="text" class="form-control" id="TransId" value="' +
                                        $value.user.full_name +
                                        '" disabled=""></td></tr><tr><th>Pacpay User Id</th><td><input type="text" class="form-control" value="' +
                                        $value.user
                                        .pacpay_user_id +
                                        '" disabled=""></td></tr><tr><th>User Type</th><td><input type="text" class="form-control" value="' +
                                        $value.user.user_type +
                                        '" disabled=""></td></tr></tr>'
                                    );

                                } else {

                                }

                            })


                        }
                    });

                });



                //Failed Withdrawal
                $("#dataTable").on('click', '.failed_withdrawal', function() {

                    var withdrawalId = $(this).data('withdrawalid');
                    //  console.log(withdrawalId);
                    //var Status = $(this).closest('tr').find('.status').text();
                    //console.log(Status);
                    //var BankRefNo = $(this).closest('tr').find('.bank_reference_no').text();
                    //console.log(BankRefNo);
                    Swal.fire({
                        title: "Enter Remark",
                        text: "",
                        input: 'text',
                        showCancelButton: true
                    }).then((result) => {
                        if (result.value) {
                            //  console.log("Result: " + result.value);
                            $.ajax({
                                url: 'api/user/withdrawal/bank-request/' + withdrawalId,
                                type: 'patch',
                                dataType: 'JSON',
                                data: {
                                    status: "BANK_WITHDRAWAL_FAILED",
                                    remark: result.value
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

                                        swal(data.errors.status, "error");
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

                //Paid Withdrawal
                $("#dataTable").on('click', '.paid_withdrawal', function() {

                    $('#paid_Withdrawal_form').modal('show');
                    $('#submit_button').attr('data-withdrawal-id', $(this).data('withdrawalid'));
                });
                /*  $("#paid_Withdrawal_form").on("hide.bs.modal", function() {
                     console.log("outside model");
                     $('#dataTable').DataTable().ajax.reload();
                 }); */
                $('#paidWithdrawal').on('submit', function(e) {
                    e.preventDefault();

                    var formFields = $('#paidWithdrawal').serialize();
                    var WithdrawalId = $('#submit_button').data('withdrawal-id');
                    var status = "BANK_WITHDRAWAL_PAID";
                    //  console.log("Withdrawal Id: " + WithdrawalId);

                    $.ajax({
                        url: 'api/user/withdrawal/bank-request/' + WithdrawalId,
                        type: 'patch',
                        dataType: 'JSON',
                        data: formFields + '&status=' + status,
                        success: function(data) {
                            //alert(JSON.stringify(meta.message));
                            //   console.log("ttttt");
                            if (data.error_code == 0) {
                                // console.log(data);
                                $('#paid_Withdrawal_form').modal('hide');
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

                            $('#paidWithdrawal').closest('form').find(
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

            });
        </script>
    @endsection
