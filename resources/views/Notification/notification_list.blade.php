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
                            <h5 class="m-0 font-weight-bold text-primary">Notification List</h5>
                            <button type="submit" class="btn-fill btn" id='submit_button'
                                style="float:right; margin-top: -20px;">Send Notification</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">Title</th>
                                            <th class="text-center">Body</th>
                                            <th class="text-center">User</th>
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

    <!-- Send Notification Model-->
    <div class="modal fade" id="add_notification_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Send Notification</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span> </button>
                </div>
                <div class="modal-body">
                    <form name='addNotification' id='addNotification'>
                        <div class="row">
                            <div class="col-md-6" style="margin:0 auto; display:block;">
                                <div class="form-group">
                                    <label>Select User Type</label>
                                    <div class="input-group">
                                        <select name="user_type_id" id="user_type_id"
                                            class="select2 form-control custom-select">
                                            <option value="2"> All Retail Customer </option>
                                            <option value="4">All Merchant </option>
                                            <option value="3">All Agent </option>
                                            <option value="0" selected="selected">For All Users</option>
                                            <option value="" id="IndvUsers">For Specific Users</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group" id="SpecificUsers" style="display: none;">
                                    {{-- <label>Specific User</label> --}}
                                    <div class="input-group">
                                        <select name="user_id[]" id="userList"
                                            class="js-example-basic-multiple select2 form-control" multiple="multiple">

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Title</label>
                                    <div class="input-group">
                                        <input type="text" name="title" class="form-control" id="title"
                                            required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Body</label>
                                    <div class="input-group">
                                        {{-- <input type="text" name="body" class="form-control" id="body" required> --}}
                                        <textarea class="form-control" id="body" rows="3" name="body" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <br><br>
                        </div>
                        <div id='response'></div>
                        <div style="text-align:center">
                            <button type="submit" class="btn btn-primary btn-rounded btn-fw" id='submit_button'
                                data-user-id="" style="font-weight:500;">Add</button>
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        </div>

                    </form>

                    <div id='response'></div>
                </div>

                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('vendor/datatables/jquery.dataTables.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".navbar-nav li").removeClass("active"); //this will remove the active class from  
            //previously active menu item 

            //multiple select option
            $('#user_type_id').on('change', function() {

                if (this.value == '') {
                    $("#SpecificUsers").show();
                } else {
                    $("#SpecificUsers").hide();
                }
            });
            $('.js-example-basic-multiple').select2({
                placeholder: "Select Specific users",
                allowClear: true
            });


            //Display  List 
            $('#dataTable').DataTable({
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                "bLengthChange": false,
                "processing": true,
                "serverSide": true,
                "searching": false,
                "ordering": false,
                "ajax": {
                    url: '{{ url('api/notification') }}',
                    data: function(d) {
                        d.search = d.search['value'],
                            d.request_origin = 'web'
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
                        data: 'title'
                    },
                    {
                        data: 'body'
                    },
                    {
                        data: 'user.username',
                        render: function(data, type, row) {
                            return '<b>UserName: </b>' + row.user.username +
                                '<br><b>PacpayId: </b> ' + row
                                .user
                                .pacpay_user_id + '<br><b>UserType: </b>' + row
                                .user
                                .user_type;
                        }
                    }
                ]

            });

            var spinner = $('#loader');

            //Get User List
            $.ajax({
                url: 'api/user/search',
                type: 'get',
                data: {
                    'request_origin': 'web'
                },
                success: function(data) {
                    //  console.log('data');
                    $('#userList').empty();

                    $.each(data.data, function($index, $value) {

                        $('#userList').append('</option>' +
                            '<option type="checkbox" value="' +
                            $value.id +
                            '" >' +
                            $value
                            .username + '</option>');

                    })
                }
            });

            //Add Notification
            $("#submit_button").on('click', function() {
                /* $('#add_notification_form').empty(); */
                $('#add_notification_form').modal('show');
            });
            i = 0;
            $('#addNotification').on('submit', function(e) {
                e.preventDefault();
                spinner.show();

                var formFields = $('#addNotification').serialize();

                $.ajax({
                    url: 'api/alert',
                    type: 'post',
                    dataType: 'JSON',
                    data: formFields,
                    success: function(data) {
                        //alert(JSON.stringify(meta.message));
                        // console.log("ttttt");
                        if (data.error_code == 0) {
                            //console.log(data);
                            spinner.hide();
                            $('#add_notification_form').modal('hide');
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

                        $('#addNotification').closest('form').find(
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
                                        "<br/>"
                                    ); //this is my div with messages
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
