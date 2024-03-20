@extends('layouts.master')
@section('styles')
@endsection
@section('content')
                    <!-- PAGE-HEADER -->
                    <div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
                        <h1 class="page-title">Verified User</h1>
                        <div>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/index')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Verified User</li>
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
                                    <div class="card">
                                        <div class="e-table px-5 pb-5 pd-12">
                                            <div class="table-responsive table-lg">
                                                <table class="table border-top table-bordered mb-0 text-nowrap" id="dataTable" style="width:100%;">
                                                    <thead class="border-top">
                                                        <tr>
                                                            <th class="border-bottom-0">Name</th>
                                                            <th class="border-bottom-0">Email</th>
                                                            <th class="border-bottom-0">Username</th>
                                                            <th class="border-bottom-0 ">Mobile No</th>
                                                            <th class="border-bottom-0">Actions</th>
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
                        <!-- ROW CLOSED -->
                    </div>
                    <!-- CONTAINER CLOSED -->
                    
@endsection
@section('scripts')
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
                "ajax": {
                    url: '{{ url('api/user/search') }}',
                    data: function(d) {
                        d.user_type_id = 2,
                            d.search = d.search['value'],
                            d.request_origin = 'web',
                            d.is_pending_verification = 0
                    }
                },
                columnDefs: [{
                    targets: 4,
                    render: function(data, type, row, meta) {
                        return '<td class="text-center"><a class="" title="Edit User" href="{{ url('api/user') }}/' +
                            row.id + '/edit"><i class="bi bi-pencil-square"></i></a></td>';
                    }

                }],
                "columns": [{
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
@endsection