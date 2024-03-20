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
                            <h5 class="m-0 font-weight-bold text-primary">Add New Bank</h5>

                        </div>

                        <div class="card">
                            <div class="card-body">


                                <form name='addNewBank' id='addNewBank'>
                                    <div class="row">
                                        <div class="col-md-6" style="margin:0 auto; display:block;">
                                            <div class="form-group">
                                                <label>Bank Name</label>
                                                <div class="input-group">
                                                    <input type="text" name="bank_name" class="form-control"
                                                        id="bank_name" required>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Account Number</label>
                                                <div class="input-group">
                                                    <input type="text" name="account_no" class="form-control"
                                                        id="account_no" required>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Swift</label>
                                                <div class="input-group">
                                                    <input type="text" name="swift" class="form-control"
                                                        id="swift" required>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>BSB</label>
                                                <div class="input-group">
                                                    <input type="text" name="bsb" class="form-control"
                                                        id="bsb" required>

                                                </div>
                                            </div>


                                        </div>

                                        <br><br>
                                        <div class="col-md-12">
                                            <div class="form-group row">

                                                <div class="col-sm-4"
                                                    style="text-align: center;display: block;margin: 0 auto; padding-top: 30px;">
                                                    <button type="submit" class="btn btn-primary btn-rounded btn-fw"
                                                        style="font-weight:500;">{{-- <i
                                                            class="loading-spinner fa fa-lg fas fas-spinner fa-spin"></i> --}}Add</button>

                                                </div>

                                            </div>
                                        </div>
                                        <div id='response'></div>

                                    </div>
                                </form>
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

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span> </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ asset('login') }}">Logout</a>
                </div>
            </div>
        </div>
    </div>



    <script type="text/javascript">
        $(document).ready(function() {
            $(".navbar-nav li").removeClass("active");
        });
        var spinner = $('#loader');
        $('#addNewBank').on('submit', function(e) {
            e.preventDefault();
            spinner.show();
            /* // Activate the loading spinner
            $('.loading-spinner').toggleClass('active'); */

            var formFields = $('#addNewBank').serialize();

            $.ajax({
                url: 'api/admin-bank-details',
                type: 'post',
                dataType: 'JSON',
                data: formFields,
                success: function(data) {
                    //alert(JSON.stringify(meta.message));
                    // console.log("ttttt");
                    if (data.error_code == 0) {
                        // console.log(data);
                        spinner.hide();
                        /*  // Deactivate Loading Spinner
                         $('.loading-spinner').toggleClass('active'); */
                        Swal.fire({
                            title: "" + data.meta.message,
                            icon: 'success',
                            showCloseButton: true
                        })
                    } else {
                        swal(data.meta.message, "error");
                    }

                    $('#addNewBank').closest('form').find("input[type=text], textarea").val("");

                },
                error: function(data) {

                    if (data.status === 422) {
                        var errors = $.parseJSON(data.responseText);
                        $.each(errors, function(key, value) {
                            // console.log(key+ " " +value);
                            $('#response').addClass("alert alert-danger");

                            if ($.isPlainObject(value)) {
                                $.each(value, function(key, value) {
                                    //  console.log(key + " " + value);
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
