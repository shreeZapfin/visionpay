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
        @include('sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('header')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5 class="m-0 font-weight-bold text-primary">View User Activity</h5>
                          
                        </div>
                        {{-- filter --}}

                   

                        <form name='filter_search' id='filter_search' style="margin-top: 10px;">
                                <div class="input-group input-daterange">
                                    <div class="form-group col-sm">
                                        <input type="text"required name="from_date" id="from_date" readonly
                                            class="form-control" placeholder="Start 
                                            Date" />
                                    </div>&nbsp;&nbsp;
                                    <div class="input-group-addon">to</div> &nbsp;&nbsp;
                                    <div class="form-group col-sm">
                                        <input type="text" required name="to_date" id="to_date" readonly
                                            class="form-control" placeholder="To Date" />
                                    </div>

                                    <div class="form-group col-sm" id="UserIDD">
                               
                                    <select name="user_id" id="user_id" style="width: 220px;"
                                        class="js-example-basic-single select2 form-control">
                                    </select>
                                </div>
                                    <div class="form-group col-sm">
                                        <button type="button" name="filter" id="filter" class="btn btn-info btn-sm"
                                            style="text-align: center; height : 40px; width: 100px;">Filter</button>
                                        &nbsp;&nbsp;
                                        <button type="button" name="export" id="export" class="btn btn-block"
                                            style="text-align: center;height : 40px; width: 100px; background:	#006400; color: rgb(255,255,255);">Export
                                            ALL</button>
                                    </div>
                            </form>




                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered dataTable" id="dataTable" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">DATE</th>
                                            <th class="text-center">EVENT</th>
                                            <th class="text-center">REMARK</th>
                                            <th class="text-center">USERNAME</th>
                                            <th class="text-center">USER ID</th>
                                            <!-- <th class="text-center">ACTION</th> -->
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
            <div id="loader"></div>
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="{{ asset('#page-top') }}">
        <i class="fas fa-angle-up"></i> </a>

    <!-- Add Funds Model-->
    <div class="modal fade" id="add_funds_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Add Funds</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span> </button>
                </div>
                <div class="modal-body">
                    <form name='addFunds' id='addFunds'>
                        <div class="row">
                            <div class="col-md-6" style="margin:0 auto; display:block;">
                                <div class="form-group">
                                    <label>Amount</label>
                                    <div class="input-group">
                                        <input type="text" name="amount" class="form-control" id="amount"
                                            required>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Transaction Pin</label>
                                    <div class="input-group">
                                        <input type="text" name="transaction_pin" class="form-control"
                                            id="transaction_pin" required>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <div class="input-group">
                                        <input type="text" name="description" class="form-control"
                                            id="description" required>

                                    </div>
                                </div>


                            </div>

                            <br><br>

                        </div>
                        <div style="text-align:center">
                            <button type="submit" class="btn btn-primary btn-rounded btn-fw" id='submit_button'
                                data-user-id="" style="font-weight:500;">Add</button>
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        </div>

                    </form>


                </div>

                <div class="modal-footer">
                    <div id='response'></div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('vendor/datatables/jquery.dataTables.js') }}"></script>
    {{-- Date Picker --}}
        <script src="{{ asset('vendor/moment/moment.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".navbar-nav li").removeClass("active"); //this will remove the active class from
        
            $('#user').addClass('active');
            
    
 
            var spinner = $('#loader');

            $('.input-daterange').datepicker({
                    todayBtn: 'linked',
                    format: 'yyyy-mm-dd',
                    autoclose: true,
                    orientation: "bottom left"
                });

            $('.js-example-basic-single').select2({
                placeholder: "Select User",
                allowClear: true});

     
             //Select User
             $.ajax({
                url: 'api/user/search',
                type: 'get',
                data: {
                    'request_origin': 'web'
                },
                success: function(data) {
                    // console.log('data');
                    $('#user_id').empty();
                    $("#user_id").append(new Option("Select User", ""));
                    $.each(data.data, function($index, $value) {

                        $('#user_id').append('</option>' + '<option value="' + $value.id +
                            '" >' +
                            $value
                            .username + '-' + $value.full_name + '</option>');
                    })
                }
            });
            fetch_data();

          
            function fetch_data(from_date = (new Date()).toISOString().split('T')[0],
                    to_date = (new Date()).toISOString().split('T')[0], user_id) {

                $('#dataTable').DataTable().clear().destroy();

                $('#dataTable').DataTable({
                    "lengthMenu": [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ],
                    "processing": true,
                    "serverSide": true,
                    "searching": true,
                    "ajax": {
                        url: '{{ url('api/user-event/') }}',
                        data: function(d) {
                            d.user_type_id = 9,
                                d.search = d.search['value'],
                                d.request_origin = 'web',
                                d.user_id = user_id ?? 'all',
                                    d.from_date = from_date,
                                    d.to_date = to_date
                        }
                    },
                    // columnDefs: [{
                    //         targets: 5,
                    //         render: function(data, type, row, meta) {
                    //             return '<td class="text-center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a title="User Details" href="{{ url('api/user') }}/' +
                    //                 row.id +
                    //                 '/edit" style="color: rgb(30, 50, 250);"><i class="fas fa-fw fa-user"></i></a>&nbsp;&nbsp;<button title="Add Funds" data-userid="' +
                    //                 row.id +
                    //                 '" class="add_funds_entry" style="color: rgb(0,128,0); border: none; background: none; width="100px";"><i class="fa fa-money fa-lg"></i></button></td>';
                    //         }

                    //     },
                    //     {
                    //         "orderable": false,
                    //         "targets": '_all'
                    //     }
                    // ],
                    "columns": [{
                            data: 'created_at',
                            sortable: true,
                            searchable: true ,
                            className: "created_at",
                            render: function(data, type, row, meta) {
                                return moment.utc(data).local().format('DD/MM/YYYY HH:mm a');
                            }
                        },
                        {
                            data: 'event',
                            sortable: true,
                            searchable: true 
                        },
                        {
                            data: 'remark',
                            sortable: true,
                            searchable: true 
                        },
                        {
                            data: 'action_user_full_name',
                            sortable: true,
                            searchable: true 
                        },
                        {
                            data: 'user_id',
                            sortable: true,
                            searchable: true 
                        },
                    ]

                });
            }



            //Filter Button
            $('#filter').click(function() {
                var from_date = $('#from_date').val();
                    var to_date = $('#to_date').val();

                var user_id = $('#user_id').find(":selected").val();

                fetch_data(from_date, to_date, user_id);

       
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
                //console.log("Bank Id: " + send_to);

                $.ajax({
                    url: 'api/send-funds',
                    type: 'post',
                    dataType: 'JSON',
                    data: formFields + '&is_wallet_refill=1&send_to=' + send_to,
                    success: function(data) {
                        //alert(JSON.stringify(meta.message));
                        //console.log("ttttt");
                        if (data.error_code == 0) {
                            //console.log(data);
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
                            //console.log(data);
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
</body>

</html>
