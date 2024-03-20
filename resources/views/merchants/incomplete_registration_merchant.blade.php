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
                            <div class="col-xl-12">
                                <div class="card p-0">
                                    <div class="card-body p-4">
                                        <div class="row align-items-center">
                                            <div class="e-table px-5 pb-5">
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
                                    <!-- COL-END -->
                                </div>
                            </div>
                        </div>
                        <!-- ROW CLOSED -->
                    </div>
                    <!-- CONTAINER CLOSED -->
                    
@endsection

    <!-- Add KYC Model-->
    <div class="modal fade" id="add_kyc_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Add KYC</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
                            <button type="button" class="btn btn-light cancel_btn" data-bs-dismiss="modal" id="cancel_btn">Cancel</button>
                        </div>
                    </form>
                    <div id='response1'></div>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form name='addSelfie' id='addSelfie' enctype="multipart/form-data">
                        <div class="row gy-3">
                                <div class="col-xl-12">
                                    <label>Upload Selfie</label>
                                    <input type="file" name="selfie_image" class="form-control"
                                            id="selfie_image" required>
                                </div>
                        </div>
                        <div class="text-center px-4 py-4">
                            <button type="submit" class="btn btn-primary btn-rounded btn-fw"
                                id='selfie_submit_button' data-user-id="" style="font-weight:500;">Add</button>
                            <button type="button" class="btn btn-light cancel_btn" data-bs-dismiss="modal" id="cancel_btn">Cancel</button>
                        </div>
                    </form>
                    <div id='response2'></div>
                </div>
            </div>
        </div>
    </div>

    <!--Add Company Tin Image -->
    <div class="modal fade" id="add_company_tin_form" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Add Company Tin Image</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form name='addCompanyTin' id='addCompanyTin' enctype="multipart/form-data">
                        <div class="row gy-3">
                                <div class="col-xl-12">
                                    <label>Upload Company Tin</label>
                                    <input type="file" name="company_tin_image" class="form-control"
                                            id="company_tin_image" required>
                                </div>
                        </div>
                        <div class="text-center px-4 py-4">
                            <button type="submit" class="btn btn-primary btn-rounded btn-fw"
                                id='company_tin_submit_button' data-user-id="" style="font-weight:500;">Add</button>
                            <button type="button" class="btn btn-light cancel_btn" data-bs-dismiss="modal" id="cancel_btn">Cancel</button>
                        </div>
                    </form>
                    <div id='response3'></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Company Reg Image-->
    <div class="modal fade" id="add_company_reg_form" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Add Company Reg Image</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form name='addCompanyReg' id='addCompanyReg' enctype="multipart/form-data">
                        <div class="row gy-3">
                                <div class="col-xl-12">
                                    <label>Upload Company Reg Image</label>
                                    <input type="file" name="company_reg_image" class="form-control"
                                            id="company_reg_image" required>
                                </div>
                        </div>
                        <div class="px-4 py-4 text-center">
                            <button type="submit" class="btn btn-primary btn-rounded btn-fw"
                                id='company_reg_submit_button' data-user-id="" style="font-weight:500;">Add</button>
                            <button type="button" class="btn btn-light cancel_btn" data-bs-dismiss="modal" id="cancel_btn">Cancel</button>
                        </div>
                    </form>
                    <div id='response4'></div>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
                            <button type="button" class="btn btn-light cancel_btn" data-bs-dismiss="modal" id="cancel_btn">Cancel</button>
                        </div>
                    </form>
                    <div id='response5'></div>
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
                    <h4 class="modal-title" id="exampleModalLabel">Add Selfie</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form name='addPin' id='addPin'>
                        <div class="row gy-3">
                                <div class="col-xl-12">
                                    <label>Transaction Pin</label>
                                        <input type="text" name="transaction_pin" class="form-control"
                                            id="transaction_pin" autocomplete="one-time-code" required inputmode="numeric" maxlength="4" pattern="\d{4}">
                                </div>
                                <div class="col-xl-12">
                                    <label>Confirm Transaction Pin</label>
                                    <input type="text" name="transaction_pin_confirmation"
                                            class="form-control" id="transaction_pin_confirmation" 
                                            autocomplete="one-time-code" required inputmode="numeric" maxlength="4" pattern="\d{4}">
                                </div>
                        </div>
                        <div class="px-4 py-4 text-center">
                            <button type="submit" class="btn btn-primary btn-rounded btn-fw" id='pin_submit_button'
                                data-user-id="" style="font-weight:500;">Add</button>
                            <button type="button" class="btn btn-light cancel_btn" data-bs-dismiss="modal" id="cancel_btn">Cancel</button>
                        </div>
                    </form>
                    <div id='response6'></div>
                </div>
            </div>
        </div>
    </div>

