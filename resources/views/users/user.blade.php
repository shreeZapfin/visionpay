@extends('layouts.master')
@section('styles')
@endsection
@section('content')
                    <!-- PAGE-HEADER -->
                    <div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
                        <h1 class="page-title">User List</h1>
                        <div>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/index')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Users</li>
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
                                            <form name='filter_search' id='filter_search' style="margin-top: 20px;">
                                                <div class="input-group">
                                                    <div class="form-group col-sm">
                                                        <label>Gender</label>
                                                        <select name="gender" id="gender" class="select2 form-control custom-select">
                                                            <option value="" selected="selected">Select Gender</option>
                                                            <option value="MALE">Male</option>
                                                            <option value="FEMALE">Female</option>
                                                        </select>
                                                    </div> &nbsp;&nbsp;
                                                    <div class="form-group col-sm">
                                                    <label>City</label>
                                                    <input type="text" name="city" id="city" class="form-control" aria-describedby="button-addon2"
                                                        placeholder="Enter City" />
                                                    </div>
                                                    <div class="form-group col-sm d-flex report_btns" style="padding-top: 29px !important;">
                                                                    <button type="button" name="filter" id="filter"
                                                                        class="btn btn-info btn-sm filter">Filter
                                                                    </button>
                                                                    &nbsp;&nbsp;
                                                                    <button type="button" name="export" id="export"
                                                                        class="btn btn-block btn-success">Export All
                                                                    </button>
                                                                </div>
                                                </div>
                                            </form>
                                            <div class="col-xl-2 col-lg-12">
                                                <!-- <a href="javascript:void(0);" class="btn btn-primary btn-block float-end my-2"  data-bs-toggle="modal" data-bs-target="#add-user"><i class="fa fa-plus-square me-2"></i>Add User</a> -->
                                                <div class="modal fade" id="add-user" tabindex="-1" aria-labelledby="add-userLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h6 class="modal-title" id="add-userLabel">Add User</h6>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body px-4">
                                                                <div class="row gy-3">
                                                                    <div class="col-xl-12">
                                                                        <label for="user-name" class="form-label">User Name</label>
                                                                        <input type="text" class="form-control" id="user-name" placeholder="Enter Name">
                                                                    </div>
                                                                    <div class="col-xl-12">
                                                                        <label class="form-label">Designation</label>
                                                                        <input type="text" class="form-control" id="user-designation" placeholder="Enter Designation">
                                                                    </div>
                                                                    <div class="col-xl-12">
                                                                        <div class="file-upload-text">
                                                                            <input type="file" id="user-file-input" multiple>
                                                                            <label for="user-file-input" class="text-primary fs-13">
                                                                                <img src="{{asset('build/assets/images/users/22.jpg')}}" class="rounded-circle h-20p w-20p" alt="">
                                                                                Upload Profile
                                                                                <span class="text-muted"></span>
                                                                            </label>
                                                                            <i class="fa fa-times-circle remove"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                                <button type="button" class="btn btn-primary">Add User</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-content mb-5">
                                <div class="tab-pane active" id="tab-11">
                                    <div class="card">
                                        <div class="card-header border-bottom-0 px-5">
                                            <div class="page-options ms-auto">
                                                <!-- <select class="form-control select2 w-100">
                                                    <option value="asc">Latest</option>
                                                    <option value="desc">Oldest</option>
                                                </select> -->
                                            </div>
                                        </div>
                                        <div class="e-table px-5 pb-5">
                                            <div class="table-responsive table-lg">
                                                <table class="table border-top table-bordered mb-0 text-nowrap userstbl" id="dataTable" style="width:100%;">
                                                    <thead class="border-top">
                                                        <tr>
                                                            <th class="border-bottom-0">Date</th>
                                                            <th class="border-bottom-0">Name</th>
                                                            <th class="border-bottom-0">Email</th>
                                                            <th class="border-bottom-0">Username</th>
                                                            <th class="border-bottom-0 ">Mobile No</th>
                                                            <th class="border-bottom-0">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="">
                                        <ul class="pagination float-end">
                                            <li class="page-item page-prev disabled">
                                                <a class="page-link" href="javascript:void(0);" tabindex="-1">Prev</a>
                                            </li>
                                            <li class="page-item active"><a class="page-link"
                                                    href="javascript:void(0);">1</a></li>
                                            <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                                            <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                                            <li class="page-item"><a class="page-link" href="javascript:void(0);">4</a></li>
                                            <li class="page-item"><a class="page-link" href="javascript:void(0);">5</a></li>
                                            <li class="page-item page-next">
                                                <a class="page-link" href="javascript:void(0);">Next</a>
                                            </li>
                                        </ul>
                                    </div> -->
                                    <!-- COL-END -->
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
                <div class="modal-body px-4">
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
                                <div class="px-4 py-4 text-center">
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
@section('scripts')
<script type="text/javascript">
        //Add asterisk in TIN input
        transaction_pin.addEventListener("keyup", function changeChar() {
                const asterisks = "****";
                document.getElementById("pin").value = transaction_pin.value;
                if(transaction_pin.value.length == 4){
                    if (transaction_pin.value.length <= asterisks.length) {
                        let newNumber = asterisks.substring(0, transaction_pin.value.length);
                        transaction_pin.value = newNumber;
                    }
                }
                
            });
        $(document).ready(function() {
            $('.cancel_btn').click(function() {
                $('form :input').val('');   //CLEAR FORM INPUT
            });

            //For OTP input
            // const input = document.querySelector('[autocomplete=one-time-code');
            // input.addEventListener('input', () => input.style.setProperty('--_otp-digit', input.selectionStart));
            $(".navbar-nav li").removeClass("active"); //this will remove the active class from
            //previously active menu item
            //$('#home').addClass('active');
            //for demo
            $('#user').addClass('active');
            //for sale
            //$('#merchant').addClass('active');

            var spinner = $('#loader');

            fetch_data();

            function fetch_data(gender, city) {
                $('#dataTable').DataTable().clear().destroy();

                $('#dataTable').DataTable({
                    "lengthMenu": [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ],
                    "processing": true,
                    "serverSide": true,
                    "searching": true,
                    "ajax": {
                        url: '{{ url('api/user/search') }}',
                        data: function(d) {
                            d.user_type_id = 2,
                                d.search = d.search['value'],
                                d.request_origin = 'web',
                                d.gender = gender,
                                d.city = city
                        }
                    },
                    columnDefs: [{
                        targets: 5,
                        render: function(data, type, row, meta) {
                            return '<div class="btn-list"><a title="Edit" class="btn btn-sm btn-icon" style="color:#00a5a2;font-size: 15px;" href="{{ url('api/user') }}/' +
                                row.id + '/edit"><i class="bi bi-pencil-square"></i></a><a  title="Add Funds"  data-bs-toggle="modal" data-bs-target="#add_funds_form" class="add_funds_entry btn btn-sm btn-icon" style="color:#db555d; font-size:16px;" data-userid="' +
                                row.id + '"><i class="bi bi-cash"></i></a></div>';
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
                            data: 'full_name'
                            /* sortable: true,
                            searchable: true */
                        },
                        {
                            data: 'email'
                        },
                        {
                            data: 'username'
                        },
                        {
                            data: 'mobile_no'
                        },
                    ]

                });
            }



            //Filter Button
            $('#filter').click(function() {
                var gender = $('#gender').val();
                var city = $('#city').val();

                fetch_data(gender, city);
            });



            //Get User ID
            $("#dataTable").on('click', '.add_funds_entry', function() {

                $('#add_funds_form').modal('show');


                $('#submit_button').attr('data-user-id', $(this).data('userid'));
            });

            //Add funds
            $('#addFunds').on('submit', function(e) {
                e.preventDefault();
                spinner.show();

                var formFields = $('#addFunds').serialize();
                var send_to = $('#submit_button').data('user-id');
                //console.log("Bank Id: " + send_to);

                $.ajax({
                    url: 'api/send-funds',
                    type: 'post',
                    dataType: 'JSON',
                    data: formFields + '&is_wallet_refill=1&send_to=' + send_to,
                    success: function(data) {
                        //alert(JSON.stringify(meta.message));
                        //console.log("ttttt");
                        if (data.error_code == 0) {
                            //console.log(data);
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
                        if (data.status == 400) {
                            $('#add_funds_form').modal('hide');
                            $('#dataTable').DataTable().ajax.reload();
                            spinner.hide();
                            Swal.fire({
                                title: "" + data.responseJSON.meta
                                    .message,
                                icon: 'error',
                                showCloseButton: true
                            })
                        } else
                        if (data.status === 422) {
                            var errors = $.parseJSON(data.responseText);
                            $.each(errors, function(key, value) {
                                // console.log(key+ " " +value);
                                $('#response').addClass(
                                    "alert alert-danger");

                                if ($.isPlainObject(value)) {
                                    $.each(value, function(key, value) {
                                        //console.log(key + " " +value);
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

        });
    </script>
@endsection
