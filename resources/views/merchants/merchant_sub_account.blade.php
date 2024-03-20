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
                            <h5 class="m-0 font-weight-bold text-primary">Sub Account</h5>
                        </div>


                        <form name='filter_search' id='filter_search' style="margin-top: 20px;">
                            <div class="input-group input-daterange">
                                <div class="form-group col-sm">
                                    <label>Merchant Name</label>
                                    <select name="master_account_user_id" id="SelectMerchantName"
                                        class="select2 form-control custom-select" required>

                                    </select>
                                </div>
                                <div class="input-group col-sm">
                                    &nbsp;&nbsp;
                                    <button type="button" name="filter" id="filter" class="btn btn-info btn-sm"
                                        style="text-align: center; margin-top:30px; height : 40px; width: 80px;">Filter</button>
                                    &nbsp;&nbsp;
                                    <a type="button" name="export" id="export" class="btn btn-block"
                                        href="{{ url('api/user/search?user_type_id=7&download_csv=1') }}"
                                        style="text-align: center; margin-top:30px; height : 40px; width: 100px; background:	#006400; color: rgb(255,255,255);">Export
                                        ALL</a>
                                </div>
                            </div>
                        </form>


                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Username</th>
                                            <th class="text-center">Balance</th>
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



    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    {{-- <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script> --}}

    <script src="{{ asset('vendor/datatables/jquery.dataTables.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".navbar-nav li").removeClass("active");
            $('#merchant').addClass('active');

            var spinner = $('#loader');

            fetch_data();

            function fetch_data(SelectMerchantName) {
                $('#dataTable').DataTable().clear().destroy();

                $('#dataTable').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "searching": true,
                    "ordering": false,
                    "ajax": {
                        url: '{{ url('api/user/search') }}',
                        data: function(d) {
                            d.user_type_id = 7,
                                d.search = d.search['value'],
                                d.request_origin = 'web',
                                d.master_account_user_id = SelectMerchantName
                        }
                    },
                    "columns": [{
                            data: 'full_name'
                        },
                        {
                            data: 'username'
                        },
                        {
                            data: 'wallet.balance'
                        }

                    ]

                });


            }

            //Merchant List
            $.ajax({
                url: 'api/user/search',
                type: 'get',
                data: {
                    'user_type_id': 4
                },
                success: function(data) {
                    // console.log('Mercahnt List data');
                    $('#SelectMerchantName').empty();
                    $.each(data.data.data, function($index, $value) {

                        $('#SelectMerchantName').append('<option value="' + $value.id +
                            '" >' +
                            $value
                            .full_name + '</option>');
                    })
                }
            });

            //Filter Button
            $('#filter').click(function() {
                var SelectMerchantName = $('#SelectMerchantName').val();

                fetch_data(SelectMerchantName);
            });


            //Get User ID
            $("#dataTable").on('click', '.add_funds_entry', function() {

                $('#add_funds_form').modal('show');
                // console.log("userid: " + $(this).data('userid'));

                $('#submit_button').attr('data-user-id', $(this).data('userid'));
            });

            //Add funds
            $('#addFunds').on('submit', function(e) {
                e.preventDefault();
                spinner.show();

                var formFields = $('#addFunds').serialize();
                var send_to = $('#submit_button').data('user-id');
                // console.log("Bank Id: " + send_to);

                $.ajax({
                    url: 'api/send-funds',
                    type: 'post',
                    dataType: 'JSON',
                    data: formFields + '&is_wallet_refill=1&send_to=' + send_to,
                    success: function(data) {
                        //alert(JSON.stringify(meta.message));
                        //  console.log("ttttt");
                        if (data.error_code == 0) {
                            // console.log(data);
                            spinner.hide();
                            $('#add_funds_form').modal('hide');
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
                        spinner.hide();
                        $('#addFunds').closest('form').find(
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
                                        "<br/>"); //this is my div with messages
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
