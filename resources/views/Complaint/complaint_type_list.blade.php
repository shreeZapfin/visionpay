@extends('layouts.master')
@section('styles')
<style>
    .voucher_description{
        width: 150px !important;
        border:1px solid red;
    }
</style>
@endsection
@section('content')
                    <!-- PAGE-HEADER -->
                    <div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
                        <h1 class="page-title">Ticket Type List</h1>
                        <div>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/index')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Ticket Type List</li>
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
                                            <form name='filter_search' id='filter_search' style="margin-top: 20px;">
                                                    <div class="input-group">
                                                        <div class="form-group col-sm">
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
                                                        </div> &nbsp;&nbsp;
                                                        <div class="input-group col-sm pb-3">
                                                        <button type="button" name="filter" id="filter" class="btn border"
                                                            style="text-align: center; margin-top:30px; height : 35px; width: 80px;border-top-right-radius: 0.3rem;border-bottom-right-radius: 0.3rem; ">
                                                            <i class="bi bi-search text-muted"></i></button>
                                                        </div>
                                                        <button type="button" class="btn-fill btn btn-secondary float-end" id='submit_button'
                                                        style="text-align: center; margin-top:30px; height : 35px; border-radius:0.3rem;
                                                        background:	#006400; color: rgb(255,255,255);">Add Ticket Type</button>
                                                    </div>
                                                </form>
                                            <div class="e-table px-5 pb-5 pd-12">
                                                <div class="table-responsive table-lg">
                                                    <table class="table border-top table-bordered mb-0 text-nowrap" id="dataTable" style="width:100%;">
                                                        <thead class="border-top">
                                                            <tr>
                                                                <th class="border-bottom-0">Created At</th>
                                                                <th class="border-bottom-0">Transaction Type</th>
                                                                <th class="border-bottom-0 ">Type Description</th>
                                                                <th class="border-bottom-0">Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody></tbody>
                                                    </table>
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
   
    <!-- Add Complaint Type Model-->
    <div class="modal fade" id="add_complaint_type_form" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Add Ticket Type</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body px-4">
                    <form name='addComplaintType' id='addComplaintType'>
                        <div class="row gy-3">
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
                        <div class="px-4 py-4 text-center">
                            <button type="submit" class="btn btn-primary btn-rounded btn-fw" id='submit_button'
                                data-user-id="" style="font-weight:500;">Add</button>
                                <button type="button" class="btn btn-light cancel_btn" data-bs-dismiss="modal" id="cancel_btn">Cancel</button>
                        </div>

                    </form>
                    <div id='response'></div>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body px-4">
                    <form name='updateComplaintType' id='updateComplaintType'>
                        <div class="row gy-3">
                                <div class="col-xl-12">
                                    <label>Transaction Type</label>
                                        <input type="text" name="transaction_type" class="form-control"
                                            id="c_transaction_type" required>
                                </div>
                                <div class="col-xl-12">
                                    <label>Type Description</label>
                                        <input type="text" name="type_description" class="form-control"
                                            id="c_type_description" required>
                                </div>
                        </div>
                        <div class="text-center px-4 py-4">
                            <button type="submit" class="btn btn-primary btn-rounded btn-fw" id='submit_button'
                                data-complaint-type-id="" style="font-weight:500;">Update</button>
                                <button type="button" class="btn btn-light cancel_btn" data-bs-dismiss="modal" id="cancel_btn">Cancel</button>
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
                                '" class="complaint_type_entry btn btn-primary">Update</button></td>';
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
@endsection
