@extends('layouts.master')
@section('styles')
{{-- Date Picker --}}
        <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
<style type="text/css">
    img {
        display: block;
        max-width: 100%;
    }

    .preview {
        overflow: hidden;
        width: 160px;
        height: 160px;
        margin: 10px;
        border: 1px solid red;
    }

    .modal-lg {
        max-width: 1000px !important;
    }
</style>
@endsection
@section('content')
                    <!-- PAGE-HEADER -->
                    <div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
                        <h1 class="page-title">Billers</h1>
                        <div>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/index')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Billers</li>
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
                                     <!-- COL-END -->
                                        <div class="col-xl-12 p-0">
                                            <div class="card">
                                                <div class="card-body">
                                                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                                        <li class="nav-item" role="presentation">
                                                                <button class="nav-link  tablinks" id="defaultOpen" data-is_active="1"
                                                                role="tab" aria-controls="pills-home" aria-selected="true" >Active User</button>
                                                            <!-- <button class="nav-link active tablinks" id="defaultOpen"
                                                                data-bs-toggle="pill" data-bs-target="#pills-home" type="button"
                                                                role="tab" aria-controls="pills-home"
                                                                aria-selected="true" data-is_active="1">Active User</button> -->
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                            <!-- <button class="nav-link tablinks" id="pills-profile-tab" data-bs-toggle="pill"
                                                                data-bs-target="#pills-profile" type="button" role="tab"
                                                                aria-controls="pills-profile" aria-selected="false" data-is_active="0">InActive User</button> -->
                                                                <button class="nav-link tablinks" id="inactiveuserbtn" data-is_active="0" role="tab"
                                                                aria-controls="pills-profile" aria-selected="false">InActive User</button>
                                                        </li>                                                        
                                                    </ul>
                                                    <script>
                                                        $("#defaultOpen").addClass('active');

                                                        $('.tablinks').on('click', function() {
                                                            document.getElementById('TransReport').style.display = "block";
                                                            $('.tablinks').removeClass('activeWallet');
                                                            $(this).addClass('activeWallet');
                                                            fetch_data($(this).data('is_active'));
                                                        })
                                                        $("#inactiveuserbtn").click(function(){
                                                            $("#defaultOpen").removeClass('active');
                                                            $("#inactiveuserbtn").addClass('active');
                                                        })
                                                        $("#defaultOpen").click(function(){
                                                            $("#inactiveuserbtn").removeClass('active');
                                                            $("#defaultOpen").addClass('active');
                                                        })
                                                    </script>
                                                    {{-- @if ($userDetails->user_type_id == 2 or $useDetails->user_type_id == 4 or $userDetails->user_type_id == 5) --}}
                                                    <div class="tab-content" id="TransReport">
                                                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                                            aria-labelledby="defaultOpen" tabindex="0">
                                                            <form name='filterdate' id='filterdate'>
                                                            <div class="input-group input-daterange">
                                                                <div class="form-group col-sm">
                                                                    <input type="text" name="from_date" id="from_date"
                                                                         class="form-control"
                                                                        placeholder="From Date" />
                                                                </div>&nbsp;&nbsp;
                                                                <div class="input-group-addon">to</div> &nbsp;&nbsp;
                                                                <div class="form-group col-sm">
                                                                    <input type="text" name="to_date" id="to_date"
                                                                         class="form-control" placeholder="To Date" />
                                                                </div>
                                                                <div class="form-group col-sm d-flex report_btns">
                                                                    <button type="button" name="filter" id="filter"
                                                                        class="btn btn-info btn-sm filter">Filter
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                            <div class="e-table px-0 pb-5">
                                                                <div class="table-responsive table-lg">
                                                                    <table class="table border-top table-bordered mb-0 text-nowrap activeUsersTable" id="dataTable" style="width:100%;">
                                                                        <thead class="border-top">
                                                                            <tr>
                                                                                <th class="border-bottom-0">Date</th>
                                                                                <th class="border-bottom-0">Biller Name</th>
                                                                                <th class="border-bottom-0">Biller Category Name</th>
                                                                                <th class="border-bottom-0">Logo</th>
                                                                                <th class="border-bottom-0 " id="billers">Biller Fields</th>
                                                                                <th class="border-bottom-0">Actions</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody></tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                                            aria-labelledby="pills-profile-tab" tabindex="0">
                                                            <ul class="list-group">
                                                                <li
                                                                    class="list-group-item d-flex justify-content-between align-items-start">
                                                                    <div class="me-auto d-flex align-items-center">
                                                                        <div>
                                                                            <input class="form-check-input me-2 mt-0"
                                                                                name="checkbox1" type="checkbox" value="" checked="">
                                                                            <label class="form-check-label" for="checkbox1"></label>
                                                                        </div>
                                                                        <div>
                                                                            <div class="fw-bold">Heading</div>
                                                                            <p class="mb-0 text-muted">Donec id elit non mi porta
                                                                                gravida at eget metus. Maecenas sed diam eget risus
                                                                                varius blandit.</p>
                                                                        </div>
                                                                    </div>
                                                                    <span class="badge bg-info rounded-pill">14</span>
                                                                </li>
                                                                <li
                                                                    class="list-group-item d-flex justify-content-between align-items-start">
                                                                    <div class="me-auto d-flex align-items-center">
                                                                        <div>
                                                                            <input class="form-check-input me-2 mt-0"
                                                                                name="checkbox1" type="checkbox" value="">
                                                                            <label class="form-check-label" for="checkbox1"></label>
                                                                        </div>
                                                                        <div>
                                                                            <div class="fw-bold">Heading</div>
                                                                            <p class="mb-0 text-muted">Donec id elit non mi porta
                                                                                gravida at eget metus. Maecenas sed diam eget risus
                                                                                varius blandit.</p>
                                                                        </div>
                                                                    </div>
                                                                    <span class="badge bg-danger rounded-pill">14</span>
                                                                </li>
                                                                <li
                                                                    class="list-group-item d-flex justify-content-between align-items-start">
                                                                    <div class="me-auto d-flex align-items-center">
                                                                        <div>
                                                                            <input class="form-check-input me-2 mt-0"
                                                                                name="checkbox1" type="checkbox" value=""
                                                                                >
                                                                            <label class="form-check-label" for="checkbox1"></label>
                                                                        </div>
                                                                        <div>
                                                                            <div class="fw-bold">Heading</div>
                                                                            <p class="mb-0 text-muted">Donec id elit non mi porta
                                                                                gravida at eget metus. Maecenas sed diam eget risus
                                                                                varius blandit.</p>
                                                                        </div>
                                                                    </div>
                                                                    <span class="badge bg-success rounded-pill">14</span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <div class="tab-pane" id="tab-12">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6 col-xl-4 col-xxl-3">
                                            <div class="card user-card">
                                                <div class="user-image">
                                                    <img src="{{asset('build/assets/images/media/files/04.jpg')}}" class="card-img-top" alt="...">
                                                    <span class="avatar avatar-xl rounded-circle">
                                                        <img src="{{asset('build/assets/images/users/2.jpg')}}" alt="" class="rounded-circle">
                                                    </span>
                                                </div>
                                                <div class="card-body text-center">
                                                    <div class="text-center">
                                                        <div class="dropdown text-end">
                                                            <a href="javascript:;" class="option-dots text-muted" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fe fe-more-vertical fs-16 lh-sm"></i> </a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="javascript:;">
                                                                    <i class="fe fe-message-square me-2 d-inline-flex"></i> Message
                                                                </a>
                                                                <a class="dropdown-item" href="javascript:;">
                                                                    <i class="fe fe-edit-2 me-2 d-inline-flex"></i> Edit
                                                                </a>
                                                                <a class="dropdown-item" href="javascript:;">
                                                                    <i class="fe fe-eye me-2 d-inline-flex"></i> View
                                                                </a>
                                                                <a class="dropdown-item" href="javascript:;">
                                                                    <i class="fe fe-trash-2 me-2 d-inline-flex"></i> Delete
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="{{url('profile')}}" class="fs-18 fw-bold d-block">Adam Cotter</a>
                                                    <p class="text-muted text-center">Web Designer</p>
                                                    <span class="text-muted mx-3"><i class="fe fe-map-pin mx-2 text-secondary "></i>France</span>
                                                    <span class="text-muted"><i class="fe fe-phone mx-2 text-success "></i>+1 1456789867</span>
                                                    <div class="text-center mt-3">
                                                        <a class="btn btn-sm bg-primary-transparent rounded-circle me-1" role="button" href="javascript:void(0);"><i class="mdi mdi-facebook fs-16"></i></a>
                                                        <a class="btn btn-sm bg-secondary-transparent rounded-circle me-1" role="button" href="javascript:void(0);"><i class="mdi mdi-linkedin fs-16"></i></a>
                                                        <a class="btn btn-sm bg-success-transparent rounded-circle" role="button" href="javascript:void(0);"><i class="mdi mdi-twitter fs-16"></i></a>
                                                    </div>
                                                </div>
                                                <div class="card-footer p-0">
                                                    <div class="row row-sm">
                                                        <div class="col-sm-4 border-end text-center">
                                                            <div class="p-3 text-dark">
                                                                <h5 class="mb-1 fs-16 fw-600">30k</h5>
                                                                <span class="fs-11">TOTAL POSTS</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 border-end text-center">
                                                            <div class="text-center p-3 text-dark">
                                                                <h5 class="mb-1 fs-16 fw-600">7,345</h5>
                                                                <span class="fs-11">FOLLOWERS</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="text-center p-3 text-dark">
                                                                <h5 class="mb-1 fs-16 fw-600">2,785</h5>
                                                                <span class="fs-11">FOLLOWING</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-xl-4 col-xxl-3">
                                            <div class="card user-card">
                                                <div class="user-image">
                                                    <img src="{{asset('build/assets/images/media/files/05.jpg')}}" class="card-img-top" alt="...">
                                                    <span class="avatar avatar-xl rounded-circle">
                                                        <img src="{{asset('build/assets/images/users/3.jpg')}}" alt="" class="rounded-circle">
                                                    </span>
                                                </div>
                                                <div class="card-body text-center">
                                                    <div class="text-center">
                                                        <div class="dropdown text-end">
                                                            <a href="javascript:;" class="option-dots text-muted" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fe fe-more-vertical fs-16 lh-sm"></i> </a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="javascript:;">
                                                                    <i class="fe fe-message-square me-2 d-inline-flex"></i> Message
                                                                </a>
                                                                <a class="dropdown-item" href="javascript:;">
                                                                    <i class="fe fe-edit-2 me-2 d-inline-flex"></i> Edit
                                                                </a>
                                                                <a class="dropdown-item" href="javascript:;">
                                                                    <i class="fe fe-eye me-2 d-inline-flex"></i> View
                                                                </a>
                                                                <a class="dropdown-item" href="javascript:;">
                                                                    <i class="fe fe-trash-2 me-2 d-inline-flex"></i> Delete
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="{{url('profile')}}" class="fs-18 fw-bold d-block">Dennis Trexy</a>
                                                    <p class="text-muted text-center">Web Designer</p>
                                                    <span class="text-muted mx-3"><i class="fe fe-map-pin mx-2 text-secondary "></i>United States</span>
                                                    <span class="text-muted"><i class="fe fe-phone mx-2 text-success "></i>+1 135792468</span>
                                                    <div class="text-center mt-3">
                                                        <a class="btn btn-sm bg-primary-transparent rounded-circle me-1" role="button" href="javascript:void(0);"><i class="mdi mdi-facebook fs-16"></i></a>
                                                        <a class="btn btn-sm bg-secondary-transparent rounded-circle me-1" role="button" href="javascript:void(0);"><i class="mdi mdi-linkedin fs-16"></i></a>
                                                        <a class="btn btn-sm bg-success-transparent rounded-circle" role="button" href="javascript:void(0);"><i class="mdi mdi-twitter fs-16"></i></a>
                                                    </div>
                                                </div>
                                                <div class="card-footer p-0">
                                                    <div class="row row-sm">
                                                        <div class="col-sm-4 border-end text-center">
                                                            <div class="p-3 text-dark">
                                                                <h5 class="mb-1 fs-16 fw-600">18k</h5>
                                                                <span class="fs-11">TOTAL POSTS</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 border-end text-center">
                                                            <div class="text-center p-3 text-dark">
                                                                <h5 class="mb-1 fs-16 fw-600">6,452</h5>
                                                                <span class="fs-11">FOLLOWERS</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="text-center p-3 text-dark">
                                                                <h5 class="mb-1 fs-16 fw-600">6,452</h5>
                                                                <span class="fs-11">FOLLOWING</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-xl-4 col-xxl-3">
                                            <div class="card user-card">
                                                <div class="user-image">
                                                    <img src="{{asset('build/assets/images/media/files/06.jpg')}}" class="card-img-top" alt="...">
                                                    <span class="avatar avatar-xl rounded-circle">
                                                        <img src="{{asset('build/assets/images/users/4.jpg')}}" alt="" class="rounded-circle">
                                                    </span>
                                                </div>
                                                <div class="card-body text-center">
                                                    <div class="text-center">
                                                        <div class="dropdown text-end">
                                                            <a href="javascript:;" class="option-dots text-muted" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fe fe-more-vertical fs-16 lh-sm"></i> </a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="javascript:;">
                                                                    <i class="fe fe-message-square me-2 d-inline-flex"></i> Message
                                                                </a>
                                                                <a class="dropdown-item" href="javascript:;">
                                                                    <i class="fe fe-edit-2 me-2 d-inline-flex"></i> Edit
                                                                </a>
                                                                <a class="dropdown-item" href="javascript:;">
                                                                    <i class="fe fe-eye me-2 d-inline-flex"></i> View
                                                                </a>
                                                                <a class="dropdown-item" href="javascript:;">
                                                                    <i class="fe fe-trash-2 me-2 d-inline-flex"></i> Delete
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="{{url('profile')}}" class="fs-18 fw-bold d-block">Terrie Boaler</a>
                                                    <p class="text-muted text-center">Web Designer</p>
                                                    <span class="text-muted mx-3"><i class="fe fe-map-pin mx-2 text-secondary "></i>Canada</span>
                                                    <span class="text-muted"><i class="fe fe-phone mx-2 text-success "></i>+1 1567843567</span>
                                                    <div class="text-center mt-3">
                                                        <a class="btn btn-sm bg-primary-transparent rounded-circle me-1" role="button" href="javascript:void(0);"><i class="mdi mdi-facebook fs-16"></i></a>
                                                        <a class="btn btn-sm bg-secondary-transparent rounded-circle me-1" role="button" href="javascript:void(0);"><i class="mdi mdi-linkedin fs-16"></i></a>
                                                        <a class="btn btn-sm bg-success-transparent rounded-circle" role="button" href="javascript:void(0);"><i class="mdi mdi-twitter fs-16"></i></a>
                                                    </div>
                                                </div>
                                                <div class="card-footer p-0">
                                                    <div class="row row-sm">
                                                        <div class="col-sm-4 border-end text-center">
                                                            <div class="p-3 text-dark">
                                                                <h5 class="mb-1 fs-16 fw-600">25k</h5>
                                                                <span class="fs-11">TOTAL POSTS</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 border-end text-center">
                                                            <div class="text-center p-3 text-dark">
                                                                <h5 class="mb-1 fs-16 fw-600">2,765</h5>
                                                                <span class="fs-11">FOLLOWERS</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="text-center p-3 text-dark">
                                                                <h5 class="mb-1 fs-16 fw-600">4,876</h5>
                                                                <span class="fs-11">FOLLOWING</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-xl-4 col-xxl-3">
                                            <div class="card user-card">
                                                <div class="user-image">
                                                    <img src="{{asset('build/assets/images/media/files/07.jpg')}}" class="card-img-top" alt="...">
                                                    <span class="avatar avatar-xl rounded-circle">
                                                        <img src="{{asset('build/assets/images/users/5.jpg')}}" alt="" class="rounded-circle">
                                                    </span>
                                                </div>
                                                <div class="card-body text-center">
                                                    <div class="text-center">
                                                        <div class="dropdown text-end">
                                                            <a href="javascript:;" class="option-dots text-muted" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fe fe-more-vertical fs-16 lh-sm"></i> </a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="javascript:;">
                                                                    <i class="fe fe-message-square me-2 d-inline-flex"></i> Message
                                                                </a>
                                                                <a class="dropdown-item" href="javascript:;">
                                                                    <i class="fe fe-edit-2 me-2 d-inline-flex"></i> Edit
                                                                </a>
                                                                <a class="dropdown-item" href="javascript:;">
                                                                    <i class="fe fe-eye me-2 d-inline-flex"></i> View
                                                                </a>
                                                                <a class="dropdown-item" href="javascript:;">
                                                                    <i class="fe fe-trash-2 me-2 d-inline-flex"></i> Delete
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="{{url('profile')}}" class="fs-18 fw-bold d-block">Dorothea Joicey</a>
                                                    <p class="text-muted text-center">Web Designer</p>
                                                    <span class="text-muted mx-3"><i class="fe fe-map-pin mx-2 text-secondary "></i>Indonesia</span>
                                                    <span class="text-muted"><i class="fe fe-phone mx-2 text-success "></i>+1 135792468</span>
                                                    <div class="text-center mt-3">
                                                        <a class="btn btn-sm bg-primary-transparent rounded-circle me-1" role="button" href="javascript:void(0);"><i class="mdi mdi-facebook fs-16"></i></a>
                                                        <a class="btn btn-sm bg-secondary-transparent rounded-circle me-1" role="button" href="javascript:void(0);"><i class="mdi mdi-linkedin fs-16"></i></a>
                                                        <a class="btn btn-sm bg-success-transparent rounded-circle" role="button" href="javascript:void(0);"><i class="mdi mdi-twitter fs-16"></i></a>
                                                    </div>
                                                </div>
                                                <div class="card-footer p-0">
                                                    <div class="row row-sm">
                                                        <div class="col-sm-4 border-end text-center">
                                                            <div class="p-3 text-dark">
                                                                <h5 class="mb-1 fs-16 fw-600">34k</h5>
                                                                <span class="fs-11">TOTAL POSTS</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 border-end text-center">
                                                            <div class="text-center p-3 text-dark">
                                                                <h5 class="mb-1 fs-16 fw-600">1,789</h5>
                                                                <span class="fs-11">FOLLOWERS</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="text-center p-3 text-dark">
                                                                <h5 class="mb-1 fs-16 fw-600">2,456</h5>
                                                                <span class="fs-11">FOLLOWING</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-xl-4 col-xxl-3">
                                            <div class="card user-card">
                                                <div class="user-image">
                                                    <img src="{{asset('build/assets/images/media/files/08.jpg')}}" class="card-img-top" alt="...">
                                                    <span class="avatar avatar-xl rounded-circle">
                                                        <img src="{{asset('build/assets/images/users/6.jpg')}}" alt="" class="rounded-circle">
                                                    </span>
                                                </div>
                                                <div class="card-body text-center">
                                                    <div class="text-center">
                                                        <div class="dropdown text-end">
                                                            <a href="javascript:;" class="option-dots text-muted" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fe fe-more-vertical fs-16 lh-sm"></i> </a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="javascript:;">
                                                                    <i class="fe fe-message-square me-2 d-inline-flex"></i> Message
                                                                </a>
                                                                <a class="dropdown-item" href="javascript:;">
                                                                    <i class="fe fe-edit-2 me-2 d-inline-flex"></i> Edit
                                                                </a>
                                                                <a class="dropdown-item" href="javascript:;">
                                                                    <i class="fe fe-eye me-2 d-inline-flex"></i> View
                                                                </a>
                                                                <a class="dropdown-item" href="javascript:;">
                                                                    <i class="fe fe-trash-2 me-2 d-inline-flex"></i> Delete
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="{{url('profile')}}" class="fs-18 fw-bold d-block">Donnell Farries</a>
                                                    <p class="text-muted text-center">Web Designer</p>
                                                    <span class="text-muted mx-3"><i class="fe fe-map-pin mx-2 text-secondary "></i>Poland</span>
                                                    <span class="text-muted"><i class="fe fe-phone mx-2 text-success "></i>+1 1456789456</span>
                                                    <div class="text-center mt-3">
                                                        <a class="btn btn-sm bg-primary-transparent rounded-circle me-1" role="button" href="javascript:void(0);"><i class="mdi mdi-facebook fs-16"></i></a>
                                                        <a class="btn btn-sm bg-secondary-transparent rounded-circle me-1" role="button" href="javascript:void(0);"><i class="mdi mdi-linkedin fs-16"></i></a>
                                                        <a class="btn btn-sm bg-success-transparent rounded-circle" role="button" href="javascript:void(0);"><i class="mdi mdi-twitter fs-16"></i></a>
                                                    </div>
                                                </div>
                                                <div class="card-footer p-0">
                                                    <div class="row row-sm">
                                                        <div class="col-sm-4 border-end text-center">
                                                            <div class="p-3 text-dark">
                                                                <h5 class="mb-1 fs-16 fw-600">46k</h5>
                                                                <span class="fs-11">TOTAL POSTS</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 border-end text-center">
                                                            <div class="text-center p-3 text-dark">
                                                                <h5 class="mb-1 fs-16 fw-600">2,567</h5>
                                                                <span class="fs-11">FOLLOWERS</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="text-center p-3 text-dark">
                                                                <h5 class="mb-1 fs-16 fw-600">3,345</h5>
                                                                <span class="fs-11">FOLLOWING</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-xl-4 col-xxl-3">
                                            <div class="card user-card">
                                                <div class="user-image">
                                                    <img src="{{asset('build/assets/images/media/files/09.jpg')}}" class="card-img-top" alt="...">
                                                    <span class="avatar avatar-xl rounded-circle">
                                                        <img src="{{asset('build/assets/images/users/7.jpg')}}" alt="" class="rounded-circle">
                                                    </span>
                                                </div>
                                                <div class="card-body text-center">
                                                    <div class="text-center">
                                                        <div class="dropdown text-end">
                                                            <a href="javascript:;" class="option-dots text-muted" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fe fe-more-vertical fs-16 lh-sm"></i> </a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="javascript:;">
                                                                    <i class="fe fe-message-square me-2 d-inline-flex"></i> Message
                                                                </a>
                                                                <a class="dropdown-item" href="javascript:;">
                                                                    <i class="fe fe-edit-2 me-2 d-inline-flex"></i> Edit
                                                                </a>
                                                                <a class="dropdown-item" href="javascript:;">
                                                                    <i class="fe fe-eye me-2 d-inline-flex"></i> View
                                                                </a>
                                                                <a class="dropdown-item" href="javascript:;">
                                                                    <i class="fe fe-trash-2 me-2 d-inline-flex"></i> Delete
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="{{url('profile')}}" class="fs-18 fw-bold d-block">Letizia Puncher</a>
                                                    <p class="text-muted text-center">Web Designer</p>
                                                    <span class="text-muted mx-3"><i class="fe fe-map-pin mx-2 text-secondary "></i>Ukraine</span>
                                                    <span class="text-muted"><i class="fe fe-phone mx-2 text-success "></i>+1 1234567893</span>
                                                    <div class="text-center mt-3">
                                                        <a class="btn btn-sm bg-primary-transparent rounded-circle me-1" role="button" href="javascript:void(0);"><i class="mdi mdi-facebook fs-16"></i></a>
                                                        <a class="btn btn-sm bg-secondary-transparent rounded-circle me-1" role="button" href="javascript:void(0);"><i class="mdi mdi-linkedin fs-16"></i></a>
                                                        <a class="btn btn-sm bg-success-transparent rounded-circle" role="button" href="javascript:void(0);"><i class="mdi mdi-twitter fs-16"></i></a>
                                                    </div>
                                                </div>
                                                <div class="card-footer p-0">
                                                    <div class="row row-sm">
                                                        <div class="col-sm-4 border-end text-center">
                                                            <div class="p-3 text-dark">
                                                                <h5 class="mb-1 fs-16 fw-600">24k</h5>
                                                                <span class="fs-11">TOTAL POSTS</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 border-end text-center">
                                                            <div class="text-center p-3 text-dark">
                                                                <h5 class="mb-1 fs-16 fw-600">5,765</h5>
                                                                <span class="fs-11">FOLLOWERS</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="text-center p-3 text-dark">
                                                                <h5 class="mb-1 fs-16 fw-600">7,345</h5>
                                                                <span class="fs-11">FOLLOWING</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-xl-4 col-xxl-3">
                                            <div class="card user-card">
                                                <div class="user-image">
                                                    <img src="{{asset('build/assets/images/media/files/01.jpg')}}" class="card-img-top" alt="...">
                                                    <span class="avatar avatar-xl rounded-circle">
                                                        <img src="{{asset('build/assets/images/users/10.jpg')}}" alt="" class="rounded-circle">
                                                    </span>
                                                </div>
                                                <div class="card-body text-center">
                                                    <div class="text-center">
                                                        <div class="dropdown text-end">
                                                            <a href="javascript:;" class="option-dots text-muted" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fe fe-more-vertical fs-16 lh-sm"></i> </a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="javascript:;">
                                                                    <i class="fe fe-message-square me-2 d-inline-flex"></i> Message
                                                                </a>
                                                                <a class="dropdown-item" href="javascript:;">
                                                                    <i class="fe fe-edit-2 me-2 d-inline-flex"></i> Edit
                                                                </a>
                                                                <a class="dropdown-item" href="javascript:;">
                                                                    <i class="fe fe-eye me-2 d-inline-flex"></i> View
                                                                </a>
                                                                <a class="dropdown-item" href="javascript:;">
                                                                    <i class="fe fe-trash-2 me-2 d-inline-flex"></i> Delete
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="{{url('profile')}}" class="fs-18 fw-bold d-block">Dennis Trexy</a>
                                                    <p class="text-muted text-center">Web Designer</p>
                                                    <span class="text-muted mx-3"><i class="fe fe-map-pin mx-2 text-secondary "></i>California, USA</span>
                                                    <span class="text-muted"><i class="fe fe-phone mx-2 text-success "></i>+1 135792468</span>
                                                    <div class="text-center mt-3">
                                                        <a class="btn btn-sm bg-primary-transparent rounded-circle me-1" role="button" href="javascript:void(0);"><i class="mdi mdi-facebook fs-16"></i></a>
                                                        <a class="btn btn-sm bg-secondary-transparent rounded-circle me-1" role="button" href="javascript:void(0);"><i class="mdi mdi-linkedin fs-16"></i></a>
                                                        <a class="btn btn-sm bg-success-transparent rounded-circle" role="button" href="javascript:void(0);"><i class="mdi mdi-twitter fs-16"></i></a>
                                                    </div>
                                                </div>
                                                <div class="card-footer p-0">
                                                    <div class="row row-sm">
                                                        <div class="col-sm-4 border-end text-center">
                                                            <div class="p-3 text-dark">
                                                                <h5 class="mb-1 fs-16 fw-600">16K</h5>
                                                                <span class="fs-11">TOTAL POSTS</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 border-end text-center">
                                                            <div class="text-center p-3 text-dark">
                                                                <h5 class="mb-1 fs-16 fw-600">6,452</h5>
                                                                <span class="fs-11">FOLLOWERS</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="text-center p-3 text-dark">
                                                                <h5 class="mb-1 fs-16 fw-600">6,452</h5>
                                                                <span class="fs-11">FOLLOWING</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-xl-4 col-xxl-3">
                                            <div class="card user-card">
                                                <div class="user-image">
                                                    <img src="{{asset('build/assets/images/media/files/05.jpg')}}" class="card-img-top" alt="...">
                                                    <span class="avatar avatar-xl rounded-circle">
                                                        <img src="{{asset('build/assets/images/users/1.jpg')}}" alt="" class="rounded-circle">
                                                    </span>
                                                </div>
                                                <div class="card-body text-center">
                                                    <div class="text-center">
                                                        <div class="dropdown text-end">
                                                            <a href="javascript:;" class="option-dots text-muted" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fe fe-more-vertical fs-16 lh-sm"></i> </a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="javascript:;">
                                                                    <i class="fe fe-message-square me-2 d-inline-flex"></i> Message
                                                                </a>
                                                                <a class="dropdown-item" href="javascript:;">
                                                                    <i class="fe fe-edit-2 me-2 d-inline-flex"></i> Edit
                                                                </a>
                                                                <a class="dropdown-item" href="javascript:;">
                                                                    <i class="fe fe-eye me-2 d-inline-flex"></i> View
                                                                </a>
                                                                <a class="dropdown-item" href="javascript:;">
                                                                    <i class="fe fe-trash-2 me-2 d-inline-flex"></i> Delete
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="{{url('profile')}}" class="fs-18 fw-bold d-block">Sherilyn Metzel</a>
                                                    <p class="text-muted text-center">Web Designer</p>
                                                    <span class="text-muted mx-3"><i class="fe fe-map-pin mx-2 text-secondary "></i>Australia</span>
                                                    <span class="text-muted"><i class="fe fe-phone mx-2 text-success "></i>+1 1567893456</span>
                                                    <div class="text-center mt-3">
                                                        <a class="btn btn-sm bg-primary-transparent rounded-circle me-1" role="button" href="javascript:void(0);"><i class="mdi mdi-facebook fs-16"></i></a>
                                                        <a class="btn btn-sm bg-secondary-transparent rounded-circle me-1" role="button" href="javascript:void(0);"><i class="mdi mdi-linkedin fs-16"></i></a>
                                                        <a class="btn btn-sm bg-success-transparent rounded-circle" role="button" href="javascript:void(0);"><i class="mdi mdi-twitter fs-16"></i></a>
                                                    </div>
                                                </div>
                                                <div class="card-footer p-0">
                                                    <div class="row row-sm">
                                                        <div class="col-sm-4 border-end text-center">
                                                            <div class="p-3 text-dark">
                                                                <h5 class="mb-1 fs-16 fw-600">23k</h5>
                                                                <span class="fs-11">TOTAL POSTS</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 border-end text-center">
                                                            <div class="text-center p-3 text-dark">
                                                                <h5 class="mb-1 fs-16 fw-600">4,765</h5>
                                                                <span class="fs-11">FOLLOWERS</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="text-center p-3 text-dark">
                                                                <h5 class="mb-1 fs-16 fw-600">2,765</h5>
                                                                <span class="fs-11">FOLLOWING</span>
                                                            </div>
                                                        </div>
                                                    </div>
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
 <!-- Add Funds Model-->
