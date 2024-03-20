@extends('layouts.master')
@section('styles')
@endsection
@section('content')
                    <!-- PAGE-HEADER -->
                    <div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
                        <h1 class="page-title">Transfer Limit Scheme</h1>
                        <div>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/index')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Transfer Limit Scheme</li>
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
                                                        <button type="submit" class="btn-fill btn btn-secondary" id='submit_button' style="float:right;">Add New Scheme</button>
                                                </div>
                                            </div>
                                            <div class="e-table px-5 pb-5 pd-12">
                                                <div class="table-responsive table-lg">
                                                    <table class="table border-top table-bordered mb-0 text-nowrap" id="dataTable" style="width:100%;">
                                                        <thead class="border-top">
                                                            <tr>
                                                                <th class="border-bottom-0">Name</th>
                                                                <th class="border-bottom-0">Created At</th>
                                                                <th class="border-bottom-0 ">Eligible Limit Per Month</th>
                                                                <th class="border-bottom-0 ">Eligible Limit Per Day</th>
                                                                <th class="border-bottom-0 ">Action</th>
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
                        </div>
                        <!-- ROW CLOSED -->
                    </div>
                    <!-- CONTAINER CLOSED -->
                 <!-- Add Schemes Model-->
    <div class="modal fade" id="add_scheme_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Add Scheme</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body px-4">
                    <form name='addSchemes' id='addSchemes'>
                        <div class="row gy-3">
                                <div class="col-xl-12">
                                    <label>Name</label>
                                        <input type="text" name="name" class="form-control" id="name"
                                            required>
                                </div>
                                <div class="col-xl-12">
                                    <label>Eligible Limit Per Day</label>
                                        <input type="text" name="eligible_limit_per_day" class="form-control"
                                            id="eligible_limit_per_day" required>
                                </div>
                                <div class="col-xl-12">
                                    <label>Eligible Limit Per Month</label>
                                        <input type="text" name="eligible_limit_per_month" class="form-control"
                                            id="eligible_limit_per_month" required>
                                </div>
                            </div>
                        <div id='response'></div>
                        <div class="text-center px-4 py-4">
                            <button type="submit" class="btn btn-primary btn-rounded btn-fw" id='submit_button'
                                data-user-id="" style="font-weight:500;">Add</button>
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal" id="cancel_btn">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Scheme Modal-->
    <div class="modal fade" id="scheme_edit_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Scheme</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body px-4">
                    <form name='addNewBank' id='editScheme'>
                        <div class="row gy-3">
                                <div class="col-xl-12">
                                    <label>Name</label>
                                        <input type="text" name="name" class="form-control" id="Name"
                                            required>
                                </div>
                                <div class="col-xl-12">
                                    <label>Eligible Limit Per Day</label>
                                        <input type="text" name="eligible_limit_per_day" class="form-control"
                                            id="Eligible_limit_per_day" required>
                                </div>
                                <div class="col-xl-12">
                                    <label>Eligible Limit Per Month</label>
                                        <input type="text" name="eligible_limit_per_month" class="form-control"
                                            id="Eligible_limit_per_month" required>
                                </div>
                        </div>
                        <div id='response'></div>
                        <div class="px-4 py-4 text-center">
                            <button type="submit" class="btn btn-primary btn-rounded btn-fw"
                                id='submit_scheme_button' data-scheme-id="" style="font-weight:500;">Update</button>
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

            //Display Scheme List 
            $('#dataTable').DataTable({
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                "processing": true,
                "serverSide": true,
                "searching": false,
                "ajax": {
                    url: '{{ url('api/transfer-limit-schemes') }}',
                    data: function(d) {
                        d.request_origin = 'web'
                    }

                },
                columnDefs: [{
                    targets: 4,
                    render: function(data, type, row, meta) {
                        return '<td class="text-center"><button data-schemeid="' + row.id +
                            '" class="btn-scheme_entry_delete btn" style="color:#FA5252" title="delete"><i class="bi bi-trash fa-lg"></i></button></td>';
                    }

                }],
                "columns": [{
                        data: 'name',
                        className: "name",
                    },
                    {
                        data: 'created_at',
                        className: "created_at",
                        render: function(data, type, row, meta) {
                            return moment.utc(data).local().format('DD/MM/YYYY HH:mm a');
                        }
                    },
                    {
                        data: 'eligible_limit_per_month',
                        className: "eligible_limit_per_month",
                    },
                    {
                        data: 'eligible_limit_per_day',
                        className: "eligible_limit_per_day",
                    }
                ]

            });


            //Add Scheme
            $("#submit_button").on('click', function() {
                $('#add_scheme_form').modal('show');
            });
            $('#addSchemes').on('submit', function(e) {
                e.preventDefault();
                spinner.show();
                var formFields = $('#addSchemes').serialize();

                $.ajax({
                    url: 'api/transfer-limit-schemes',
                    type: 'post',
                    dataType: 'JSON',
                    data: formFields,
                    success: function(data) {
                        //alert(JSON.stringify(meta.message));
                        //console.log("ttttt");
                        if (data.error_code == 0) {
                            // console.log(data);
                            spinner.hide();
                            $('#add_scheme_form').modal('hide');
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

                        $('#addSchemes').closest('form').find(
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

            //Edit Scheme
            $("#dataTable").on('click', '.scheme_entry', function() {
                var name = $(this).closest('tr').find('.name').text();
                var eligible_limit_per_month = $(this).closest('tr').find('.eligible_limit_per_month')
                    .text();
                var eligible_limit_per_day = $(this).closest('tr').find('.eligible_limit_per_day').text();

                $('#Name').val(name);
                $('#Eligible_limit_per_month').val(eligible_limit_per_month);
                $('#Eligible_limit_per_day').val(eligible_limit_per_day);

                $('#scheme_edit_form').modal('show');

                $('#submit_scheme_button').attr('data-scheme-id', $(this).data('schemeid'));
            });
            $('#editScheme').on('submit', function(e) {
                e.preventDefault();
                spinner.show();

                var formFields = $('#editScheme').serialize();
                var SchemeId = $('#submit_scheme_button').data('scheme-id');
                //console.log("Bank Id: " + SchemeId);

                $.ajax({
                    url: 'api/transfer-limit-schemes/' + SchemeId,
                    type: 'patch',
                    dataType: 'JSON',
                    data: formFields,
                    success: function(data) {
                        //alert(JSON.stringify(meta.message));
                        //console.log("ttttt");
                        if (data.error_code == 0) {
                            // console.log(data);
                            spinner.hide();
                            $('#scheme_edit_form').modal('hide');
                            $('#dataTable').DataTable().ajax.reload();
                            Swal.fire({
                                title: "" + data.meta.message,
                                icon: 'success',
                                showCloseButton: true
                            })
                        } else {
                            swal(data.meta.message, "error");
                        }

                        $('#editScheme').closest('form').find(
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


            //Delete Scheme
            $("#dataTable").on('click', '.btn-scheme_entry_delete', function() {

                var SchemeId = $(this).data('schemeid');
                // console.log("BankId: " + SchemeId);

                Swal.fire({
                    title: "Do you want to delete this bank?",
                    text: "",
                    showCancelButton: true
                }).then((result) => {
                    if (result.value) {
                        // console.log("Result: " + result.value);
                        $.ajax({
                            url: 'api/transfer-limit-schemes/' + SchemeId,
                            type: 'delete',
                            dataType: 'JSON',

                            success: function(data) {
                                //alert(JSON.stringify(meta.message));
                                //console.log("ttttt");
                                if (data.error_code == 0) {
                                    // console.log(data);

                                    $('#dataTable').DataTable().ajax.reload();
                                    Swal.fire({
                                        title: "" + data.meta.message,
                                        icon: 'success',
                                        showCloseButton: true
                                    })
                                } else {
                                    swal(data.meta.message, "error");
                                }
                            }
                        });
                    }
                });

            });

        });
    </script>
@endsection
