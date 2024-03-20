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
                        <h1 class="page-title">Ticket List</h1>
                        <div>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/index')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Ticket List</li>
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
                                                            <label>Transaction Id</label>
                                                            <input type="text" name="transaction_id" id="transaction_id" class="form-control"
                                                            placeholder="Filter by Transaction Id" />
                                                        </div> &nbsp;&nbsp;
                                                        <div class="form-group col-sm">
                                                            <label>Ticket Status</label>
                                                            <select name="complaint_status" id="complaint_status"
                                                                class="select2 form-control custom-select">
                                                                <option value="" selected="selected">Select Ticket Status</option>
                                                                <option value="PENDING">Pending</option>
                                                                <option value="RESOLVED">Resolved</option>
                                                            </select>
                                                        </div> &nbsp;&nbsp;
                                                        <div class="input-group col-sm pb-3">
                                                        <button type="button" name="filter" id="filter" class="btn border"
                                                            style="text-align: center; margin-top:30px; height : 35px; width: 80px;border-top-right-radius: 0.3rem;border-bottom-right-radius: 0.3rem; ">
                                                            <i class="bi bi-search text-muted"></i></button>
                                                        </div>
                                                        <button type="button" class="btn-fill btn btn-secondary float-end"  id='btn_raise_ticket'
                                                        style="text-align: center; margin-top:30px; height : 35px; border-radius:0.3rem;
                                                        background:	#006400; color: rgb(255,255,255);">Raise Ticket</button>
                                                    </div>
                                                </form>
                                            <div class="e-table px-5 pb-5 pd-12">
                                                <div class="table-responsive table-lg">
                                                    <table class="table border-top table-bordered mb-0 text-nowrap complaintdtable" id="dataTable" style="width:100%;">
                                                        <thead class="border-top">
                                                            <tr>
                                                                <th class="border-bottom-0">Created<br>At</th>
                                                                <th class="border-bottom-0">Transaction Type</th>
                                                                <th class="border-bottom-0 ">Transaction Id</th>
                                                                <!-- <th class="border-bottom-0 ">Complaint Type Id</th> -->
                                                                <th class="border-bottom-0 ">User Ticket<br>Description</th>
                                                                <th class="border-bottom-0 ">Admin Resolution<br>Description</th>
                                                                <th class="border-bottom-0 ">Status</th>
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
   
    <!-- Raise complaint-->
    <div class="modal fade" id="raise_complaint_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Raise Complaint</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body px-4">
                    <form name='raiseComplaint' id='raiseComplaint'>
                        <div class="row gy-3">
                                <div class="col-xl-12">
                                    <label>Complaint Type</label>
                                    <select name="complaint_type_id" id="complaint_type_id"
                                        class="select2 form-control custom-select" required>

                                    </select>
                                </div>
                                <div class="col-xl-12">
                                    <label>Transaction Id</label>
                                        <input type="text" name="transaction_id" class="form-control"
                                            id="transaction_id" required>
                                </div>
                                <div class="col-xl-12">
                                    <label>User Complaint Description</label>
                                        <input type="text" name="user_complaint_description" class="form-control"
                                            id="user_complaint_description" required>
                                </div>
                            </div>
                        <div id='response'></div>
                        <div class="text-center px-4 py-4">
                            <button type="submit" class="btn btn-primary btn-rounded btn-fw" id='submit_button'
                                data-user-id="" style="font-weight:500;">Add</button>
                            <button type="button" class="btn btn-light cancel_btn" data-bs-dismiss="modal" id="cancel_btn">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Message List Modal-->
    <div class="modal right fade" id="message_list_form" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="chat-popup" id="myForm">
                    <div class="main-chat-header modal-header pt-3 d-flex d-sm-flex justify-content-between">
                        <div class="main-img-user online"></div>
                            <div class="main-chat-msg-name mt-2 ms-2 flex-fill">
                                <h6 id="userName"></h6>
                                <!-- <small class="me-3">Last Seen 2 Hours ago</small> -->
                            </div>
                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                    </div>
                    <div id="messageList" class="main-chat-body flex-2 mt-2">
                    </div>
                    <form name='sendMessage' id='sendMessage' class="form-container">
                        <div class="main-chat-footer">
                            <!-- <div class="type_msg">
                                <div class="input_msg_write"> -->
                                    <!-- <input type="text" class="write_msg" placeholder="Type a message"
                                        name="message"> -->
                                        <input class="form-control" placeholder="text here..." type="text" name="message">
                                        <button type="submit" class="btn btn-icon  btn-primary brround" id='submit_button'  data-message-id="" ><i class="fa fa-paper-plane-o"></i></button>
                                        <!-- <button type="submit" class="btn btn-primary btn-rounded btn-fw msg_send_btn"
                                        id='submit_button' data-message-id="" style="font-weight:500;"><i
                                            class="fa fa-paper-plane" aria-hidden="true"></i></button> -->
                                <!-- </div>
                            </div> -->
                        </div>
                    </form>
                </div>

                    <div class="chat_user_details" id="chat_user_details">
                                        
                    </div>
                    <div class="modal-header close_btn_header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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

            fetch_data();

            function fetch_data(transaction_id, complaint_status) {
                $('#dataTable').DataTable().clear().destroy();
                //Display complaint List 
                $('#dataTable').DataTable({
                    "lengthMenu": [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ],
                    "processing": true,
                    "serverSide": true,
                    "searching": false,
                    "ajax": {
                        url: '{{ url('api/complaint') }}',
                        data: function(d) {
                            d.search = d.search['value'],
                                d.request_origin = 'web',
                                d.transaction_id = transaction_id,
                                d.complaint_status = complaint_status
                        }

                    },
                    columnDefs: [{
                        targets: 6,
                        render: function(data, type, row, meta) {
                            // console.log('data');
                            // href="{{ url('api/user') }}/' + row.id + '/edit"
                            // $(".userprofiledetails").append('<a href="{{ url('api/user') }}/' + row.user_id + '/edit">View all</a>');
                            // $(".userprofiledetails").append('<a href="{{ url('api/user') }}/' + row.user_id + '/edit">View all</a>');
                            return '<td class="text-center"><div class="d-flex"><button data-complaintid="' +
                                row.id +
                                '" class="complaint_id_entry btn btn-info btn-rounded btn-fw" title="Resolve" style="color: "#FFFFFF";">Resolve</button><button style="background-color: transparent; border: none;" title="Chat Now" data-userid="'+row.user_id+'" data-messageid="' +
                                row.id +
                                '" class="message_list"><i class="bi bi-chat-dots-fill" style="color: #23c84e; font-size:24px;"></i></button></div></td>';
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
                            data: 'complaint_type.transaction_type'
                        },
                        {
                            data: 'transaction_id'
                        },
                        // {
                        //     data: 'complaint_type_id'
                        // },
                        {
                            data: 'user_complaint_description'
                        },
                        {
                            data: 'admin_resolution_description'
                        },
                        {
                            data: 'complaint_status'
                        }
                    ]

                });

            }

            //Filter Button
            $('#filter').click(function() {
                // var from_date = $('#from_date').val();
                // var to_date = $('#to_date').val();
                var transaction_id = $('#transaction_id').val();
                var complaint_status = $('#complaint_status').val();

                // console.log("from_date " + from_date);
                // console.log("to_date " + to_date);
                // console.log("transaction_id " + transaction_id);

                fetch_data(transaction_id, complaint_status);
            });


            //Raise Complaint
            $("#btn_raise_ticket").on('click', function() {

                //Complaint Type List
                $.ajax({
                    url: 'api/admin/complaint-type',
                    type: 'get',
                    success: function(data) {
                        /*  console.log(data); */
                        $('#complaint_type_id').empty();
                        $.each(data.data.data, function($index, $value) {

                            $('#complaint_type_id').append('<option value="' + $value
                                .id +
                                '" >' +
                                $value
                                .type_description + '</option>');
                        })
                    }
                });
                $('#raise_complaint_form').modal('show');

            });
            $('#raiseComplaint').on('submit', function(e) {
                e.preventDefault();
                spinner.show();
                var formFields = $('#raiseComplaint').serialize();

                $.ajax({
                    url: 'api/complaint',
                    type: 'post',
                    dataType: 'JSON',
                    data: formFields,
                    success: function(data) {
                        //alert(JSON.stringify(meta.message));
                        // console.log("ttttt");
                        if (data.error_code == 0) {
                            //console.log(data);
                            spinner.hide();
                            $('#raise_complaint_form').modal('hide');
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

                        $('#raiseComplaint').closest('form').find(
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


            //Resolve Complaint
            $("#dataTable").on('click', '.complaint_id_entry', function() {

                var ComplaintId = $(this).data('complaintid');
                // console.log(ComplaintId);

                Swal.fire({
                    title: "Enter Description",
                    text: "",
                    input: 'text',
                    showCancelButton: true
                }).then((result) => {
                    if (result.value) {
                        //console.log("Result: " + result.value);
                        $.ajax({
                            url: 'api/complaint/' + ComplaintId + '/resolve',
                            type: 'patch',
                            dataType: 'JSON',
                            data: {
                                resolution_description: result.value
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

            function openForm() {
                document.getElementById("myForm").style.display = "block";
            }

            //Sens Message
            var msgTimer;
            $("#dataTable").on('click', '.message_list', function() {
                $('#messageList').empty();
                $('#chat_user_details').empty();
                $('#userName').empty();
                $(".online").empty();
                $("#mobVal").empty();
                $("#emailVal").empty();


                var MessageId = $(this).data('messageid');
                var userid = $(this).data('userid');

                loadProfileBox(userid);

                reloadChatBox(MessageId);
                var interval = 5000;
                msgTimer = setInterval(function() {
                    //var MessageId = $(this).data('messageid');
                    $('#messageList').empty();
                    reloadChatBox(MessageId);
                }, interval);

                $('#message_list_form').modal('show');
                $('#submit_button').attr('data-message-id', $(this).data('messageid'));
            });

            $("#message_list_form").on("hide.bs.modal", function() {
                clearInterval(msgTimer);
            });

            // loadProfileBox
            function loadProfileBox(userid) {
                $.ajax({
                    url: '{{ url('getUser') }}/' + userid ,
                    type: 'get',
                    success: function(data) {
                        var name;
                        if (data.user_type_id == 2 || data.user_type_id == 5) {
                            name = data.full_name;
                        } else if (data.user_type_id == 3 || data.user_type_id == 4) {
                            name = data.business.business_name;
                        } 
                        $(".online").append('<img alt="avatar" src="'+ data.profile_pic_img_url+'"><span class="avatar-status bg-primary"></span>');
                        var userName = document.getElementById("userName");
                        userName.textContent += name;
                         $("#chat_user_details").append('<div class="card-body p-0">'+
                                            '<div class="">'+
                                            '<div class="text-center chat-image border-bottom p-4 pb-0 mb-4 br-5">'+
                                            '<img src="'+ data.profile_pic_img_url+'" width="150" alt="img" id="profileImage" class="mb-2">'+
                                            '<div class="main-chat-msg-name">'+
                                            '<h5 class="mb-0 text-dark fw-semibold">'+name+'</h5>'+
                                            '<p class="text-muted fs-13">'+data.username+'</p>'+
                                            '</div>'+
                                            '</div>'+
                                            '<div class="border-bottom">'+
                                            '<div class="d-flex mb-2">'+
                                            '<div><a class="nav-link border rounded-pill avatar avatar-sm bg-light me-2"><i class="fe fe-mail"></i></a>'+
                                            '</div>'+
                                            '<div class="ms-2">'+
                                            '<p class="fs-13 fw-600 mb-0">Email</p>'+
                                            '<p class="fs-12 text-muted"><input id="emailVal" value="'+data.email+'" hidden/>'+data.email+'<button title="Copy" class="nav-link border rounded-pill avatar avatar-sm bg-light me-2 ms-2" onclick="copyEmail();"><i class="fe fe-clipboard"></i></button></p>'+
                                            '</div>'+
                                            '</div>'+
                                            '<div class="d-flex mb-2 mt-2">'+
                                            '<div>'+
                                            '<a class="nav-link border rounded-pill avatar avatar-sm bg-light me-2"><i class="fe fe-phone"></i></a>'+
                                            ' </div>'+
                                            ' <div class="ms-2">'+
                                            ' <p class="fs-13 fw-600 mb-0">Phone</p>'+
                                            ' <p class="fs-12 text-muted">'+data.mobile_no+'<button title="Copy" class="nav-link border rounded-pill avatar avatar-sm bg-light me-2 ms-2" onclick="copyPhone();"><i class="fe fe-clipboard"></i></button></p>'+
                                            ' </div>'+
                                            '</div><input id="mobVal" value="'+data.mobile_no+'" hidden/>'+
                                            '<div class="d-flex mb-2 mt-2">'+
                                             ' <div>'+
                                             '<a class="nav-link border rounded-pill avatar avatar-sm bg-light me-2"><i class="fe fe-map-pin"></i></a>'+
                                                         '</div>'+
                                                        ' <div class="ms-2">'+
                                                        '<p class="fs-13 fw-600 mb-0">Address</p>'+
                                                            '<p class="fs-12 text-muted">'+data.address+'</p>'+
                                                            '</div>'+
                                                        '</div>'+
                                                    '</div>'+
                                                '  <div class="border-bottom">'+
                                                '  <div class="fs-15 fw-600 mt-3 mb-2">Shared Files :'+
                                                    '<span class="float-end fs-12 userprofiledetails">'+
                                                        ' <a href="{{ url('api/user') }}/'+data.id+'/edit" class="text-underline"><u>View All</u></a>'+
                                                            ' </span>'+
                                                        '</div>'+
                                                    '</div>'+
                                                '</div></div>');
                    }
                });
               
            }
            
            function reloadChatBox(MessageId) {
                $.ajax({
                    url: '{{ url('api/complaint') }}/' + MessageId + '/message',
                    type: 'get',
                    async: false,
                    success: function(data) {
                        //console.log('data');

                        $.each(data.data.data, function($index, $value) {
                                if ($value.message_type == 'SENT') {
                                $("#messageList").append(
                                    '<div class="media flex-row-reverse chat-right">'+
                                        // '<div class="main-img-user online"><img alt="avatar" src="http://localhost/Vexel/Vexel/build/assets/images/users/21.jpg"><span class="avatar-status bg-primary"></span></div>'+
                                            '<div class="media-body">'+
                                                '<div class="main-msg-wrapper">'+
                                                    $value.message +
                                                '</div>'+
                                            '<div>'+
                                            '<span>'+ moment.utc($value.created_at).local().format('DD/MM/YYYY HH:mm a')+'</span> '+
                                            '</div>'+
                                        '</div>'+
                                    '</div>');
                            } else {
                                $("#messageList").append(
                                    '<div class="media chat-left">'+
                                        // '<div class="main-img-user online"><img alt="avatar" src="http://localhost/Vexel/Vexel/build/assets/images/users/21.jpg"><span class="avatar-status bg-primary"></span></div>'+
                                            '<div class="media-body">'+
                                                '<div class="main-msg-wrapper">'+
                                                    $value.message +
                                                '</div>'+
                                            '<div class="datewrap">'+
                                            '<span>'+ moment.utc($value.created_at).local().format('DD/MM/YYYY HH:mm a')+'</span>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>');
                            }
                        })

                    }
                });
            }
            var spinner = $('#loader');
            $('#sendMessage').on('submit', function load(e) {
                e.preventDefault();
                spinner.show();
                var formFields = $('#sendMessage').serialize();
                //console.log("formFields: " + formFields);
                var MessageId = $('#submit_button').data('message-id');
                //console.log("Message Id: " + MessageId);

                $.ajax({
                    url: 'api/complaint/' + MessageId + '/message',
                    type: 'patch',
                    dataType: 'JSON',
                    data: formFields,
                    success: function(data) {
                        //alert(JSON.stringify(meta.message));
                        // console.log("ttttt");

                        if (data.error_code == 0) {
                            //  $("#message_list_form")[0].reset();
                            // setInterval(e, interval);
                            spinner.hide();
                        } else {
                            swal(data.meta.message, "error");
                        }

                        $('#sendMessage').closest('form').find(
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

        // copy Email to ClipBoard
        function copyEmail(){
            var copyText1 = document.getElementById("emailVal");
            // Select the text field
            copyText1.select();

            // Copy the text inside the text field
            navigator.clipboard.writeText(copyText1.value);
        }
        // copy Phone to Clipboard
        function copyPhone(){
            // Get the text field
            var copyText = document.getElementById("mobVal");
            // Select the text field
            copyText.select();
            copyText.setSelectionRange(0, 99999); // For mobile devices

            // // Copy the text inside the text field
            navigator.clipboard.writeText(copyText.value);
        }
    </script>
@endsection
