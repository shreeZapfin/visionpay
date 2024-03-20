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
                        <h1 class="page-title">Incomplete Registration</h1>
                        <div>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/index')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Incomplete Registration</li>
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
                                            <h5 class="m-0 font-weight-bold text-primary">App Grid</h5>
                                            {{-- <button type="submit" class="btn-fill btn" id='update_app_grid'
                                                style="float:right; margin-top: -20px;">Update</button> --}}
                                                <div class="e-table px-5 pb-5 pd-12">
                                                <div class="table-responsive table-lg">
                                                    <table class="table border-top table-bordered mb-0 text-nowrap" id="dataTable" style="width:100%;">
                                                        <thead class="border-top">
                                                            <tr>
                                                                <th class="border-bottom-0">Date</th>
                                                                <th class="border-bottom-0">Label</th>
                                                                <th class="border-bottom-0">Logo</th>
                                                                <th class="border-bottom-0">Type</th>
                                                                <th class="border-bottom-0">Redirect To</th>
                                                                <th class="border-bottom-0">Grid No</th>
                                                                <th class="border-bottom-0">Grid For</th>
                                                                <th class="border-bottom-0 ">App Grid For</th>
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
                                <!-- /.container-fluid -->
                                <div id='response'></div>
                            </div>
                        </div>
                        <!-- ROW CLOSED -->
                    </div>
                    <!-- CONTAINER CLOSED -->
   <!-- Modal  -->
<div class="modal fade" id="update_app_grid_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update App Grid</h5>
                    <button class="btn-close" type="button" data-dismiss="modal" aria-label="Close"></button>
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
                                        <select name="grid_no" id="grid_no" class="select2 form-control custom-select"
                                            required>
                                            <option value="1" selected="selected">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                        </select>
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
                                            <option value="App/Models/Biller">Biller</option>
                                            <option value="App/Models/BillerCategory">Biller Category</option>
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
                        <div class="px-4 py-4 text-center">
                            <button type="submit" class="btn btn-primary btn-rounded btn-fw" id='submit_button'
                                data-biller-id="" style="font-weight:500;">Update</button>
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        </div>
                        <div id='response'></div>
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
                "ajax": {
                    url: '{{ url('api/app-grid') }}',
                    data: function(d) {
                        d.request_origin = 'web'
                    },
                    // success:function(a){
                    //         console.log(a);
                    //     }
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
                        data: 'created_at',
                        className: "created_at",
                        render: function(data, type, row, meta) {
                            return moment.utc(data).local().format('DD/MM/YYYY HH:mm a');
                        }
                    },
                    {
                        data: 'label',
                        className: 'label'
                    },
                    {
                        data: 'logo_url',
                        className: 'logo_url',
                        render: function(data, type, row, meta) {
                            return '<img src="'+data+'"></img>';
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
                        data: 'grid_no',
                        className: 'grid_no'
                    },
                    {
                        data: 'grid_for',
                        className: 'grid_for'
                    },
                    {
                        data: 'app_grid_for.category_name',
                        className: 'category_name'
                    }

                ]

            });

            var spinner = $('#loader');

            $('#grid_for').on('change', function() {

                if (this.value == 'App/Models/Biller') {
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

                $('#appGridId').val(AppGridId);
                $('#Label').val(label);
                $('#logo_url').val(Logo_url);
                $('#type').val(Type);
                $('#redirect_to').val(Type);
                $('#grid_for').val(Grid_for);
                $('#grid_no').val(Grid_No);

                $('#update_app_grid_form').modal('show');
            });
            $('#app_Grid').on('submit', function(e) {
                e.preventDefault();
                spinner.show();
                var formFields = $('#app_Grid').serialize();
                $.ajax({
                    url: 'api/app-grid',
                    type: 'patch',
                    dataType: 'JSON',
                    data: formFields,
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

@endsection