<div class="modal fade" id="add_funds_form" tabindex="-1" aria-labelledby="add-userLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="add-userLabel">Add Funds</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form name='addFunds' id='addFunds'>
                        @csrf
                        <div class="row gy-3">
                                <div class="col-xl-12">
                                    <label class="form-label">Amount</label>
                                    <input type="text" name="amount" class="form-control" id="amount" required>
                                </div>
                                <div class="col-xl-12">
                                    <label class="form-label">Transaction Pin</label>
                                    <input type="text" name="transaction_pin" 
                                    id="transaction_pin"
                                    autocomplete="one-time-code" required inputmode="numeric" maxlength="4">
                                    <!-- <input type="text" autocomplete="one-time-code" inputmode="numeric" maxlength="4" pattern="\d{4}"> -->
                                </div>
                                <input type="text" name="pin" id="pin" hidden/>
                                <div class="col-xl-12">
                                    <label>Description</label>
                                    <textarea type="text" name="description" class="form-control" id="description"
                                            required></textarea>
                                </div>
                                <div style="text-align:center">
                                    <button type="submit" class="btn btn-primary btn-rounded btn-fw" id='submit_button'
                                        data-user-id="" style="font-weight:500;">Add</button>
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal" id="cancel_btn">Cancel</button>
                                </div>
                        </div>
                    </form>
                </div>
                <!-- <div class="modal-footer">
                    <div id='response'></div>
                </div> -->
            </div>
        </div>
    </div>

    {{-- Add Biller --}}
    <div class="modal fade" id="biller_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Biller</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form name='addNewBiller' id='addNewBiller' enctype="multipart/form-data">
                        <div class="row gy-3">
                                <div class="col-xl-12">
                                    <label>Mobile Number</label>
                                        <input type="text" name="mobile_no" class="form-control" id="mobile_no">
                                </div>
                                <div class="col-xl-12">
                                    <label>Email</label>
                                        <input type="email" name="email" class="form-control" id="email"
                                            required>
                                </div>
                                <div class="col-xl-12">
                                    <label>Username</label>
                                        <input type="text" name="username" class="form-control" id="username"
                                            value="$" pattern="^[$].{8,}"
                                            title="Must start with $ sign followed by at least 8 or more characters"
                                            required>
                                </div>
                                <div class="col-xl-12">
                                    <label>Password</label>
                                        <input type="password" name="password" class="form-control" id="password"
                                            required>
                                </div>
                                <div class="col-xl-12">
                                    <label>Confirm Password</label>
                                        <input type="password" name="password_confirmation" class="form-control"
                                            id="password_confirmation" required>
                                </div>
                                <div class="col-xl-12">
                                    <label>Biller Name</label>
                                        <input type="text" name="biller_name" class="form-control"
                                            id="biller_name" required>
                                </div>
                                <div class="col-xl-12">
                                    <label>Select Service Category</label>
                                    <select class="select2 form-control custom-select" name="biller_category_id"
                                        id="biller_category_id" required>
                                    </select>
                                </div>
                                <div class="col-xl-12">
                                    <div class="col-md-4 text-center">
                                        <div id="cropie-demo" style="width:250px"></div>
                                    </div>
                                    <label>Upload Logo</label>
                                        <input type="file" name="biller_img" class="form-control" id="upload"
                                            required>
                                </div>
                                <div class="col-xl-12">
                                    <label>Add Fields</label>
                                    <a href="javascript:void(0);" class="add_button" style="margin:0px"
                                        title="Add more fields"><img src="" /><i
                                            class="material-icons">add</i></a>
                                    <div class="fields">
                                        <div class="col-xl-12">
                                            <label>Placeholder</label>
                                            <div class="input-group">
                                                <input type="text" name="biller_fields[fields][0][name]"
                                                    value="" class="form-control"
                                                    title="Placeholder(e.g. Mobile No, Biller No.)" required />
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <label>Validate</label>
                                            <input type="checkbox" name="biller_fields[fields][0][check_regex]"
                                                id="checkbox1" class="checkboxClass" value=0>
                                        </div>
                                        <div class="col-xl-12" style="display: none;" id="regex">
                                            <label>Regex</label>
                                            <div class="input-group">
                                                <input type="text" name="biller_fields[fields][0][regex]"
                                                    value="" class="form-control"
                                                    title="To validate placeholder" />

                                            </div>
                                            <a href="https://regex-generator.olafneumann.org/?sampleText=1458795647&flags=i&onlyPatterns=false&matchWholeLine=false&selection="
                                                target="_blank" style="margin:0px" title="Add more fields">Generate
                                                Regex</a>
                                        </div>
                                    </div>
                            </div>
                        </div>
                </div>
                <input type="hidden" name="user_type_id" value="5">
                <input type="hidden" name="device_name" value="web">
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

    <!-- Edit Biller Modal-->
    <div class="modal fade" id="edit_billers_form" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Biller</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form name='editBiller' id='editBiller'>
                        <div class="row gy-3">
                                <div class="col-xl-12">
                                    <label><b>Biller Name</b></label>
                                    <input type="text" name="biller_name" class="form-control"
                                            id="billerName" required>

                                </div>
                                <div class="col-xl-12">
                                    <label><b>Biller Category</b></label>
                                    <select name="biller_category_id" id="billerCategory"
                                        class="select2 form-control custom-select" required>
                                    </select>
                                </div>
                                <label><b>Biller Fields</b></label>
                                {{-- <label>Add Fields</label>
                                <a href="javascript:void(0);" class="add_button" style="margin:0px"
                                    title="Add more fields"><img src="" /><i class="material-icons">add</i></a> --}}
                                <div id="appendfields" class="mt-0">
                                </div>
                        </div>
                        <div class="px-4 py-4 text-center">
                            <button type="submit" class="btn btn-primary btn-rounded btn-fw" id='submit_button'
                                data-biller-id="" style="font-weight:500;">Update</button>
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal" id="cancel_btn">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Biller transaction details Modal-->
    <div class="modal fade" id="billers_transaction_form" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 1000px;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Biller Report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form name='billerTrans' id='billerTrans'>
                        @csrf
                        <div class="row gy-3">
                                <div class="col-xl-12">
                                    <label>Biller Name</label>
                                    <input type="text" name="biller_name" class="form-control" id="billerNm"
                                            disabled="">
                                </div>
                                <div class="card-body" style="width: 700px;">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTableBillerTrans" width="100%"
                                            cellspacing="0">
                                            <h2>Transactions</h2>
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Created At</th>
                                                    <th class="text-center">Bill Payment ID</th>
                                                    <th class="text-center">Amount</th>
                                                    <th class="text-center">User</th>
                                                </tr>
                                            </thead>
                                            <tbody class="tablebody">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center px-4 py-4">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal" id="cancel_btn">Cancel</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Funds Model-->
    <div class="modal fade" id="add_funds_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Add Funds</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form name='addFunds' id='addFunds'>
                        <div class="row gy-3">
                                <div class="col-xl-12">
                                    <label>Amount</label>
                                        <input type="text" name="amount" class="form-control" id="amount"
                                            required>
                                </div>
                                <div class="col-xl-12">
                                    <label>Transaction Pin</label>
                                        <input type="text" name="transaction_pin" class="form-control"
                                            id="transaction_pin" required>
                                </div>
                                <div class="col-xl-12">
                                    <label>Description</label>
                                        <input type="text" name="description" class="form-control"
                                            id="description" required>
                                </div>
                            </div>
                        <div class="text-center px-4 py-4">
                            <button type="submit" class="btn btn-primary btn-rounded btn-fw" id='submit_button'
                                data-user-id="" style="font-weight:500;">Add</button>
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal" id="cancel_btn">Cancel</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div id='response'></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Upload Biller Logo-->
    <div class="modal fade" id="upload_biller_logo_form" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Add Biller Logo</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data">
                        <div class="row gy-3">
                                <div class="col-xl-12">
                                    <div class="col-md-4 text-center">
                                        <div id="cropie-demo" style="width:250px"></div>
                                    </div>
                                    <label>Upload Logo</label>
                                    <div class="input-group">
                                        <input type="file" name="image" class="image form-control" id="upload" required>
                                    </div>
                                </div>
                        </div>
                        <div class="text-center px-4 py-4">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancel_btn">Cancel</button>
                        </div>
                    </form>
                    <div id='response'></div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <div class="col-md-8">
                                <img id="image" src="">
                            </div>
                            <div class="col-md-4">
                                <div class="preview"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal" id="cancel_btn">Cancel</button>
                    {{-- <button type="button" class="btn btn-primary" id="crop">Upload</button> --}}
                    <button type="button" class="btn btn-primary btn-rounded btn-fw"
                        id='upload_biller_submit_button' data-biller-id="" style="font-weight:500;">Upload
                    </button>
                </div>
            </div>
        </div>
    </div>

