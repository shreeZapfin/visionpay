<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pacpay Admin Panel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">


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
                            <h5 class="m-0 font-weight-bold text-primary">Biller Withdrawal Funds</h5>

                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6" style="margin:0 auto; display:block;">
                                        <div class="form-group">
                                            <label>Biller</label>
                                            <select name="biller" id="biller"
                                                class="select2 form-control custom-select" required>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6" style="margin:0 auto; display:block;">
                                        <div class="form-group">
                                            <label>Balance</label>
                                            <div class="input-group">
                                                <input type="text" name="balance" class="form-control" id="balance"
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="row">
                                    <div class="col-md-6" style="margin:0 auto; display:block;">
                                        <div class="form-group">
                                            <label>Biller Balance</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="billerBalance" required
                                                    disabled>

                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                                <form name='biller_funds' id='biller_funds'>
                                    <div class="row">
                                        <div class="col-md-6" style="margin:0 auto; display:block;">
                                            <div class="form-group">
                                                <label>Amount</label>
                                                <div class="input-group">
                                                    <input type="text" name="amount" class="form-control"
                                                        id="amount" required>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Transaction Pin</label>
                                                <div class="input-group">
                                                    <input type="text" name="transaction_pin" class="form-control"
                                                        id="transaction_pin"required>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Remark</label>
                                                <div class="input-group">
                                                    <input type="text" name="remark" class="form-control"
                                                        id="remark" required>

                                                </div>
                                            </div>


                                        </div>

                                        <br><br>

                                    </div>
                                    <div style="text-align:center">
                                        <button type="submit" class="btn btn-primary btn-rounded btn-fw"
                                            id='withdrawal_biller_funds_submit_button' data-user-id=""
                                            style="font-weight:500;">Withdraw Funds</button>
                                    </div>

                                </form>
                                <div id='response'></div>
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





    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".navbar-nav li").removeClass("active"); //this will remove the active class from
            //previously active menu item
            $('#bill_payment').addClass('active');


        });

        var UserId = null;

        //Select Biller
        $.ajax({
            url: 'api/biller',
            type: 'get',
            success: function(data) {
                // console.log('data');

                $('#biller').empty();
                $("#biller").append(new Option("Select Biller", ""));
                $.each(data.data.data, function($index, $value) {

                    /*  $('#biller').append('</option>' + '<option value="' + $value.user.id +
                         '" data-biller-id=' + $value.id + ' >' +
                         $value
                         .biller_name + '</option>'); */

                    $('#biller').append('<option value="' + $value
                        .user_id +
                        '" >' +
                        $value
                        .biller_name + '</option>');

                    // console.log("UserId: " + UserId);
                });



            }
        });

        $('#biller').on('change', function() {
            UserID = $('#biller').val();
            console.log("User Id : " + UserID);
            $.ajax({
                url: 'api/biller',
                type: 'get',
                data: {
                    'user_id': UserID,
                    'request_origin': 'web'
                },
                success: function(data) {
                    //console.log('data');
                    $('#balance').val(data.data[0].user.wallet.balance);
                    console.log("bal: " + data.data[0].user.wallet.balance);
                    /*  var dataString = JSON.stringify(data.data[0].user.wallet.balance);
                     console.log(dataString);
                     $('#balance').val(dataString); */
                }
            });
        });

        var spinner = $('#loader');
        $('#biller_funds').on('submit', function(e) {
            e.preventDefault();
            spinner.show();
            /*  // Activate the loading spinner
             $('.loading-spinner').toggleClass('active'); */

            var send_to = $('#biller').val();
            // console.log("send_to: " + send_to);

            var formFields = new FormData(this);

            //console.log(formFields);

            $.ajax({
                url: '{{ url('api/user/withdrawal') }}/' + send_to +
                    '/admin-withdrawal',
                type: 'post',
                dataType: 'JSON',
                data: formFields,
                contentType: false, // The content type used when sending data to the server.
                //cache: false, // To unable request pages to be cached
                processData: false,
                success: function(data) {
                    //alert(JSON.stringify(meta.message));
                    // console.log("ttttt");
                    if (data.error_code == 0) {
                        // console.log(data);
                        spinner.hide();
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

                },
                error: function(data) {
                    if (data.status == 400) {
                        // console.log(data);
                        spinner.hide();
                        Swal.fire({
                            title: "" + data.responseJSON.meta
                                .message,
                            icon: 'error',
                            showCloseButton: true
                        }).then(okay => {
                            if (okay) {
                                window.location
                                    .reload();
                            }
                        });
                    } else
                    if (data.status === 422) {
                        var errors = $.parseJSON(data.responseText);
                        $.each(errors, function(key, value) {
                            // console.log(key+ " " +value);
                            $('#response').addClass("alert alert-danger");

                            if ($.isPlainObject(value)) {
                                $.each(value, function(key, value) {
                                    // console.log(key + " " + value);
                                    $('#response').show().append(value + "<br/>");
                                    spinner.hide();
                                });
                            } else {
                                $('#response').show().append(value +
                                    "<br/>"); //this is my div with messages
                                spinner.hide();
                            }
                        });
                    }

                }



            });
        });
    </script>
</body>

</html>
