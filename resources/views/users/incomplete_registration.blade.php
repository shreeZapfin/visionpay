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

    <link href="{{ asset('https://fonts.googleapis.com/icon?family=Material+Icons') }}" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        {{-- <x- sidebar /> --}}
        @include('sidebar')
        <!-- End of Sidebar -->


        {{-- @include('datatables) --}}

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
                            <h5 class="m-0 font-weight-bold text-primary">Incomplete Registration</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered dataTable" id="dataTable" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">NAME</th>
                                            <th class="text-center">EMAIL</th>
                                            <th class="text-center">USERNAME</th>
                                            <th class="text-center">MOBILE NO</th>
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
                <div id='response'></div>
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


    <!-- Add KYC Model-->
    <div class="modal fade" id="add_kyc_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Add KYC</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span> </button>
                </div>
                <div class="modal-body">
                    <form name='addKyc' id='addKyc' enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6" style="margin:0 auto; display:block;">
                                <div class="form-group">
                                    <label>Select Country</label>
                                    <select name="kyc_document_type" id="kyc_document_type"
                                        class="select2 form-control custom-select" required>
                                        <option value="">Select document type</option>
                                        <option value="DRIVING_LICENSE" selected="selected">DRIVING_LICENSE</option>
                                        <option value="VOTERID">VOTERID</option>
                                        <option value="PASSPORT">PASSPORT</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Upload KYC document</label>
                                    <div class="input-group">
                                        <input type="file" name="kyc_document_image" class="form-control"
                                            id="kyc_document_image" required>
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


                </div>

                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

    <!-- Add Selfie Model-->
    <div class="modal fade" id="add_selfie_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Add Selfie</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span> </button>
                </div>
                <div class="modal-body">
                    <form name='addSelfie' id='addSelfie' enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6" style="margin:0 auto; display:block;">
                                <div class="form-group">
                                    <label>Upload Selfie</label>
                                    <div class="input-group">
                                        <input type="file" name="selfie_image" class="form-control"
                                            id="selfie_image" required>
                                    </div>
                                </div>
                            </div>
                            <br><br>
                        </div>
                        <div style="text-align:center">
                            <button type="submit" class="btn btn-primary btn-rounded btn-fw"
                                id='selfie_submit_button' data-user-id="" style="font-weight:500;">Add</button>
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        </div>

                    </form>


                </div>

                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

    <!-- Add Profile Picture Model-->
    <div class="modal fade" id="add_profile_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Add Profile</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span> </button>
                </div>
                <div class="modal-body">
                    <form name='addProfile' id='addProfile' enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6" style="margin:0 auto; display:block;">
                                <div class="form-group">
                                    <label>Upload Profile</label>
                                    <div class="input-group">
                                        <input type="file" name="profile_pic_image" class="form-control"
                                            id="profile_pic_image" required>
                                    </div>
                                </div>
                            </div>
                            <br><br>
                        </div>
                        <div style="text-align:center">
                            <button type="submit" class="btn btn-primary btn-rounded btn-fw"
                                id='profile_submit_button' data-user-id="" style="font-weight:500;">Add</button>
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        </div>

                    </form>


                </div>

                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

    {{-- Transaction Pin Model --}}
    <div class="modal fade" id="add_pin_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Add Transaction Pin</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span> </button>
                </div>
                <div class="modal-body">
                    <form name='addPin' id='addPin'>
                        <div class="row">
                            <div class="col-md-6" style="margin:0 auto; display:block;">
                                <div class="form-group">
                                    <label>Transaction Pin</label>
                                    <div class="input-group">
                                        <input type="text" name="transaction_pin" class="form-control"
                                            id="transaction_pin" required>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Confirm Transaction Pin</label>
                                    <div class="input-group">
                                        <input type="text" name="transaction_pin_confirmation"
                                            class="form-control" id="transaction_pin_confirmation" required>

                                    </div>
                                </div>
                            </div>
                            <br><br>
                        </div>
                        <div style="text-align:center">
                            <button type="submit" class="btn btn-primary btn-rounded btn-fw" id='pin_submit_button'
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



    <script src="{{ asset('vendor/datatables/jquery.dataTables.js') }}"></script>


    <script type="text/javascript">
        $(document).ready(function() {
            $(".navbar-nav li").removeClass("active"); //this will remove the active class from
            //previously active menu item
            //$('#home').addClass('active');
            //for demo
            $('#user').addClass('active');
            //for sale
            //$('#merchant').addClass('active');

            $('#dataTable').DataTable({
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                "processing": true,
                "serverSide": true,
                "searching": true,
                "ajax": {
                    url: '{{ url('api/user/search') }}',
                    data: function(d) {

                        d.user_type_id = 2,
                            d.search = d.search['value'],
                            d.request_origin = 'web',
                            d.registration_status = 0
                    }
                },
                columnDefs: [{
                    targets: 4,
                    "searchable": false,
                    "orderable": false,
                    render: function(data, type, row, meta) {
                        if (row.kyc_document_url == null) {
                            return '<td class="text-center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a title="User Details" href="{{ url('api/user') }}/' +
                                    row.id +
                                    '/edit" style="color: rgb(30, 50, 250);"><i class="fas fa-fw fa-user"></i></a>&nbsp;&nbsp;<button title="Add KYC" data-userid="' +
                                row.id +
                                '" class="add_funds_entry" style="color: rgb(0,128,0); border: none; background: none; width="100px";"><i class="fa fa-file-upload fa-lg"></i></button></td>';


                        } else if (row.selfie_img_url == null) {
                            return '<td class="text-center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a title="User Details" href="{{ url('api/user') }}/' +
                                    row.id +
                                    '/edit" style="color: rgb(30, 50, 250);"><i class="fas fa-fw fa-user"></i></a>&nbsp;&nbsp;<button title="Add Selfie" data-userid="' +
                                row.id +
                                '" class="add_selfie_entry" style="color: rgb(0,255,128); border: none; background: none; width="100px";"><i class="fa fa-portrait fa-lg"></i></button></td>';


                        }
                        /* else if (row.profile_pic_img_url == null) {
                                                   return '<td class="text-center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button title="Add Profile Picture" data-userid="' +
                                                       row.id +
                                                       '" class="add_profile_entry" style="color: rgb(115, 106, 255); border: none; background: none; width="100px";"><i class="fa fa-portrait fa-lg"></i></button></td>';


                                               } */
                        else {
                            return '<td class="text-center">&nbsp;&nbsp;<button title="Set Transaction Pin Number" data-userid="' +
                                row.id +
                                '" class="add_transaction_pin" style="color: rgb(0,255,128); border: none; background: none; width="100px";"><i class="material-icons" style="font-size:26px;">Set Pin</i></button></td>';
                        }
                    }

                }],
                "columns": [{
                        data: 'full_name'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'username'
                    },
                    {
                        data: 'mobile_no'
                    }
                ]

            });

            //Get User ID
            $("#dataTable").on('click', '.add_funds_entry', function() {

                $('#add_kyc_form').modal('show');


                $('#submit_button').attr('data-user-id', $(this).data('userid'));

            });
            //Add KYC
            $('#addKyc').on('submit', function(e) {
                e.preventDefault();

                var formFields = new FormData(this);
                var send_to = $('#submit_button').data('user-id');
                //console.log("send_to Id: " + send_to);

                $.ajax({
                    url: 'api/user/kyc-document/' + send_to,
                    type: 'post',
                    dataType: 'JSON',
                    data: formFields,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        //alert(JSON.stringify(meta.message));
                        //console.log("ttttt");
                        if (data.error_code == 0) {
                            //console.log(data);
                            $('#add_kyc_form').modal('hide');
                            $('#dataTable').DataTable().ajax.reload();
                            Swal.fire({
                                title: "" + data.meta.message,
                                icon: 'success',
                                showCloseButton: true
                            })
                        } else {
                            swal(data.meta.message, "error");
                        }

                        $('#addKyc').closest('form').find(
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


            //Add Selfie
            $("#dataTable").on('click', '.add_selfie_entry', function() {

                $('#add_selfie_form').modal('show');


                $('#selfie_submit_button').attr('data-user-id', $(this).data('userid'));

            });
            $('#addSelfie').on('submit', function(e) {
                e.preventDefault();

                var formFields = new FormData(this);
                var send_to = $('#selfie_submit_button').data('user-id');
                // console.log("send_to Id: " + send_to);

                $.ajax({
                    url: 'api/user/selfie-image/' + send_to,
                    type: 'post',
                    dataType: 'JSON',
                    data: formFields,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        //alert(JSON.stringify(meta.message));
                        // console.log("ttttt");
                        if (data.error_code == 0) {
                            //console.log(data);
                            $('#add_selfie_form').modal('hide');
                            $('#dataTable').DataTable().ajax.reload();
                            Swal.fire({
                                title: "" + data.meta.message,
                                icon: 'success',
                                showCloseButton: true
                            })
                        } else {
                            swal(data.meta.message, "error");
                        }

                        $('#addSelfie').closest('form').find(
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

            //Add Profile Picture
            $("#dataTable").on('click', '.add_profile_entry', function() {

                $('#add_profile_form').modal('show');


                $('#profile_submit_button').attr('data-user-id', $(this).data('userid'));

            });
            $('#addProfile').on('submit', function(e) {
                e.preventDefault();

                var formFields = new FormData(this);
                var send_to = $('#profile_submit_button').data('user-id');
                //  console.log("send_to Id: " + send_to);

                $.ajax({
                    url: 'api/user/profile-pic/' + send_to,
                    type: 'post',
                    dataType: 'JSON',
                    data: formFields,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        //alert(JSON.stringify(meta.message));
                        //console.log("ttttt");
                        if (data.error_code == 0) {
                            //console.log(data);
                            $('#add_profile_form').modal('hide');
                            $('#dataTable').DataTable().ajax.reload();
                            Swal.fire({
                                title: "" + data.meta.message,
                                icon: 'success',
                                showCloseButton: true
                            })
                        } else {
                            swal(data.meta.message, "error");
                        }

                        $('#addProfile').closest('form').find(
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

            //Transaction Pin
            $("#dataTable").on('click', '.add_transaction_pin', function() {

                $('#add_pin_form').modal('show');


                $('#pin_submit_button').attr('data-user-id', $(this).data('userid'));

            });
            $('#addPin').on('submit', function(e) {
                // console.log("gvgvggv");
                e.preventDefault();

                var formFields = $('#addPin').serialize();
                // console.log(formFields);
                var send_to = $('#pin_submit_button').data('user-id');
                // console.log("send_to Id: " + send_to);

                $.ajax({
                    url: 'api/user/' + send_to,
                    type: 'patch',
                    dataType: 'JSON',
                    data: formFields,
                    success: function(data) {
                        //alert(JSON.stringify(meta.message));
                        //console.log("ttttt");
                        if (data.error_code == 0) {
                            //console.log(data);
                            $('#add_pin_form').modal('hide');
                            $('#dataTable').DataTable().ajax.reload();
                            Swal.fire({
                                title: "" + data.meta.message,
                                icon: 'success',
                                showCloseButton: true
                            })
                        } else {
                            swal(data.meta.message, "error");
                        }

                        $('#addPin').closest('form').find(
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
