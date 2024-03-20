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
                            <h5 class="m-0 font-weight-bold text-primary">Transfer Limit Scheme</h5>
                            <button type="submit" class="btn-fill btn" id='submit_button'
                                style="float:right; margin-top: -20px;">Add New Scheme</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Created At</th>
                                            <th class="text-center">Eligible Limit Per Month</th>
                                            <th class="text-center">Eligible Limit Per Day</th>
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
            <div id="loader"></div>
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="{{ asset('#page-top') }}">
        <i class="fas fa-angle-up"></i> </a>

    <!-- Add Schemes Model-->
    <div class="modal fade" id="add_scheme_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Add Scheme</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span> </button>
                </div>
                <div class="modal-body">
                    <form name='addSchemes' id='addSchemes'>
                        <div class="row">
                            <div class="col-md-6" style="margin:0 auto; display:block;">
                                <div class="form-group">
                                    <label>Name</label>
                                    <div class="input-group">
                                        <input type="text" name="name" class="form-control" id="name"
                                            required>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Eligible Limit Per Day</label>
                                    <div class="input-group">
                                        <input type="text" name="eligible_limit_per_day" class="form-control"
                                            id="eligible_limit_per_day" required>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Eligible Limit Per Month</label>
                                    <div class="input-group">
                                        <input type="text" name="eligible_limit_per_month" class="form-control"
                                            id="eligible_limit_per_month" required>

                                    </div>
                                </div>
                            </div>
                            <br><br>
                        </div>
                        <div id='response'></div>
                        <div style="text-align:center">
                            <button type="submit" class="btn btn-primary btn-rounded btn-fw" id='submit_button'
                                data-user-id="" style="font-weight:500;">Add</button>
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        </div>

                    </form>


                </div>

                <div class="modal-footer">

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
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span> </button>
                </div>
                <div class="modal-body">
                    <form name='addNewBank' id='editScheme'>
                        <div class="row">
                            <div class="col-md-6" style="margin:0 auto; display:block;">
                                <div class="form-group">
                                    <label>Name</label>
                                    <div class="input-group">
                                        <input type="text" name="name" class="form-control" id="Name"
                                            required>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Eligible Limit Per Day</label>
                                    <div class="input-group">
                                        <input type="text" name="eligible_limit_per_day" class="form-control"
                                            id="Eligible_limit_per_day" required>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Eligible Limit Per Month</label>
                                    <div class="input-group">
                                        <input type="text" name="eligible_limit_per_month" class="form-control"
                                            id="Eligible_limit_per_month" required>

                                    </div>
                                </div>
                            </div>
                            <br><br>
                        </div>
                        <div id='response'></div>
                        <div style="text-align:center">
                            <button type="submit" class="btn btn-primary btn-rounded btn-fw"
                                id='submit_scheme_button' data-scheme-id="" style="font-weight:500;">Update</button>
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
                        //console.log('data');
                        return '<td class="text-center"><button data-schemeid="' +
                            row.id +
                            '" class="btn-scheme_entry_delete btn" style="color: rgb(30, 50, 250);"><i class="fa fa-close fa-lg"></i></button></td>';
                        //return '<td class="text-center"><button data-schemeid="' + row.id +
                        '" class="scheme_entry btn" style="color: rgb(30, 50, 250);"><i class="fa fa-edit fa-lg"></i></button>        </td>';
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
</body>

</html>
