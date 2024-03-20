@extends('layouts.master')
@section('styles')
@endsection
@section('content')
                    <!-- PAGE-HEADER -->
                    <div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
                        <h1 class="page-title">Services</h1>
                        <div>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/index')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Services</li>
                            </ol>
                        </div> 
                    </div>
                    <!-- PAGE-HEADER END -->

                    <!-- CONTAINER -->
                    <div class="main-container container-fluid">
                        <!-- ROW OPEN -->
                        <div class="row row-cards">
                            <div class="tab-content mb-5">
                                <div class="tab-pane active" id="tab-11">
                                    <div class="card p-0">
                                        <div class="card-body p-4">
                                            <div class="row align-items-center">
                                                <!-- <form name='filter_search' id='filter_search' style="margin-top: 20px;"> -->
                                                    <div class="input-group">
                                                        <div class="input-group col-sm justify-content-end pb-3">
                                                                <button type="button" class="btn-fill btn btn-secondary" id='submit_button'
                                                                style="text-align: center; margin-top:30px; height : 35px; width: 80px;border-top-right-radius: 0.3rem;border-bottom-right-radius: 0.3rem; ">
                                                                Add</button>
                                                        </div>
                                                    </div>
                                                <!-- </form> -->
                                                <div class="e-table px-5 pb-5 pd-12">
                                                    <div class="table-responsive table-lg">
                                                        <table class="table border-top table-bordered mb-0 text-nowrap incomplete_registration" id="dataTable" style="width:100%;">
                                                            <thead class="border-top">
                                                                <tr>
                                                                    <th class="border-bottom-0">Created At</th>
                                                                    <th class="border-bottom-0">Category Name</th>
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
                                <!-- /.container-fluid -->
                                <div id='response'></div>
                            </div>
                        </div>
                        <!-- ROW CLOSED -->
                    </div>
                    <!-- CONTAINER CLOSED -->
@endsection
@section('scripts')
<script type="text/javascript">
        $(document).ready(function() {
            $(".navbar-nav li").removeClass("active"); //this will remove the active class from  
            //previously active menu item 
            $('#bill_payment').addClass('active');

            //Display Bank List 
            $('#dataTable').DataTable({
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                "bLengthChange": true,
                "processing": true,
                "serverSide": true,
                "searching": true,
                "ajax": {
                    url: '{{ url('api/biller-category') }}',
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
                        data: 'category_name'
                    }
                ]

            });



            //Add Biller Category(Services)
            $("#submit_button").on('click', function() {

                Swal.fire({
                    title: "Enter Service Category Name",
                    text: "",
                    input: 'text',
                    showCancelButton: true
                }).then((result) => {
                    if (result.value) {
                        console.log("inside");
                        console.log("Result: " + result.value);
                        $.ajax({
                            url: 'api/biller-category',
                            type: 'post',
                            dataType: 'JSON',
                            data: {
                                category_name: result.value
                            },
                            success: function(data) {
                                //alert(JSON.stringify(meta.message));
                                console.log("ttttt");
                                if (data.error_code == 0) {
                                    console.log(data);

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
                    }
                });

            });
        });
    </script>

@endsection
