@extends('layouts.master')
@section('styles')
@endsection
@section('content')
                    <!-- PAGE-HEADER -->
                    <div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
                        <h1 class="page-title">Notification List</h1>
                        <div>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/index')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Notification List</li>
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
                                            <div class="input-group">
                                                <div class="input-group col-sm justify-content-end pb-3">
                                                    <button type="submit" class="btn-fill btn btn-secondary" id='submit_button'>Send Notification</button>                                                
                                                </div>
                                            </div>
                                            <div class="e-table px-5 pb-5 pd-12">
                                                <div class="table-responsive table-lg">
                                                    <table class="table border-top table-bordered mb-0 text-nowrap" id="dataTable" style="width:100%;">
                                                        <thead class="border-top">
                                                            <tr>
                                                                <th class="border-bottom-0 ">Date</th>
                                                                <th class="border-bottom-0 ">Title</th>
                                                                <th class="border-bottom-0 ">Body</th>
                                                                <th class="border-bottom-0 ">User</th>
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
                        </div>
                        <!-- ROW CLOSED -->
                    </div>
                    <!-- CONTAINER CLOSED -->
                    <!-- Send Notification Model-->
    <div class="modal fade" id="add_notification_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Send Notification</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body px-4">
                    <form name='addNotification' id='addNotification'>
                        <div class="row gy-3">
                                <div class="col-xl-12">
                                    <label>Select User Type</label>
                                        <select name="user_type_id" id="user_type_id"
                                            class="select2 form-control custom-select">
                                            <option value="2"> All Retail Customer </option>
                                            <option value="4">All Merchant </option>
                                            <option value="3">All Agent </option>
                                            <option value="0" selected="selected">For All Users</option>
                                            <option value="" id="IndvUsers">For Specific Users</option>
                                        </select>
                                </div>
                                <div class="col-xl-12" id="SpecificUsers" style="display: none;">
                                    {{-- <label>Specific User</label> --}}
                                        <select name="user_id[]" id="userList"
                                            class="js-example-basic-multiple select2 form-control" multiple="multiple">
                                        </select>
                                </div>
                                <div class="col-xl-12">
                                    <label>Title</label>
                                        <input type="text" name="title" class="form-control" id="title"
                                            required>
                                </div>
                                <div class="col-xl-12">
                                    <label>Body</label>
                                        {{-- <input type="text" name="body" class="form-control" id="body" required> --}}
                                        <textarea class="form-control" id="body" rows="3" name="body" required></textarea>
                                </div>
                            </div>
                        <div id='response'></div>
                        <div class="text-center px-4 py-4">
                            <button type="submit" class="btn btn-primary btn-rounded btn-fw" id='submit_button'
                                data-user-id="" style="font-weight:500;">Add</button>
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal" id="cancel_btn">Cancel</button>
                        </div>
                    </form>
                    <div id='response'></div>
                </div>
            </div>
        </div>
    </div>    
@endsection
@section('scripts')
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
                        data: 'body',
                        className:'text-wrap'
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
@endsection
