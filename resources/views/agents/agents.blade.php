@extends('layouts.master')
@section('styles')
@endsection
@section('content')
                    <!-- PAGE-HEADER -->
                    <div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
                        <h1 class="page-title">Agents Information</h1>
                        <div>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/index')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Agents Information</li>
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
                                                        <label>Gender</label>
                                                        <select name="gender" id="gender" class="select2 form-control custom-select">
                                                            <option value="" selected="selected">Select Gender</option>
                                                            <option value="MALE">Male</option>
                                                            <option value="FEMALE">Female</option>
                                                        </select>
                                                    </div> &nbsp;&nbsp;
                                                    <div class="form-group col-sm">
                                                    <label>City</label>
                                                    <input type="text" name="city" id="city" class="form-control" aria-describedby="button-addon2"
                                                        placeholder="Enter City" />
                                                    </div>
                                                    <div class="input-group col-sm justify-content-end">
                                                    <button type="button" name="filter" id="filter" class="btn border btn-info"
                                                        style="text-align: center; margin-top:30px; height : 35px; width: 100px;border-radius:0.3rem; margin-right: 9px;">
                                                        Filter</button>
                                                    <!-- &nbsp;&nbsp; -->
                                                    <a type="button" name="export" id="export" class="btn btn-success btn-block float-end"
                                                        href="{{ url('api/user/search?user_type_id=2&download_csv=1') }}"
                                                        style="text-align: center; margin-top:30px; height : 35px; width: 100px; border-radius:0.3rem; margin-right: 9px;
                                                        background:	#006400; color: rgb(255,255,255);">
                                                        Export All</a>
                                                    <!-- &nbsp;&nbsp; -->
                                                    <a type="button" class="btn btn-secondary btn-block float-end"
                                                        href="{{asset('addUser')}}"
                                                        style="text-align: center; margin-top:30px; height : 35px; width: 114px; border-radius:0.3rem;
                                                        background:	#006400; color: rgb(255,255,255);">
                                                        Add Agent</a>
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="e-table px-5 pb-5">
                                                    <div class="table-responsive table-lg">
                                                        <table class="table border-top table-bordered mb-0 text-nowrap" id="dataTable" style="width:100%;">
                                                            <thead class="border-top">
                                                                <tr>
                                                                    <th class="border-bottom-0">Date</th>
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
                                    <!-- COL-END -->
                                </div>
                            </div>
                        </div>
                        <!-- ROW CLOSED -->
                    </div>
                    <!-- CONTAINER CLOSED -->
                    
@endsection

 <!-- Add Funds Model-->
 <div class="modal fade" id="add_funds_form" tabindex="-1" aria-labelledby="add-userLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="add-userLabel">Add Funds</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form name='addFunds' id='addFunds'>
                        @csrf
                        <div class="row gy-3">
                                <div class="col-xl-12">
                                    <label class="form-label">Amount</label>
                                    <input type="text" name="amount" class="form-control" id="amount" required>
                                </div>
                                <div class="col-xl-12">
                                    <label class="form-label">Transaction Pin</label>
                                    <!-- <input type="text" name="transaction_pin" class="form-control"
                                            id="transaction_pin" required> -->
                                    <input type="text" name="transaction_pin" 
                                    id="transaction_pin"
                                    autocomplete="one-time-code" required inputmode="numeric" maxlength="4">
                                </div>
                                <input type="text" name="pin" id="pin" hidden/>
                                <div class="col-xl-12">
                                    <label>Description</label>
                                    <textarea type="text" name="description" class="form-control" id="description"
                                            required></textarea>
                                </div>
                                <div style="text-align:center">
                                    <button type="submit" class="btn btn-primary btn-rounded btn-fw" id='submit_button'
                                        data-user-id="" style="font-weight:500;">Add</button>
                                    <button type="button" class="btn btn-light cancel_btn" data-bs-dismiss="modal" id="cancel_btn">Cancel</button>
                                </div>
                        </div>
                    </form>
                     <div id='response'></div>
                </div>
            </div>
        </div>
    </div>


