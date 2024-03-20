<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pacpay Admin Panel</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css') }}"
        rel="stylesheet" media="screen" />
    <link href="{{ asset('http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css') }}"
        rel="stylesheet">
    <link rel="stylesheet"
        href="{{ asset('http://fortawesome.github.io/Font-Awesome/3.2.1/assets/font-awesome/css/font-awesome.css') }}">
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="{{ asset('https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i') }}"
        rel="stylesheet">
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet" media="screen" />
    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <link rel="stylesheet"
        href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.css') }}">

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
                            <h5 class="m-0 font-weight-bold text-primary">Message List</h5>
                        </div>
                        <form name='sendMessage' id='sendMessage' class="form-container">

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
                        </form>
                        <div id="msgList" class="outgoing_msg sent_msg">

                        </div>
                        <div id="msgRec" class="received_msg received_withd_msg">

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
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="{{ asset('#page-top') }}">
        <i class="fas fa-angle-up"></i> </a>

    <script src="{{ asset('vendor/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.js"> </script>


    <script type="text/javascript">
        $(document).ready(function() {
            $(".navbar-nav li").removeClass("active"); //this will remove the active class from  
            //previously active menu item 
            $('#complaint').addClass('active');

            msgId = <?php echo json_encode($complaintDetails); ?>.id;;
            console.log(msgId);

            $.ajax({
                url: '{{ url('api/complaint') }}/' + msgId + '/message',
                type: 'get',

                success: function(data) {
                    console.log('data');

                    $.each(data.data.data, function($index, $value) {

                        if ($value.message_type == 'SENT') {
                            $("#msgList").append('<p>' + $value
                                .message + '</p>' + '<h6>' + $value
                                .created_at + '</h6>');
                        } else {
                            $("#msgRec").append('<p>' + $value
                                .message + '</p>' + '<h6>' + $value
                                .created_at + '</h6>');
                        }
                    })

                }
            });

            $('#sendMessage').on('submit', function(e) {
                e.preventDefault();

                var formFields = $('#sendMessage').serialize();
                console.log("formFields: " + formFields);
                var MessageId = $('#submit_button').data('message-id');
                console.log("Message Id: " + MessageId);

                $.ajax({
                    url: 'api/complaint/' + MessageId + '/message',
                    type: 'patch',
                    dataType: 'JSON',
                    data: formFields,
                    success: function(data) {
                        //alert(JSON.stringify(meta.message));
                        console.log("ttttt");
                        if (data.error_code == 0) {
                            window.location.reload();

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
                                        console.log(key + " " +
                                            value);
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
