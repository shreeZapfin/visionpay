@extends('layouts.master')
@section('styles')
@endsection
@section('content')
                    <!-- PAGE-HEADER -->
                    <div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
                        <h1 class="page-title">Incomplete Registration</h1>
                        <div>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/index')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Incomplete Registration</li>
                            </ol>
                        </div> 
                    </div>
                    <!-- PAGE-HEADER END -->

                    <!-- CONTAINER -->
                    <div class="main-container container-fluid">
                        <!-- ROW OPEN -->
                        <div class="row row-cards">
                            <div class="tab-content mb-5">
                                <div class="tab-pane active" id="tab-11">
                                    <div class="card">
                                        <div class="e-table px-5 pb-5 pd-12">
                                            <div class="table-responsive table-lg">
                                                <table class="table border-top table-bordered mb-0 text-nowrap incomplete_registration" id="dataTable" style="width:100%;">
                                                    <thead class="border-top">
                                                        <tr>
                                                            <th class="border-bottom-0">Name</th>
                                                            <th class="border-bottom-0">Email</th>
                                                            <th class="border-bottom-0">Username</th>
                                                            <th class="border-bottom-0 ">Mobile No</th>
                                                            <th class="border-bottom-0">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>
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
                    
                    
    <!-- Add KYC Model-->
    <div class="modal fade" id="add_kyc_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Add KYC</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4">
                    <form name='addKyc' id='addKyc' enctype="multipart/form-data">
                        <div class="row gy-3">
                                <div class="col-xl-12">
                                    <label>Select Country</label>
                                    <select name="kyc_document_type" id="kyc_document_type"
                                        class="select2 form-control custom-select" required>
                                        <option value="">Select document type</option>
                                        <option value="DRIVING_LICENSE" selected="selected">DRIVING_LICENSE</option>
                                        <option value="VOTERID">VOTERID</option>
                                        <option value="PASSPORT">PASSPORT</option>
                                    </select>
                                </div>
                                <div class="col-xl-12">
                                    <label>Upload KYC document</label>
                                    <input type="file" name="kyc_document_image" class="form-control"
                                            id="kyc_document_image" required>
                                </div>
                        </div>
                        <div class="text-center px-4 py-4">
                            <button type="submit" class="btn btn-primary btn-rounded btn-fw" id='submit_button'
                                    data-user-id="" style="font-weight:500;">Add</button>
                            <button type="button" class="btn btn-light cancel_btn" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                    <div id="response_kyc"></div>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4">
                    <form name='addSelfie' id='addSelfie' enctype="multipart/form-data">
                        <div class="row gy-3">
                            <div class="col-xl-12">
                                <label>Upload Selfie</label>
                                    <input type="file" name="selfie_image" class="form-control"
                                            id="selfie_image" required>
                            </div>
                        </div>
                        <div class="px-4 py-4 text-center">
                            <button type="submit" class="btn btn-primary btn-rounded btn-fw"
                                id='selfie_submit_button' data-user-id="" style="font-weight:500;">Add</button>
                            <button type="button" class="btn btn-light cancel_btn" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                    <div id="response_selfie"></div>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4">
                    <form name='addProfile' id='addProfile' enctype="multipart/form-data">
                        <div class="row gy-3">
                                <div class="col-xl-12">
                                    <label>Upload Profile</label>
                                        <input type="file" name="profile_pic_image" class="form-control"
                                            id="profile_pic_image" required>
                                </div>
                        </div>
                        <div class="px-4 py-4 text-center">
                            <button type="submit" class="btn btn-primary btn-rounded btn-fw"
                                id='profile_submit_button' data-user-id="" style="font-weight:500;">Add</button>
                            <button type="button" class="btn btn-light cancel_btn" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                    <div id="response_profile"></div>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4">
                    <form name='addPin' id='addPin'>
                        <div class="row gy-3">
                                <div class="col-xl-12">
                                    <label>Transaction Pin</label>
                                        <input type="text" name="transaction_pin" class="form-control"
                                            id="transaction_pin" required>
                                </div>
                                <div class="col-xl-12">
                                    <label>Confirm Transaction Pin</label>
                                        <input type="text" name="transaction_pin_confirmation"
                                            class="form-control" id="transaction_pin_confirmation" required>
                                </div>
                        </div>
                        <div class="px-4 py-4 text-center">
                            <button type="submit" class="btn btn-primary btn-rounded btn-fw" id='pin_submit_button'
                                data-user-id="" style="font-weight:500;">Add</button>
                                <button type="button" class="btn btn-light cancel_btn" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                    <div id="response_tin"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script type="text/javascript">
        
        //on cancle button make input fields empty & hide error message.
        $('.cancel_btn').on('click', function () {
            $(this).closest('form').find("input[type=text],input[type=file], textarea").val("");
            $("#response_selfie, #response_profile , #response_tin, #response_kyc").hide();            
        });
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
                            return '<td class="text-center"><a title="User Details" href="{{ url('api/user') }}/' + 
                                row.id + '/edit" ><i class="bi bi-pencil-square"></i></a></td><td class="text-center btn">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button title="Add KYC" data-userid="' +
                                row.id + '" class="add_funds_entry btn btn-secondary"><i class="bi bi-upload fa-lg"></i></button></td>';
                        } else if (row.selfie_img_url == null) {
                            return '<td class="text-center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button title="Add Selfie" data-userid="' +
                                row.id +
                                '" class="add_selfie_entry btn btn-info"><i class="bi bi-image"></i></button></td>';
                        }
                        /* else if (row.profile_pic_img_url == null) {
                                                   return '<td class="text-center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button title="Add Profile Picture" data-userid="' +
                                row.id +
                                '" class="btn btn-warning add_profile_entry"><i class="bi bi-person"></i></button></td>';
                                               } */
                        else {
                            return '<td class="text-center">&nbsp;&nbsp;<button title="Set Transaction Pin Number" data-userid="' +
                                row.id +
                                '" class="add_transaction_pin" style="color: rgb(34,166,177); border: none; background: none; width="100px" ;"><i class="material-icons" style="font-size:15px;">Set Pin</i></button></td>';
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
                                $('#response_kyc').addClass(
                                    "alert alert-danger");

                                if ($.isPlainObject(value)) {
                                    $.each(value, function(key, value) {
                                        // console.log(key + " " +
                                        //     value);
                                        $('#response_kyc').show()
                                            .append(value +
                                                "<br/>");

                                    });
                                } else {
                                    $('#response_kyc').show().append(value +
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
                                $('#response_selfie').addClass(
                                    "alert alert-danger");

                                if ($.isPlainObject(value)) {
                                    $.each(value, function(key, value) {
                                        // console.log(key + " " +
                                        //     value);
                                        $('#response_selfie').show()
                                            .append(value +
                                                "<br/>");

                                    });
                                } else {
                                    $('#response_selfie').show().append(value +
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
                                $('#response_profile').addClass(
                                    "alert alert-danger");

                                if ($.isPlainObject(value)) {
                                    $.each(value, function(key, value) {
                                        // console.log(key + " " +
                                        //     value);
                                        $('#response_profile').show()
                                            .append(value +
                                                "<br/>");

                                    });
                                } else {
                                    $('#response_profile').show().append(value +
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
                                $('#response_tin').addClass(
                                    "alert alert-danger");

                                if ($.isPlainObject(value)) {
                                    $.each(value, function(key, value) {
                                        // console.log(key + " " +
                                        //     value);
                                        $('#response_tin').show()
                                            .append(value +
                                                "<br/>");

                                    });
                                } else {
                                    $('#response_tin').show().append(value +
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
