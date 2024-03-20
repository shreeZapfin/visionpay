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
                            <h5 class="m-0 font-weight-bold text-primary">Ticket Type List</h5>
                            <button type="submit" class="btn-fill btn" id='submit_button'
                                style="float:right; margin-top: -20px;">Add Ticket Type</button>
                        </div>
                        <form name='filter_search' id='filter_search' style="margin-top: 20px;">
                            <div class="col-12 col-sm-6 col-md-6 input-group input-daterange">
                                <div class="form-group">
                                    <label>Transaction Type</label>
                                    <select name="transaction_type" id="transaction_type"
                                        class="select2 form-control custom-select">
                                        <option value="" selected="selected">Select transaction type</option>
                                        <option value="WALLET_TRANSFER">WALLET TRANSFER </option>
                                        <option value="DEPOSIT">DEPOSIT</option>
                                        <option value="WITHDRAWAL">WITHDRAWAL</option>
                                        <option value="BILL_PAYMENT">BILL_PAYMENT</option>
                                        <option value="WITHDRAWAL_CHARGE">WITHDRAWAL CHARGE</option>
                                        <option value="CASHBACK">CASHBACK</option>
                                        <option value="GENERAL_COMPLAINT">GENERAL COMPLAINT</option>
                                    </select>
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
                                            <th class="text-center">Created At</th>
                                            <th class="text-center">Transaction Type</th>
                                            <th class="text-center">Type Description</th>
                                            <th class="text-center">ACTION</th>
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
            <div id="loader"></div>
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="{{ asset('#page-top') }}">
        <i class="fas fa-angle-up"></i> </a>

    <!-- Add Complaint Type Model-->
    <div class="modal fade" id="add_complaint_type_form" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Add Ticket Type</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span> </button>
                </div>
                <div class="modal-body">
                    <form name='addComplaintType' id='addComplaintType'>
                        <div class="row">
                            <div class="col-md-6" style="margin:0 auto; display:block;">
                                <div class="form-group">
                                    <label>Transaction Type</label>
                                    <div class="input-group">
                                        <select name="transaction_type" id="transaction_type"
                                            class="select2 form-control custom-select" required>
                                            <option value="" selected="selected">Select Transaction Type</option>
                                            <option value="WALLET_TRANSFER">Wallet Transafer</option>
                                            <option value="DEPOSIT">Deposit</option>
                                            <option value="WITHDRAWAL">Withdrawal</option>
                                            <option value="BILL_PAYMENT">Bill Payment</option>
                                            <option value="WITHDRAWAL_CHARGE">Withdrawal Charge</option>
                                            <option value="CASHBACK">Cashback</option>
                                            <option value="GENERAL_COMPLAINT">General Complaint</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Type Description</label>
                                    <div class="input-group">
                                        <input type="text" name="type_description" class="form-control"
                                            id="type_description" required>
                                    </div>
                                </div>
                            </div>
                            <br><br>
                        </div>
                        <div style="text-align:center">
                            <button type="submit" class="btn btn-primary btn-rounded btn-fw" id='submit_button'
                                data-user-id="" style="font-weight:500;">Add</button>
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        </div>

                    </form>
                    <div id='response'></div>

                </div>

                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

    <!-- Update Complaint Type Modal-->
    <div class="modal fade" id="update_complaint_type_form" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Ticket Type</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span> </button>
                </div>
                <div class="modal-body">
                    <form name='updateComplaintType' id='updateComplaintType'>
                        <div class="row">
                            <div class="col-md-6" style="margin:0 auto; display:block;">
                                <div class="form-group">
                                    <label>Transaction Type</label>
                                    <div class="input-group">
                                        <input type="text" name="transaction_type" class="form-control"
                                            id="c_transaction_type" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Type Description</label>
                                    <div class="input-group">
                                        <input type="text" name="type_description" class="form-control"
                                            id="c_type_description" required>

                                    </div>
                                </div>
                            </div>
                            <br><br>
                        </div>
                        <div style="text-align:center">
                            <button type="submit" class="btn btn-primary btn-rounded btn-fw" id='submit_button'
                                data-complaint-type-id="" style="font-weight:500;">Update</button>
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

    <script type="text/javascript">
        $(document).ready(function() {
            $(".navbar-nav li").removeClass("active"); //this will remove the active class from  
            //previously active menu item 
            $('#complaint').addClass('active');

            //Display Bank List 

            fetch_data();

            function fetch_data(transaction_type) {
                $('#dataTable').DataTable().clear().destroy();
                $('#dataTable').DataTable({
                    "lengthMenu": [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ],
                    "processing": true,
                    "serverSide": true,
                    "searching": true,
                    "ajax": {
                        url: '{{ url('api/admin/complaint-type') }}',
                        data: function(d) {
                            d.search = d.search['value'],
                                d.request_origin = 'web',
                                d.transaction_type = transaction_type
                        }

                    },
                    columnDefs: [{
                        targets: 3,
                        render: function(data, type, row, meta) {
                            //   console.log('data');
                            return '<td class="text-center"><button data-complainttypeid="' +
                                row.id +
                                '" class="complaint_type_entry btn" style="color: rgb(30, 50, 250);">Update</button></td>';
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
                            data: 'transaction_type',
                            className: "transactionType",
                        },
                        {
                            data: 'type_description',
                            className: "typeDescription",
                        }
                    ]

                });
            }

            //Filter Button
            $('#filter').click(function() {
                var transaction_type = $('#transaction_type').val();
                fetch_data(transaction_type);
            });

            var spinner = $('#loader');

            //Update Complaint Type
            $("#dataTable").on('click', '.complaint_type_entry', function() {
                var transactionType = $(this).closest('tr').find('.transactionType').text();
                var typeDescription = $(this).closest('tr').find('.typeDescription').text();
                // console.log("fetchData" + transactionType + " " + typeDescription);
                $('#c_transaction_type').val(transactionType);
                $('#c_type_description').val(typeDescription);

                $('#update_complaint_type_form').modal('show');

                $('#submit_button').attr('data-complaint-type-id', $(this).data('complainttypeid'));
            });
            $('#updateComplaintType').on('submit', function(e) {
                e.preventDefault();
                spinner.show();
                var formFields = $('#updateComplaintType').serialize();
                var ComplaintTypeId = $('#submit_button').data('complaint-type-id');
                //  console.log("Complaint Type Id: " + ComplaintTypeId);

                $.ajax({
                    url: 'api/admin/complaint-type/' + ComplaintTypeId,
                    type: 'patch',
                    dataType: 'JSON',
                    data: formFields,
                    success: function(data) {
                        //alert(JSON.stringify(meta.message));
                        // console.log("ttttt");
                        if (data.error_code == 0) {
                            //console.log(data);
                            spinner.hide();
                            $('#update_complaint_type_form').modal('hide');
                            $('#dataTable').DataTable().ajax.reload();
                            Swal.fire({
                                title: "" + data.meta.message,
                                icon: 'success',
                                showCloseButton: true
                            })
                        } else {
                            swal(data.meta.message, "error");
                        }

                        $('#updateComplaintType').closest('form').find(
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

            //Add Complaint Type
            $("#submit_button").on('click', function() {
                $('#add_complaint_type_form').modal('show');
            });
            $('#addComplaintType').on('submit', function(e) {
                e.preventDefault();
                spinner.show();
                //console.log("inside complaint type");
                var formFields = $('#addComplaintType').serialize();
                //console.log("Form fields: " + formFields);
                $.ajax({
                    url: 'api/admin/complaint-type',
                    type: 'post',
                    dataType: 'JSON',
                    data: formFields,
                    success: function(data) {
                        //alert(JSON.stringify(meta.message));
                        // console.log("ttttt");
                        if (data.error_code == 0) {
                            //  console.log(data);
                            spinner.hide();
                            $('#add_complaint_type_form').modal('hide');
                            $('#dataTable').DataTable().ajax.reload();
                            Swal.fire({
                                title: "" + data.meta.message,
                                icon: 'success',
                                showCloseButton: true
                            })
                        } else {
                            swal(data.meta.message, "error");
                        }

                        $('#addComplaintType').closest('form').find(
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
