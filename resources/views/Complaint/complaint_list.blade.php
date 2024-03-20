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


    <style>
        .buttonIn {
            width: 300px;
            position: relative;
        }

        input {
            margin: 0px;
            padding: 0px;
            width: 100%;
            outline: none;
            height: 30px;
            border-radius: 5px;
        }

        #submit_button {
            position: absolute;
            top: 0;
            border-radius: 5px;
            right: 0px;
            z-index: 2;
            border: none;
            height: 30px;
            cursor: pointer;
            color: white;
            background-color: #1e90ff;
            transform: translateX(2px);
        }
    </style>
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
                            <h5 class="m-0 font-weight-bold text-primary">Ticket List</h5>
                            <button type="submit" class="btn-fill btn" id='btn_raise_ticket'
                                style="float:right; margin-top: -20px;">Raise Ticket</button>
                        </div>
                        <form name='filter_search' id='filter_search' style="margin-top: 20px;">
                            <div class="input-group input-daterange">
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
                                </div>
                                &nbsp;&nbsp;
                                <div class="form-group col-sm">
                                    <button type="button" name="filter" id="filter" class="btn btn-info btn-sm"
                                        style="text-align: center; margin-top:30px; height : 40px; width: 80px;">Filter</button>
                                </div>
                            </div>
                        </form>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Ticket ID</th>
                                            <th class="text-center">Created At</th>
                                            <th class="text-center">Transaction Type</th>
                                            <th class="text-center">Transaction Id</th>
                                            {{-- <th class="text-center">Complaint Type Id</th> --}}
                                            <th class="text-center">User Ticket Description</th>
                                            <th class="text-center">Admin Resolution Description</th>
                                            <th class="text-center">Status</th>
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

    <!-- Raise complaint-->
    <div class="modal fade" id="raise_complaint_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Raise Complaint</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span> </button>
                </div>
                <div class="modal-body">
                    <form name='raiseComplaint' id='raiseComplaint'>
                        <div class="row">
                            <div class="col-md-6" style="margin:0 auto; display:block;">
                                <div class="form-group">
                                    <label>Complaint Type</label>
                                    <select name="complaint_type_id" id="complaint_type_id"
                                        class="select2 form-control custom-select" required>

                                    </select>
                                </div>
                                <div class="form-group" id="UserIDD">
                                    <label>User</label><br>
                                    <select name="user_id" id="user_id" style="width: 220px;margin: 10px;"
                                        class="js-example-basic-single select2 form-control">
                                    </select>
                                </div>
                                <div class="form-group" id="TransactionIdd" style="display: none;">
                                    <label>Transaction Id</label>
                                    <div class="input-group">
                                        <input type="text" name="transaction_id" class="form-control"
                                            id="transaction_id">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>User Complaint Description</label>
                                    <div class="input-group">
                                        {{-- <input type="text" name="user_complaint_description" class="form-control"
                                            id="user_complaint_description" required> --}}
                                        <textarea name="user_complaint_description" class="form-control" id="user_complaint_description" required>
                                                </textarea>

                                    </div>
                                </div>
                            </div>
                            <br><br>
                        </div>
                        <div id='response'></div>
                        <div style="text-align:center">
                            <button type="submit" class="btn btn-primary btn-rounded btn-fw" data-user-id=""
                                style="font-weight:500;">Add</button>
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        </div>

                    </form>


                </div>

                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

    <!-- Message List Modal-->
    <div class="modal fade" id="message_list_form" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chat</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span> </button>
                </div>
                <div class="chat-popup" id="myForm" style="padding: 5px;">

                    {{-- <form name='sendMessage' id='sendMessage' class="form-container">

                        <div style="text-align:right; margin: 0 auto; max-width: 800px; padding: 0 20px;">
                            <div class="type_msg">
                                <div class="input_msg_write">
                                    <input type="text" class="write_msg" placeholder="Type a message"
                                        name="message">
                                    <button type="submit" class="btn btn-primary btn-rounded btn-fw msg_send_btn"
                                        id='submit_button' data-message-id="" style="font-weight:500;"><i
                                            class="fa fa-paper-plane" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                    </form> --}}
                    <div id="messageList">

                    </div>

                </div>

                <div class="modal-footer">
                    <form name='sendMessage' id='sendMessage' class="form-container">

                        <div class="buttonIn">
                            <input type="text" id="enter" placeholder="Type a message" name="message">
                            <button type="submit" id='submit_button' data-message-id=""><i
                                    class="fa fa-paper-plane" aria-hidden="true"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('vendor/datatables/jquery.dataTables.js') }}"></script>
    {{-- Date Picker --}}
    <script src="{{ asset('vendor/moment/moment.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".navbar-nav li").removeClass("active"); //this will remove the active class from  
            //previously active menu item 
            $('#complaint').addClass('active');


            $('#complaint_type_id').on('change', function() {
                console.log("inside on change type");
                if (this.value == 1 || this.value ==
                    2) {
                    $("#TransactionIdd").hide();
                    $("#UserIDD").show();
                } else {
                    $("#TransactionIdd").show();
                    $("#UserIDD").hide();
                }
            });
            $('.js-example-basic-single').select2({
                placeholder: "Select User",
                allowClear: true
            });

            //Select User
            $.ajax({
                url: 'api/user/search',
                type: 'get',
                data: {
                    'request_origin': 'web'
                },
                success: function(data) {
                    // console.log('data');
                    $('#user_id').empty();
                    $("#user_id").append(new Option("Select User", ""));
                    $.each(data.data, function($index, $value) {

                        $('#user_id').append('</option>' + '<option value="' + $value.id +
                            '" >' +
                            $value
                            .username + '-' + $value.full_name + '</option>');
                    })
                }
            });

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
                        targets: 7,
                        render: function(data, type, row, meta) {
                            // console.log('data');
                            return '<td class="text-center"><button data-complaintid="' +
                                row.id +
                                '" class="complaint_id_entry btn btn-primary btn-rounded btn-fw" style="color: "#FFFFFF";">Resolve</button><button style="background-color: transparent; border: none;" title="Message" data-messageid="' +
                                row.id +
                                '" class="message_list"><i class="fas fa-comment-dots" style="color: rgb(30, 50, 250); font-size:24px;"></i></button></td>';
                        }

                    }],
                    "columns": [{
                            data: 'id'
                        }, {
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
            $("#btn_raise_ticket").on('click', function(e) {

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
                                .transaction_type + ": " +
                                $value
                                .type_description + '</option>');
                        })


                    }
                });

                //clear form fields
                var form = $("#raiseComplaint");
                if (e.target !== form[0]) {
                    form[0].reset();
                }

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

                var MessageId = $(this).data('messageid');
                // console.log("MessageId: " + MessageId);

                reloadChatBox(MessageId);


                var interval = 5000;
                msgTimer = setInterval(function() {
                    //var MessageId = $(this).data('messageid');
                    $('#messageList').empty();
                    reloadChatBox(MessageId);
                }, interval);



                //  console.log("dgdsg");
                $('#message_list_form').modal('show');
                $('#submit_button').attr('data-message-id', $(this).data('messageid'));
                //var MessageId = $(this).data('messageid');
                //console.log("MessageId : " + MessageId);
            });

            $("#message_list_form").on("hide.bs.modal", function() {
                clearInterval(msgTimer);
            });


            function reloadChatBox(MessageId) {
                // console.log("inside function");

                $.ajax({
                    url: '{{ url('api/complaint') }}/' + MessageId + '/message',
                    type: 'get',
                    async: false,
                    success: function(data) {
                        //console.log('data');

                        $.each(data.data.data, function($index, $value) {
                            $("#messageList").append(
                                '</br></br>');
                            if ($value.message_type == 'SENT') {
                                $("#messageList").append(
                                    '<div class="outgoing_msg sent_msg"><p>' +
                                    $value
                                    .message + '</p></div>' +
                                    '</br><p class="sent_msg" style="font-size:10px;">' +
                                    moment.utc($value
                                        .created_at).local().format('DD/MM/YYYY HH:mm a') +
                                    '</p>');
                            } else {
                                $("#messageList").append(
                                    '<div class="received_msg received_withd_msg"><p>' +
                                    $value
                                    .message + '</p></div>' +
                                    '</br><p class="received_withd_msg" style="font-size:10px;">' +
                                    moment.utc($value
                                        .created_at).local().format('DD/MM/YYYY HH:mm a') +
                                    '</p>');
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
    </script>
</body>

</html>
