@extends('layouts.master')
@section('styles')
@endsection
@section('content')
                    <!-- PAGE-HEADER -->
                    <div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
                        <h1 class="page-title">Sub Account</h1>
                        <div>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/index')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Sub Accounts</li>
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
                                                        <label>Merchant Name</label>
                                                        <select name="master_account_user_id" id="SelectMerchantName"
                                                        class="select2 form-control custom-select" required></select>
                                                    </div> &nbsp;&nbsp;
                                                    <div class="form-group col-sm d-flex report_btns" style="padding-top: 29px !important;">
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
                                            <div class="e-table px-5 pb-5">
                                                    <div class="table-responsive table-lg">
                                                        <table class="table border-top table-bordered mb-0 text-nowrap" id="dataTable" style="width:100%;">
                                                            <thead class="border-top">
                                                                <tr>
                                                                    <th class="border-bottom-0">Name</th>
                                                                    <th class="border-bottom-0">Username</th>
                                                                    <th class="border-bottom-0">Balance</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody></tbody>
                                                        </table>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- COL-END -->
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
            $(".navbar-nav li").removeClass("active");
            $('#merchant').addClass('active');

            var spinner = $('#loader');

            fetch_data();

            function fetch_data(SelectMerchantName) {
                $('#dataTable').DataTable().clear().destroy();

                $('#dataTable').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "searching": true,
                    "ordering": false,
                    "ajax": {
                        url: '{{ url('api/user/search') }}',
                        data: function(d) {
                            d.user_type_id = 7,
                                d.search = d.search['value'],
                                d.request_origin = 'web',
                                d.master_account_user_id = SelectMerchantName
                        }
                    },
                    "columns": [{
                            data: 'full_name'
                        },
                        {
                            data: 'username'
                        },
                        {
                            data: 'wallet.balance'
                        }

                    ]

                });


            }

            //Merchant List
            $.ajax({
                url: 'api/user/search',
                type: 'get',
                data: {
                    'user_type_id': 4
                },
                success: function(data) {
                    // console.log('Mercahnt List data');
                    $('#SelectMerchantName').empty();
                    $.each(data.data.data, function($index, $value) {

                        $('#SelectMerchantName').append('<option value="' + $value.id +
                            '" >' +
                            $value
                            .full_name + '</option>');
                    })
                }
            });

            //Filter Button
            $('#filter').click(function() {
                var SelectMerchantName = $('#SelectMerchantName').val();

                fetch_data(SelectMerchantName);
            });


            //Get User ID
            $("#dataTable").on('click', '.add_funds_entry', function() {

                $('#add_funds_form').modal('show');
                // console.log("userid: " + $(this).data('userid'));

                $('#submit_button').attr('data-user-id', $(this).data('userid'));
            });

            //Add funds
            $('#addFunds').on('submit', function(e) {
                e.preventDefault();
                spinner.show();

                var formFields = $('#addFunds').serialize();
                var send_to = $('#submit_button').data('user-id');
                // console.log("Bank Id: " + send_to);

                $.ajax({
                    url: 'api/send-funds',
                    type: 'post',
                    dataType: 'JSON',
                    data: formFields + '&is_wallet_refill=1&send_to=' + send_to,
                    success: function(data) {
                        //alert(JSON.stringify(meta.message));
                        //  console.log("ttttt");
                        if (data.error_code == 0) {
                            // console.log(data);
                            spinner.hide();
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
                        spinner.hide();
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
                                        // console.log(key + " " +
                                        //     value);
                                        $('#response').show()
                                            .append(value +
                                                "<br/>");
                                        spinner.hide();
                                    });
                                } else {
                                    $('#response').show().append(value +
                                        "<br/>"); //this is my div with messages
                                    spinner.hide();
                                }
                            });
                        }

                    }



                });
            });
        });
    </script>

@endsection
