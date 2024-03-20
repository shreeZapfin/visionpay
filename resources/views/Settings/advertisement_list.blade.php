@extends('layouts.master')
@section('styles')
@endsection
@section('content')
                    <!-- PAGE-HEADER -->
                    <div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
                        <h1 class="page-title">Advertisement</h1>
                        <div>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/index')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Advertisement</li>
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
                                                    <!-- <button type="button" class="btn-fill btn btn-secondary" id='submit_button'
                                                        style="text-align: center; margin-top:30px; height : 35px; width: 80px;border-top-right-radius: 0.3rem;border-bottom-right-radius: 0.3rem; ">
                                                        Add</button> -->
                                                    <a href="{{ asset('add-advertisement') }}" class="btn-fill btn btn-secondary"
                                                    style="text-align: center; margin-top:30px; border-top-right-radius: 0.3rem;border-bottom-right-radius: 0.3rem; ">Add New Advertisement</a>
                                                </div>
                                            </div>
                                            <div class="e-table px-5 pb-5 pd-12">
                                                <div class="table-responsive table-lg">
                                                    <table class="table border-top table-bordered mb-0 text-nowrap" id="dataTable" style="width:100%;">
                                                        <thead class="border-top">
                                                            <tr>
                                                                <th class="border-bottom-0">Title</th>
                                                                <th class="border-bottom-0 ">Date</th>
                                                                <th class="border-bottom-0 ">Body</th>
                                                                <th class="border-bottom-0 ">Url</th>
                                                                <th class="border-bottom-0 ">Type</th>
                                                                <th class="border-bottom-0">Actions</th>
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
                    
@endsection
@section('scripts')
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
                            return '<td class="text-center"><div class="d-flex align-items-baseline justify-content-evenly gap-2"><button title="Disable Advertisement" data-advertisementid= "' +
                                row.id +'"  class="disable_advertisement btn-block btn btn-secondary" style="width: 70px;" >Disable</button><button title="Delete Advertisement" data-advertisementid="' +
                                row.id +'" class="advertisement_entry_delete btn btn-warning btn-fill-approve btn-block" style="width: 70px;">Delete</button></div></td>';
                        } else {
                            return '<td class="text-center"><div class="d-flex align-items-baseline justify-content-evenly gap-2"><button title="Enable Advertisement" data-advertisementid= "' +
                                row.id +'"  class="enable_advertisement btn-fill-approve btn btn-success btn-block" style="width: 70px;" >Enable</button><button title="Delete Advertisement" data-advertisementid="' +
                                row.id +'" class="advertisement_entry_delete btn btn-warning btn-fill-approve btn-block" style="width: 70px;">Delete</button></div></td>';
                        }

                    }

                }],
                "columns": [{
                        data: 'title',
                        className: "title text-wrap",
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
                        className: "faq_body text-wrap",
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
@endsection
