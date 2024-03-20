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
                            <h5 class="m-0 font-weight-bold text-primary">Advertisement</h5>
                            <a href="{{ asset('add-advertisement') }}" class="btn-fill btn"
                                style="float:right; margin-top: -20px;">Add New Advertisement</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">TITLE</th>
                                            <th class="text-center">DATE</th>
                                            <th class="text-center">BODY</th>
                                            <th class="text-center">URL</th>
                                            <th class="text-center">TYPE</th>
                                            <th class="text-center">STATUS</th>
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

    <script src="{{ asset('vendor/datatables/jquery.dataTables.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".navbar-nav li").removeClass("active"); //this will remove the active class from  
            //previously active menu item 
            $('#setting').addClass('active');

            //Display Bank List 
            $('#dataTable').DataTable({
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                "processing": true,
                "serverSide": true,
                "searching": false,
                "ajax": {
                    url: '{{ url('api/advertisement') }}',
                    data: function(d) {
                        d.search = d.search['value'],
                            d.request_origin = 'web'
                    }

                },
                columnDefs: [{
                    targets: 5,
                    render: function(data, type, row, meta) {
                        // console.log('data');

                        if (row.status == 1) {
                            return '<td class="text-center"><button title="Disable Advertisement" data-advertisementid= "' +
                                row
                                .id +
                                '"  class="btn disable_advertisement btn-block" style="background-color: rgb(95,158,160); color: rgb(255,255,255); width: 80px;" >Disable </button>&nbsp;&nbsp;&nbsp;<button title="Delete Advertisement" data-advertisementid="' +
                                row.id +
                                '" class="advertisement_entry_delete btn btn-fill-approve btn-block" style="width: 80px; background-color: rgb(255,0,0)">Delete</button></td>';


                        } else {
                            return '<td class="text-center"><button title="Enable Advertisement" data-advertisementid= "' +
                                row
                                .id +
                                '"  class="btn enable_advertisement btn-fill-approve btn-block" style="background-color: rgb(0,128,0); width: 80px;" >Enable</button>&nbsp;&nbsp;&nbsp;<button title="Delete Advertisement" data-advertisementid="' +
                                row.id +
                                '" class="btn advertisement_entry_delete btn-fill-approve btn-block" style="width: 80px;  background-color: rgb(255,0,0)">Delete</button></td>';
                        }


                    }

                }],
                "columns": [{
                        data: 'title',
                        className: "title",
                    },
                    {
                        data: 'created_at',
                        className: "created_at",
                        render: function(data, type, row, meta) {
                            return moment.utc(data).local().format('DD/MM/YYYY HH:mm a');
                        }
                    },
                    {
                        data: 'body',
                        className: "body",
                    },
                    {
                        "render": function(data, type, JsonResultRow, meta) {
                            return '<img src="' + JsonResultRow.advertisement_img_url +
                                '"height="75" width="75">';
                        }
                    },
                    {
                        data: 'advertisement_type',
                        className: "advertisement_type",
                    }
                ]

            });

            //Disable Advertisement
            $("#dataTable").on('click', '.disable_advertisement', function() {
                //d.preventDefault();

                var AdvertisementId = $(this).data('advertisementid');
                // console.log("UserId: " + AdvertisementId);

                Swal.fire({
                    title: "Do you want to Disable this advertisement?",
                    text: "",
                    showCancelButton: true
                }).then((result) => {
                    if (result.value) {
                        //console.log("Result: " + result.value);
                        $.ajax({
                            url: '{{ url('api/advertisement') }}/' + AdvertisementId +
                                '/status',
                            type: 'patch',
                            dataType: 'JSON',
                            data: {
                                'status': 0
                            },
                            success: function(data) {
                                //alert(JSON.stringify(meta.message));
                                // console.log("ttttt");
                                if (data.error_code == 0) {
                                    //console.log(data);

                                    $('#dataTable').DataTable().ajax.reload();
                                    Swal.fire({
                                        title: "" + data.meta.message,
                                        icon: 'success',
                                        showCloseButton: true
                                    })
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
                    }
                });
            });
            //Enable Advertisement
            $("#dataTable").on('click', '.enable_advertisement', function() {
                var AdvertisementId = $(this).data('advertisementid');
                // console.log("UserId: " + AdvertisementId);

                Swal.fire({
                    title: "Do you want to Enable this advertisement?",
                    text: "",
                    showCancelButton: true
                }).then((result) => {
                    if (result.value) {
                        //  console.log("Result: " + result.value);
                        $.ajax({
                            url: '{{ url('api/advertisement') }}/' + AdvertisementId +
                                '/status',
                            type: 'patch',
                            dataType: 'JSON',
                            data: {
                                'status': 1
                            },
                            success: function(data) {
                                //alert(JSON.stringify(meta.message));
                                // console.log("ttttt");
                                if (data.error_code == 0) {
                                    // console.log(data);

                                    $('#dataTable').DataTable().ajax.reload();
                                    Swal.fire({
                                        title: "" + data.meta.message,
                                        icon: 'success',
                                        showCloseButton: true
                                    })
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
                    }
                });
            });



            //Delete Advertisement
            $("#dataTable").on('click', '.advertisement_entry_delete', function() {
                //console.log("uiioi");
                var advertisementId = $(this).data('advertisementid');
                //console.log("advertisementid: " + advertisementId);

                Swal.fire({
                    title: "Do you want to delete this advertisement?",
                    text: "",
                    showCancelButton: true
                }).then((result) => {
                    if (result.value) {
                        // console.log("Result: " + result.value);
                        $.ajax({
                            url: 'api/advertisement/' + advertisementId,
                            type: 'delete',
                            dataType: 'JSON',

                            success: function(data) {
                                //alert(JSON.stringify(meta.message));
                                // console.log("ttttt");
                                if (data.error_code == 0) {
                                    // console.log(data);

                                    $('#dataTable').DataTable().ajax.reload();
                                    Swal.fire({
                                        title: "" + data.meta.message,
                                        icon: 'success',
                                        showCloseButton: true
                                    })
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
                    }
                });

                $('#submit_button').attr('data-bnk-id', $(this).data('bankid'));
            });

        });
    </script>
</body>

</html>
