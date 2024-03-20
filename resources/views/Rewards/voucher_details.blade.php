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
                            <h5 class="m-0 font-weight-bold text-primary">Voucher Details</h5>
                        </div>

                        <div class="col-md-8 mt-1">
                            {{-- class="card mb-3 content" --}}
                            <div>

                                <div class="class-body" style="padding-left: 3%;">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div>
                                                <strong class="text-dark">Promotion:</strong>
                                                &nbsp; {{ $voucher_details->promotion_name }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div>
                                                <strong class="text-dark">Transaction Type:</strong>
                                                &nbsp; {{ $voucher_details->promotion_transaction_type }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div>
                                                <strong class="text-dark">Voucher code:</strong>
                                                &nbsp; {{ $voucher_details->voucher->code }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div>
                                                <strong class="text-dark">Voucher For:</strong>
                                                &nbsp; {{ $voucher_details->voucher->data['voucher_for'] }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div>
                                                <strong class="text-dark">Min Transaction Amount:</strong>
                                                &nbsp; {{ $voucher_details->voucher->data['min_txn_amount'] }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div>
                                                <strong class="text-dark">Cashback Type:</strong>
                                                &nbsp; {{ $voucher_details->voucher->data['cashback_type'] }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div>
                                                <strong class="text-dark">Cashback Amount:</strong>
                                                &nbsp; {{ $voucher_details->voucher->data['cashback_amount'] }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div>
                                                <strong class="text-dark">Voucher Type:</strong>
                                                &nbsp; {{ $voucher_details->voucher->data['voucher_type'] }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div>
                                                <strong class="text-dark">Reward Upto Max Amount:</strong>
                                                &nbsp;
                                                {{ $voucher_details->voucher->data['reward_upto_max_amount'] }}
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>

                        </div>


                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <tr>
                                        <th>Txn date time</th>
                                        <th>Transaction Id</th>
                                        <th>Description</th>
                                        <th>Debit Amount</th>
                                        <th>Credit Amount</th>
                                        <th>Debit user</th>
                                        <th>Credit user</th>
                                    </tr>
                                    @foreach ($voucher_details->redeemed_transactions as $txn)
                                        {{-- {{ dd($txn) }} --}}
                                        <tr>
                                            <td>{{ $txn->created_at }}</td>
                                            <td>{{ $txn->transaction_id }}</td>
                                            <td>{{ $voucher_details->voucher->data['voucher_description'] }}</td>
                                            <td>{{ $txn->debit_amount }}</td>
                                            <td>{{ $txn->credit_amount }}</td>
                                            <td><b>Username: </b>{{ $txn->debitedUser->username }} <br><b>Pacpay
                                                    Id:
                                                </b>{{ $txn->debitedUser->pacpay_user_id }}<br><b>MobileNo:</b>
                                                {{ $txn->debitedUser->mobile_no }}<br><b>UserType:</b>
                                                {{ $txn->debitedUser->user_type }}</td>
                                            <td><b>Username: </b>{{ $txn->creditedUser->username }}<br><b>Pacpay
                                                    Id:
                                                </b>{{ $txn->creditedUser->pacpay_user_id }}<br><b>MobileNo:</b>
                                                {{ $txn->creditedUser->mobile_no }}<br><b>UserType:</b>
                                                {{ $txn->creditedUser->user_type }}</td>
                                        </tr>
                                    @endforeach
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
        </div>a
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

        });
    </script>
</body>

</html>