@section('scripts')

<script type="text/javascript">
    
    //on cancle button make input fields empty & hide error message.
    $('.cancel_btn').on('click', function () {
        $(this).closest('form').find("input[type=text],input[type=file], textarea").val("");
        $("#response1,#response2,#response3,#response4,#response5,#response6").hide();
        
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

                        d.user_type_id = 4,
                            d.search = d.search['value'],
                            d.request_origin = 'web',
                            d.registration_status = 0
                    }
                },
                columnDefs: [{
                    targets: 4,
                    render: function(data, type, row, meta) {
                        if (row.kyc_document_url == null) {
                            return '<td class="text-center btn"><button title="Add KYC" data-userid="' +row.id +'" class="add_funds_entry btn btn-secondary"><i class="bi bi-upload"></i></button></td>';
                        } else if (row.selfie_img_url == null) {
                            return '<td class="text-center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button title="Add Selfie" data-userid="' +
                                row.id +
                                '" class="add_selfie_entry btn btn-info"><i class="bi bi-image"></i></button></td>';
                        } else if (row.business.company_tin_img_url == null) {
                            return '<td class="text-center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button title="Add Company Tin Image" data-userid="' +
                                row.id +
                                '" class="add_company_tin_entry btn btn-warning" ><i class="bi bi-image-fill"></i></button></td>';
                        } else if (row.business.company_reg_img_url == null) {
                            return '<td class="text-center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button title="Add Company Reg Image" data-userid="' +
                                row.id +
                                '" class="add_company_reg_entry btn btn-default"><i class="bi bi-image-fill"></i></button></td>';
                        }
                        /* else if (row.profile_pic_img_url == null) {
                                                   return '<td class="text-center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button title="Add Profile Picture" data-userid="' +
                                                       row.id +
                                                       '" class="add_profile_entry" style="color: rgb(115, 106, 255); border: none; background: none; width="100px";"><i class="fa fa-portrait fa-lg"></i></button></td>';


                                               }  */
                        else {
                            return '<td class="text-center">&nbsp;&nbsp;<button title="Set Transaction Pin Number" data-userid="' +
                                row.id +
                                '" class="add_transaction_pin" style="color: rgb(0,255,128); border: none; background: none; width="100px";"><i class="material-icons" style="font-size:15px;">Set Pin</i></button></td>';
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
                    },
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
                console.log("send_to Id: " + send_to);

                $.ajax({
                    url: 'api/user/kyc-document/' + send_to,
                    type: 'post',
                    dataType: 'JSON',
                    data: formFields,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        //alert(JSON.stringify(meta.message));
                        console.log("ttttt");
                        if (data.error_code == 0) {
                            console.log(data);
                            $('#add_kyc_form').modal('hide');
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

                        $('#addKyc').closest('form').find(
                            "input[type=text], textarea").val(
                            "");

                    },
                    error: function(data) {

                        if (data.status === 422) {
                            var errors = $.parseJSON(data.responseText);
                            $.each(errors, function(key, value) {
                                // console.log(key+ " " +value);
                                $('#response1').addClass(
                                    "alert alert-danger");

                                if ($.isPlainObject(value)) {
                                    $.each(value, function(key, value) {
                                        console.log(key + " " +
                                            value);
                                        $('#response1').show()
                                            .append(value +
                                                "<br/>");

                                    });
                                } else {
                                    $('#response1').show().append(value +
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
                console.log("send_to Id: " + send_to);

                $.ajax({
                    url: 'api/user/selfie-image/' + send_to,
                    type: 'post',
                    dataType: 'JSON',
                    data: formFields,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        //alert(JSON.stringify(meta.message));
                        console.log("ttttt");
                        if (data.error_code == 0) {
                            console.log(data);
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
                                $('#response2').addClass(
                                    "alert alert-danger");

                                if ($.isPlainObject(value)) {
                                    $.each(value, function(key, value) {
                                        console.log(key + " " +
                                            value);
                                        $('#response2').show()
                                            .append(value +
                                                "<br/>");

                                    });
                                } else {
                                    $('#response2').show().append(value +
                                        "<br/>"
                                    ); //this is my div with messages
                                }
                            });
                        }

                    }



                });
            });

            //Add Company Tin
            $("#dataTable").on('click', '.add_company_tin_entry', function() {

                $('#add_company_tin_form').modal('show');


                $('#company_tin_submit_button').attr('data-user-id', $(this).data('userid'));

            });
            $('#addCompanyTin').on('submit', function(e) {
                e.preventDefault();

                var formFields = new FormData(this);
                var send_to = $('#company_tin_submit_button').data('user-id');
                console.log("send_to Id: " + send_to);

                $.ajax({
                    url: 'api/user/business/company-tin-image/' + send_to,
                    type: 'post',
                    dataType: 'JSON',
                    data: formFields,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        //alert(JSON.stringify(meta.message));
                        console.log("ttttt");
                        if (data.error_code == 0) {
                            console.log(data);
                            $('#add_company_tin_form').modal('hide');
                            $('#dataTable').DataTable().ajax.reload();
                            Swal.fire({
                                title: "" + data.meta.message,
                                icon: 'success',
                                showCloseButton: true
                            })
                        } else {
                            swal(data.meta.message, "error");
                        }

                        $('#addCompanyTin').closest('form').find(
                            "input[type=text], textarea").val(
                            "");

                    },
                    error: function(data) {

                        if (data.status === 422) {
                            var errors = $.parseJSON(data.responseText);
                            $.each(errors, function(key, value) {
                                // console.log(key+ " " +value);
                                $('#response3').addClass(
                                    "alert alert-danger");

                                if ($.isPlainObject(value)) {
                                    $.each(value, function(key, value) {
                                        console.log(key + " " +
                                            value);
                                        $('#response3').show()
                                            .append(value +
                                                "<br/>");

                                    });
                                } else {
                                    $('#response3').show().append(value +
                                        "<br/>"
                                    ); //this is my div with messages
                                }
                            });
                        }

                    }



                });
            });

            //Add Company Reg Image
            $("#dataTable").on('click', '.add_company_reg_entry', function() {

                $('#add_company_reg_form').modal('show');


                $('#company_reg_submit_button').attr('data-user-id', $(this).data('userid'));

            });
            $('#addCompanyReg').on('submit', function(e) {
                e.preventDefault();

                var formFields = new FormData(this);
                var send_to = $('#company_reg_submit_button').data('user-id');
                console.log("send_to Id: " + send_to);

                $.ajax({
                    url: 'api/user/business/company-reg-image/' + send_to,
                    type: 'post',
                    dataType: 'JSON',
                    data: formFields,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        //alert(JSON.stringify(meta.message));
                        console.log("ttttt");
                        if (data.error_code == 0) {
                            console.log(data);
                            $('#add_company_reg_form').modal('hide');
                            $('#dataTable').DataTable().ajax.reload();
                            Swal.fire({
                                title: "" + data.meta.message,
                                icon: 'success',
                                showCloseButton: true
                            })
                        } else {
                            swal(data.meta.message, "error");
                        }

                        $('#addCompanyReg').closest('form').find(
                            "input[type=text], textarea").val(
                            "");

                    },
                    error: function(data) {

                        if (data.status === 422) {
                            var errors = $.parseJSON(data.responseText);
                            $.each(errors, function(key, value) {
                                // console.log(key+ " " +value);
                                $('#response4').addClass(
                                    "alert alert-danger");

                                if ($.isPlainObject(value)) {
                                    $.each(value, function(key, value) {
                                        console.log(key + " " +
                                            value);
                                        $('#response4').show()
                                            .append(value +
                                                "<br/>");

                                    });
                                } else {
                                    $('#response4').show().append(value +
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
                console.log("send_to Id: " + send_to);

                $.ajax({
                    url: 'api/user/profile-pic/' + send_to,
                    type: 'post',
                    dataType: 'JSON',
                    data: formFields,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        //alert(JSON.stringify(meta.message));
                        console.log("ttttt");
                        if (data.error_code == 0) {
                            console.log(data);
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
                                $('#response5').addClass(
                                    "alert alert-danger");

                                if ($.isPlainObject(value)) {
                                    $.each(value, function(key, value) {
                                        console.log(key + " " +
                                            value);
                                        $('#response5').show()
                                            .append(value +
                                                "<br/>");

                                    });
                                } else {
                                    $('#response5').show().append(value +
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
                console.log("gvgvggv");
                e.preventDefault();

                var formFields = $('#addPin').serialize();
                console.log(formFields);
                var send_to = $('#pin_submit_button').data('user-id');
                console.log("send_to Id: " + send_to);

                $.ajax({
                    url: 'api/user/' + send_to,
                    type: 'patch',
                    dataType: 'JSON',
                    data: formFields,
                    success: function(data) {
                        //alert(JSON.stringify(meta.message));
                        console.log("ttttt");
                        if (data.error_code == 0) {
                            console.log(data);
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
                                $('#response6').addClass(
                                    "alert alert-danger");

                                if ($.isPlainObject(value)) {
                                    $.each(value, function(key, value) {
                                        console.log(key + " " +
                                            value);
                                        $('#response6').show()
                                            .append(value +
                                                "<br/>");

                                    });
                                } else {
                                    $('#response6').show().append(value +
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
