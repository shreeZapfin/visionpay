
@extends('layouts.master')

@section('styles')

@endsection

@section('content')
	
                    <!-- PAGE-HEADER -->
                    <div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
                        <h1 class="page-title">Add New Advertisement</h1>
                        <div>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/index')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add Advertisement</li>
                            </ol>
                        </div>
                    </div>
                    <!-- PAGE-HEADER END -->
                    
                    <!-- CONTAINER -->
                    <div class="main-container container-fluid adduser_container">
                        <!-- ROW-1 -->
                        <div class="row justify-content-center">
                            <div class="col-xl-12 p-0">
                                <form name='add_user_form' id='add_user_form'>
                                    @csrf
                                    <div class="card">
                                        <div class="card-body">
                                                <div class="row">
                                                    <div class="col-xl-6 col-lg-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label class="fw-semibold mt-4">Title</label>
                                                        <div class="input-group">
                                                            <input type="text" name="title" class="form-control"
                                                                id="title" required>
                                                        </div>
                                                    </div>
                                                    </div>   
                                                    <div class="col-xl-6 col-lg-6 col-sm-6">
                                                        <div class="form-group">
                                                            <label class="fw-semibold mt-4">Body</label>
                                                            <div class="input-group">
                                                            <textarea id="w3review" name="body" class="form-control" id="body" rows="4" cols="50"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-6 col-lg-6 col-sm-6">
                                                        <div class="form-group">
                                                            <label>Type</label>
                                                            <div class="input-group">
                                                                <select name="advertisement_type" id="advertisement_type"
                                                                    class="select2 form-control custom-select" required>
                                                                    <option value="Select advertisement type" selected="selected">Select
                                                                        advertisement type</option>
                                                                    <option value="IMAGE">IMAGE</option>
                                                                    <option value="TEXT">TEXT</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-sm-6">
                                                        <div class="form-group">
                                                            <label class="fw-semibold">Redirect To</label>
                                                            <div class="input-group">
                                                                <select name="redirect_to" id="redirect_to"
                                                                    class="select2 form-control custom-select">
                                                                    <option value="NONE" selected="selected">NONE</option>
                                                                    <option value="APP">APP</option>
                                                                    <option value="WEB">WEB</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-6 col-lg-6 col-sm-6" id="img_advertisement" style="display: none;">
                                                        <div class="form-group">
                                                            <label class="fw-semibold">Advertisement Image</label>
                                                            <div class="input-group">
                                                                <input type="file" name="advertisement_image"
                                                                class="form-control" id="advertisement_image">                                                 
                                                                </div>
                                                            </div>
                                                        </div>  
                                                    <div class="col-xl-6 col-lg-6 col-sm-6" style="display: none;" id="redirect_url">
                                                        <div class="form-group">
                                                            <label class="fw-semibold">Redirect Url</label>
                                                            <div class="input-group">
                                                                <input type="text" name="redirect_web_url" class="form-control"
                                                                    id="redirect_web_url">
                                                            </div>
                                                                <p style="color: red; font-size: 70%;">Note: URL will redirect to
                                                                page like facebook, twitter, etc.</p>
                                                        </div>
                                                    </div>   
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-6 col-lg-6 col-sm-6" id="redirect_option" style="display: none;">
                                                        <div class="form-group">
                                                            <label class="fw-semibold">Redirect App</label>
                                                            <div class="input-group">
                                                                <select name="redirect_app" id="redirect_app"
                                                                    class="select2 form-control custom-select">
                                                                    <option value="" selected="selected">NONE</option>
                                                                    <option value="PAYMENTS">PAYMENTS</option>
                                                                    <option value="DEPOSIT">DEPOSIT</option>
                                                                    <option value="REWARDS">REWARDS</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>      
                                                </div>
                                        </div>
                                        <div id='response'></div>
                                        <div class="card-footer">
                                            <div class="float-end btn-list">
                                                <button type="submit" class="btn btn-primary btn-rounded btn-fw"
                                                                style="font-weight:500;">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div id='response'></div>
                            </div>
                        </div>
                        <!-- ROW-1 CLOSED -->
                    </div>
                    <!-- CONTAINER CLOSED -->
@endsection

@section('scripts')
<script type="text/javascript">
        $(document).ready(function() {
            $(".navbar-nav li").removeClass("active"); //this will remove the active class from
            //previously active menu item
            $('#setting').addClass('active');

            $('#advertisement_type').on('change', function() {
                if (this.value == 'IMAGE') {
                    $("#img_advertisement").show();
                } else {
                    $("#img_advertisement").hide();
                }
            });

            $('#redirect_to').on('change', function() {
                /* ||
                    this.value == 'WEB' */
                if (this.value == 'APP') {
                    $("#redirect_option").show();
                    $("#redirect_url").show();
                } else {
                    $("#redirect_option").hide();
                    $("#redirect_url").show();
                }
            });

        });
        var spinner = $('#loader');
        $('#addNewAdvertisement').on('submit', function(e) {
            e.preventDefault();
            spinner.show();
            /*  // Activate the loading spinner
             $('.loading-spinner').toggleClass('active'); */

            var formFields = new FormData(this);

            //console.log(formFields);

            $.ajax({
                url: 'api/advertisement',
                type: 'post',
                dataType: 'JSON',
                data: formFields,
                contentType: false, // The content type used when sending data to the server.
                //cache: false, // To unable request pages to be cached
                processData: false,
                success: function(data) {
                    //alert(JSON.stringify(meta.message));
                    // console.log("ttttt");
                    if (data.error_code == 0) {
                        //  console.log(data);
                        spinner.hide();
                        Swal.fire({
                            title: "" + data.meta.message,
                            icon: 'success',
                            showCloseButton: true
                        })
                    } else {
                        swal(data.meta.message, "error");
                    }
                    /*   // Deactivate Loading Spinner
                                        $('.loading-spinner').toggleClass('active');
                     */
                    $('#addNewAdvertisement').closest('form').find("input[type=text], textarea").val(
                        "");
                    top.location.href = "{{ asset('advertisement-list') }}";
                },
                error: function(data) {

                    if (data.status === 422) {
                        var errors = $.parseJSON(data.responseText);
                        $.each(errors, function(key, value) {
                            // console.log(key+ " " +value);
                            $('#response').addClass("alert alert-danger");

                            if ($.isPlainObject(value)) {
                                $.each(value, function(key, value) {
                                    // console.log(key + " " + value);
                                    $('#response').show().append(value + "<br/>");
                                    spinner.hide();
                                });
                            } else {
                                $('#response').show().append(value +
                                    "<br/>"); //this is my div with messages
                                spinner.hide();
                            }
                        });
                    }

                }



            });
        });
    </script>

@endsection
