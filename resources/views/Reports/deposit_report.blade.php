@extends('layouts.master')
@section('styles')
    {{-- Date Picker --}}
        <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />

        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">

@endsection
@section('content')
                    <!-- PAGE-HEADER -->
                    <div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
                        <h1 class="page-title">Deposit Report</h1>
                        <div>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/index')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Deposit Report</li>
                            </ol>
                        </div> 
                    </div>
                    <!-- PAGE-HEADER END -->

                    <!-- CONTAINER -->
                    <div class="main-container container-fluid">
                        <!-- ROW OPEN -->
                        <div class="row row-cards">
                            <div class="tab-content mb-5">
                                <div class="tab-pane active exprtbtns" id="tab-11">
                                    <div class="card p-0">
                                        <div class="card-body p-4">
                                            <div class="row align-items-center justify-content-end">
                                                    <form name='filter_search' id='filter_search' style="margin-top: 20px;">
                                                            <div class="input-group input-daterange">
                                                                <div class="form-group col-sm" style="padding-top: 29px !important;">
                                                                    <input type="text" name="from_date" id="from_date"
                                                                         class="form-control"
                                                                        placeholder="From Date" />
                                                                </div>&nbsp;&nbsp;
                                                                <div class="input-group-addon" style="padding-top: 29px !important;">to</div> &nbsp;&nbsp;
                                                                <div class="form-group col-sm" style="padding-top: 29px !important;">
                                                                    <input type="text" name="to_date" id="to_date"
                                                                         class="form-control" placeholder="To Date" />
                                                                </div>
                                                                <div class="form-group col-sm d-flex report_btns" style="padding-top: 29px !important;">
                                                                    <button type="button" name="filter" id="filter"
                                                                        class="btn btn-info btn-sm filter">Filter
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                <div class="e-table px-5 pb-5 pd-12">
                                                    <div class="table-responsive table-lg">
                                                        <table class="table border-top table-bordered mb-0 text-nowrap incomplete_registration" id="dataTable" 
                                                        style="width: 100% !important;">
                                                            <thead class="border-top">
                                                                <tr>
                                                                    <th class="border-bottom-0">Date</th>
                                                                    <th class="border-bottom-0">Amount</th>
                                                                    <th class="border-bottom-0">Deposit ID</th>
                                                                    <th class="border-bottom-0">Commission<br>Processed</th>
                                                                    <th class="border-bottom-0">Agent ID</th>
                                                                    <th class="border-bottom-0">User ID</th>
                                                                    <th class="border-bottom-0">Agent</th>
                                                                    <th class="border-bottom-0">Agent Pacpay<br>ID</th>
                                                                    <th class="border-bottom-0">User</th>
                                                                    <th class="border-bottom-0">User Pacpay<br>ID</th>
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
	
    <!-- Datatables Cdn -->
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.6/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

    {{-- Date Picker --}}
        <script src="{{ asset('vendor/moment/moment.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $(".navbar-nav li").removeClass("active"); //this will remove the active class from  
                $('#reports').addClass('active');

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
                            url: '{{ url('api/user/deposit') }}',
                            data: function(d) {
                                d.search = d.search['value'],
                                    d.request_origin = 'web',
                                    d.from_date = from_date,
                                    d.to_date = to_date
                            }

                        },
                        "columns": [{
                                data: 'created_at',
                                className: "created_at text-wrap",
                                render: function(data, type, row, meta) {
                                    return moment.utc(data).local().format('DD/MM/YYYY HH:mm a');
                                }
                            },
                            {
                                data: 'amount'
                            },
                            {
                                data: 'deposit_id'
                            },
                            {
                                data: 'commission_processed'
                            },
                            {
                                data: 'agent_id'
                            },
                            {
                                data: 'user_id'
                            },
                            {
                                data: 'agent_user.full_name'
                            },
                            {
                                data: 'agent_user.pacpay_user_id'
                            },
                            {
                                data: 'user.full_name',
                                className:'text-wrap'
                            },
                            {
                                data: 'user.pacpay_user_id',
                            }
                        ],
                        dom: 'Bfrtip',
                        buttons: [{
                                extend: 'excelHtml5',
                                title: 'Excel',
                                text: 'Excel'
                                //Columns to export
                                //exportOptions: {
                                //     columns: [0, 1, 2, 3,4,5,6]
                                // }
                            },
                            {
                                extend: 'pdfHtml5',
                                title: 'PDF',
                                text: 'PDF'
                                //Columns to export
                                //exportOptions: {
                                //     columns: [0, 1, 2, 3, 4, 5, 6]
                                //  }
                            }
                        ]

                    });


                }

                $('#filter').click(function() {
                    // var formFields = $('#filterdate').serialize();
                    // console.log(formFields);
                    var from_date = $('#from_date').val();
                    var to_date = $('#to_date').val();
                    // console.log("from_date " + from_date);
                    // console.log("to_date " + to_date);

                    fetch_data(from_date, to_date);


                });



            });
        </script>
    @endsection
