@extends('layouts.master')
@section('styles')
<style>
    .voucher_description{
        width: 150px !important;
        border:1px solid red;
    }
</style>
@endsection
@section('content')
                    <!-- PAGE-HEADER -->
                    <div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
                        <h1 class="page-title">FAQ</h1>
                        <div>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/index')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">FAQ</li>
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
                                        <div class="align-items-center d-flex justify-content-between pb-2">
                                          
                                           <h5 class="m-0 font-weight-bold">Category List</h5>
                                           <button type="submit" class="btn-fill btn btn-secondary" id='add_faq_category'>Add New Category</button>

                                        </div>
                                        <div class="align-items-center d-flex gap-3">        
                                            @if ($faq_categories)                                          
                                                @foreach ($faq_categories as $key)
                                                    <button type="submit" class="btn-fill btn faq_category" id='faq_category_{{$key}}'
                                                        data-cat_id={{ $key->id }}
                                                        style="background-color: rgb(199, 255, 208); color: rgb(30, 125, 39);  margin-top: 10px;">
                                                        {{ $key->name }}</button>
                                                    {{-- <h2 class="prod-name">
                                                    {{ $key->name }}
                                                    </h2> --}}
                                                @endforeach
                                            @endif
                                        </div>
                                            <div class="e-table pb-5 pd-12 pt-3" id="category-list" style="display: none;">

                                            <button type="submit" class="btn-fill btn btn-primary" id='add_new_faq'
                                                    style="float:right; margin-top: 20px;">Add FAQ</button>
                                                <div class="table-responsive table-lg">
                                                {{-- <h2 id="category-name"></h2> --}}
                                               
                                                    <table class="table border-top table-bordered mb-0 text-nowrap complaintdtable faqtable" style="width:100%;max-width: 100%;min-width: 100%;" id="dataTable">
                                                        <thead class="border-top">
                                                            <tr>
                                                                <th class="border-bottom-0">Question</th>
                                                                <th class="border-bottom-0">Answer</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        <!-- </div> -->
                                    </div>
                                    
                                </div>
                                <!-- /.container-fluid -->
                                <div id='response'></div>
                            </div>
                        </div>
                        <!-- ROW CLOSED -->
                    </div>
                    <!-- CONTAINER CLOSED -->
   
   <!-- Add faq Modal-->
   <div class="modal fade" id="faq_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add FAQ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4">
                    <form name='addNewFaq' id='addNewFaq'>
                        <div class="row gy-3">
                                <div class="col-xl-12">
                                    <label>Question</label>
                                        <input type="text" name="question" class="form-control" id="question"
                                            required>
                                </div>
                                <div class="col-xl-12">
                                    <label>Answer</label>
                                        <input type="text" name="answer" class="form-control" id="answer"
                                            required>
                                </div>
                        </div>
                        <div class="text-center px-4 py-4">
                            <button type="submit" class="btn btn-primary btn-rounded btn-fw" id='submit_button'
                                data-user-id="" style="font-weight:500;">Add</button>
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')

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
@endsection
