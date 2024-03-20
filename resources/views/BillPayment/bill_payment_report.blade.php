@extends('layouts.master')
@section('styles')
    {{-- Date Picker --}}
        <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />

@endsection
@section('content')
                    <!-- PAGE-HEADER -->
                    <div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
                        <h1 class="page-title">Bill Payment</h1>
                        <div>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/index')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Bill Payment</li>
                            </ol>
                        </div> 
                    </div>
                    <!-- PAGE-HEADER END -->

                    <!-- CONTAINER -->
                    <div class="main-container container-fluid">
                        <!-- ROW OPEN -->
                        <div class="row row-cards">
                            <div class="tab-content mb-5">
                                <div class="tab-pane active" id="tab-11">
                                    <div class="card p-0">
                                        <div class="card-body p-4">
                                            <div class="row align-items-center justify-content-end">
                                                <form name='filterdate' id='filterdate'>
                                                            <div class="input-group input-daterange">
                                                                <div class="form-group col-sm">
                                                                    <input type="text" name="from_date" id="from_date"
                                                                         class="form-control"
                                                                        placeholder="From Date" />
                                                                </div>&nbsp;&nbsp;
                                                                <div class="input-group-addon">to</div> &nbsp;&nbsp;
                                                                <div class="form-group col-sm">
                                                                    <input type="text" name="to_date" id="to_date"
                                                                         class="form-control" placeholder="To Date" />
                                                                </div>
                                                                <div class="form-group col-sm d-flex report_btns">
                                                                    <button type="button" name="filter" id="filter"
                                                                        class="btn btn-info btn-sm filter">Filter
                                                                    </button>
                                                                    &nbsp;&nbsp;
                                                                    <button type="button" name="export" id="export"
                                                                        class="btn btn-block btn-success">Export All
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                <div class="e-table px-5 pb-5 pd-12">
                                                    <div class="table-responsive table-lg">
                                                        <table class="table border-top table-bordered mb-0 text-nowrap incomplete_registration" id="dataTable" style="width:100%;">
                                                            <thead class="border-top">
                                                                <tr>
                                                                    <th class="border-bottom-0">Date</th>
                                                                    <th class="border-bottom-0">Name</th>
                                                                    <th class="border-bottom-0">Bill Payment Id</th>
                                                                    <th class="border-bottom-0">Amount</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody></tbody>
                                                        </table>
                                                    </div>
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
@endsection
