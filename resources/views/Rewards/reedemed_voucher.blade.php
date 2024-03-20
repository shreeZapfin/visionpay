@extends('layouts.master')
@section('styles')
@endsection
@section('content')
                    <!-- PAGE-HEADER -->
                    <div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
                        <h1 class="page-title">Reedemmed Vouchers</h1>
                        <div>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/index')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Reedemmed Vouchers</li>
                            </ol>
                        </div> 
                    </div>
                    <!-- PAGE-HEADER END -->

                    <!-- CONTAINER -->
                    <div class="main-container container-fluid">
                        <!-- ROW OPEN -->
                        <div class="row row-cards">
                            <div class="col-xl-12">
                                <div class="card p-0">
                                    <div class="card-body p-4">
                                        <div class="row align-items-center">
                                            <form name='filter_search' id='filter_search' style="margin-top: 20px;">
                                                    <div class="input-group">
                                                        <div class="form-group col-sm">
                                                            <label>Voucher For</label>
                                                            <select name="voucher_for" id="voucher_for"
                                                                class="select2 form-control custom-select">
                                                                <option value="" selected="selected">Select Vocher For</option>
                                                                <option value="MERCHANT_PAYMENT">Merchant Payment</option>
                                                                <option value="FUND_REQUEST">Fund Request</option>
                                                                <option value="BILL_PAYMENT">Bill Payment</option>
                                                                <option value="DEPOSIT">Deposit</option>
                                                            </select>
                                                        </div> &nbsp;&nbsp;
                                                        <div class="input-group col-sm pb-3">
                                                        <button type="button" name="filter" id="filter" class="btn border"
                                                            style="text-align: center; margin-top:30px; height : 35px; width: 80px;border-top-right-radius: 0.3rem;border-bottom-right-radius: 0.3rem; ">
                                                            <i class="bi bi-search text-muted"></i></button>
                                                        </div>
                                                    </div>
                                                </form>
                                            <div class="e-table px-5 pb-5 pd-12">
                                                <div class="table-responsive table-lg">
                                                    <table class="table border-top table-bordered mb-0 text-nowrap" id="dataTable" style="width:100%;">
                                                        <thead class="border-top">
                                                            <tr>
                                                                <th class="border-bottom-0">Date</th>
                                                                <th class="border-bottom-0">Redemmed<br>Date</th>
                                                                <th class="border-bottom-0">Code</th>
                                                                <th class="border-bottom-0">Promotion<br>Name</th>
                                                                <th class="border-bottom-0">Voucher<br>For</th>
                                                                <th class="border-bottom-0">Min Transaction<br>Amount</th>
                                                                <!-- <th class="border-bottom-0">Transaction ID</th>
                                                                <th class="border-bottom-0">Transaction Type</th> -->
                                                                <th class="border-bottom-0">Cashback<br>Type</th>
                                                                <th class="border-bottom-0">Voucher<br>Type</th>
                                                                <th class="border-bottom-0">Voucher<br>Description</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <!-- /.container-fluid -->
                                <div id='response'></div>
                            </div>
                        </div>
                        <!-- ROW CLOSED -->
                    </div>
                    <!-- CONTAINER CLOSED -->
   

@endsection
@section('scripts')
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
                            data: 'redeemed_at',
                            className:"redeemed_at"
                        },
                        {
                            data: 'voucher.code'
                        },
                        {
                            data: 'voucher.data.promotion_name',
                            className:"promotion_name"
                        },
                        {
                            data: 'voucher.data.voucher_for'
                        },
                        {
                            data: 'voucher.data.min_txn_amount',
                            className:"min_txn_amount"
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
                            data: 'voucher.data.voucher_description',
                            className:"voucher_description"
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


@endsection