@section('scripts')

<script type="text/javascript">
        //Add asterisk in TIN input
        transaction_pin.addEventListener("keyup", function changeChar() {
            const asterisks = "****";
            document.getElementById("pin").value = transaction_pin.value;
            if(transaction_pin.value.length == 4){
                if (transaction_pin.value.length <= asterisks.length) {
                    let newNumber = asterisks.substring(0, transaction_pin.value.length);
                    transaction_pin.value = newNumber;
                }
            }
            
        });

    $(document).ready(function() {
             //Filter Button
             $('#cancel_btn').click(function() {
                $('form :input').val('');   //CLEAR FORM INPUT
            });
            
            $(".navbar-nav li").removeClass("active"); //this will remove the active class from  
            $('#admin').addClass('active');
            var spinner = $('#loader');

            fetch_data();

            function fetch_data(gender, city) {
                $('#dataTable').DataTable().clear().destroy();
                $('#dataTable').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "searching": true,
                    "ajax": {
                        url: '{{ url('api/user/search') }}',
                        data: function(d) {
                            d.user_type_id = 3,
                                d.search = d.search['value'],
                                d.request_origin = 'web',
                                d.gender = gender,
                                d.city = city
                        }
                    },
                    columnDefs: [{
                        targets: 5,
                        render: function(data, type, row, meta) {
                            return '<td class="text-center"><a title="Edit" href="{{ asset('api/user') }}/' +
                                row.id +
                                '/edit" ><i class="bi bi-pencil-square"></i></a>&nbsp;&nbsp;<a data-bs-toggle="modal" data-bs-target="#add_funds_form" class="add_funds_entry btn btn-sm btn-icon "  style="color:#db555d;font-size: 16px;" data-userid="' + row.id + '"><i class="bi bi-cash"></i></a>';
                        }
                    }],
                    "columns": [{
                            data: 'created_at',
                            className: "created_at",
                            render: function(data, type, row, meta) {
                                return moment.utc(data).local().format('DD/MM/YYYY HH:mm a');
                            }
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

            }

            //Filter Button
            $('#filter').click(function() {
                var gender = $('#gender').val();
                var city = $('#city').val();

                fetch_data(gender, city);
            });

            //Get User ID
            $("#dataTable").on('click', '.add_funds_entry', function() {

                $('#add_funds_form').modal('show');


                $('#submit_button').attr('data-user-id', $(this).data('userid'));
            });

            //Add funds
            $('#addFunds').on('submit', function(e) {
                e.preventDefault();
                spinner.show();
                var formFields = $('#addFunds').serialize();
                var send_to = $('#submit_button').data('user-id');
                console.log("Bank Id: " + send_to);
                console.log("Formfields: " + formFields);

                $.ajax({
                    url: 'api/send-funds',
                    type: 'post',
                    dataType: 'JSON',
                    data: formFields + '&is_wallet_refill=1&send_to=' + send_to,
                    success: function(data) {
                        //alert(JSON.stringify(meta.message));
                        console.log("ttttt");
                        if (data.error_code == 0) {
                            console.log(data);
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
                        if (data.status == 400) {
                            $('#add_funds_form').modal('hide');
                            $('#dataTable').DataTable().ajax.reload();
                            spinner.hide();
                            Swal.fire({
                                title: "" + data.responseJSON.meta
                                    .message,
                                icon: 'error',
                                showCloseButton: true
                            })
                        } else
                        if (data.status === 422) {
                            var errors = $.parseJSON(data.responseText);
                            $.each(errors, function(key, value) {
                                // console.log(key+ " " +value);
                                $('#response').addClass(
                                    "alert alert-danger");

                                if ($.isPlainObject(value)) {
                                    $.each(value, function(key, value) {
                                        //console.log(key + " " +value);
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
