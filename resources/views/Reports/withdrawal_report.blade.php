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
                            <h5 class="m-0 font-weight-bold text-primary">Withdrawal Report</h5>

                            <br>
                            <form name='filterdate' id='filterdate'>

                                <div class="col-12 col-sm-6 col-md-6 form-group">
                                    <label>Select Status</label>
                                    <select name="status" id="status" class="select2 form-control custom-select">
                                        <option value="BANK_WITHDRAWAL_REQUEST" selected="selected">Bank Withdrawal
                                            Request</option>
                                        <option value="">All Request</option>
                                        <option value="INITIATED_BY_AGENT">Initiated By Agent</option>
                                        <option value="ADMIN_WITHDRAWAL">Admin Withdrawal</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 input-group input-daterange">
                                    <input type="text" name="from_date" id="from_date" readonly class="form-control"
                                        placeholder="Start Date" />&nbsp;&nbsp;
                                    <div class="input-group-addon">to</div> &nbsp;&nbsp;
                                    <input type="text" name="to_date" id="to_date" readonly class="form-control"
                                        placeholder="End Date" />

                                    &nbsp;&nbsp;
                                    <button type="button" name="filter" id="filter"
                                        class="btn btn-info btn-sm">Filter</button>
                                </div>
                            </form>


                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Date</th>
                                                <th class="text-center">Withdrawal Id</th>
                                                <th class="text-center">Amount</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Expires At</th>
                                                <th class="text-center">Action</th>
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

        <!-- Paid Withdrawal -->
        <div class="modal fade" id="paid_Withdrawal_form" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">Paid Withdrawal</h4>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span> </button>
                    </div>
                    <div class="modal-body">
                        <form name='paidWithdrawal' id='paidWithdrawal'>
                            <div class="row">
                                <div class="col-md-6" style="margin:0 auto; display:block;">
                                    <div class="form-group">
                                        <label>Bank Reference No.</label>
                                        <div class="input-group">
                                            <input type="text" name="bank_reference_no" class="form-control"
                                                id="bank_reference_no" required>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Remark</label>
                                        <div class="input-group">
                                            <input type="text" name="remark" class="form-control" id="remark"
                                                required>

                                        </div>
                                    </div>
                                </div>
                                <br><br>
                            </div>
                            <div id='response'></div>
                            <div style="text-align:center">
                                <button type="submit" class="btn btn-primary btn-rounded btn-fw" id='submit_button'
                                    data-withdrawal-id="" style="font-weight:500;">Submit</button>
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            </div>

                        </form>


                    </div>

                    <div class="modal-footer">

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
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span> </button>
                    </div>
                    <div class="modal-body">
                        <form name='MoreDetails' id='MoreDetails'>
                            <div class="row">
                                <div style="margin:5%;">
                                    <table class="table table-bordered" cellspacing="0">
                                        <tr>
                                            <th>Status:</th>
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
                    autoclose: true,
                    orientation: "bottom left"
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
                                    return '<td class="text-center"><button title="Paid Withdrawal" data-withdrawalid= "' +
                                        row
                                        .withdrawal_id +
                                        '" class="paid_withdrawal btn btn-block" style="background-color: rgb(82, 208, 23); color: rgb(255,255,255); width: 80px;" >Paid</button><button title="Failed Withdrawal" data-withdrawalid= "' +
                                        row.withdrawal_id +
                                        '" class="failed_withdrawal btn btn-block" style="width: 80px; background-color: rgb(255,0,0); color: rgb(255,255,255);">Failed</button><button title="More Details" data-userid="' +
                                        row.id +
                                        '" class="more_details btn" style="color: rgb(30, 50, 250);"><i class="fa fa-arrow-right" aria-hidden="true"></i></button></td>';
                                } else {
                                    return '<td class="text-center"><button title="More Details" data-userid="' +
                                        row.id +
                                        '" class="more_details btn" style="color: rgb(30, 50, 250);"><i class="fa fa-arrow-right" aria-hidden="true"></i></button></td>';
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
                            'withdrawal_id': withdrawal_id
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
</body>

</html>
