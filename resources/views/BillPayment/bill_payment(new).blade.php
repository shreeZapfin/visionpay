<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pacpay Admin Panel</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css') }}"
        rel="stylesheet" media="screen" />
    <link href="{{ asset('http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css') }}"
        rel="stylesheet">
    <link rel="stylesheet"
        href="{{ asset('http://fortawesome.github.io/Font-Awesome/3.2.1/assets/font-awesome/css/font-awesome.css') }}">
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="{{ asset('https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i') }}"
        rel="stylesheet">
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet" media="screen" />
    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <link rel="stylesheet"
        href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.css') }}">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Country Code -->
    <link href="{{ asset('css/intlTelInput.css') }}" rel="stylesheet">
    <link href="{{ asset('css/demo.css') }}" rel="stylesheet">

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
                            <h5 class="m-0 font-weight-bold text-primary">Bill Payment</h5>
                            <button type="submit" class="btn-fill btn" id='submit_button'
                                style="float:right; margin-top: -20px;">Add</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <h2>Biller List</h2>
                                    <thead>
                                        <tr>
                                            <th class="text-center">Created At</th>
                                            <th class="text-center">BILLER NAME</th>
                                            <th class="text-center">Logo</th>
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
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="{{ asset('#page-top') }}">
        <i class="fas fa-angle-up"></i> </a>

    {{-- Add Biller --}}
    <div class="modal fade" id="biller_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Biller</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span> </button>
                </div>
                <div class="modal-body">
                    <form name='addNewBiller' id='addNewBiller' enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6" style="margin:0 auto; display:block;">
                                <div class="form-group">
                                    <label>Mobile Number</label>
                                    <div class="input-group">
                                        <input type="text" name="mobile_no" class="form-control" id="mobile_no"
                                            required>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <div class="input-group">
                                        <input type="email" name="email" class="form-control" id="email" required>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <div class="input-group">
                                        <input type="text" name="username" class="form-control" id="username"
                                            value="$" pattern="^[$].{8,}"
                                            title="Must start with $ sign followed by at least 8 or more characters"
                                            required>

                                    </div>
                                </div>




                            </div>

                            <div class="col-md-6" style="margin:0 auto; display:block;">
                                <div class="form-group">
                                    <label>Biller Name</label>
                                    <div class="input-group">
                                        <input type="text" name="biller_name" class="form-control" id="biller_name"
                                            required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Select Service Category</label>
                                    <select class="select2 form-control custom-select" name="biller_category_id"
                                        id="biller_category_id" required>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Upload Logo</label>
                                    <div class="input-group">
                                        <input type="file" name="biller_img" class="form-control" id="biller_img"
                                            required>
                                    </div>
                                </div>


                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <label>Add Fields</label>
                                <a href="javascript:void(0);" class="add_button" style="margin:0px"
                                    title="Add more fields"><img src="" /><i class="material-icons">add</i></a>


                                <label>Remove Fields</label>
                                <a href="javascript:void(0);" class="remove_button" style="margin:0px"
                                    title="Add more fields"><img src="" /><i class="material-icons">add</i></a>

                                <div class="fields">


                                    <div class="row">
                                        <div class="col-md-4" style="margin:0 auto; display:block;">
                                            <div class="form-group">
                                                <label>Placeholder</label>
                                                <div class="input-group">
                                                    <input type="text" name="biller_fields[fields][][name]" value=""
                                                        class="form-control"
                                                        title="Placeholder(e.g. Mobile No, Biller No.)" required />
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-md-4" style="margin:0 auto; display:block;">
                                            <div class="form-group">
                                                <label>Validate</label>
                                                <div class="input-group">
                                                    <input type="checkbox" class="checkboxClass" name="biller_fields[fields][][check_regex]"
                                                        id="checkbox1" value="false">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4" style="margin:0 auto; display:block;">

                                            <div class="form-group" style="display: none;" id="regex">
                                                <label>Regex</label>
                                                <div class="input-group">
                                                    <input type="text" name="biller_fields[fields][][regex]" value=""
                                                        class="form-control" title="To validate placeholder" />

                                                </div>
                                                <a href="https://regex-generator.olafneumann.org/?sampleText=1458795647&flags=i&onlyPatterns=false&matchWholeLine=false&selection="
                                                    target="_blank" class="" style="margin:0px"
                                                    title="Add more fields">Generate Regex</a>
                                            </div>
                                        </div>



                                    </div>
                                </div>
                            </div>

                        </div>
                </div>
                <input type="hidden" name="user_type_id" value="5">
                <input type="hidden" name="device_name" value="web">
                <div style="text-align:center; padding:5%">
                    <button type="submit" class="btn btn-primary btn-rounded btn-fw" id='submit_button' data-user-id=""
                        style="font-weight:500;">Add</button>
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
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.js"></script>
    <script src="{{ asset('vendor/moment/moment.min.js') }}"></script>
    {{-- country code --}}
    <script src="js/intlTelInput.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".navbar-nav li").removeClass("active"); //this will remove the active class from  
            //previously active menu item 
            $('#bill_payment').addClass('active');

            //country code
            var input = document.querySelector("#mobile_no");
            window.intlTelInput(input, {

                utilsScript: "js/utils.js",
            });


            //Display Biller 
            $('#dataTable').DataTable({
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                "bLengthChange": false,
                "processing": true,
                "serverSide": true,
                "searching": false,
                "ajax": {
                    url: '{{ url('api/biller') }}',
                    data: function(d) {
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
                        data: 'biller_name',
                        className: "biller_name",
                    },
                    {
                        "render": function(data, type, JsonResultRow, meta) {
                            return '<img src="' + JsonResultRow.biller_img_url +
                                '"height="75" width="75" alt="Logo">';
                        }
                    }
                ]

            });

            function getImg(data, type, full, meta) {
                //
                return '<img  src="your image path(imgsrc )" />';
            }

            //Add Biller
            $("#submit_button").on('click', function() {
                $('#biller_form').modal('show');

                //Get biller category list
                $.ajax({
                    url: 'api/biller-category',
                    type: 'get',
                    success: function(data) {
                        console.log('data');
                        $('#biller_category_id').empty();
                        $.each(data.data, function($index, $value) {

                            $('#biller_category_id').append('<option value="' + $value
                                .id + '" >' + $value
                                .category_name + '</option>');
                        })
                    }
                });
            });

            $(".checkboxClass").on('change', function() {
                if ($(this).is(':checked')) {
                    $(this).attr('value', 'true');
                    console.log( $(this).parent().next());
                    $(this).parent().next().find($("#regex")).show();
                } else {
                    console.log( $(this).parent().next());
                    $(this).attr('value', 'false');
                    $(this).parent().next().find($("#regex")).show();
                }
            });

            var maxField = 10;
            var addButton = $('.add_button');
            var removeButton = $('.remove_button');
            var addfields = $('.fields');
            // var inputField =
            //     '<div style="margin-top:5px;"><input type="text" name="biller_fields[fields][][name]" value="" class="form-control" title="Placeholder(e.g. Mobile No, Biller No.)"/> <input type="checkbox" name="biller_fields[fields][][check_regex]" id="checkbox1" value="false" />  <input type="text" name="biller_fields[fields][][regex]" value="" title="To validate placeholder"/> </div>';

            var inputField =
                '  <div class="row"><div class="col-md-4" style="margin:0 auto; display:block;"> <div class="form-group"><label>Placeholder</label><div class="input-group"> <input type="text" name="biller_fields[fields][][name]" value=""class="form-control" title="Placeholder(e.g. Mobile No, Biller No.)" required /></div> </div> </div><div class="col-md-4" style="margin:0 auto; display:block;"><div class="form-group"><label>Validate</label><div class="input-group"><input type="checkbox" name="biller_fields[fields][][check_regex]"id="checkbox1" class="checkboxClass" value="false"></div></div></div><div class="col-md-4" style="margin:0 auto; display:block;"><div class="form-group" style="display: none;" id="regex"><label>Regex</label><div class="input-group"><input type="text" name="biller_fields[fields][][regex]" value=""class="form-control" title="To validate placeholder" /></div><a href="https://regex-generator.olafneumann.org/?sampleText=1458795647&flags=i&onlyPatterns=false&matchWholeLine=false&selection="target="_blank" class="" style="margin:0px"title="Add more fields">Generate Regex</a> </div></div>';
            var i = 1;

            $(addButton).click(function() {
                if (i < maxField) {
                    i++;
                    $(addfields).append(inputField);
                    $(addfields).children.add(inputField);
                }
            });

            $(removeButton).click(function() {

                $(addfields).children().last().remove();

            });



            $('#addNewBiller').on('submit', function(e) {
                e.preventDefault();
                var password = Math.floor(10000000 + Math.random() * 90000000);
                var password_confirmation = password;

                $("<input />").attr("type", "hidden")
                    .attr("name", "password")
                    .attr("value", password)
                    .appendTo("#addNewBiller");

                $("<input />").attr("type", "hidden")
                    .attr("name", "password_confirmation")
                    .attr("value", password)
                    .appendTo("#addNewBiller");

                //var formFields =  $('#addNewBiller').serialize();
                var formFields = new FormData(this);
                //console.log("FormFields: " + formFields);

                $.ajax({
                    url: 'api/user',
                    type: 'post',
                    dataType: 'JSON',
                    data: formFields,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        //alert(JSON.stringify(meta.message));
                        console.log("ttttt");
                        if (data.error_code == 0) {
                            console.log(data);
                            $('#biller_form').modal('hide');
                            $('#dataTable').DataTable().ajax.reload();
                            Swal.fire({
                                title: "" + data.meta.message,
                                icon: 'success',
                                showCloseButton: true
                            })
                        } else {
                            swal(data.meta.message, "error");
                        }

                        $('#addNewBiller').closest('form').find(
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
                                        console.log(key + " " +
                                            value);
                                        $('#response').show()
                                            .append(value +
                                                "<br/>");

                                    });
                                } else {
                                    $('#response').show().append(value +
                                        "<br/>"
                                    ); //this is my div with messages
                                }
                            });
                        }

                    }



                });
            });

            $("#biller_form").on("hide.bs.modal", function() {

                window.location.reload();
            });

        });
    </script>
</body>

</html>
