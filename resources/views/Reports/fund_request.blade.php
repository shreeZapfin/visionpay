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
                            <h5 class="m-0 font-weight-bold text-primary">Fund Request</h5>

                        </div>

                        <form name='filter_search' id='filter_search' style="margin-top: 20px;">
                            <div class="col-12 col-sm-6 col-md-6 input-group input-daterange">
                                <div class="form-group">
                                    <label>Select Type</label>
                                    <select name="is_received_or_sent" id="is_received_or_sent"
                                        class="select2 form-control custom-select">
                                        <option value="received" selected="selected">Received</option>
                                        <option value="sent">Sent</option>
                                    </select>
                                </div> &nbsp;&nbsp;
                                <div class="form-group">
                                    <label>Select Status</label>
                                    <select name="status" id="status" class="select2 form-control custom-select">
                                        <option value="REQUESTED" selected="selected">Requested</option>
                                        <option value="ACCEPTED">Accepted</option>
                                        <option value="REJECTED">Rejected</option>
                                    </select>
                                </div>
                                <div class="input-group">
                                    <input type="text" name="from_date" id="from_date" readonly class="form-control"
                                        placeholder="Start Date" />&nbsp;&nbsp;
                                    <div class="input-group-addon">to</div> &nbsp;&nbsp;
                                    <input type="text" name="to_date" id="to_date" readonly class="form-control"
                                        placeholder="End Date" />

                                </div>

                                &nbsp;&nbsp;
                                <button type="button" name="filter" id="filter" class="btn btn-info btn-sm"
                                    style="text-align: center; margin-top:30px; height : 40px; width: 80px;">Filter</button>
                            </div>
                        </form>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">DATE</th>
                                            <th class="text-center">PACPAY USER ID</th>
                                            <th class="text-center">NAME</th>
                                            <th class="text-center">AMOUNT</th>
                                            <th class="text-center">BANK NAME</th>
                                            <th class="text-center">STATUS</th>
                                            <th class="text-center">USER TYPE</th>
                                            <th class="text-center">Transaction No</th>
                                            <th class="text-center">REMARK</th>
                                            {{-- <div style="display: none;"> --}}
                                            <th class="text-center">ACTION</th>
                                            {{-- </div> --}}


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
                autoclose: true,
                orientation: "bottom left"
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
                                '" class="btn-fill-reject btn" type="button" style="background-color: rgb(245, 174, 174); color: rgb(196, 49, 49); width: 70px;">Reject</button></td>';
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
</body>

</html>
