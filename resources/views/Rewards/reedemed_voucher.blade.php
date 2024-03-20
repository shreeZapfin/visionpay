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
                            <h5 class="m-0 font-weight-bold text-primary"> Reedemed Vouchers</h5>
                        </div>
                        <form name='filter_search' id='filter_search' style="margin-top: 20px;">
                            <div class="col-12 col-sm-6 col-md-6 input-group input-daterange">
                                <div class="form-group">
                                    <label>Vocher For</label>
                                    <select name="voucher_for" id="voucher_for"
                                        class="select2 form-control custom-select">
                                        <option value="" selected="selected">Select Vocher For</option>
                                        <option value="MERCHANT_PAYMENT">Merchant Payment</option>
                                        <option value="FUND_REQUEST">Fund Request</option>
                                        <option value="BILL_PAYMENT">Bill Payment</option>
                                        <option value="DEPOSIT">Deposit</option>
                                    </select>
                                </div>

                                &nbsp;&nbsp;
                                <button type="button" name="filter" id="filter" class="btn btn-info btn-sm"
                                    style="text-align: center; margin-top:30px; height : 40px; width: 80px;">Filter</button>
                            </div>
                        </form>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">Redemmed Date</th>
                                            <th class="text-center">Code</th>
                                            <th class="text-center">Promotion Name</th>
                                            <th class="text-center">Voucher For</th>
                                            <th class="text-center">Min Transaction Amount</th>
                                            {{-- <th class="text-center">Transaction Id</th>
                                            <th class="text-center">Transaction Type</th> --}}
                                            <th class="text-center">Cashback Type</th>
                                            <th class="text-center">Voucher Type</th>
                                            <th class="text-center">Voucher Description</th>
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
            $('#rewards').addClass('active');

            fetch_data();

            function fetch_data(voucher_for) {
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
                        url: '{{ url('api/promotion/reedemed-vouchers') }}',
                        data: function(d) {
                            d.voucher_for = voucher_for,
                                d.request_origin = 'web'
                        }

                    },
                    "columns": [{
                            data: 'voucher.created_at',
                            className: "created_at",
                            render: function(data, type, row, meta) {
                                return moment.utc(data).local().format('DD/MM/YYYY HH:mm a');
                            }
                        },
                        {
                            data: 'redeemed_at'
                        },
                        {
                            data: 'voucher.code'
                        },
                        {
                            data: 'voucher.data.promotion_name'
                        },
                        {
                            data: 'voucher.data.voucher_for'
                        },
                        {
                            data: 'voucher.data.min_txn_amount'
                        },
                        /* {
                                    data: 'transaction_user_voucher.user_transaction.transaction_id'
                                    // data: '[,].transaction_user_voucher.user_transaction.transaction_id',
                                   // render: function(data, type, row) {
                                   //     return data;
                                    //} 
                            },
                            {
                                data: 'transaction_user_voucher.user_transaction.transaction_type'
                            },
                            */
                        {
                            data: 'voucher.data.cashback_type'
                        }, {
                            data: 'voucher.data.voucher_type'
                        }, {
                            data: 'voucher.data.voucher_description'
                        }
                    ]

                });

            }

            //Filter Button
            $('#filter').click(function() {
                var voucher_for = $('#voucher_for').val();


                fetch_data(voucher_for);
            });

        });
    </script>
</body>

</html>
