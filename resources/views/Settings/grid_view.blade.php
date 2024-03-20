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
                            <h5 class="m-0 font-weight-bold text-primary">App Grid</h5>
                            {{-- <button type="submit" class="btn-fill btn" id='update_app_grid'
                                style="float:right; margin-top: -20px;">Update</button> --}}
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Grid No</th>
                                            <th class="text-center">Label</th>
                                            <th class="text-center">Logo</th>
                                            <th class="text-center">Type</th>
                                            <th class="text-center">Redirect To</th>
                                            <th class="text-center">App Grid For</th>
                                            <th class="text-center">Grid For</th>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">Action</th>
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

    {{-- update app grid --}}
    <div class="modal fade" id="update_app_grid_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update App Grid</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span> </button>
                </div>
                <div class="modal-body">

                    <form id="app_Grid">

                        <div class="row">
                            <div class="col-md-6" style="margin:0 auto; display:block;">
                                <input type="hidden" name="id" value="id" id="appGridId">
                                <input type="hidden" name="redirect_to" value="redirect_to" id="redirect_to">

                                <div class="form-group">
                                    <label>Grid No</label>
                                    <div class="input-group">
                                        <input type="text" name="grid_no" class="form-control" id="grid_no"
                                            required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Label</label>
                                    <div class="input-group">
                                        <input type="text" name="label" class="form-control" id="Label"
                                            required>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Logo URL</label>
                                    <div class="input-group">
                                        <input type="text" name="logo_url" class="form-control" id="logo_url"
                                            required>
                                        <div title="Upload Image" id="UploadImageUrl">
                                            <i class="fa fa-upload" style="padding: 5px;"></i>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label>Type</label>
                                    <div class="input-group">
                                        <select name="type" id="type"
                                            class="select2 form-control custom-select" required>
                                            <option value="category" selected="selected">Category</option>
                                            <option value="singular">Singular</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Grid For</label>
                                    <div class="input-group">
                                        <select name="grid_for" id="grid_for"
                                            class="select2 form-control custom-select" required>
                                            <option value="" selected="selected">Select Biller / Biller Category
                                            </option>
                                            <option value="App\Models\Biller" data-selected-id="biller">Biller
                                            </option>
                                            <option value="App\Models\BillerCategory"
                                                data-selected-id="biller_category">Biller Category</option>
                                        </select>
                                    </div>
                                </div>
                                <div id="redirect_option" style="display: none;">
                                    <div class="form-group">
                                        <label>Biller</label>
                                        <select name="unique_id" id="unique_id"
                                            class="select2 form-control custom-select" required>

                                        </select>
                                    </div>
                                </div>

                            </div>


                        </div>
                        <div style="text-align:center; padding:5%">
                            <button type="submit" class="btn btn-primary btn-rounded btn-fw" id='submit_button'
                                data-biller-id="" style="font-weight:500;">Update</button>
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        </div>

                        <div id='response'></div>

                    </form>

                </div>

                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
    {{-- upload image on aws --}}
    <div class="modal fade" id="add_image_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Add Image</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span> </button>
                </div>
                <div class="modal-body">
                    <form name='addImage' id='addImage' enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6" style="margin:0 auto; display:block;">
                                <div class="form-group">
                                    <label>Upload Image</label>
                                    <div class="input-group">
                                        <input type="file" name="image" class="form-control" id="image"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <br><br>
                        </div>
                        <div style="text-align:center">
                            <button type="submit" class="btn btn-primary btn-rounded btn-fw"
                                id='image_submit_button' data-user-id="" style="font-weight:500;">Add</button>
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        </div>

                    </form>


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
                "bPaginate": false,
                "bInfo": false,
                "ajax": {
                    url: '{{ url('api/app-grid') }}',
                    data: function(d) {
                        d.request_origin = 'web'
                    }
                },

                columnDefs: [{
                    targets: 8,
                    render: function(data, type, row, meta) {
                        return '<td class="text-center"><button data-appgridid="' +
                            row.id +
                            '" class="btn_app_grid btn" style="color: rgb(30, 50, 250);"><i class="fas fa-fw fa-edit"></i></button></td>';
                    }

                }],
                "columns": [{
                        data: 'grid_no',
                        className: 'grid_no'
                    },
                    {
                        data: 'label',
                        className: 'label'
                    },
                    {
                        "render": function(data, type, JsonResultRow, meta) {
                            return '<img src="' + JsonResultRow.logo_url +
                                '"height="75" width="75" alt="Biller Logo">';
                        }
                    },
                    {
                        data: 'type',
                        className: 'type'
                    },
                    {
                        data: 'redirect_to',
                        className: 'redirect_to'
                    },
                    {
                        data: 'app_grid_for',
                        className: 'category_name',
                        render: function(data, type, row, meta) {
                            console.log(row.app_grid_for);
                            if (row.app_grid_for != null) {
                                if (row.app_grid_for.hasOwnProperty('category_name'))
                                    return row.app_grid_for.category_name;
                                else
                                    return row.app_grid_for.biller_name;
                            } else {
                                return "-"
                            }
                        }
                    },
                    {
                        data: 'grid_for',
                        className: 'grid_for'
                    },
                    {
                        data: 'created_at',
                        className: "created_at",
                        render: function(data, type, row, meta) {
                            return moment.utc(data).local().format('DD/MM/YYYY HH:mm a');
                        }
                    }

                ]

            });

            var spinner = $('#loader');

            $('#grid_for').on('change', function() {

                if ($(this).find(":selected").text() === "Biller") {
                    $("#redirect_option").show();
                    $.ajax({
                        url: 'api/biller',
                        type: 'get',
                        success: function(data) {
                            // console.log('data');
                            $('#unique_id').empty();
                            // $("#unique_id").append(new Option("Select Biller", ""));
                            $.each(data.data.data, function($index, $value) {

                                $('#unique_id').append('</option>' + '<option value="' +
                                    $value.id +
                                    '" >' +
                                    $value
                                    .biller_name + '</option>');
                            })
                        }
                    });
                } else {
                    $("#redirect_option").show();
                    $.ajax({
                        url: 'api/biller-category',
                        type: 'get',
                        data: function(d) {
                            d.request_origin = 'web'
                        },
                        success: function(data) {
                            // console.log('data');
                            $('#unique_id').empty();
                            //$("#unique_id").append(new Option("Select Biller Category", ""));
                            $.each(data.data, function($index, $value) {

                                $('#unique_id').append('<option value="' + $value
                                    .id + '" >' + $value
                                    .category_name + '</option>');
                            })
                        }
                    });
                }
            });

            function convertFormToJSON(form) {
                return $(form)
                    .serializeArray()
                    .reduce(function(json, {
                        name,
                        value
                    }) {
                        json[name] = value;
                        return json;
                    }, {});
            }

            //Update AppGrid
            $("#dataTable").on('click', '.btn_app_grid', function() {
                var AppGridId = $(this).data('appgridid');
                console.log("AppGridId: ", AppGridId);


                var label = $(this).closest('tr').find('.label').text();
                var Logo_url = $(this).closest('tr').find('.logo_url')
                    .text();
                var Type = $(this).closest('tr').find('.type').text();
                var Grid_for = $(this).closest('tr').find('.grid_for').text();
                var Grid_No = $(this).closest('tr').find('.grid_no').text();
                var unique_id = $(this).closest('tr').find('.grid_no').text();



                $('#appGridId').val(AppGridId);
                $('#Label').val(label);
                $('#logo_url').val(Logo_url);
                $('#type').val(Type);
                $('#redirect_to').val(Type);
                $('#grid_for').val(Grid_for);
                $('#grid_no').val(Grid_No);


                $("div.grid_for select").val(Grid_for);
                $("div.type select").val(Type);
                $("div.unique_id select").val(unique_id);



                $('#update_app_grid_form').modal('show');


            });
            $('#UploadImageUrl').click(function() {
                $('#add_image_form').modal('show');
            });
            $('#addImage').on('submit', function(e) {
                e.preventDefault();
                console.log("onclick of add button");

                var formFields = new FormData(this);

                $.ajax({
                    url: 'api/image/upload',
                    type: 'post',
                    dataType: 'JSON',
                    data: formFields,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        //alert(JSON.stringify(meta.message));
                        console.log("ttttt");
                        $('#add_image_form').modal('hide');
                        $('#logo_url').val(data.file_name);
                        console.log("ImgUrl: " + data.file_name);

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
            $('#app_Grid').on('submit', function(e) {
                e.preventDefault();
                spinner.show();
                // var formFields = $('#app_Grid').serialize();
                var formFields = convertFormToJSON($('#app_Grid'));
                $.ajax({
                    url: 'api/app-grid',
                    type: 'patch',
                    dataType: 'JSON',
                    data: {
                        app_grid: [formFields]
                    },
                    success: function(data) {
                        //alert(JSON.stringify(meta.message));
                        console.log("ttttt");
                        if (data.error_code == 0) {
                            console.log(data);
                            spinner.hide();
                            $('#update_app_grid_form').modal('hide');
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
