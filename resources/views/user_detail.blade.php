
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
                        <h1 class="page-title">User Details</h1>
                        <div>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/index')}}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{url('/users')}}">Users</a></li>
                                <li class="breadcrumb-item active" aria-current="page">User Details</li>
                            </ol>
                        </div>
                    </div>
                    <!-- PAGE-HEADER END -->

                    <!-- CONTAINER -->
                    <div class="main-container container-fluid">

                        <!-- ROW-1 -->
                        <div class="row">
                            <div class="col-xxl-3 col-xl-4 col-lg-5 col-md-5">
                                <div class="card text-center shadow-none border profile-cover__img">
                                    <div class="card-body">
                                        <div class="profile-img-1">
                                            <img src="{{ $userDetails->profile_pic_img_url }}"
                                                            width="150" alt="img" id="profile-img">

                                        </div>
                                        <div class="profile-img-content text-dark my-2">
                                            <div>
                                                <h5 class="mb-0">
                                                    @if ($userDetails->user_type_id == 2 or $userDetails->user_type_id == 5)
                                                        {{ $userDetails->full_name }}
                                                    @endif
                                                    @if ($userDetails->user_type_id == 3 or $userDetails->user_type_id == 4)
                                                        {{ $userDetails->business->business_name }}
                                                    @endif
                                                </h5>
                                                {{-- <label class="main">
                                                <input type="checkbox" name="checkbox_[]" class="checkBoxClass check_checkbox" id="">
                                                <div class="geekmark"></div>
                                                </label> --}}
                                                <p class="text-muted mb-0">{{ $userDetails->username }}</p>
                                            </div>
                                        </div>
                                        <div class="d-flex btn-list btn-list-icon justify-content-center">
                                            <input type="hidden" id="userID" name="userID" value="{{$userDetails->id}}"/>
                                            <a data-userid="{{ $userDetails->id }}" class="btn btn-primary edit_user_class"
                                            onclick='return edit_user_class()' type="submit" id="edit_button" title="Edit User Details">
                                                    <i class="bi bi-pencil-square "></i></a>
                                                <a data-userid="{{ $userDetails->id }}"
                                                 class="btn btn-secondary add_profile_entry"
                                                    type="submit" id="edit_profile" title="Change Profile" ><i class="bi bi-person-circle"></i></a>
                                                <a data-userid="{{ $userDetails->id }}" class="btn btn-info add_funds_entry"
                                                    type="submit" id="add_fds" title="Add Funds"
                                                    style="color: rgb(0,128,0);"><i class="bi bi-cash"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header d-flex balance_flex">
                                        <div class="card-title">Balance</div>
                                        @if ($userDetails->user_type_id == 2 or $userDetails->user_type_id == 4 or $userDetails->user_type_id == 5)
                                                        <div class="balance_value">{{ $userDetails->wallet->balance }}</div>
                                                    @endif
                                                    @if ($userDetails->user_type_id == 3)
                                                        <div class="balance_value">{{ $userDetails->agent->agentFundsWallet->balance }}</div>
                                                    @endif
                                                    {{-- <button class="btn-fill btn" type="button">Freeze Account</button>
                                    <button class="btn-inverse btn" type="button">Freeze Transactions</button> --}}
                                    </div>
                                    <div class="card-body balance_btns">
                                        <div class="tags">
                                                    @if ($userDetails->account_blocked == 0)
                                                        <button
                                                            data-userid="  {{ $userDetails->id }}
                                                            "
                                                            class="btn btn-primary" type="button" id="FreezAccount">Block
                                                            Account
                                                        </button>
                                                    @else
                                                        <button
                                                            data-userid="  {{ $userDetails->id }}"
                                                            class="btn btn-secondary" type="button"
                                                            id="UnBlockAccount">UnBlock
                                                            Account
                                                        </button>
                                                    @endif

                                                    @if ($userDetails->wallet->blocked_balance <= 0)
                                                        <button
                                                            data-userid="  {{ $userDetails->id }}"
                                                            class="btn btn-info" type="button"
                                                            id="freezWalletBal">Block Wallet
                                                        </button>
                                                    @else
                                                        <button
                                                            data-userid="  {{ $userDetails->id }}"
                                                            class="btn btn-secondary" type="button"
                                                            id="UnBlockWalletBal">UnBlock Wallet
                                                        </button>
                                                        <div class="block_bal">
                                                            <h6>Block Balance:
                                                            {{ $userDetails->wallet->blocked_balance }}</h6></div>
                                                    @endif
                                        </div>
                                    </div>
                                    {{-- Sub account checks --}}
                                            @if ($userDetails->user_type_id == 4)
                                                <div>
                                                    <div class="text-center" style="margin-top: 8%;">
                                                        @if ($userDetails->has_sub_accounts == 0)
                                                            <button
                                                                data-userid="  {{ $userDetails->id }}
                                                            "
                                                                class="btn btn-primary" type="button"
                                                                id="FreezSubAccount">Enable
                                                                SubAccount
                                                            </button>
                                                        @else
                                                            <button
                                                                data-userid="  {{ $userDetails->id }}
                                                            "
                                                                class="btn btn-secondary" type="button"
                                                                id="UnBlockSubAccount">Disable
                                                                SubAccount
                                                            </button>
                                                        @endif

                                                    </div>
                                                </div>
                                            @endif

                                            <div class="text-center" style="margin-top: 15px;">
                                                @if ($userDetails->is_kyc_verified == false &&
                                                    $userDetails->selfie_img_url != '' &&
                                                    $userDetails->kyc_document_url != '' &&
                                                    $userDetails->transaction_pin != '')
                                                    <button
                                                        data-userid="  {{ $userDetails->id }}
                                                        "
                                                        class="btn btn-primary" type="button"
                                                        id="approve">Approve <i class="fa fa-check"></i></button>
                                                    <button
                                                        data-userid="  {{ $userDetails->id }}
                                                        "
                                                        class="btn btn-secondary" type="button"
                                                        style="background-color: rgb(245, 174, 174); color: rgb(196, 49, 49);"
                                                        id="reject">Reject <i class="fa fa-times"></i></button>
                                                @endif

                                            </div>
                                </div>
                                <div class="card">
                                    <div class="card-header justify-content-between align-items-center">
                                        <div class="card-title">QR Code<span class="badge rounded-pill bg-default"></span></div>
                                        <a class="bi bi-warning" data-userid="{{ $userDetails->id }}"
                                                    href="{{ url('api/user/qr/download/' . $userDetails->id) }}"
                                                    type="submit" id="download_button" title="Download QR Code"
                                                    style="color: rgb(0,128,0);"><i
                                                        class="
                                                        bi bi-download"></i></a>
                                    </div>
                                    <div class="card-body px-5">
                                        <div class="row">
                                            @if (isset($userDetails->qr_code_info))
                                                <img src="data:image/png;base64, {!! base64_encode(
                                                    \SimpleSoftwareIO\QrCode\Facades\QrCode::size(200)->format('png')->backgroundColor(255, 255, 255)->merge('/public/img/qr_logo.png', 0.4)->errorCorrection('H')->generate($userDetails->qr_code_info),
                                                ) !!} ">
                                            @else
                                                <div class="danger">QR NOT FOUND</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-9 col-xl-8 col-lg-7 col-md-7">
                                <div class="card">
                                    <div class="card-header">
                                        <ul class="nav nav-pills gap-2" id="pills-tab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button type="button" aria-label="anchor" class="nav-link active" id="about-tab"
                                                    data-bs-toggle="pill" data-bs-target="#about">About</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="timeline-tab" data-bs-toggle="pill"
                                                    data-bs-target="#timeline" type="button" role="tab"
                                                    aria-controls="timeline" aria-selected="false">User Details</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="gallery-tab" data-bs-toggle="pill"
                                                    data-bs-target="#gallery" type="button" role="tab"
                                                    aria-controls="gallery" aria-selected="false">Documents</button>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="tab-content" id="pills-tabContent">
                                            <div class="tab-pane fade show active" id="about">
                                            <div class="table-responsive p-5">
                                                    <h5 class="mb-3">Personal Info</h5>
                                                    <div class="row">
                                                        <div class="col-xl-8 ms-3">
                                                            <div class="row row-sm">
                                                                <div class="col-md-3">
                                                                    <span class="fw-semibold fs-14">First Name : </span>
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <span class="fs-15">{{isset($userDetails->first_name) && !empty($userDetails->first_name) ? $userDetails->first_name  : 'NA'}}</span>
                                                                </div>
                                                            </div>
                                                            <div class="row row-sm mt-3">
                                                                <div class="col-md-3">
                                                                    <span class="fw-semibold fs-14">Last Name : </span>
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <span class="fs-15">{{isset($userDetails->last_name) && !empty($userDetails->last_name) ? $userDetails->last_name  : 'NA'}}</span>
                                                                </div>
                                                            </div>
                                                            <div class="row row-sm mt-3">
                                                                <div class="col-md-3">
                                                                    <span class="fw-semibold fs-14">Mobile : </span>
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <span class="fs-15">{{isset($userDetails->mobile_no) && !empty($userDetails->mobile_no) ? $userDetails->mobile_no  : 'NA'}}</span>
                                                                </div>
                                                            </div>
                                                            <div class="row row-sm mt-3">
                                                                <div class="col-md-3">
                                                                    <span class="fw-semibold fs-14">Email : </span>
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <span class="fs-15 text-primary">{{isset($userDetails->email) && !empty($userDetails->email) ? $userDetails->email  : 'NA'}}</span>
                                                                </div>
                                                            </div>
                                                            <div class="row row-sm mt-3">
                                                                <div class="col-md-3">
                                                                    <span class="fw-semibold fs-14">Date of birth : </span>
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <span class="fs-15">{{isset($userDetails->date_of_birth) && !empty($userDetails->date_of_birth) ? $userDetails->date_of_birth  : 'NA'}}</span>
                                                                </div>
                                                            </div>
                                                            <div class="row row-sm mt-3">
                                                                <div class="col-md-3">
                                                                    <span class="fw-semibold fs-14">Gender : </span>
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <span class="fs-15">{{isset($userDetails->gender) && !empty($userDetails->gender) ? $userDetails->gender  : 'NA'}}</span>
                                                                </div>
                                                            </div>
                                                            <div class="row row-sm mt-3">
                                                                <div class="col-md-3">
                                                                    <span class="fw-semibold fs-14">Country : </span>
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <span class="fs-15">{{isset($userDetails->city->country->country_name) && !empty($userDetails->city->country->country_name) ? $userDetails->city->country->country_name  : 'NA'}}</span>
                                                                </div>
                                                            </div>
                                                            <div class="row row-sm mt-3">
                                                                <div class="col-md-3">
                                                                    <span class="fw-semibold fs-14">City : </span>
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <span class="fs-15">{{isset($userDetails->city->city_name) && !empty($userDetails->city->city_name) ? $userDetails->city->city_name  : 'NA'}}</span>
                                                                </div>
                                                            </div>
                                                            @if ($userDetails->user_type_id == 4 or $userDetails->user_type_id == 3)
                                                                <div class="row row-sm mt-3">
                                                                    <div class="col-md-3">
                                                                        <span class="fw-semibold fs-14">Business Name : </span>
                                                                    </div>
                                                                    <div class="col-md-9">
                                                                        <span class="fs-15">{{isset($userDetails->business->business_name) && !empty($userDetails->business->business_name) ? $userDetails->business->business_name : 'NA'}}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="row row-sm mt-3">
                                                                    <div class="col-md-3">
                                                                        <span class="fw-semibold fs-14">Business Type : </span>
                                                                    </div>
                                                                    <div class="col-md-9">
                                                                        <span class="fs-15">{{isset($userDetails->business->businessType->business_type) && !empty($userDetails->business->businessType->business_type) ? $userDetails->business->businessType->business_type : 'NA'}}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="row row-sm mt-3">
                                                                    <div class="col-md-3">
                                                                        <span class="fw-semibold fs-14">Merchant Category : </span>
                                                                    </div>
                                                                    <div class="col-md-9">
                                                                        <span class="fs-15">{{isset($userDetails->business->merchantCategory->category_name) && !empty($userDetails->business->merchantCategory->category_name) ? $userDetails->business->merchantCategory->category_name : 'NA'}}</span>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            <div class="row row-sm mt-3">
                                                                <div class="col-md-3">
                                                                    <span class="fw-semibold fs-14">Address : </span>
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <span class="fs-15">{{isset($userDetails->address) && !empty($userDetails->address) ? $userDetails->address  : 'NA'}}</span>
                                                                </div>
                                                            </div>
                                                          </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="timeline">
                                                <div class="row p-5">
                                                    <div class="col-xl-12">
                                                    <div class="card user_cards">
                                                            <div class="card-body">
                                                                <div class="card-pay">
                                                                    <ul class="tabs-menu nav" role="tablist">
                                                                        <li class=""><a href="#tab_transfer" class="active" data-bs-toggle="tab" aria-selected="true" role="tab"> TRANSFER LIMIT SCHEME </a></li>
                                                                        @if ($userDetails->user_type_id == 2 or $userDetails->user_type_id == 4 or $userDetails->user_type_id == 5)
                                                                        <li><a href="#tab_payment" data-bs-toggle="tab" class="" aria-selected="false" role="tab" tabindex="-1"> PAYMENT CHARGE PACKAGE</a></li>
                                                                        @endif
                                                                        @if ($userDetails->user_type_id == 3)
                                                                            <li><a href="#tab_wallet" data-bs-toggle="tab" class="" aria-selected="false" role="tab" tabindex="-1">  WALLET LIMIT SCHEME </a></li>
                                                                        @endif
                                                                    </ul>
                                                                    <div class="tab-content">
                                                                        <div class="tab-pane active show" id="tab_transfer" role="tabpanel">
                                                                                <h5 class="font-bold mb-4">
                                                                                    Transfer Limit Scheme
                                                                                </h5>
                                                                                <div>
                                                                                    <table class="table table-bordered" cellspacing="0">
                                                                                        <tr style="text-align: center;">
                                                                                            <th>Name</th>
                                                                                            <th>Eligible Limit Per Month</th>
                                                                                            <th>Eligible Limit Per Day</th>
                                                                                            <th>Edit</th>
                                                                                        </tr>
                                                                                        <tr style="text-align: center;">
                                                                                            <td>{{ $userDetails->transferLimitScheme->name }}
                                                                                            </td>
                                                                                            <td>{{ $userDetails->transferLimitScheme->eligible_limit_per_month }}
                                                                                            </td>
                                                                                            <td>{{ $userDetails->transferLimitScheme->eligible_limit_per_day }}
                                                                                            </td>
                                                                                            <td>
                                                                                                <button class="btn btn-primary limit_class"
                                                                                                    type="submit" id="editTransferLimitScheme"
                                                                                                    title="Edit Transfer Limit"><i
                                                                                                        class="bi bi-pencil-square fa-lg"></i></button>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </div>
                                                                        </div>
                                                                        <div class="tab-pane" id="tab_payment" role="tabpanel">
                                                                                <h5 class="font-bold mb-4">Payment Charge
                                                                                    Package</h5>
                                                                                <div>
                                                                                    <table class="table table-bordered" cellspacing="0">
                                                                                        <tr style="text-align: center;">
                                                                                            <th>Package type</th>
                                                                                            <th>Package name</th>
                                                                                            <th>Edit</th>
                                                                                        </tr>
                                                                                        @foreach ($userDetails->paymentChargePackage as $package)
                                                                                            <tr style="text-align: center;">
                                                                                                <td>{{ $package->package_type }} </td>
                                                                                                <td>{{ $package->package_name }} </td>
                                                                                                <td>
                                                                                                    <button
                                                                                                        data-packagetype="  {{ $package->package_type }}
                                                                                                    "
                                                                                                        class="btn btn-primary package_class"
                                                                                                        type="submit" id="submit_button"
                                                                                                        title="Edit"><i
                                                                                                            class="bi bi-pencil-square fa-lg"></i></button>
                                                                                                </td>
                                                                                            </tr>
                                                                                        @endforeach
                                                                                    </table>
                                                                            </div>
                                                                        </div>
                                                                        @if ($userDetails->user_type_id == 3)
                                                                            <div class="tab-pane" id="tab_wallet" role="tabpanel">
                                                                                <h4 class="font-bold mb-4">Agent Wallet</h4>
                                                                                <div>
                                                                                    <table class="table table-bordered" cellspacing="0">
                                                                                        <tr>
                                                                                            <th>Date</th>
                                                                                            <th>Wallet Type</th>
                                                                                            <th>Balance</th>
                                                                                            <th>Blocked Balance</th>
                                                                                        </tr>
                                                                                        @foreach ($userDetails->agent->agentWallets as $agentWallet)
                                                                                            <tr>
                                                                                                <td>{{ $agentWallet->updated_at }} </td>
                                                                                                <td>{{ $agentWallet->wallet_type }} </td>
                                                                                                <td>{{ $agentWallet->balance }} </td>
                                                                                                <td>{{ $agentWallet->blocked_balance }}
                                                                                                </td>
                                                                                            </tr>
                                                                                        @endforeach
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                   </div>
                                                </div>
                                            </div>
                                                <div class="tab-pane fade" id="gallery">
                                                    <div class="row p-5">
                                                    <div class="col-xl-12">
                                                            <div class="card user_cards">
                                                                    <div class="card-body">
                                                                        <div class="card-pay">
                                                                            <ul class="tabs-menu nav" role="tablist">
                                                                                <li class=""><a href="#tab_gallery" class="active" data-bs-toggle="tab" aria-selected="true" role="tab"> Passport </a></li>
                                                                                <li><a href="#tab_selfie" data-bs-toggle="tab" class="" aria-selected="false" role="tab" tabindex="-1"> Selfie </a></li>
                                                                            </ul>
                                                                            <div class="tab-content">
                                                                                    {{-- kyc content --}}
                                                                                    <div class="tab-pane show active"
                                                                                        id="tab_gallery" role="tabpanel" aria-labelledby="kyc-doc-tab">
                                                                                        <h5 class="font-bold mb-4">
                                                                                            {{ isset($userDetails->kyc_document_type) && !empty($userDetails->kyc_document_type) ? $userDetails->kyc_document_type : 'Passport' }}
                                                                                        </h5>
                                                                                        <button data-userid="{{ $userDetails->id }}"
                                                                                            class="btn btn-primary add_kyc_entry" type="submit" id="add_fds"
                                                                                            title="Edit KYC"
                                                                                            style="color: rgb(0,128,0); border: none; background: none; width=100px; float: right;"><i
                                                                                                class="bi bi-upload fa-lg"></i> Edit KYC</button>
                                                                                        <div style="margin-top: 10px;"><img
                                                                                                src="{{ $userDetails->kyc_document_url }}"
                                                                                                style="margin-left: auto; margin-right: auto; display: block; border: 1px solid rgb(223, 223, 223); padding: 30px; border-radius: 6px; width: 50%; height:300px;">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="tab-pane" id="tab_selfie" role="tabpanel">
                                                                                        {{-- selfie content --}}
                                                                                        <div class="tab-pane" id="selfie"
                                                                                            role="tabpanel" aria-labelledby="selfie-tab">
                                                                                            <h5 class="font-bold mb-4">Selfie</h5>
                                                                                            <button data-userid="{{ $userDetails->id }}"
                                                                                                class="btn btn-primary add_selfie_entry" type="submit" id="add_fds"
                                                                                                title="Edit Selfie"
                                                                                                style="color: rgb(0,128,0); border: none; background: none; width=100px; float: right;"><i
                                                                                                    class="bi bi-person fa-lg"></i> Edit Selfie</button>

                                                                                            <div style="margin-top: 10px;"><img
                                                                                                    src="{{ $userDetails->selfie_img_url }}"
                                                                                                    style="margin-left: auto; margin-right: auto; display: block; border: 1px solid rgb(223, 223, 223); padding: 30px; border-radius: 6px; width: 50%;height:300px;">
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
                                                </div>
                                    </div>
                                </div>
                                {{-- Transaction Report --}}
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="card ">
                                            <div class="card-header justify-content-between">
                                                <h4 class="card-title mb-0">Report</h4>
                                                <div class="tab">
                                                    <button class="btn btn-primary tablinks" id="defaultOpen"
                                                        data-usertypeid="{{ $userDetails->user_type_id }}"
                                                        data-wallet_type="FUNDS">Wallet History</button>
                                                    @if ($userDetails->user_type_id == 3)
                                                        <button class="btn btn-secondary tablinks"
                                                            data-usertypeid="{{ $userDetails->user_type_id }}"
                                                            data-wallet_type="COMMISSION">Commission
                                                            Report</button>
                                                    @endif
                                                </div>
                                                <script>
                                                    $('.tablinks').on('click', function() {
                                                        document.getElementById('TransReport').style.display = "block";
                                                        $('.tablinks').removeClass('activeWallet');
                                                        $(this).addClass('activeWallet');
                                                        fetch_data(new Date().toISOString().split('T')[0],
                                                            to_date = (new Date()).toISOString().split('T')[0], $(this).data('wallet_type'));
            
                                                    })
                                                </script>
                                            </div>
                                            {{-- @if ($userDetails->user_type_id == 2 or $useDetails->user_type_id == 4 or $userDetails->user_type_id == 5) --}}
                                                <div id="TransReport" class="tabcontent">
                                                    <div class="card-body">

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
                                                                    &nbsp;&nbsp;
                                                                    <button type="button" name="export" id="export"
                                                                        class="btn btn-block">Export All
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>

                                                        <div class="table-responsive">
                                                            <table class="table table-bordered" id="dataTable" width="100%"
                                                                cellspacing="0">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="text-center">Date</th>
                                                                        <th class="text-center">Opening Balance</th>
                                                                        <th class="text-center">Closing Balance</th>
                                                                        <th class="text-center">Credit Amount</th>
                                                                        <th class="text-center">Debit Amount</th>
                                                                        <th class="text-center">Transaction Id</th>
                                                                        <th class="text-center">Transaction Type
                                                                        </th>
                                                                        <th class="text-center">Description</th>
                                                                    </tr>
                                                                </thead>

                                                                <tbody>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- @endif --}}
                                       
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="loader"></div>
                        </div>
                        <!-- ROW-1 CLOSED -->
                    </div>
                    <!-- CONTAINER CLOSED -->
  <!-- Scroll to Top Button-->

            <!-- Edit User Details Modal-->
            <div class="modal fade" id="edit_user_details_form" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit User Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body px-4">
                            <form name='editUserDetails' id='editUserDetails'>
                                <div class="row gy-3">
                                        <div class="col-xl-12">
                                            <label class="text-label form-label">First Name</label>
                                            <input type="text" name="first_name" class="form-control"
                                                    id="first_name" value="{{ $userDetails->first_name }}"
                                                    required>
                                        </div>
                                        <div class="col-xl-12">
                                            <label class="text-label">Last Name</label>
                                            <input type="text" name="last_name" class="form-control"
                                                    id="last_name" value="{{ $userDetails->last_name }}" required>
                                        </div>

                                        <div class="col-xl-12">
                                            <label class="text-label">Date of birth</label>
                                                <input type="date" name="date_of_birth" class="form-control"
                                                    id="date_of_birth" value="{{ $userDetails->date_of_birth }}"
                                                    required>
                                        </div>
                                        <div class="col-xl-12">
                                            <label class="text-label">Gender</label>
                                            <select name="gender" id="gender"
                                                    class="select2 form-control custom-select" required>
                                                    <!-- <option value="{{ $userDetails->gender }}" selected="selected">
                                                        Select Gender
                                                    </option> -->
                                                    <option @if($userDetails->gender == 'MALE') selected  @endif >MALE</option>
                                                    <option @if($userDetails->gender == 'FEMALE') selected  @endif>FEMALE</option>
                                                </select>
                                        </div>
                                        <div class="col-xl-12">
                                            <label class="text-label">Address</label>
                                                <textarea class="form-control" type="text"
                                                name="address" id="address" required>{{ $userDetails->address }}</textarea>
                                        </div>
                                        @if ($userDetails->user_type_id == 4)
                                            <div class="col-xl-12">
                                                <label class="text-label">Business Name</label>
                                                    <input type="text" name="business_name" class="form-control"
                                                        id="business_name"
                                                        value="{{ $userDetails->business->business_name }}">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div id="response" class="px-4 py-4" style="text-align:center">
                                    <button type="submit" class="btn btn-primary btn-rounded btn-fw"
                                        id='edit_button' data-user-id="" style="font-weight:500;">Update
                                    </button>
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Update Profile Picture Model-->
            <div class="modal fade" id="add_profile_form" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel">Add Profile</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body px-4">
                            <form enctype="multipart/form-data">
                                <div class="row  gy-3">
                                    <div class="col-xl-12">
                                            <div class="col-md-4 text-center">
                                                <div id="cropie-demo" style="width:250px"></div>
                                            </div>
                                            <label>Upload Profile</label>
                                            <div class="input-group">
                                            <input type="file" name="image" class="image form-control" id="upload"
                                                    required>
                                            </div>
                                    </div>
                                    <div class="px-4 py-4 text-center">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel
                                    </div>
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
                            {{-- <h5 class="modal-title" id="modalLabel">Laravel Cropper Js - Crop Image Before Upload -
                                Tutsmake.com</h5> --}}
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body px-4">
                            <div class="img-container">
                                <div class="row">
                                    <div class="col-md-8">
                                        <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
                                    </div>
                                    <div class="col-md-4">
                                        <div class="preview"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel
                            {{-- <button type="button" class="btn btn-primary" id="crop">Upload</button> --}}
                            <button type="button" class="btn btn-primary btn-rounded btn-fw"
                                id='profile_submit_button' data-user-id="" style="font-weight:500;">Upload
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add Funds Model-->
            <div class="modal fade" id="add_funds_form" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel">Add Funds</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body px-4">
                            <form name='addFunds' id='addFunds'>
                                    <div class="row gy-3">
                                        <div class="col-xl-12">
                                            <label>Amount</label>
                                                <input type="text" name="amount" class="form-control"
                                                    id="amount" required>
                                        </div>
                                        <div class="col-xl-12">
                                            <label>Transaction Pin</label>
                                                <!-- <input type="text" name="transaction_pin" class="form-control"
                                                    id="transaction_pin" required> -->
                                                <input type="text" name="transaction_pin"
                                                id="transaction_pin"
                                                autocomplete="one-time-code" required inputmode="numeric" maxlength="4">
                                        </div>
                                        <input hidden type="text" name="pin" id="pin"/>
                                        <div class="col-xl-12">
                                            <label>Description</label>
                                                <input type="text" name="description" class="form-control"
                                                    id="description" required>
                                        </div>
                                </div>
                                <div class="px-4 py-4 text-center">
                                    <button type="submit" class="btn btn-primary btn-rounded btn-fw"
                                        id='add_funds_submit_button' data-user-id=""
                                        style="font-weight:500;">Add</button>
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                        <!-- <div class="modal-footer"> -->
                            <div id='response'></div>
                        <!-- </div> -->
                    </div>
                </div>
            </div>

            {{-- Update Transfer Limit Scheme --}}
            <div class="modal fade" id="update_transfer_limt_scheme" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Transfer Limit Scheme</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body px-4">
                            <form name='updateTransferLimitScheme' id='updateTransferLimitScheme'>
                                <div class="row gy-3">
                                    <div class="col-xl-12">
                                            <label>Select Scheme</label>
                                            <select class="select2 form-control custom-select"
                                                name="transfer_limit_scheme_id" id="transfer_limit_scheme_id"
                                                required>
                                            </select>
                                    </div>
                                </div>
                                <div id="response" class="px-4 py-4 text-center">
                                    <button type="submit" class="btn btn-primary btn-rounded btn-fw"
                                        id='submit_button' data-package-id="" style="font-weight:500;">Update
                                    </button>
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <input id="storeUserId" type="hidden" value="{{ $userDetails->id }}">
            <input id="storeUserTypeId" type="hidden" value="{{ $userDetails->user_type_id }}">
            {{-- Update Payment Charge Package --}}
            <div class="modal fade" id="update_payment_charge_package" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Payment Charge Package</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body px-4">
                            <form name='updatePaymentChargePackage' id='updatePaymentChargePackage'>
                                <div class="row gy-3">
                                    <div class="col-xl-12">
                                            <label>Select Package Type</label>
                                            <select class="select2 form-control custom-select"
                                                name="payment_charge_package_id" id="payment_charge_package_id"
                                                required>
                                            </select>
                                    </div>
                                </div>
                                <div id="response" class="px-4 py-4 text-center">
                                    <button type="submit" class="btn btn-primary btn-rounded btn-fw"
                                        id='submit_button' data-package-id="" style="font-weight:500;">Update
                                    </button>
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add KYC Model-->
            <div class="modal fade" id="add_kyc_form" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel">Add KYC</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body px-4">
                            <form name='addKyc' id='addKyc' enctype="multipart/form-data">
                                <div class="row gy-3">
                                        <div class="col-xl-12" >
                                            <label>Select Country</label>
                                            <select name="kyc_document_type" id="kyc_document_type"
                                                class="select2 form-control custom-select" required>
                                                <option value="">Select document type</option>
                                                <option value="DRIVING_LICENSE" selected="selected">DRIVING_LICENSE
                                                </option>
                                                <option value="VOTERID">VOTERID</option>
                                                <option value="PASSPORT">PASSPORT</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-12">
                                            <label>Upload KYC document</label>
                                            <input type="file" name="kyc_document_image" class="form-control"
                                                    id="kyc_document_image" required>
                                        </div>
                                    </div>
                                <div class="px-4 py-4 text-center">
                                    <button type="submit" class="btn btn-primary btn-rounded btn-fw"
                                        id='submit_kyc_button' data-user-id="" style="font-weight:500;">Add</button>
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel
                                    </button>
                                </div>
                                <div id='response'></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add Selfie Model-->
            <div class="modal fade" id="add_selfie_form" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel">Add Selfie</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body px-4">
                            <form name='addSelfie' id='addSelfie' enctype="multipart/form-data">
                                <div class="row">
                                        <div class="col-xl-12">
                                            <label>Upload Selfie</label>
                                            <div class="input-group">
                                                <input type="file" name="selfie_image" class="form-control"
                                                    id="selfie_image" required>
                                        </div>
                                </div>
                                <div class="px-4 py-4 text-center">
                                    <button type="submit" class="btn btn-primary btn-rounded btn-fw"
                                        id='selfie_submit_button' data-user-id=""
                                        style="font-weight:500;">Add</button>
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!--Add Company Tin Image -->
            <div class="modal fade" id="add_company_tin_form" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel">Add Company Tin Image</h4>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span> </button>
                        </div>
                        <div class="modal-body">
                            <form name='addCompanyTin' id='addCompanyTin' enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6" style="margin:0 auto; display:block;">
                                        <div class="form-group">
                                            <label>Upload Company Tin</label>
                                            <div class="input-group">
                                                <input type="file" name="company_tin_image" class="form-control"
                                                    id="company_tin_image" required>
                                            </div>
                                        </div>
                                    </div>
                                    <br><br>
                                </div>
                                <div style="text-align:center">
                                    <button type="submit" class="btn btn-primary btn-rounded btn-fw"
                                        id='company_tin_submit_button' data-user-id=""
                                        style="font-weight:500;">Add</button>
                                    <button class="btn btn-secondary" type="button"
                                        data-dismiss="modal">Cancel</button>
                                </div>

                            </form>


                        </div>

                        <div class="modal-footer">

                        </div>
                    </div>
                </div>
            </div>

            <!-- Add Company Reg Image-->
            <div class="modal fade" id="add_company_reg_form" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel">Add Company Reg Image</h4>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span> </button>
                        </div>
                        <div class="modal-body">
                            <form name='addCompanyReg' id='addCompanyReg' enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6" style="margin:0 auto; display:block;">
                                        <div class="form-group">
                                            <label>Upload Company Reg Image</label>
                                            <div class="input-group">
                                                <input type="file" name="company_reg_image" class="form-control"
                                                    id="company_reg_image" required>
                                            </div>
                                        </div>
                                    </div>
                                    <br><br>
                                </div>
                                <div style="text-align:center">
                                    <button type="submit" class="btn btn-primary btn-rounded btn-fw"
                                        id='company_reg_submit_button' data-user-id=""
                                        style="font-weight:500;">Add</button>
                                    <button class="btn btn-secondary" type="button"
                                        data-dismiss="modal">Cancel</button>
                                </div>

                            </form>


                        </div>

                        <div class="modal-footer">

                        </div>
                    </div>
                </div>
            </div>

            <!-- Add Sub Account-->
            <div class="modal fade" id="add_sub_account_form" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel">Add Sub Account</h4>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span> </button>
                        </div>
                        <div class="modal-body">
                            <form name='addSubAccount' id='addSubAccount'>
                                <div class="row">
                                    <div class="col-md-6" style="margin:0 auto; display:block;">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <div class="form-text">
                                                <input type="text" name="username" value="@"
                                                    class="form-control" id="usernm"
                                                    style="padding:5px 5px 5px 20px;" required>
                                                {{-- <span class="static-value">@</span> --}}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <div class="input-group">
                                                <input type="password" name="password" class="form-control"
                                                    id="password" required>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <div class="input-group">
                                                <input type="password" name="password_confirmation"
                                                    class="form-control" id="password_confirmation" required>

                                            </div>
                                        </div>
                                    </div>
                                    <br><br>
                                </div>
                                <input type="hidden" name="master_account_user_id"
                                    value="{{ $userDetails->id }}">
                                <div id='response'></div>
                                <div style="text-align:center">
                                    <button type="submit" class="btn btn-primary btn-rounded btn-fw"
                                        id='submit_button' data-user-id="" style="font-weight:500;">Add</button>
                                    <button class="btn btn-secondary" type="button"
                                        data-dismiss="modal">Cancel</button>
                                </div>

                            </form>
                            <div id="subAcErrorResponse">
                            </div>

                        </div>

                        <div class="modal-footer">

                        </div>
                    </div>
                </div>
            </div>
