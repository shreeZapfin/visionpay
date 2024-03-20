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
                            <h5 class="m-0 font-weight-bold text-primary">System Bank List</h5>
                            <button type="submit" class="btn-fill btn" id='submit_button'
                                style="float:right; margin-top: -20px;">Add Bank</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Created At</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Swift</th>
                                            <th class="text-center">BSB</th>
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

    <!-- Add Bank Model-->
    <div class="modal fade" id="add_system_bank_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Add System Bank</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span> </button>
                </div>
                <div class="modal-body">
                    <form name='addSystemBank' id='addSystemBank'>
                        <div class="row">
                            <div class="col-md-6" style="margin:0 auto; display:block;">
                                <div class="form-group">
                                    <label>Bank Name</label>
                                    <div class="input-group">
                                        <input type="text" name="bank_name" class="form-control" id="bank_name"
                                            required>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>BSB</label>
                                    <div class="input-group">
                                        <input type="text" name="bsb" class="form-control" id="bsb"
                                            required>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Swift</label>
                                    <div class="input-group">
                                        <input type="text" name="swift" class="form-control" id="swift"
                                            required>

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

    <!-- Edit System Bank Modal-->
    <div class="modal fade" id="sys_bank_edit_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit System Bank</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span> </button>
                </div>
                <div class="modal-body">
                    <form name='editSysBank' id='editSysBank'>
                        <div class="row">
                            <div class="col-md-6" style="margin:0 auto; display:block;">
                                <input type="text" name="bank_id" class="form-control" id="bankIdd"
                                    type="hidden">
                                <div class="form-group">
                                    <label>Name</label>
                                    <div class="input-group">
                                        <input type="text" name="bank_name" class="form-control" id="bankName"
                                            required>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Swift</label>
                                    <div class="input-group">
                                        <input type="text" name="swift" class="form-control" id="Swift"
                                            required>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Bsb</label>
                                    <div class="input-group">
                                        <input type="text" name="bsb" class="form-control" id="Bsb"
                                            required>

                                    </div>
                                </div>
                            </div>
                            <br><br>
                        </div>
                        <div id='response'></div>
                        <div style="text-align:center">
                            <button type="submit" class="btn btn-primary btn-rounded btn-fw" id='submit_bank_button'
                                data-sys-bank-id="" style="font-weight:500;">Update</button>
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
            $('#bank_withdrawal').addClass('active');

            //Display System Bank List 
            $('#dataTable').DataTable({
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                "processing": true,
                "serverSide": true,
                "searching": false,
                "ajax": {
                    url: '{{ url('api/banks') }}',
                    data: function(d) {
                        d.request_origin = 'web',
                            d.show_all = 1
                    }
                },
                columnDefs: [{
                    targets: 4,
                    render: function(data, type, row, meta) {

                        if (row.deleted_at == null) {
                            return '<td class="text-center"><button title="Disable System Bank" data-bankid= "' +
                                row
                                .id +
                                '"  class="btn disable_system_bank btn-fill-approve" style="background-color: rgb(95,158,160); color: rgb(255,255,255); width: 80px;" >Disable </button><button data-bankid= "' +
                                row
                                .id +
                                '"  class="update_sys_bank btn-fill-approve btn" style="width: 80px;" >Update</button></td>';

                        } else {
                            return '<td class="text-center"><button title="Enable System Bank" data-bankid= "' +
                                row
                                .id +
                                '"  class="btn enable_system_bank btn-fill-approve" style="background-color: rgb(0,128,0); width: 80px;" >Enable</button><button data-bankid= "' +
                                row
                                .id +
                                '"  class="update_sys_bank btn-fill-approve btn" style="width: 80px;" >Update</button></td>';

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
                        data: 'bank_name',
                        className: "bank_name",
                    },
                    {
                        data: 'swift',
                        className: "swift",
                    },
                    {
                        data: 'bsb',
                        className: "bsb",
                    }
                ]

            });
            var spinner = $('#loader');

            //Add System Bank
            $("#submit_button").on('click', function() {
                $('#add_system_bank_form').modal('show');
            });
            $('#addSystemBank').on('submit', function(e) {
                e.preventDefault();
                spinner.show();
                var formFields = $('#addSystemBank').serialize();

                $.ajax({
                    url: 'api/banks',
                    type: 'post',
                    dataType: 'JSON',
                    data: formFields,
                    success: function(data) {
                        //alert(JSON.stringify(meta.message));
                        console.log("ttttt");
                        if (data.error_code == 0) {
                            console.log(data);
                            spinner.hide();
                            $('#add_system_bank_form').modal('hide');
                            $('#dataTable').DataTable().ajax.reload();
                            Swal.fire({
                                title: "" + data.meta.message,
                                icon: 'success',
                                showCloseButton: true
                            })
                        } else {
                            swal(data.meta.message, "error");
                        }

                        $('#addSystemBank').closest('form').find(
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
                                        console.log(key + " " +
                                            value);
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

            // Edit System Bank

            $("#dataTable").on('click', '.update_sys_bank', function() {

                var bank_id = $(this).data('bankid');

                console.log("BankId: " + bank_id);
                $('#bankIdd').val(bank_id);
                console.log("BankIddddd: " + $('#bankIdd').val(bank_id));
                var bank_name = $(this).closest('tr').find('.bank_name').text();
                var swift = $(this).closest('tr').find('.swift')
                    .text();
                var bsb = $(this).closest('tr').find('.bsb').text();

                $('#bankName').val(bank_name);
                $('#Swift').val(swift);
                $('#Bsb').val(bsb);

                $('#sys_bank_edit_form').modal('show');

                $('#submit_bank_button').attr('data-sys-bank-id', $(this).data('bankid'));
                //console.log("BID:" + $(this).data('bankid'));
            });
            $('#editSysBank').on('submit', function(e) {
                e.preventDefault();
                var formFields = $('#editSysBank').serialize();

                $.ajax({
                    url: 'api/banks',
                    type: 'patch',
                    dataType: 'JSON',
                    data: formFields,
                    success: function(data) {
                        //alert(JSON.stringify(meta.message));
                        // console.log("ttttt");
                        if (data.error_code == 0) {
                            // console.log(data);
                            $('#sys_bank_edit_form').modal('hide');
                            $('#dataTable').DataTable().ajax.reload();
                            Swal.fire({
                                title: "" + data.meta.message,
                                icon: 'success',
                                showCloseButton: true
                            })
                        } else {
                            swal(data.meta.message, "error");
                        }

                        $('#editSysBank').closest('form').find(
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


            //Disable System Bank
            $("#dataTable").on('click', '.disable_system_bank', function() {
                //d.preventDefault();

                var BankId = $(this).data('bankid');
                console.log("BankId: " + BankId);

                Swal.fire({
                    title: "Do you want to Disable this Bank?",
                    text: "",
                    showCancelButton: true
                }).then((result) => {
                    if (result.value) {
                        // console.log("Result: " + result.value);
                        $.ajax({
                            url: '{{ url('api/banks') }}',
                            type: 'patch',
                            dataType: 'JSON',
                            data: {
                                'disabled': 1,
                                'bank_id': BankId
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

                                                alert("Error:" +
                                                    value);
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
            //Enable System Bank
            $("#dataTable").on('click', '.enable_system_bank', function() {
                var Bank_Id = $(this).data('bankid');
                console.log("BankId: " + Bank_Id);

                Swal.fire({
                    title: "Do you want to Enable this Bank?",
                    text: "",
                    showCancelButton: true
                }).then((result) => {
                    if (result.value) {
                        // console.log("Result: " + result.value);
                        $.ajax({
                            url: '{{ url('api/banks') }}',
                            type: 'patch',
                            dataType: 'JSON',
                            data: {
                                'disabled': 0,
                                'bank_id': Bank_Id
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
            });

        });
    </script>
</body>

</html>
