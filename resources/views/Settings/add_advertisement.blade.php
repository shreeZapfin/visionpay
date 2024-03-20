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
                            <h5 class="m-0 font-weight-bold text-primary">Add Advertisement</h5>

                        </div>

                        <div class="card">
                            <div class="card-body">


                                <form name='addNewAdvertisement' id='addNewAdvertisement' enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-6" style="margin:0 auto; display:block;">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <div class="input-group">
                                                    <input type="text" name="title" class="form-control"
                                                        id="title" required>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Body</label>
                                                <div class="input-group">
                                                    <textarea id="w3review" name="body" class="form-control" id="body" rows="4" cols="50"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Type</label>
                                                <select name="advertisement_type" id="advertisement_type"
                                                    class="select2 form-control custom-select" required>
                                                    <option value="Select advertisement type" selected="selected">Select
                                                        advertisement type</option>
                                                    <option value="IMAGE">IMAGE</option>
                                                    <option value="TEXT">TEXT</option>
                                                </select>
                                            </div>
                                            <div class="form-group" id="img_advertisement" style="display: none;">
                                                <label>Advertisement Image</label>
                                                <div class="input-group">
                                                    <input type="file" name="advertisement_image"
                                                        class="form-control" id="advertisement_image">

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Redirect To</label>
                                                <select name="redirect_to" id="redirect_to"
                                                    class="select2 form-control custom-select">
                                                    <option value="NONE" selected="selected">NONE</option>
                                                    <option value="APP">APP</option>
                                                    <option value="WEB">WEB</option>
                                                </select>
                                            </div>
                                            <div id="redirect_option" style="display: none;">
                                                <div class="form-group">
                                                    <label>Redirect App</label>
                                                    <select name="redirect_app" id="redirect_app"
                                                        class="select2 form-control custom-select">
                                                        <option value="" selected="selected">NONE</option>
                                                        <option value="PAYMENTS">PAYMENTS</option>
                                                        <option value="DEPOSIT">DEPOSIT</option>
                                                        <option value="REWARDS">REWARDS</option>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="form-group" style="display: none;" id="redirect_url">
                                                <label>Redirect Url</label>
                                                <div class="input-group">
                                                    <input type="text" name="redirect_web_url" class="form-control"
                                                        id="redirect_web_url">
                                                </div>
                                                <p style="color: red; font-size: 70%;">Note: URL will redirect to
                                                    page like facebook, twitter, etc.</p>
                                            </div>
                                        </div>

                                        <br><br>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <div id='response'></div>
                                                <div class="col-sm-4"
                                                    style="text-align: center;display: block;margin: 0 auto; padding-top: 30px;">
                                                    <button type="submit" class="btn btn-primary btn-rounded btn-fw"
                                                        style="font-weight:500;">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id='response'></div>
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
            $(".navbar-nav li").removeClass("active"); //this will remove the active class from
            //previously active menu item
            $('#setting').addClass('active');

            $('#advertisement_type').on('change', function() {
                if (this.value == 'IMAGE') {
                    $("#img_advertisement").show();
                } else {
                    $("#img_advertisement").hide();
                }
            });

            $('#redirect_to').on('change', function() {
                /* ||
                    this.value == 'WEB' */
                if (this.value == 'APP') {
                    $("#redirect_option").show();
                    $("#redirect_url").show();
                } else {
                    $("#redirect_option").hide();
                    $("#redirect_url").show();
                }
            });

        });
        var spinner = $('#loader');
        $('#addNewAdvertisement').on('submit', function(e) {
            e.preventDefault();
            spinner.show();
            /*  // Activate the loading spinner
             $('.loading-spinner').toggleClass('active'); */

            var formFields = new FormData(this);

            //console.log(formFields);

            $.ajax({
                url: 'api/advertisement',
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
                        //  console.log(data);
                        spinner.hide();
                        Swal.fire({
                            title: "" + data.meta.message,
                            icon: 'success',
                            showCloseButton: true
                        })
                    } else {
                        swal(data.meta.message, "error");
                    }
                    /*   // Deactivate Loading Spinner
                                        $('.loading-spinner').toggleClass('active');
                     */
                    $('#addNewAdvertisement').closest('form').find("input[type=text], textarea").val(
                        "");
                    top.location.href = "{{ asset('advertisement-list') }}";
                },
                error: function(data) {

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
