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


    {{-- Date Picker --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
    {{-- tabs --}}
    <link href="{{ asset('https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css') }}" rel="stylesheet">

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
                            <h5 class="m-0 font-weight-bold text-primary">FAQ</h5>
                            <button type="submit" class="btn-fill btn" id='add_faq_category'
                                style="float:right; margin-top: -20px;">Add New Category</button>
                        </div>

                        <div>
                            @if ($faq_categories)
                                <h5 class="m-0 font-weight-bold">Category List</h5>
                                @foreach ($faq_categories as $key)
                                    <div class="col-md-7">
                                        <button type="submit" class="btn-fill btn faq_category" id='faq_category'
                                            data-cat_id={{ $key->id }}
                                            style="background-color: rgb(199, 255, 208); color: rgb(30, 125, 39);  margin-top: 10px;">
                                            {{ $key->name }}</button>
                                        {{-- <h2 class="prod-name">

                {{ $key->name }}
            </h2> --}}
                                    </div>
                                @endforeach
                            @endif
                        </div>


                        <div class="card-body" id="category-list" style="display: none;">
                            <div class="table-responsive">
                                {{-- <h2 id="category-name"></h2> --}}
                                <button type="submit" class="btn-fill btn" id='add_new_faq'
                                    style="float:right; margin-top: 20px;">Add FAQ</button>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Question</th>
                                            <th class="text-center">Answer</th>
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
                <div id='response'></div>
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

    <!-- Add faq Modal-->
    <div class="modal fade" id="faq_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add FAQ</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span> </button>
                </div>
                <div class="modal-body">
                    <form name='addNewFaq' id='addNewFaq'>
                        <div class="row">
                            <div class="col-md-6" style="margin:0 auto; display:block;">
                                <div class="form-group">
                                    <label>Question</label>
                                    <div class="input-group">
                                        <input type="text" name="question" class="form-control" id="question"
                                            required>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Answer</label>
                                    <div class="input-group">
                                        <input type="text" name="answer" class="form-control" id="answer"
                                            required>

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

                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->

    <script src="{{ asset('vendor/datatables/jquery.dataTables.js') }}"></script>
    {{-- Date Picker --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>


    <script type="text/javascript">
        $(document).ready(function() {
            $(".navbar-nav li").removeClass("active"); //this will remove the active class from  
            $('#setting').addClass('active');

            //Add FAQ Category
            $("#add_faq_category").on('click', function() {

                Swal.fire({
                    title: "Enter Categoty Name",
                    text: "",
                    input: 'text',
                    showCancelButton: true
                }).then((result) => {
                    if (result.value) {
                        // console.log("inside");
                        // console.log("Result: " + result.value);
                        $.ajax({
                            url: 'api/faqs/categories',
                            type: 'post',
                            dataType: 'JSON',
                            data: {
                                name: result.value
                            },
                            success: function(data) {
                                //alert(JSON.stringify(meta.message));
                                // console.log("ttttt");
                                if (data.error_code == 0) {
                                    //console.log(data);

                                    //$('#dataTable').DataTable().ajax.reload();
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

            $(".faq_category").on('click', function() {
                $("#category-list").show();
                var category_id = $(this).data('cat_id');
                //console.log(category_id);

                $('#dataTable').DataTable({
                    "bLengthChange": false,
                    "processing": true,
                    "serverSide": true,
                    "searching": false,
                    /*  "paging": false,
                     "searching": false, */
                    "ajax": {
                        url: '{{ url('api/faq') }}',
                        data: function(d) {
                            d.request_origin = 'web',
                                d.category_id = category_id
                        }
                    },
                    //dataSrc: "faqs[]",
                    "columns": [{
                            data: 'faqs[<br><br>].question'
                        },
                        {
                            data: 'faqs[<br><br>].answer'
                        }
                    ]
                });

                var spinner = $('#loader');
                //Add FAQ
                $('#addNewFaq').on('submit', function(e) {
                    e.preventDefault();
                    spinner.show();
                    var formFields = $('#addNewFaq').serialize();

                    $.ajax({
                        url: 'api/faqs',
                        type: 'post',
                        dataType: 'JSON',
                        data: formFields + '&category_id=' + category_id,
                        success: function(data) {
                            //alert(JSON.stringify(meta.message));
                            //   console.log("ttttt");
                            if (data.error_code == 0) {
                                // console.log(data);
                                spinner.hide();
                                $('#faq_form').modal('hide');
                                $('#dataTable').DataTable().ajax.reload();
                                Swal.fire({
                                    title: "" + data.meta.message,
                                    icon: 'success',
                                    showCloseButton: true
                                })
                            } else {
                                swal(data.meta.message, "error");
                            }

                            $('#addNewFaq').closest('form').find(
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

            $("#add_new_faq").on('click', function() {

                $('#faq_form').modal('show');
            });



        });
    </script>
</body>

</html>
