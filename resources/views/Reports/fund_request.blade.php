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
                        <h1 class="page-title">Bill Payment</h1>
                        <div>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/index')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Bill Payment</li>
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
                                                                    <label>Select Type</label>
                                                                    <select name="is_received_or_sent" id="is_received_or_sent"
                                                                        class="select2 form-control custom-select">
                                                                        <option value="received" selected="selected">Received</option>
                                                                        <option value="sent">Sent</option>
                                                                    </select>
                                                                </div> &nbsp;&nbsp;
                                                                <div class="form-group col-sm">
                                                                    <label>Select Status</label>
                                                                    <select name="status" id="status" class="select2 form-control custom-select">
                                                                        <option value="REQUESTED" selected="selected">Requested</option>
                                                                        <option value="ACCEPTED">Accepted</option>
                                                                        <option value="REJECTED">Rejected</option>
                                                                    </select>
                                                                </div>
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
                                                                        class="btn btn-block btn-success">Export All
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                <div class="e-table px-5 pb-5 pd-12">
                                                    <div class="table-responsive table-lg">
                                                        <table class="table border-top table-bordered mb-0 text-nowrap incomplete_registration" id="dataTable" style="width:100%;">
                                                            <thead class="border-top">
                                                                <tr>
                                                                    <th class="border-bottom-0">Date</th>
                                                                    <th class="border-bottom-0">Pacpay User ID</th>
                                                                    <th class="border-bottom-0">Name</th>
                                                                    <th class="border-bottom-0">Amount</th>
                                                                    <th class="border-bottom-0">Bank Name</th>
                                                                    <th class="border-bottom-0">Status</th>
                                                                    <th class="border-bottom-0">User Type</th>
                                                                    <th class="border-bottom-0">Transaction No</th>
                                                                    <th class="border-bottom-0">Remark</th>
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

<script type="text/javascript">
            $(document).ready(function() {
            $(".navbar-nav li").removeClass("active"); //this will remove the active class from  
            $('#reports').addClass('active');

            $('td:nth-child(10),th:nth-child(10)').hide();

            $('#status').on('change', function() {
                if (this.value == 'REQUESTED') {
                    $('td:nth-child(10),th:nth-child(10)').show();
                } else if (this.value == 'Accepted') {
                    $('td:nth-child(10),th:nth-child(10)').hide();
                } else if (this.value == 'Rejected') {
                    $('td:nth-child(10),th:nth-child(10)').hide();
                }
            });

            var date = new Date();
            $('.input-daterange').datepicker({
                todayBtn: 'linked',
                format: 'yyyy-mm-dd',
                autoclose: true
            });

            fetch_data();

            function fetch_data(from_date = (new Date()).toISOString().split('T')[0],
                to_date = (new Date()).toISOString().split('T')[0], is_received_or_sent = 'received', status =
                'REQUESTED') {
                $('#dataTable').DataTable().clear().destroy();

                $('#dataTable').DataTable({

                    "processing": true,
                    "serverSide": true,
                    "searching": true,
                    "ordering": false,
                    "ajax": {
                        url: '{{ url('api/fund-request') }}',
                        data: function(d) {
                            d.search = d.search['value'],
                                d.request_origin = 'web',
                                d.from_date = from_date,
                                d.to_date = to_date,
                                d.is_received_or_sent = is_received_or_sent,
                                d.status = status
                        }
                    },
                    columnDefs: [{
                        targets: 9,
                        render: function(data, type, row, meta) {
                            return '<td class="text-center"><button data-fundreqid= "' + row
                                .fund_request_id +
                                '"  class="btn-fill-approve btn" type="button" style="width: 70px;" id="approve">Accept</button>&nbsp;&nbsp;<button data-fundreqid= "' +
                                row.fund_request_id +
                                '" class="btn-fill-reject btn btn-danger" type="button" style="background-color: rgb(245, 174, 174); color: rgb(196, 49, 49); width: 70px;">Reject</button></td>';
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
                            data: 'sender_user.pacpay_user_id'
                        },
                        {
                            data: 'requester_user.full_name'
                        },
                        {
                            data: 'amount'
                        },
                        {
                            data: 'admin_bank_detail.bank_name'
                        },
                        {
                            data: 'status'
                        },
                        {
                            data: 'requester_user.user_type'
                        },
                        {
                            data: 'transaction_ref_no'
                        },
                        {
                            data: 'reject_remark'
                        }
                    ],
                    dom: 'Bfrtip',
                    buttons: [{
                            extend: 'excelHtml5',
                            title: 'Reports',
                            text: 'Excel'
                            //Columns to export
                            //exportOptions: {
                            //     columns: [0, 1, 2, 3,4,5,6]
                            // }
                        },
                        {
                            extend: 'pdfHtml5',
                            title: 'Reports',
                            text: 'PDF'
                            //Columns to export
                            //exportOptions: {
                            //     columns: [0, 1, 2, 3, 4, 5, 6]
                            //  }
                        }
                    ]

                });


            }

            //Filter Button
            $('#filter').click(function() {
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();
                var is_received_or_sent = $('#is_received_or_sent').val();
                var status = $('#status').val();

                /*   console.log("from_date " + from_date);
                  console.log("to_date " + to_date);
                  console.log("is_received_or_sent " + is_received_or_sent);
                  console.log("status " + status); */

                fetch_data(from_date, to_date, is_received_or_sent, status);
            });



            $("#dataTable").on('click', '.btn-fill-approve', function() {

                var FundRequestId = $(this).data('fundreqid');
                // console.log(FundRequestId);

                Swal.fire({
                    title: "Enter Transaction Pin",
                    text: "",
                    input: 'text',
                    showCancelButton: true
                }).then((result) => {
                    if (result.value) {
                        //  console.log("Result: " + result.value);
                        $.ajax({
                            url: 'api/fund-request/' + FundRequestId + '/accept',
                            type: 'patch',
                            dataType: 'JSON',
                            data: {
                                transaction_pin: result.value
                            },
                            success: function(data) {
                                //alert(JSON.stringify(meta.message));
                                // console.log("ttttt");
                                if (data.error_code == 0) {
                                    //console.log(data);

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

                $('#submit_button').attr('data-bnk-id', $(this).data('bankid'));
            });


            $("#dataTable").on('click', '.btn-fill-reject', function() {

                var FundRequestId = $(this).data('fundreqid');
                // console.log(FundRequestId);

                Swal.fire({
                    title: "Enter Remark",
                    text: "",
                    input: 'text',
                    showCancelButton: true
                }).then((result) => {
                    if (result.value) {
                        //console.log("Result: " + result.value);
                        $.ajax({
                            url: 'api/fund-request/' + FundRequestId + '/reject',
                            type: 'patch',
                            dataType: 'JSON',
                            data: {
                                reject_remark: result.value
                            },
                            success: function(data) {
                                //alert(JSON.stringify(meta.message));
                                // console.log("ttttt");
                                if (data.error_code == 0) {
                                    //console.log(data);

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

                $('#submit_button').attr('data-bnk-id', $(this).data('bankid'));
            });

        });
    </script>
@endsection
