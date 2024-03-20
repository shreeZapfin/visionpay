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

    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css" rel="stylesheet" />

    {{-- Date Picker --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />


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
                            <h5 class="m-0 font-weight-bold text-primary">Bill Payment</h5>

                            <br>
                            <form name='filterdate' id='filterdate'>
                                <div class="col-12 col-sm-6 col-md-6 input-group input-daterange">

                                    <input type="text" name="from_date" id="from_date" readonly class="form-control"
                                        placeholder="Start Date" />&nbsp;&nbsp;
                                    <div class="input-group-addon">to</div> &nbsp;&nbsp;
                                    <input type="text" name="to_date" id="to_date" readonly class="form-control"
                                        placeholder="End Date" />

                                    &nbsp;&nbsp;
                                    <button type="button" name="filter" id="filter"
                                        class="btn btn-info btn-sm">Filter</button>
                                </div>
                            </form>


                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Date</th>
                                                <th class="text-center">Name</th>
                                                <th class="text-center">Bill Payment Id</th>
                                                <th class="text-center">Amount</th>
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

        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
        <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
        <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>

        <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>

        {{-- Date Picker --}}

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>


        <script type="text/javascript">
            $(document).ready(function() {
                $(".navbar-nav li").removeClass("active"); //this will remove the active class from  
                $('#bill_payment').addClass('active');

                var date = new Date();

                $('.input-daterange').datepicker({
                    todayBtn: 'linked',
                    format: 'yyyy-mm-dd',
                    autoclose: true
                });


                fetch_data();


                function fetch_data(from_date = (new Date()).toISOString().split('T')[0],
                    to_date = (new Date()).toISOString().split('T')[0]) {


                    $('#dataTable').DataTable().clear().destroy();

                    $('#dataTable').DataTable({
                        "lengthMenu": [
                            [10, 25, 50, -1],
                            [10, 25, 50, "All"]
                        ],
                        "processing": true,
                        "serverSide": true,
                        "searching": false,
                        "ajax": {
                            url: '{{ url('api/bill-payment') }}',
                            data: function(d) {
                                d.search = d.search['value'],
                                    d.request_origin = 'web',
                                    d.from_date = from_date,
                                    d.to_date = to_date
                            }

                        },
                        "columns": [{
                                data: 'created_at',
                                className: "created_at",
                                render: function(data, type, row, meta) {
                                    return moment.utc(data).local().format('DD/MM/YYYY HH:mm a');
                                }
                            },
                            {
                                data: 'biller.biller_name'
                            },
                            {
                                data: 'bill_payment_id'
                            },
                            {
                                data: 'biller_fields.amount.value'
                            }
                        ],
                        dom: 'Bfrtip',
                        buttons: [{
                                extend: 'excelHtml5',
                                title: 'Excel',
                                text: 'Export to excel'
                                //Columns to export
                                //exportOptions: {
                                //     columns: [0, 1, 2, 3,4,5,6]
                                // }
                            },
                            {
                                extend: 'pdfHtml5',
                                title: 'PDF',
                                text: 'Export to PDF'
                                //Columns to export
                                //exportOptions: {
                                //     columns: [0, 1, 2, 3, 4, 5, 6]
                                //  }
                            }
                        ]

                    });


                }

                $('#filter').click(function() {
                    var from_date = $('#from_date').val();
                    var to_date = $('#to_date').val();

                    fetch_data(from_date, to_date);


                });



            });
        </script>
</body>

</html>
