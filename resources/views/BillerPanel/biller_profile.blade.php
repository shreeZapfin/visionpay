<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Pacpay</title>
    <!-- Custom fonts for this template-->
    <link href="{{ asset('https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css') }}"
        rel="stylesheet" media="screen" />
    <link href="{{ asset('https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css') }}"
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
    <style>
        .my_img {
            position: absolute;
            right: 0;
            bottom: 0;
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

                <div>
                    <div class="main-content position-relative">
                        <div class="container-fluid py-4">
                            <div class="page-header min-height-300 border-radius-xl mt-4"
                                style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
                                <span class="mask bg-gradient-primary opacity-6"></span>
                            </div>
                            <h4 style="color: rgb(30, 50, 250); margin-top:5%;">Profile Details</h4>
                            <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
                                <div class="row gx-4">
                                    <div class="col-auto">
                                        <div class="avatar avatar-xl position-relative">
                                            <div id="profilePic">
                                            </div>


                                            <a href="javascript:;" class="my_img" title="Edit Profile"
                                                style="color: rgb(30, 50, 250);"><i class="fa fa-edit fa-lg"></i>
                                            </a>
                                        </div>

                                    </div>
                                    <div class="col-auto my-auto">
                                        <div class="h-100">
                                            <h5 class="mb-1" id="username"></h5>
                                            <p class="mb-0 font-weight-bold text-sm" id="fullname"></p>
                                            <p class="mb-0 font-weight-bold text-sm" id="joinedDate"></p>
                                        </div>
                                    </div>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <div>
                                        <div id="qrCode">
                                            {{-- <img src="/img/QR.png" alt="profile_image" height="150" width="150"
                                                class="w-100 border-radius-lg shadow-sm"> --}}
                                        </div>
                                    </div>


                                </div>



                            </div>
                        </div>
                        <div class="container-fluid py-4">
                            <div class="card">
                                <div class="card-header pb-0 px-3">
                                    <h4 class="mb-0">Profile Information</h4>
                                </div>
                                <div class="card-body pt-4 p-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label">Username</label>
                                                <div>
                                                    <input class="form-control" value="" type="text"
                                                        placeholder="UserName" id="userName" name="username" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label">Mobile No</label>
                                                <div>
                                                    <input class="form-control" value="" type="email"
                                                        placeholder="Phone" id="mobileNo" name="mobile_no" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label">Email</label>
                                                <div>
                                                    <input class="form-control" value="" type="email"
                                                        placeholder="@example.com" id="email" name="email"
                                                        readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label">Biller Name</label>
                                                <div>
                                                    <input class="form-control" value="" type="email"
                                                        placeholder="Pacpay ID" id="billerName" name="pacpay_user_id"
                                                        readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <form role="form text-left" name='editUserDetails' id='editUserDetails'>


                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-control-label">First Name</label>
                                                    <div>
                                                        <input class="form-control" value="" type="text"
                                                            placeholder="First Name" id="firstName"
                                                            name="first_name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-control-label">Last Name</label>
                                                    <div>
                                                        <input class="form-control" value="" type="text"
                                                            placeholder="Last Name" id="lastName" name="last_name">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Address</label>
                                            <div>
                                                <textarea class="form-control" id="address" rows="3" placeholder="Say something about your location"
                                                    name="address"></textarea>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn bg-gradient-info btn-md mt-4 mb-4"
                                                style="color: #FFFFFF">Save
                                                Changes</button>
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
                        <div class="copyright text-center my-auto"><span>Copyright &copy; Pacpay 2021</span></div>
                    </div>
                </footer>
                <!-- End of Footer -->
                <div id="loader"></div>
            </div>
            <!-- End of Content Wrapper -->
        </div>
        <!-- End of Page Wrapper -->
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="{{ asset('#page-top') }}"> <i class="fas fa-angle-up"></i> </a>

        <script src="{{ asset('vendor/datatables/jquery.dataTables.js') }}"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Bootstrap core JavaScript-->
        {{-- <script src="vendor/jquery/jquery.min.js"></script> --}}
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>
        <!-- Page level plugins -->
        <script src="vendor/chart.js/Chart.min.js"></script>
        <!-- Page level custom scripts -->
        <script src="js/demo/chart-area-demo.js"></script>
        <script src="js/demo/chart-pie-demo.js"></script>


        <script type="text/javascript">
            $(document).ready(function() {
                $(".navbar-nav li").removeClass("active"); //this will remove the active class from
                //previously active menu item
                $('#biller_profile').addClass('active');
                var spinner = $('#loader');
                var UserId = null;
                $.ajax({
                    url: '{{ url('api/user') }}',
                    type: 'GET',
                    datatype: 'JSON',
                    success: function(data) {
                        //alert(JSON.stringify(data));

                        console.log(data);
                        UserId = data.data.id;
                        console.log("Iside func UserId: " + UserId);
                        //$('#img_pic_url').html(data.data.profile_pic_img_url);
                        $('#username').html(data.data.username);
                        $('#fullname').html(data.data.full_name);
                        $('#joinedDate').html('Joined: ' + moment.utc(data.data.created_at).local().format(
                            'DD/MM/YYYY'));
                        $('#profilePic').html('<img src="' + data.data.profile_pic_img_url +
                            '"height="150" width="150" style="border-radius: 20px;" alt="Profile" />');
                        //'<img src="' + data.data.biller_img_url + '"height="75" width="75" alt="Profile" />'
                        $('#qrCode').html('<img src="' + data.data.qr_code_info +
                            '"height="80" width="80" style="border-radius: 20px;" alt="QR Code" />');

                        //Personal Information
                        $('#userName').val(data.data.username);
                        $('#mobileNo').val(data.data.mobile_no);
                        $('#firstName').val(data.data.first_name);
                        $('#lastName').val(data.data.last_name);
                        $('#email').val(data.data.email);
                        $('#billerName').val(data.data.biller.biller_name);
                        $('#address').val(data.data.address);
                    },
                    error: function(error) {
                        alert(error);
                    }
                });

                //Edit Personal Details
                $('#editUserDetails').on('submit', function(e) {
                    e.preventDefault();
                    spinner.show();
                    var formFields = $('#editUserDetails').serialize();

                    $.ajax({
                        url: '{{ url('api/user') }}/' + UserId,
                        type: 'patch',
                        dataType: 'JSON',
                        data: formFields,
                        success: function(data) {
                            //alert(JSON.stringify(meta.message));
                            console.log("ttttt");
                            if (data.error_code == 0) {
                                //console.log(data);
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

                            if (data.status === 422) {
                                var errors = $.parseJSON(data.responseText);
                                $.each(errors, function(key, value) {
                                    // console.log(key+ " " +value);
                                    $('#response').addClass(
                                        "alert alert-danger");
                                    $('#response').empty();
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


            });
        </script>




</body>

</html>