@endsection

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
                function fetch_data(from_date,
                    to_date, walletType) {
                    // console.log("inside fetch func");
                    var userId = $('#storeUserId').val();
                    var userTypeId = $('#storeUserTypeId').val();
                    // console.log(walletType);
                    $('#dataTable').DataTable().clear().destroy();

                    $('#dataTable').DataTable({
                        "lengthMenu": [
                            [10, 25, 50, -1],
                            [10, 25, 50, "All"]
                        ],
                        "processing": true,
                        "serverSide": true,
                        "searching": false,
                        "ajax": {
                            url: '{{ url('api/wallet-history') }}',
                            data: function(d) {
                                d.search = d.search['value'],
                                    d.request_origin = 'web',
                                    d.from_date = from_date,
                                    d.to_date = to_date,
                                    d.user_id = userId
                                if (userTypeId == 3) {
                                    d.wallet_type = walletType
                                }
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
                                data: 'opening_balance'
                            },
                            {
                                data: 'closing_balance'
                            },
                            {
                                data: 'credit_amount'
                            },
                            {
                                data: 'debit_amount'
                            },
                            {
                                data: 'transaction_id'
                            },
                            {
                                data: 'transaction_type'
                            },
                            {
                                data: 'description'
                            },
                        ]
                    });




                }


                $(document).ready(function() {
                    $('.cancel_btn').click(function() {
                        $('form :input').val('');   //CLEAR FORM INPUT
                    });

                    $('#dataTable').DataTable();
                    $(".navbar-nav li").removeClass("active"); //this will remove the active class from
                    //previously active menu item
                    $('#home').addClass('active');

                    //Default Active Tab
                    document.getElementById("defaultOpen").click();

                    var date = new Date();

                    var spinner = $('#loader');

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

                    //Update Profile Picture
                    $(".add_profile_entry").on('click', function() {

                        $('#add_profile_form').modal('show');


                        $('#profile_submit_button').attr('data-user-id', $(this).data('userid'));

                    });
                    $("#profile_submit_button").click(function() {
                        /*  e.preventDefault(); */
                        spinner.show();
                        var send_to = $('#profile_submit_button').data('user-id');
                        //console.log("send_to Id: " + send_to);
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
                                //console.log("img: " + base64data);

                                $.ajax({
                                    url: '{{ url('api/user/profile-pic') }}/' + send_to,
                                    type: 'post',
                                    dataType: 'JSON',
                                    data: {
                                        'profile_pic_base64': base64data
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

                                        $('#addProfile').closest('form').find(
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


                    $('.input-daterange').datepicker({
                        todayBtn: 'linked',
                        format: 'yyyy-mm-dd',
                        autoclose: true
                    });
                    {{-- userId = <?php echo json_encode($userDetails); ?>. --}}
                    // id;;
                    userId = $('#storeUserId').val();
                    // console.log(userId);


                    $('#filter').click(function() {
                        var from_date = $('#from_date').val();
                        var to_date = $('#to_date').val();
                        // console.log($('.activeWallet').data('wallet_type'));
                        fetch_data(from_date, to_date, $('.activeWallet').data('wallet_type'));
                    });

                    $('#export').click(function() {
                        // console.log("inside export function");
                        userId = $('#storeUserId').val();
                        var userTypeId = $('#storeUserTypeId').val();
                        var fromDate = $('#from_date').val();
                        var to_date = $('#to_date').val();
                        var walletType = $('.activeWallet').data('wallet_type');
                        $.ajax({
                            url: '{{ url('api/wallet-history') }}',

                            type: "GET",
                            data: {
                                'download_csv': 1,
                                'user_id': userId,
                                'user_type_id': userTypeId,
                                'from_date': fromDate,
                                'to_date': to_date
                                /*   if (userTypeId == 3) {
                                      'wallet_type': walletType
                                  } */
                            },
                            xhrFields: {
                                responseType: 'blob'
                            },
                            success: function(data) {
                                var a = document.createElement('a');
                                var url = window.URL.createObjectURL(data);
                                a.href = url;
                                a.download = 'myfile.csv';
                                document.body.append(a);
                                a.click();
                                a.remove();
                                window.URL.revokeObjectURL(url);
                            }
                        });
                    });

                    //Accept
                    $('#approve').on('click', function(d) {
                        //d.preventDefault();

                        var UserId = $(this).data('userid');
                        $.ajax({
                            url: '{{ url('api/user') }}/' + UserId,
                            type: 'patch',
                            dataType: 'JSON',
                            data: {
                                'is_kyc_verified': 1
                            },

                            success: function(data) {
                                if (data.error_code == 0) {
                                    //console.log(data);
                                    //console.log("Msg: " + data.meta.message);
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
                                                //     console.log(key + " " +
                                                //     value); $('#response').show()
                                                // .append(value +
                                                //     "<br/>");

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

                    $('#reject').on('click', function(d) {
                        //d.preventDefault();

                        var UserId = $(this).data('userid');
                        Swal.fire({
                            title: "Enter Remark",
                            text: "",
                            input: 'text',
                            showCancelButton: true
                        }).then((result) => {
                            if (result.value) {
                                //console.log("Result: " + result.value);
                                $.ajax({
                                    url: '{{ url('api/user-event') }}/' + UserId,
                                    type: 'post',
                                    dataType: 'JSON',
                                    data: {
                                        remark: result.value,
                                        event: 'KYC_REJECTED'
                                    },
                                    success: function(data) {
                                        //alert(JSON.stringify(meta.message));
                                        // console.log("ttttt");
                                        if (data.error_code == 0) {
                                            // console.log(data);
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

                        /*  $.ajax({

                             url: '{{ url('api/user') }}/' + UserId,
                             type: 'patch',
                             dataType: 'JSON',
                             data: {
                                 'is_kyc_verified': 0
                             },

                             success: function(data) {
                                 if (data.error_code == 0) {
                                     console.log(data);
                                     console.log("Msg: " + data.meta.message);
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

                                             });
                                         } else {
                                             $('#response').show().append(value +
                                                 "<br/>"
                                             ); //this is my div with messages
                                         }
                                     });
                                 }

                             }
                         }); */

                    });

                    //Block/Freez Account
                    $('#FreezAccount').on('click', function(d) {
                        //d.preventDefault();

                        var UserId = $(this).data('userid');
                        // console.log("UserId: " + UserId);
                        $.ajax({
                            url: '{{ url('api/admin/user') }}/' + UserId +
                                '/account-block',
                            type: 'patch',
                            dataType: 'JSON',
                            data: {
                                'account_blocked': 1
                            },

                            success: function(data) {
                                if (data.error_code == 0) {
                                    // console.log(data);
                                    //console.log("Msg: " + data.meta.message);
                                    //  location.reload();
                                    Swal.fire({
                                        title: "" + data.meta.message,
                                        icon: 'success',
                                        showCloseButton: true
                                    }).then(okay => {
                                        if (okay) {
                                            window.location.reload();
                                        }
                                    });
                                    /*, function() {
                                                                        location.reload();
                                                                    }*/
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

                    });
                    //UnBlock Account
                    $('#UnBlockAccount').on('click', function(d) {
                        //d.preventDefault();

                        var UserId = $(this).data('userid');
                        // console.log("UserId: " + UserId);
                        $.ajax({
                            url: '{{ url('api/admin/user') }}/' + UserId +
                                '/account-block',
                            type: 'patch',
                            dataType: 'JSON',
                            data: {
                                'account_blocked': 0
                            },

                            success: function(data) {
                                if (data.error_code == 0) {
                                    //console.log(data);
                                    //console.log("Msg: " + data.meta.message);
                                    // location.reload();
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

                    //Block/Freez Sub Account
                    $('#FreezSubAccount').on('click', function(d) {
                        d.preventDefault();

                        var UserId = $(this).data('userid');
                        //console.log("UserId: " + UserId);
                        $.ajax({
                            url: '{{ url('api/user') }}/' + UserId,
                            type: 'patch',
                            dataType: 'JSON',
                            data: {
                                'has_sub_accounts': 1
                            },

                            success: function(data) {
                                if (data.error_code == 0) {
                                    //console.log(data);
                                    // console.log("Msg: " + data.meta.message);
                                    //  location.reload();
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
                    //UnBlock Sub Account
                    $('#UnBlockSubAccount').on('click', function(d) {
                        //d.preventDefault();

                        var UserId = $(this).data('userid');
                        //console.log("UserId: " + UserId);
                        $.ajax({
                            url: '{{ url('api/user') }}/' + UserId,
                            type: 'patch',
                            dataType: 'JSON',
                            data: {
                                'has_sub_accounts': 0
                            },

                            success: function(data) {
                                if (data.error_code == 0) {
                                    //console.log(data);
                                    //console.log("Msg: " + data.meta.message);
                                    // location.reload();
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


                    //Block/Freez Transaction
                    $('#freezWalletBal').on('click', function(d) {
                        var UserId = $(this).data('userid');
                        //console.log("UserId: " + UserId);
                        Swal.fire({
                            title: "Enter Amount",
                            text: "",
                            input: 'text',
                            showCancelButton: true
                        }).then((result) => {
                            if (result.value) {
                                //  console.log("Result: " + result.value);
                                $.ajax({
                                    url: '{{ url('api/admin/user') }}/' + UserId +
                                        '/wallet-balance-block',
                                    //url: 'api/admin/user/' + UserId + '/wallet-balance-block',
                                    type: 'patch',
                                    dataType: 'JSON',
                                    data: {
                                        amount: result.value
                                    },
                                    success: function(data) {
                                        //alert(JSON.stringify(meta.message));
                                        //console.log("ttttt");
                                        if (data.error_code == 0) {
                                            // console.log(data);
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
                    //UnBlock Transaction
                    $('#UnBlockWalletBal').on('click', function(d) {
                        //d.preventDefault();

                        var UserId = $(this).data('userid');
                        //console.log("UserId: " + UserId);
                        $.ajax({
                            url: '{{ url('api/admin/user') }}/' + UserId +
                                '/wallet-balance-block',
                            type: 'patch',
                            dataType: 'JSON',
                            data: {
                                'amount': 0
                            },

                            success: function(data) {
                                if (data.error_code == 0) {
                                    // console.log(data);
                                    //  console.log("Msg: " + data.meta.message);
                                    //location.reload();
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

                    //Edit User Details
                    $(".edit_user_class").on('click', function() {
                        $('#edit_user_details_form').modal('show');
                        $('#edit_button').attr('data-user-id', $(this).data('userid'));
                    });
                    $('#editUserDetails').on('submit', function(e) {
                        e.preventDefault();

                        //  console.log("inside edit user details");
                        var formFields = $('#editUserDetails').serialize();
                        // console.log("Formfields: " + formFields);
                        var UserId = $('#edit_button').data('user-id');
                        // console.log("UserId: " + UserId);

                        $.ajax({
                            url: '{{ url('api/user') }}/' + UserId,
                            type: 'patch',
                            dataType: 'JSON',
                            data: formFields,
                            success: function(data) {
                                //alert(JSON.stringify(meta.message));
                                //console.log("ttttt");
                                if (data.error_code == 0) {
                                    // console.log(data);
                                    $('#edit_user_details_form').modal('hide');
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




                    //Add Funds
                    $(".add_funds_entry").on('click', function() {
                        $('#add_funds_form').modal('show');
                        $('#add_funds_submit_button').attr('data-user-id', $(this).data('userid'));
                    });
                    $('#addFunds').on('submit', function(e) {
                        //console.log("Inside function");
                        e.preventDefault();
                        spinner.show();

                        var formFields = $('#addFunds').serialize();
                        var send_to = $('#add_funds_submit_button').data('user-id');
                        //console.log("Bank Id: " + send_to);

                        $.ajax({
                            url: '{{ url('api/send-funds') }}',
                            type: 'post',
                            dataType: 'JSON',
                            data: formFields + '&is_wallet_refill=1&send_to=' + send_to,
                            success: function(data) {
                                //alert(JSON.stringify(meta.message));
                                // console.log("ttttt");
                                if (data.error_code == 0) {
                                    // console.log(data);
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


                    //Download QR Code
                    $('.download_qr_button').on('click', function() {
                        //d.preventDefault();
                        //console.log("fghgvh");
                        var UserId = $(this).data('userid');
                        // console.log("UserId: " + UserId);
                        $.ajax({
                            url: '{{ url('api/user/qr/download') }}/' + UserId,
                            dataType: 'JSON',

                            success: function(data) {
                                if (data.error_code == 0) {
                                    // console.log(data);
                                    // console.log("Msg: " + data.meta.message);
                                    //location.reload();
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

                    //Edit Transfer Limit Scheme
                    $(".limit_class").on('click', function() {

                        $.ajax({
                            url: '{{ url('api/transfer-limit-schemes') }}',
                            type: 'get',

                            success: function(data) {
                                //  console.log('data');
                                $('#transfer_limit_scheme_id').empty();
                                $.each(data.data, function($index, $value) {

                                    $('#transfer_limit_scheme_id').append('<option value="' +
                                        $value
                                        .id + '" >' + $value
                                        .name + '</option>');
                                })
                            }
                        });
                        $('#update_transfer_limt_scheme').modal('show');

                    });
                    $('#updateTransferLimitScheme').on('submit', function(e) {
                        //console.log("gdg");
                        e.preventDefault();


                        var formFields = $('#updateTransferLimitScheme').serialize();
                        // console.log("Fields: " + formFields);


                        $.ajax({
                            url: '{{ url('api/user') }}/' + userId,
                            type: 'patch',
                            dataType: 'JSON',
                            data: formFields,
                            success: function(data) {
                                //alert(JSON.stringify(meta.message));
                                //console.log("ttttt");
                                if (data.error_code == 0) {
                                    //console.log(data);
                                    $('#update_transfer_limt_scheme').modal('hide');
                                    //location.reload();
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

                                $('#updateTransferLimitScheme').closest('form').find(
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

                    //Edit Package
                    $(".package_class").on('click', function() {
                        var packageType = $(this).data('packagetype');

                        //console.log(packageType);
                        $.ajax({
                            url: '{{ url('api/payment-charge-package') }}',
                            type: 'get',
                            data: {
                                'package_type': packageType,
                                'request_origin': 'web'
                            },
                            success: function(data) {
                                //      console.log('data');
                                $('#payment_charge_package_id').empty();
                                $.each(data.data, function($index, $value) {

                                    $('#payment_charge_package_id').append('<option value="' +
                                        $value
                                        .id + '" >' + $value
                                        .package_name + '</option>');
                                })
                            }
                        });
                        $('#update_payment_charge_package').modal('show');

                    });
                    $('#updatePaymentChargePackage').on('submit', function(e) {
                        // console.log("gdg");
                        e.preventDefault();


                        var formFields = $('#updatePaymentChargePackage').serialize();
                        //console.log("Fields: " + formFields);


                        $.ajax({
                            url: '{{ url('api/user') }}/' + userId,
                            type: 'patch',
                            dataType: 'JSON',
                            data: formFields,
                            success: function(data) {
                                //alert(JSON.stringify(meta.message));
                                //console.log("ttttt");
                                if (data.error_code == 0) {
                                    // console.log(data);
                                    $('#update_payment_charge_package').modal('hide');
                                    //location.reload();
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

                                $('#updatePaymentChargePackage').closest('form').find(
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


                    //Edit Kyc Documents
                    $(".add_kyc_entry").on('click', function() {
                        $('#add_kyc_form').modal('show');
                        $('#submit_kyc_button').attr('data-user-id', $(this).data('userid'));
                    });
                    $('#addKyc').on('submit', function(e) {
                        e.preventDefault();
                        spinner.show();
                        var formFields = new FormData(this);
                        var UserId = $('#submit_kyc_button').data('user-id');
                        //console.log("UserId: " + UserId);

                        $.ajax({
                            url: '{{ url('api/user/kyc-document') }}/' + UserId,
                            type: 'post',
                            dataType: 'JSON',
                            data: formFields,
                            processData: false,
                            contentType: false,
                            success: function(data) {
                                //alert(JSON.stringify(meta.message));
                                //  console.log("ttttt");
                                if (data.error_code == 0) {
                                    //console.log(data);
                                    spinner.hide();
                                    $('#add_kyc_form').modal('hide');
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


                    //Edit Selfie Documents
                    $(".add_selfie_entry").on('click', function() {
                        $('#add_selfie_form').modal('show');
                        $('#selfie_submit_button').attr('data-user-id', $(this).data('userid'));
                    });
                    $('#addSelfie').on('submit', function(e) {
                        e.preventDefault();
                        spinner.show();
                        var formFields = new FormData(this);
                        var UserId = $('#selfie_submit_button').data('user-id');
                        //console.log("UserId: " + UserId);

                        $.ajax({
                            url: '{{ url('api/user/selfie-image') }}/' + UserId,
                            type: 'post',
                            dataType: 'JSON',
                            data: formFields,
                            processData: false,
                            contentType: false,
                            success: function(data) {
                                //alert(JSON.stringify(meta.message));
                                // console.log("ttttt");
                                if (data.error_code == 0) {
                                    //console.log(data);
                                    spinner.hide();
                                    $('#add_selfie_form').modal('hide');
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


                    //Edit Company Tin Documents
                    $(".add_company_tin_entry").on('click', function() {
                        $('#add_company_tin_form').modal('show');
                        $('#company_tin_submit_button').attr('data-user-id', $(this).data('userid'));
                    });
                    $('#addCompanyTin').on('submit', function(e) {
                        e.preventDefault();
                        spinner.show();
                        var formFields = new FormData(this);
                        var UserId = $('#company_tin_submit_button').data('user-id');
                        // console.log("UserId: " + UserId);

                        $.ajax({
                            url: '{{ url('api/user/business/company-tin-image') }}/' + UserId,
                            type: 'post',
                            dataType: 'JSON',
                            data: formFields,
                            processData: false,
                            contentType: false,
                            success: function(data) {
                                //alert(JSON.stringify(meta.message));
                                // console.log("ttttt");
                                if (data.error_code == 0) {
                                    //console.log(data);
                                    spinner.hide();
                                    $('#add_company_tin_form').modal('hide');
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

                    //Edit Company Reg Documents
                    $(".add_company_reg_entry").on('click', function() {
                        $('#add_company_reg_form').modal('show');
                        $('#company_reg_submit_button').attr('data-user-id', $(this).data('userid'));
                    });
                    $('#addCompanyReg').on('submit', function(e) {
                        e.preventDefault();
                        spinner.show();
                        var formFields = new FormData(this);
                        var UserId = $('#company_reg_submit_button').data('user-id');
                        // console.log("UserId: " + UserId);

                        $.ajax({
                            url: '{{ url('api/user/business/company-reg-image') }}/' + UserId,
                            type: 'post',
                            dataType: 'JSON',
                            data: formFields,
                            processData: false,
                            contentType: false,
                            success: function(data) {
                                //alert(JSON.stringify(meta.message));
                                // console.log("ttttt");
                                if (data.error_code == 0) {
                                    //console.log(data);
                                    spinner.hide();
                                    $('#add_company_reg_form').modal('hide');
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

                    //List of Sub Accounts
                    $.ajax({

                        url: '{{ url('api/user/search') }}',
                        type: 'get',
                        data: {
                            'master_account_user_id': userId
                        },
                        async: false,
                        success: function(data) {
                            //console.log(data);
                            //var fields = '';
                            //console.log("inside details");

                            $.each(data.data.data, function($index, $value) {
                                /*  console.log("fhd");
                                 console.log("fname: " + $value); */

                                $('.appendfields').append(
                                    '<div style="float: left;width: 25%;padding: 0 10px;"><div style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);padding: 16px;text-align: center;background-color: #FFFFFF;"><h5>UserId: ' +
                                    $value.id + '</h5><h5><b>' +
                                    $value.username + '</b></h5></div></div>'
                                );

                            })
                            $('#sub_account_userId').empty();
                            $.each(data.data.data, function($index, $value) {
                                //console.log("get sub ac list");
                                $('#sub_account_userId').append('</option>' + '<option value="' + $value
                                    .id +
                                    '" >' +
                                    $value
                                    .username + '</option>');
                            })

                        }
                    });
                    //Add Sub Account
                    $("#sub_account_submit_button").on('click', function() {
                        $('#add_sub_account_form').modal('show');
                    });
                    $('#addSubAccount').on('submit', function(e) {
                        e.preventDefault();
                        //  spinner.show();
                        var formFields = $('#addSubAccount').serialize();
                        // console.log("FormFields: " + formFields);

                        $.ajax({
                            url: '{{ url('api/sub-account') }}',
                            type: 'post',
                            dataType: 'JSON',
                            data: formFields,
                            success: function(data) {
                                //alert(JSON.stringify(meta.message));
                                //console.log("ttttt");
                                if (data.error_code == 0) {
                                    // console.log(data);
                                    spinner.hide();
                                    $('#add_sub_account_form').modal('hide');
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
                                if (data.status == 400) {
                                    //console.log(data);
                                    spinner.hide();
                                    Swal.fire({
                                        title: "" + data.responseJSON.meta
                                            .message,
                                        icon: 'error',
                                        showCloseButton: true
                                    }).then(okay => {
                                        if (okay) {
                                            window.location
                                                .reload();
                                        }
                                    });
                                } else
                                if (data.status === 422) {
                                    var errors = $.parseJSON(data.responseText);
                                    $.each(errors, function(key, value) {
                                        // console.log(key+ " " +value);
                                        $('#subAcErrorResponse').addClass(
                                            "alert alert-danger");

                                        if ($.isPlainObject(value)) {
                                            $.each(value, function(key, value) {
                                                // console.log(key + " " +
                                                //     value);
                                                $('#subAcErrorResponse').show()
                                                    .append(value +
                                                        "<br/>");
                                                spinner.hide();
                                            });
                                        } else {
                                            $('#subAcErrorResponse').show().append(value +
                                                "<br/>"
                                            ); //this is my div with messages
                                            spinner.hide();
                                        }
                                    });
                                }

                            }



                        });
                    });

                    //Sub Account Wallet history
                    fetchData();

                    function fetchData(fromSubAccDate = (new Date()).toISOString().split('T')[0],
                        toDate = (new Date()).toISOString().split('T')[0], sub_account_userId = $('#sub_account_userId')
                        .val()) {

                        $('#subAccDataTable').DataTable().clear().destroy();

                        $('#subAccDataTable').DataTable({
                            "lengthMenu": [
                                [10, 25, 50, -1],
                                [10, 25, 50, "All"]
                            ],
                            "processing": true,
                            "serverSide": true,
                            "searching": false,
                            "ajax": {
                                url: '{{ url('api/wallet-history') }}',
                                data: function(d) {

                                    d.request_origin = 'web',
                                        d.user_id = sub_account_userId,
                                        d.from_date = fromSubAccDate,
                                        d.to_date = toDate
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
                                    data: 'opening_balance',
                                    className: 'opening_balance'
                                },
                                {
                                    data: 'closing_balance',
                                    className: 'closing_balance'
                                },
                                {
                                    data: 'credit_amount',
                                    className: 'credit_amount'
                                },
                                {
                                    data: 'debit_amount',
                                    className: 'debit_amount'
                                },
                                {
                                    data: 'transaction_id',
                                    className: 'transaction_id'
                                },
                                {
                                    data: 'transaction_type',
                                    className: 'transaction_type'
                                },
                                {
                                    data: 'description',
                                    className: 'description'
                                },
                            ]

                        });


                    }

                    $('#sub_account_filter').click(function() {
                        var fromSubAccDate = $('#fromSubAccDate').val();
                        var toDate = $('#toDate').val();
                        var sub_account_userId = $('#sub_account_userId').val();
                        // console.log("SUBBBBBB: " + fromSubAccDate + toDate + sub_account_userId);
                        fetchData(fromSubAccDate, toDate, sub_account_userId);

                    });
                });
            </script>
@endsection
