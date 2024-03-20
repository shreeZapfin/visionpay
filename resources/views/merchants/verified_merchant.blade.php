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
                            <h5 class="m-0 font-weight-bold text-primary">Verified Merchant</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered dataTable" id="dataTable" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Business Name</th>
                                            <th class="text-center">NAME</th>
                                            <th class="text-center">EMAIL</th>
                                            <th class="text-center">USERNAME</th>
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


    <script src="{{ asset('vendor/datatables/jquery.dataTables.js') }}"></script>

    <script type="text/javascript">
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
                "ordering": false,
                "ajax": {
                    url: '{{ url('api/user/search') }}',
                    data: function(d) {
                        d.user_type_id = 4,
                            d.search = d.search['value'],
                            d.request_origin = 'web',
                            d.is_pending_verification = 0
                    }
                },
                columnDefs: [{
                    targets: 5,
                    render: function(data, type, row, meta) {
                        return '<td class="text-center"><a title="Edit" href="{{ url('api/user') }}/' +
                            row.id +
                            '/edit" style="color: rgb(30, 50, 250);"><i class="fas fa-fw fa-user"></i></a></td>';
                    }

                }],
                "columns": [{
                        data: 'business.business_name'
                    },
                    {
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
        });
    </script>
</body>

</html>
