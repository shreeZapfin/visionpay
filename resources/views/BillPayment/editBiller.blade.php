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

        {{-- @include('datatables) --}}

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
                            <h5 class="m-0 font-weight-bold text-primary">Billers</h5>
                        </div>



                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered dataTable" id="dataTable" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">USERNAME</th>
                                            <th class="text-center">EMAIL</th>
                                            <th class="text-center">MOBILE NO</th>
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
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="{{ asset('#page-top') }}">
        <i class="fas fa-angle-up"></i> </a>

    <!-- Add Funds Model-->
    <div class="modal fade" id="add_funds_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Add Funds</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span> </button>
                </div>
                <div class="modal-body">
                    <form name='addFunds' id='addFunds'>
                        <div class="row">
                            <div class="col-md-6" style="margin:0 auto; display:block;">
                                <div class="form-group">
                                    <label>Amount</label>
                                    <div class="input-group">
                                        <input type="text" name="amount" class="form-control" id="amount" required>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Transaction Pin</label>
                                    <div class="input-group">
                                        <input type="text" name="transaction_pin" class="form-control"
                                            id="transaction_pin" required>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <div class="input-group">
                                        <input type="text" name="description" class="form-control" id="description"
                                            required>

                                    </div>
                                </div>


                            </div>

                            <br><br>



                        </div>
                        <div style="text-align:center">
                            <button type="submit" class="btn btn-primary btn-rounded btn-fw" id='submit_button'
                                data-user-id="" style="font-weight:500;">Add</button>
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        </div>

                    </form>


                </div>

                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('vendor/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".navbar-nav li").removeClass("active"); //this will remove the active class from
            //previously active menu item
            //$('#home').addClass('active');
            //for demo
            $('#bill_payment').addClass('active');
            //for sale
            //$('#merchant').addClass('active');

            $('#dataTable').DataTable().clear().destroy();

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
                        d.user_type_id = 5,
                            d.search = d.search['value'],
                            d.request_origin = 'web'
                    }
                },
                columnDefs: [{
                    targets: 3,
                    render: function(data, type, row, meta) {
                        return '<td class="text-center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a title="Edit" href="billerinfo/editBiller/' +
                            row.id +
                            '" style="color: rgb(30, 50, 250);"><i class="fa fa-edit fa-lg"></i></a>&nbsp;&nbsp;<button title="Add Funds" data-userid="' +
                            row.id +
                            '" class="add_funds_entry" style="color: rgb(0,128,0); border: none; background: none; width="100px";"><i class="fa fa-money fa-lg"></i></button></td>';
                    }

                }],
                "columns": [{
                        data: 'username'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'mobile_no'
                    },
                ]

            });






            //Get User ID
            $("#dataTable").on('click', '.add_funds_entry', function() {

                $('#add_funds_form').modal('show');


                $('#submit_button').attr('data-user-id', $(this).data('userid'));
            });

            //Add funds
            $('#addFunds').on('submit', function(e) {
                e.preventDefault();


                var formFields = $('#addFunds').serialize();
                var send_to = $('#submit_button').data('user-id');
                console.log("Bank Id: " + send_to);

                $.ajax({
                    url: 'api/send-funds',
                    type: 'post',
                    dataType: 'JSON',
                    data: formFields + '&is_wallet_refill=1&send_to=' + send_to,
                    success: function(data) {
                        //alert(JSON.stringify(meta.message));
                        console.log("ttttt");
                        if (data.error_code == 0) {
                            console.log(data);
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