@section('scripts')
            <script src="{{ asset('vendor/moment/moment.min.js') }}"></script>
            <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.js"></script>

            
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
            <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
            <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>

            {{-- Date Picker --}}
            <script
                src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
            <script src="{{ asset('vendor/moment/moment.min.js') }}"></script>
<script type="text/javascript">
        function fetch_data(isActive) {
            //  console.log("IsActive: " + isActive);
            //Biller List
            $('#dataTable').DataTable().clear().destroy();
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
                        d.request_origin = 'web',
                            d.is_active = isActive
                    }
                },

                columnDefs: [{

                    targets: 5,
                    render: function(data, type, row, meta) {

                        if (row.is_active == 1) {

                            return '<td class="text-center"><button title="Edit Biller Details" data-billerid="' +
                                row.id +
                                '" class="bank_entry"><i class="bi bi-pencil"></i></button><button title="Upload Biller Logo" data-billerid="' +
                                row.id +
                                '" class="biller_logo btn"><i class="bi bi-upload"></i></button><button title="Transaction Details" data-billerid="' +
                                row.id +
                                '" class="biller_transaction btn" ><i class="bi bi-list-check"></i></button><a class="editusercls" title="Edit" href="{{ url('api/user') }}/' +
                                row.user_id +
                                '/edit" ><i class="bi bi-pencil-square"></i></a><button title="Add Funds" data-userid="' +
                                row.user_id +
                                '" class="add_funds_entry btn btn-sm btn-icon " style="font-size:16px"><i class="bi bi-cash"></i></button><button title="Disable Biller" data-billerid= "' +
                                row .id +
                                '"  class="btn btn-danger disable_biller btn-block mt-3" >Disable </button></td>';
                        } else {
                            return '<td class="text-center"><button title="Edit Biller Details" data-billerid="' +
                                row.id +
                                '" class="bank_entry "><i class="bi bi-pencil"></i></button><button title="Upload Biller Logo" data-billerid="' +
                                row.id +
                                '" class="biller_logo btn"><i class="bi bi-upload"></i></button><button title="Transaction Details" data-billerid="' +
                                row.id +
                                '" class="biller_transaction btn" ><i class="bi bi-list-check"></i></button><a title="Edit" href="{{ url('api/user') }}/' +
                                row.user_id +
                                '/edit" class="editusercls" ><i class="bi bi-pencil-square"></i></a><button title="Add Funds" data-userid="' +
                                row.user_id +
                                '" class="add_funds_entry btn btn-sm btn-icon "style="font-size:16px"><i class="bi bi-cash"></i></button><button title="Enable Biller" data-billerid= "' +
                                row.id +
                                '"  class="btn btn-info enable_biller btn-fill-approve btn-block mt-3" >Enable</button></td>';
                        }
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
                        data: 'biller_name',
                        className: "biller_name",
                    },
                    {
                        data: 'biller_category.category_name',
                        className: "biller_category",
                    },
                    {
                        "render": function(data, type, JsonResultRow, meta) {
                            return '<img src="' + JsonResultRow.biller_img_url +
                                '"height="75" width="75" alt="Logo">';
                        }
                    },
                    {
                        "render": function(data, type, JsonResultRow, meta) {
                            //console.log(JsonResultRow.biller_fields.fields);
                            var fields = '<table class="table tbl">';
                            $.each(JsonResultRow.biller_fields.fields, function(key, value) {
                                fields += '<tr><td>' + value.name + '</td><td>' +
                                    value
                                    .regex + '</td></tr>';
                            })
                            fields += '</table>';
                            //console.log(fields);
                            return fields;
                        }

                    }
                ]

            });
        }

        $(document).ready(function() {
            $(".navbar-nav li").removeClass("active"); //this will remove the active class from  
            //previously active menu item 
            $('#bill_payment').addClass('active');

            //Default Active Tab
            document.getElementById("defaultOpen").click();

            //country code
            /* var input = document.querySelector("#mobile_no");
            window.intlTelInput(input, {

                utilsScript: "js/utils.js",
            }); */

            /*  Crop Image */
            /* $uploadCrop = $('#cropie-demo').croppie({
                enableExif: true,
                viewport: {
                    width: 200,
                    height: 200,
                    type: 'circle'
                },
                boundary: {
                    width: 300,
                    height: 300
                }
            });
            $('#upload').on('change', function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $uploadCrop.croppie('bind', {
                        url: e.target.result
                    }).then(function() {
                        console.log('jQuery bind complete');
                    });
                }
                reader.readAsDataURL(this.files[0]);
            }); */

            var spinner = $('#loader');

            /* var IsActive = $(this).data('is_active');
            console.log("IsActive: " + IsActive); */





            function getImg(data, type, full, meta) {
                //
                return '<img  src="your image path(imgsrc )" />';
            }

            //Get User ID
            $("#dataTable").on('click', '.add_funds_entry', function() {

                $('#add_funds_form').modal('show');


                $('#submit_button').attr('data-user-id', $(this).data('userid'));
            });
            $('.input-daterange').datepicker({
                        todayBtn: 'linked',
                        format: 'yyyy-mm-dd',
                        autoclose: true
                    });
            $('#filter').click(function() {
                        var from_date = $('#from_date').val();
                        var to_date = $('#to_date').val();
                        // console.log($('.activeWallet').data('wallet_type'));
                        fetch_data(from_date, to_date, $('.activeWallet').data('wallet_type'));
                    });
            //Add funds
            $('#addFunds').on('submit', function(e) {
                e.preventDefault();
                spinner.show();

                var formFields = $('#addFunds').serialize();
                var send_to = $('#submit_button').data('user-id');
                // console.log("Bank Id: " + send_to);

                $.ajax({
                    url: 'api/send-funds',
                    type: 'post',
                    dataType: 'JSON',
                    data: formFields + '&is_wallet_refill=1&send_to=' + send_to,
                    success: function(data) {
                        //alert(JSON.stringify(meta.message));
                        //console.log("ttttt");
                        if (data.error_code == 0) {
                            //  console.log(data);
                            spinner.hide();
                            $('#add_funds_form').modal('hide');
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
                        spinner.hide();
                        $('#addFunds').closest('form').find(
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
                                        "<br/>"); //this is my div with messages

                                    spinner.hide();
                                }
                            });
                        }

                    }



                });
            });



            //Disable Biller
            $("#dataTable").on('click', '.disable_biller', function() {
                //d.preventDefault();

                var BillerId = $(this).data('billerid');
                // console.log("PromotionId: " + BillerId);

                Swal.fire({
                    title: "Do you want to Disable this Biller?",
                    text: "",
                    showCancelButton: true
                }).then((result) => {
                    if (result.value) {
                        //   console.log("Result: " + result.value);
                        $.ajax({
                            url: '{{ url('api/biller') }}/' + BillerId,
                            type: 'patch',
                            dataType: 'JSON',
                            data: {
                                'is_active': 0
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

                                                alert("Error:" +
                                                    value);
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
            //Enable Biller
            $("#dataTable").on('click', '.enable_biller', function() {
                var BillerId = $(this).data('billerid');
                //console.log("PromotionId: " + BillerId);

                Swal.fire({
                    title: "Do you want to Enable this Voucher?",
                    text: "",
                    showCancelButton: true
                }).then((result) => {
                    if (result.value) {
                        //console.log("Result: " + result.value);
                        $.ajax({
                            url: '{{ url('api/biller') }}/' + BillerId,
                            type: 'patch',
                            dataType: 'JSON',
                            data: {
                                'is_active': 1
                            },
                            success: function(data) {
                                //alert(JSON.stringify(meta.message));
                                //console.log("ttttt");
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

            /*         Crop Image */
            var $modal = $('#modal');
            var image = document.getElementById('image');
            var cropper;
            $("body").on("change", ".image", function(e) {
                var files = e.target.files;
                var done = function(url) {
                    image.src = url;
                    $modal.modal('show');
                };
                var reader;
                var file;
                var url;
                if (files && files.length > 0) {
                    file = files[0];
                    if (URL) {
                        done(URL.createObjectURL(file));
                    } else if (FileReader) {
                        reader = new FileReader();
                        reader.onload = function(e) {
                            done(reader.result);
                        };
                        reader.readAsDataURL(file);
                    }
                }
            });
            $modal.on('shown.bs.modal', function() {
                cropper = new Cropper(image, {
                    aspectRatio: 1,
                    viewMode: 3,
                    preview: '.preview'
                });
            }).on('hidden.bs.modal', function() {
                cropper.destroy();
                cropper = null;
            });
            //Upload image
            var Biller_Id = null;
            $("#dataTable").on('click', '.biller_logo', function() {
                //console.log("inside biller logo model");
                var billerId = $(this).data('billerid');
                Biller_Id = billerId;
                //console.log("BillerIDDD: ", billerId);

                $('#upload_biller_logo_form').modal('show');

                $('#upload_biller_submit_button').attr('data-biller-id', $(this).data('billerid'));
            });
            $("#upload_biller_submit_button").click(function() {
                /*  e.preventDefault(); */
                spinner.show();
                //console.log("BilllerIDDDDD: " + Biller_Id);
                /*  var send_to = $('#upload_biller_submit_button').data('user-id');
                 console.log("send_to Id: " + send_to); */
                canvas = cropper.getCroppedCanvas({
                    width: 160,
                    height: 160,
                });
                canvas.toBlob(function(blob) {
                    url = URL.createObjectURL(blob);
                    var reader = new FileReader();
                    reader.readAsDataURL(blob);
                    reader.onloadend = function() {
                        var base64data = reader.result;
                        console.log("imgUploadLogo: " + base64data);

                        $.ajax({
                            url: '{{ url('api/biller') }}/' + Biller_Id,
                            type: 'post',
                            dataType: 'JSON',
                            data: {
                                'biller_img_base64': base64data
                            },
                            success: function(data) {
                                //alert(JSON.stringify(meta.message));
                                //console.log("ttttt");
                                if (data.error_code == 0) {
                                    // console.log(data);
                                    spinner.hide();
                                    $('#add_profile_form').modal('hide');
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
                                            $.each(value, function(key,
                                                value) {
                                                // console.log(key +
                                                //     " " +
                                                //     value);
                                                $('#response')
                                                    .show()
                                                    .append(value +
                                                        "<br/>");
                                                spinner.hide();
                                            });
                                        } else {
                                            $('#response').show().append(
                                                value +
                                                "<br/>"
                                            ); //this is my div with messages
                                            spinner.hide();
                                        }
                                    });
                                }

                            }


                        });
                    }
                });

            });

            //Edit Biller 
            $("#dataTable").on('click', '.bank_entry', function() {
                // console.log("yyer");
                var BillerNm = $(this).closest('tr').find('.biller_name').text();
                var billerid = $(this).data('billerid');
                //  console.log("BillerIDDD: ", billerid);

                $('#billerName').val(BillerNm);
                //$('#billers').value(field);

                $('#edit_billers_form').modal('show');

                //Get biller category list
                $.ajax({
                    url: 'api/biller-category',
                    type: 'get',
                    success: function(data) {
                        // console.log('data');
                        $('#billerCategory').empty();
                        $.each(data.data, function($index, $value) {

                            $('#billerCategory').append('<option value="' + $value
                                .id + '" >' + $value
                                .category_name + '</option>');
                        })
                    }
                });

                $.ajax({
                    url: 'api/biller/' + billerid,
                    type: 'get',
                    success: function(data) {
                        // console.log('data');
                        $('#appendfields').empty();
                        //var fields = '';
                        i = 0;
                        $.each(data.data.biller_fields.fields, function($index, $value) {
                            $('#appendfields').append(
                                '<div class="col-xl-12 p-0" style="border-bottom: 1px solid #e4e4e4;margin-bottom: 10px;"><div class="row"><div class="col-xl-6"><label>Placeholder</label><div class="input-group"><input title="Placeholder" class="billerInput" type="text" name="biller_fields[fields][' +
                                i +
                                '][name]" id="name" value="' +
                                $value.name +
                                '"></div></div><div class="col-xl-6"><label>Regex</label><div class="input-group"><input  class="billerInput" title="Regex" type="text" name="biller_fields[fields][' +
                                i +
                                '][regex]" id="regex" value="' +
                                $value.regex + '"></div></div></div>' +
                                '<div class="col-xl-6 p-0 d-flex justify-text-center mt-2" style="width:-webkit-fill-available;"><label style="width: 100%;padding-top: 6px;">Check regex</label><div class="input-group"><input  class="billerInput" title="Regex" id="checkbox_' +
                                i +
                                '" type="checkbox"  class="checkboxClass"  name="biller_fields[fields][' +
                                i +
                                '][check_regex]" id="check_regex" value="' +
                                $value.check_regex + '"></div></div>' +
                                '</div>');

                            if ($value.check_regex)
                                $('#checkbox_' + i).attr('checked', 'checked');
                            i++;

                        })


                    }
                });

                $('#submit_button').attr('data-biller-id', $(this).data('billerid'));
            });

            $("#edit_billers_form").on("hide.bs.modal", function() {

                // window.location.reload();
            });
            $('#editBiller').on('submit', function(e) {
                e.preventDefault();

                var formFields = $('#editBiller').serialize();
                // var formFields = new FormData($('#editBiller'));
                console.log("formFields: " + formFields);
                var BillerId = $('#submit_button').data('biller-id');

                $.ajax({
                    url: 'api/biller/' + BillerId,
                    type: 'patch',
                    dataType: 'JSON',
                    data: formFields,
                    cache: false,
                    async: false,
                    success: function(data) {
                        //alert(JSON.stringify(meta.message));
                        if (data.error_code == 0) {
                            //console.log(data);
                            $('#edit_billers_form').modal('hide');
                            
                            Swal.fire({
                                title: "" + data.meta.message,
                                icon: 'success',
                                showCloseButton: true
                            })
                            $('#dataTable').DataTable().ajax.reload();
                        } else {
                            swal(data.meta.message, "error");
                        }

                        $('#editBiller').closest('form').find(
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

            //Biller Transaction Details
            $("#dataTable").on('click', '.biller_transaction', function() {
                // console.log("yyer");
                var BillerNm = $(this).closest('tr').find('.biller_name').text();
                var billerid = $(this).data('billerid');
                //console.log("BillerIDDD: ", billerid);

                $('#billerNm').val(BillerNm);

                $('#billers_transaction_form').modal('show');

                $('#dataTableBillerTrans').DataTable({
                    "lengthMenu": [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ],
                    "bLengthChange": false,
                    "processing": true,
                    "serverSide": true,
                    "searching": false,
                    "ajax": {
                        url: '{{ url('api/bill-payment') }}',
                        data: function(d) {
                            d.request_origin = 'web',
                                d.biller_id = billerid
                        }
                    },
                    "columns": [{
                            data: 'created_at',
                            className: "created_at",
                            render: function(data, type, row, meta) {
                                return moment.utc(data).local().format(
                                    'DD/MM/YYYY HH:mm a');
                            }
                        },
                        {
                            data: 'bill_payment_id'
                        },
                        {
                            data: 'biller_fields.amount.value'
                        },
                        {
                            data: 'user.username',

                            render: function(data, type, row) {
                                return row.user.username + '<br>(MobileNo: ' + row.user
                                    .mobile_no +
                                    ')' + '<br>(UserType: ' + row.user.user_type +
                                    ')';
                            }
                        }
                    ]

                });

            });
            $("#billers_transaction_form").on("hide.bs.modal", function() {

                window.location.reload();
            });



            //Add Biller
            $("#add_biller_button").on('click', function() {
                $('#biller_form').modal('show');

                //Get biller category list
                $.ajax({
                    url: 'api/biller-category',
                    type: 'get',
                    success: function(data) {
                        // console.log('data');
                        $('#biller_category_id').empty();
                        $.each(data.data, function($index, $value) {

                            $('#biller_category_id').append('<option value="' + $value
                                .id + '" >' + $value
                                .category_name + '</option>');
                        })
                    }
                });
            });

            $(document).on('change', '.checkboxClass', function() {
                if ($(this).is(':checked')) {
                    $(this).attr('value', 1);
                    // console.log( $(this).parent().next());
                    $(this).parent().next().show();
                } else {
                    // console.log( $(this).parent().next());
                    $(this).attr('value', 0);
                    $(this).parent().next().hide();
                }
            });

            var maxField = 10;
            var addButton = $('.add_button');
            var addfields = $('.fields');
            i = 0;


            $(addButton).click(function() {
                if (i < maxField) {
                    i++;
                    var inputField =
                        '<div class="fields"><div class="form-group"><label>Placeholder</label><div class="input-group"><input type="text" name="biller_fields[fields][' +
                        i +
                        '][name]" value="" class="form-control" title="Placeholder(e.g. Mobile No, Biller No.)" required /></div></div><div class="form-group"><label>Validate</label><input type="checkbox" name="biller_fields[fields][' +
                        i +
                        '][check_regex]" id="checkbox1"  class="checkboxClass"  value=0></div><div class="form-group" id="regex"><label>Regex</label><div class="input-group"><input type="text" name="biller_fields[fields][' +
                        i +
                        '][regex]" value="" class="form-control" title="To validate placeholder" /></div></div></div>';
                    $(addfields).append(inputField);
                }
            });

            $('#addNewBiller').on('submit', function(e) {
                e.preventDefault();
                spinner.show();
                /* var password = Math.floor(10000000 + Math.random() * 90000000);
                var password_confirmation = password;

                $("<input />").attr("type", "hidden")
                    .attr("name", "password")
                    .attr("value", password)
                    .appendTo("#addNewBiller");

                $("<input />").attr("type", "hidden")
                    .attr("name", "password_confirmation")
                    .attr("value", password)
                    .appendTo("#addNewBiller"); */

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
                        //console.log("ttttt");

                        if (data.error_code == 0) {
                            //console.log(data);
                            spinner.hide();
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

            // $("#biller_form").on("hide.bs.modal", function() {

            //     window.location.reload();
            // });

</script>

@endsection

