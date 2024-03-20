<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Pacpay Admin Panel</title>

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

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Commission
                                                (Annual)
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><span
                                                    id="annual_earning_amount"></span></div>
                                        </div>
                                        <div class="col-auto"><i
                                                class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4" id="monthlyEarningAmount">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Commission
                                                (Monthly)
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><span
                                                    id="monthly_earning_amount"></span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Pending
                                                Requests
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><span
                                                    id="pending_fund_request_count"></span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Bank Withdrawal -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Bank Withdrawal (Daily)
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><span
                                                    id="withdrawals_today_amount"></span></div>
                                        </div>
                                        <div class="col-auto"><i
                                                class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4" id="totalCustomer">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total
                                                Customers
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><span
                                                    id="customer_count"></span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4" id="totalMerchant">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total
                                                Merchants
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><span
                                                    id="merchant_count"></span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4" id="totalAgent">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Total
                                                Agents
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><span
                                                    id="agent_count"></span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Agent Withdrawal
                                                (Daily)
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><span
                                                    id="agent_withdrawal"></span></div>
                                        </div>
                                        <div class="col-auto"><i
                                                class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Deposits
                                                (Daily)
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><span
                                                    id="deposits_today_amount"></span></div>
                                        </div>
                                        <div class="col-auto"><i
                                                class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-12 col-sm-12 col-md-12">
                            <div class="table-box">
                                <div style="padding: 15px;">
                                    <h4>Pending Fund Request</h4>

                                </div>

                                <div class="table-box-corner-curve">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th class="text-center">PACPAY USER ID</th>
                                                    <th class="text-center">NAME</th>
                                                    <th class="text-center">AMOUNT</th>
                                                    <th class="text-center">STATUS</th>
                                                    <th class="text-center">USER TYPE</th>
                                                    <th class="text-center">Transaction No</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Content Row -->
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
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="{{ asset('#page-top') }}"> <i class="fas fa-angle-up"></i> </a>


    <!-- Logout Modal-->
    {{-- <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="{{ asset('login') }}">Logout</a></div>
        </div>
    </div>
</div> --}}


    <script src="{{ asset('vendor/datatables/jquery.dataTables.js') }}"></script>


    <script type="text/javascript">
        $(document).ready(function() {
            $(".navbar-nav li").removeClass("active"); //this will remove the active class from
            //previously active menu item
            $('#home').addClass('active');

            $('#dataTable').DataTable({

                "processing": true,
                "serverSide": true,
                "searching": false,
                "ordering": false,
                "ajax": {

                    url: '{{ url('api/fund-request') }}',
                    data: function(d) {
                        d.search = d.search['value'],
                            d.request_origin = 'web',
                            d.is_received_or_sent = 'received',
                            d.status = 'REQUESTED'
                    }
                },
                "columns": [{
                        data: 'requester_user.pacpay_user_id'
                    },
                    {
                        data: 'requester_user.full_name'
                    },
                    {
                        data: 'amount'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'requester_user.user_type'
                    },
                    {
                        data: 'transaction_ref_no'
                    }
                ]

            });

            //Redirect
            $('#monthlyEarningAmount').click(function() {
                window.location.href = '{{ asset('admin-commission') }}';
            });

            $('#totalCustomer').click(function() {
                window.location.href = '{{ asset('users') }}';
            });

            $('#totalMerchant').click(function() {
                window.location.href = '{{ asset('merchants') }}';
            });

            $('#totalAgent').click(function() {
                window.location.href = '{{ asset('agents') }}';
            });

        });

        /* $(document).ready(function () {

            $.ajax({
                url: '{{ url('api/wallet-balance') }}',
                headers: {
                    'Content-Type': 'application/json'
                },
                type: 'GET',
                dataType: 'JSON',
                success: function (response) {
                    $('#span_balance').html(response.data[0].balance);
                },
                error: function (error) {
                    alert(error);
                },
            });

        }) */


        $(document).ready(function() {
            $.ajax({
                url: '{{ url('api/admin/business-metrics') }}',
                headers: {
                    'Content-Type': 'application/json'
                },
                type: 'GET',
                datatype: 'JSON',
                success: function(data) {
                    //alert(JSON.stringify(data));

                    // console.log(data);
                    $('#annual_earning_amount').html(data.data.annual_earning_amount);
                    $('#monthly_earning_amount').html(data.data.monthly_earning_amount);
                    $('#pending_fund_request_count').html(data.data.pending_fund_request_count);
                    $('#withdrawals_today_amount').html(data.data.withdrawals_today_amount
                        .bank_withdrawal);
                    $('#customer_count').html(data.data.users_count.customer_count);
                    $('#merchant_count').html(data.data.users_count.merchant_count);
                    $('#agent_count').html(data.data.users_count.agent_count);
                    $('#agent_withdrawal').html(data.data.withdrawals_today_amount
                        .agent_withdrawal);
                    $('#deposits_today_amount').html(data.data.deposits_today_amount);
                },
                error: function(error) {
                    alert(error);
                }
            });
        });
    </script>




</body>

</html>
