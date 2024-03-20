<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pacpay Admin Panel</title>

    <!-- Custom fonts for this template-->
    {{-- Tabs --}}
    <link href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css') }}"
        rel="stylesheet" media="screen" />

    <link href="{{ asset('https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css') }}"
        rel="stylesheet" media="screen" />
    <link href="{{ asset('https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="{{ asset('https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i') }}"
        rel="stylesheet">
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet" media="screen" />
    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <link rel="stylesheet"
        href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.css') }}">


    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css" rel="stylesheet" />

    {{-- Date Picker --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />

    {{-- Crop Image --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css"> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>

    <style>


    </style>
</head>
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
                    <!-- Page Heading -->
                    <h4 style="color: rgb(30, 50, 250);">Users Details</h4>
                    <!-- DataTales Example -->
                    <div class="card-main row">
                        <div class="col-12 col-sm-12 col-md-12">
                            <div class="table-box">
                                <div style="padding-top: 15px; padding-bottom: 15px;">
                                    <div class="row">
                                        <div class="col-6 col-sm-4 col-md-4">
                                            <div class="avatar-upload">
                                                <div class="avatar-preview ">
                                                    <div><img src="{{ $userDetails->profile_pic_img_url }}"
                                                            width="150"
                                                            style="margin: 0 auto;display: block;width: 120px;height: 120px;border-radius: 100%;background-size: cover;background-repeat: no-repeat;background-position: center;margin-left: auto;margin-right: auto;border: 5px solid #1e32fa;">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <h4 style="display: inline-block;"><span class="dot-blue"></span>
                                                    @if ($userDetails->user_type_id == 2 or $userDetails->user_type_id == 5)
                                                        {{ $userDetails->full_name }}
                                                    @endif
                                                    @if ($userDetails->user_type_id == 3 or $userDetails->user_type_id == 4)
                                                        {{ $userDetails->business->business_name }}
                                                    @endif
                                                </h4>
                                                {{-- <label class="main">
                  <input type="checkbox" name="checkbox_[]" class="checkBoxClass check_checkbox" id="">
                  <div class="geekmark"></div>
                  </label> --}}
                                                <h6>{{ $userDetails->username }}</h6>
                                                <a data-userid="{{ $userDetails->id }}" class="edit_user_class"
                                                    type="submit" id="edit_button" title="Edit User Details"
                                                    style="color: rgb(0,128,0);"><i
                                                        class="
                                                    fa fa-edit fa-lg"></i></a>
                                                <a data-userid="{{ $userDetails->id }}" class="add_profile_entry"
                                                    type="submit" id="edit_profile" title="Change Profile"
                                                    style="color: rgb(0,128,0);"><i class="far fa-user-circle"></i></a>
                                                <a data-userid="{{ $userDetails->id }}" class="add_funds_entry"
                                                    type="submit" id="add_fds" title="Add Funds"
                                                    style="color: rgb(0,128,0);"><i class="fa fa-money fa-lg"></i></a>

                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4 col-md-4">
                                            <div>
                                                <div class="text-center" style="margin-top: 8%;">
                                                    <label class="text-label">
                                                        Balance</label>
                                                    @if ($userDetails->user_type_id == 2 or $userDetails->user_type_id == 4 or $userDetails->user_type_id == 5)
                                                        <h3>{{ $userDetails->wallet->balance }}</h3>
                                                    @endif
                                                    @if ($userDetails->user_type_id == 3)
                                                        <h3>{{ $userDetails->agent->agentFundsWallet->balance }}</h3>
                                                    @endif
                                                    {{-- <button class="btn-fill btn" type="button">Freeze Account</button>
                  <button class="btn-inverse btn" type="button">Freeze Transactions</button> --}}
                                                </div>
                                            </div>
                                            <div>
                                                <div class="text-center" style="margin-top: 8%;">
                                                    @if ($userDetails->account_blocked == 0)
                                                        <button
                                                            data-userid="  {{ $userDetails->id }}
                                                            "
                                                            class="btn-fill btn" type="button" id="FreezAccount">Block
                                                            Account
                                                        </button>
                                                    @else
                                                        <button
                                                            data-userid="  {{ $userDetails->id }}
                                                            "
                                                            class="btn-fill btn" type="button"
                                                            id="UnBlockAccount">UnBlock
                                                            Account
                                                        </button>
                                                    @endif

                                                    @if ($userDetails->wallet->blocked_balance <= 0)
                                                        <button
                                                            data-userid="  {{ $userDetails->id }}
                                                            "
                                                            class="btn-inverse btn" type="button"
                                                            id="freezWalletBal">Block
                                                            Wallet
                                                        </button>
                                                    @else
                                                        <button
                                                            data-userid="  {{ $userDetails->id }}
                                                            "
                                                            class="btn-inverse btn" type="button"
                                                            id="UnBlockWalletBal">UnBlock
                                                            Wallet
                                                        </button>
                                                        <h5>Block Balance:
                                                            {{ $userDetails->wallet->blocked_balance }}</h5>
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
                                                                class="btn-fill btn" type="button"
                                                                id="FreezSubAccount">Enable
                                                                SubAccount
                                                            </button>
                                                        @else
                                                            <button
                                                                data-userid="  {{ $userDetails->id }}
                                                            "
                                                                class="btn-fill btn" type="button"
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
                                                        class="btn-fill-approve btn" type="button"
                                                        id="approve">Approve <i class="fa fa-check"></i></button>
                                                    <button
                                                        data-userid="  {{ $userDetails->id }}
                                                        "
                                                        class="btn-fill-reject btn" type="button"
                                                        style="background-color: rgb(245, 174, 174); color: rgb(196, 49, 49);"
                                                        id="reject">Reject <i class="fa fa-times"></i></button>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="QR-Code-destop col-6 col-sm-4 col-md-4">
                                            @if (isset($userDetails->qr_code_info))
                                                <img src="data:image/png;base64, {!! base64_encode(
                                                    \SimpleSoftwareIO\QrCode\Facades\QrCode::size(200)->format('png')->backgroundColor(255, 255, 255)->merge('/public/img/qr_logo.png', 0.4)->errorCorrection('H')->generate($userDetails->qr_code_info),
                                                ) !!} ">
                                            @else
                                                <div class="danger">QR NOT FOUND</div>
                                            @endif
                                            <div class="text-center">

                                                <a data-userid="{{ $userDetails->id }}"
                                                    href="{{ url('api/user/qr/download/' . $userDetails->id) }}"
                                                    type="submit" id="download_button" title="Download QR Code"
                                                    style="color: rgb(0,128,0);"><i
                                                        class="
                                                        fa fa-download"></i></a>
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-12 col-sm-6 col-md-6">
                                            <label class="text-label">First Name: </label>
                                            <label class="text-label">{{ $userDetails->first_name }}</label>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-6">
                                            <label class="text-label">Last Name: </label>
                                            <label class="text-label">{{ $userDetails->last_name }}</label>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-6">
                                            <label class="text-label">Phone number: </label>
                                            <label class="text-label">{{ $userDetails->mobile_no }}</label>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-6">
                                            <label class="text-label">Email: </label>
                                            <label class="text-label">{{ $userDetails->email }}</label>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-6">
                                            <label class="text-label">Date of birth: </label>
                                            <label class="text-label">{{ $userDetails->date_of_birth }}</label>
                                        </div>

                                        <div class="col-12 col-sm-6 col-md-6">
                                            <label class="text-label">Gender: </label>
                                            <label class="text-label">{{ $userDetails->gender }}</label>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-6">
                                            <label class="text-label">Country: </label>
                                            <label
                                                class="text-label">{{ $userDetails->city->country->country_name ?? 'N/A' }}</label>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-6">
                                            <label class="text-label">City: </label>
                                            <label
                                                class="text-label">{{ $userDetails->city->city_name ?? 'N/A' }}</label>
                                        </div>

                                        @if ($userDetails->user_type_id == 4 or $userDetails->user_type_id == 3)
                                            <div class="col-12 col-sm-6 col-md-6">
                                                <label class="text-label">Business Name: </label>
                                                <label
                                                    class="text-label">{{ $userDetails->business->business_name }}</label>
                                            </div>
                                            <div class="col-12 col-sm-6 col-md-6">
                                                <label class="text-label">Business Type: </label>
                                                <label
                                                    class="text-label">{{ $userDetails->business->businessType->business_type ?? 'N/A' }}</label>
                                            </div>
                                            <div class="col-12 col-sm-6 col-md-6">
                                                <label class="text-label">Merchant Category: </label>
                                                <label
                                                    class="text-label">{{ $userDetails->business->merchantCategory->category_name ?? 'N/A' }}</label>
                                            </div>
                                        @endif
                                        {{-- <div class="col-12 col-sm-6 col-md-6">
                                            <label class="text-label">City</label>
                                            <input class="form-control form-control text-input" type="text"
                                                disabled="" value="{{ $userDetails->city->country_id }}"
                                                style="border-color: white;">
                                        </div> --}}
                                        <div class="col-12 col-sm-12 col-md-12">
                                            <label class="text-label">Address: </label>
                                            <label class="text-label">{{ $userDetails->address }}</label>
                                            {{-- <textarea class="form-control form-control text-input" type="text" disabled=""
                                                style="border-color: white; "></textarea> --}}
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12">
                                            <label class="text-label">Source of income: </label>
                                            <label class="text-label">{{ $userDetails->sourceOfIncome->source ?? 'N/A' }} </label>
                                            {{-- <textarea class="form-control form-control text-input" type="text" disabled=""
                                                style="border-color: white; "></textarea> --}}
                                        </div>


                                        <div class="col-12 col-sm-12 col-md-12">
                                            <label class="text-label">TIN: </label>
                                            <label class="text-label">{{ $userDetails->personal_tin_no ?? 'N/A' }} </label>
                                            {{-- <textarea class="form-control form-control text-input" type="text" disabled=""
                                                style="border-color: white; "></textarea> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- User Details --}}
                            <section class="header">
                                <div class="container py-4">
                                    <h4 class="text-label" style="color: rgb(30, 50, 250);">User Details</h4>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <!-- Tabs nav -->
                                            <div class="nav flex-column nav-pills nav-pills-custom" id="v-pills-tab"
                                                role="tablist" aria-orientation="vertical">
                                                <a class="nav-link mb-3 p-3 shadow active"
                                                    id="transfer-limit-scheme-tab" data-toggle="pill"
                                                    href="#transfer-limit-scheme" role="tab"
                                                    aria-controls="transfer-limit-scheme" aria-selected="true">

                                                    <span class="font-weight-bold small text-uppercase">Transfer
                                                        Limit
                                                        Scheme</span></a>

                                                @if ($userDetails->user_type_id == 2 or $userDetails->user_type_id == 4 or $userDetails->user_type_id == 5)
                                                    <a class="nav-link mb-3 p-3 shadow"
                                                        id="payment-charge-package-tab" data-toggle="pill"
                                                        href="#payment-charge-package" role="tab"
                                                        aria-controls="payment-charge-package" aria-selected="false">

                                                        <span class="font-weight-bold small text-uppercase">Payment
                                                            Charge
                                                            Package</span></a>
                                                @endif

                                                <a class="nav-link mb-3 p-3 shadow"
                                                    id="wallet-limit-tab" data-toggle="pill"
                                                    href="#wallet-limit" role="tab"
                                                    aria-controls="wallet-limit" aria-selected="true">

                                                    <span class="font-weight-bold small text-uppercase">Wallet
                                                        Limit
                                                        Scheme</span></a>

                                                @if ($userDetails->user_type_id == 3)
                                                    <a class="nav-link mb-3 p-3 shadow" id="agent-wallet-tab"
                                                        data-toggle="pill" href="#agent-wallet" role="tab"
                                                        aria-controls="agent-wallet" aria-selected="false">
                                                        <span class="font-weight-bold small text-uppercase">Agent
                                                            Wallet</span></a>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="col-md-9">
                                            <!-- Tabs content -->
                                            <div class="tab-content" id="v-pills-tabContent">
                                                <div class="tab-pane fade shadow rounded bg-white show active p-5"
                                                    id="transfer-limit-scheme" role="tabpanel"
                                                    aria-labelledby="transfer-limit-scheme-tab">
                                                    <h4 class="font-italic mb-4">
                                                        Transfer Limit Scheme
                                                    </h4>
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
                                                                    <button class="btn-fill btn limit_class"
                                                                        type="submit" id="editTransferLimitScheme"
                                                                        title="Edit Transfer Limit"><i
                                                                            class="fa fa-edit fa-lg"></i></button>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="tab-pane fade shadow rounded bg-white p-5"
                                                    id="payment-charge-package" role="tabpanel"
                                                    aria-labelledby="payment-charge-package-tab">
                                                    <h4 class="font-italic mb-4">Payment Charge
                                                        Package</h4>
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
                                                                            class="btn-fill btn package_class"
                                                                            type="submit" id="submit_button"
                                                                            title="Edit"><i
                                                                                class="fa fa-edit fa-lg"></i></button>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </table>
                                                    </div>

                                                    
                                                </div>


                                                <div class="tab-pane fade shadow rounded bg-white p-5"
                                                    id="wallet-limit" role="tabpanel"
                                                    aria-labelledby="wallet-limit-tab">
                                                    <h4 class="font-italic mb-4">Wallet Limit
                                                        </h4>
                                                    <div>
                                                        <table class="table table-bordered" cellspacing="0">
                                                            <tr style="text-align: center;">
                                                                <th>Wallet</th>
                                                                <th>Limit</th>
                                                                <th>Edit</th>
                                                            </tr>
                                                           
                                                                <tr style="text-align: center;">
                                                                  
                                                                    <td>Main</td>
                                                                    <td>{{ $userDetails->wallet->wallet_limit }} </td>
                                                                  <td>
                                                                    <input id='wallet-limit-class-input' type="number"  min=1 max=100000 require=true/>
                                                                    <input type="label" id ='wallet-limit-user-id' value="{{ $userDetails->id }}" hidden />
                                                                    <input type='submit' class="btn-fill btn wallet_limit_class" >
                                                                        <!-- <button
                                                                            data-packagetype="  {{ $package->package_type }}
                                                                        "
                                                                            class="btn-fill btn wallet_limit_class"
                                                                            type="submit" id="submit_button"
                                                                            title="Update"><i
                                                                                class="fa fa-check fa-sm"></i></button> -->
                                            </td>
                                                             
                                                                </tr>
                                                        
                                                        </table>
                                                    </div>

                                                    
                                                </div>


                                              

                                                @if ($userDetails->user_type_id == 3)
                                                    <div class="tab-pane fade shadow rounded bg-white p-5"
                                                        id="agent-wallet" role="tabpanel"
                                                        aria-labelledby="agent-wallet-tab">
                                                        <h4 class="font-italic mb-4">Agent Wallet</h4>
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
                            </section>

                            {{-- Uploded Documents Tabs --}}
                            <section class="header">
                                <div class="container py-4">
                                    <h4 class="text-label" style="color: rgb(30, 50, 250);">Uploaded Documents
                                    </h4>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <!-- Tabs nav -->
                                            <div class="nav flex-column nav-pills nav-pills-custom" id="v-pills-tab"
                                                role="tablist" aria-orientation="vertical">
                                                <a class="nav-link mb-3 p-3 shadow active" id="kyc-doc-tab"
                                                    data-toggle="pill" href="#kyc-doc" role="tab"
                                                    aria-controls="kyc-doc" aria-selected="true">
                                                    <span
                                                        class="font-weight-bold small text-uppercase">{{ $userDetails->kyc_document_type }}</span></a>

                                                <a class="nav-link mb-3 p-3 shadow" id="selfie-tab"
                                                    data-toggle="pill" href="#selfie" role="tab"
                                                    aria-controls="selfie" aria-selected="false">
                                                    <span
                                                        class="font-weight-bold small text-uppercase">Selfie</span></a>

                                                @if ($userDetails->user_type_id == 4 or $userDetails->user_type_id == 3)
                                                    <a class="nav-link mb-3 p-3 shadow" id="company-tin-tab"
                                                        data-toggle="pill" href="#company-tin" role="tab"
                                                        aria-controls="company-tin" aria-selected="false">
                                                        <span class="font-weight-bold small text-uppercase">Company
                                                            Tin</span></a>
                                                    <a class="nav-link mb-3 p-3 shadow" id="company-reg-tab"
                                                        data-toggle="pill" href="#company-reg" role="tab"
                                                        aria-controls="company-reg" aria-selected="false">
                                                        <span class="font-weight-bold small text-uppercase">Company
                                                            Reg</span></a>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="col-md-9">
                                            <!-- Tabs content -->
                                            <div class="tab-content" id="v-pills-tabContent">
                                                {{-- kyc content --}}
                                                <div class="tab-pane fade shadow rounded bg-white show active p-5"
                                                    id="kyc-doc" role="tabpanel" aria-labelledby="kyc-doc-tab">

                                                    <h4 class="font-italic mb-4">
                                                        {{ $userDetails->kyc_document_type }}
                                                    </h4>
                                                    <button data-userid="{{ $userDetails->id }}"
                                                        class="add_kyc_entry" type="submit" id="add_fds"
                                                        title="Edit KYC"
                                                        style="color: rgb(0,128,0); border: none; background: none; width=100px; float: right;"><i
                                                            class="fa fa-file-upload fa-lg"></i> Edit KYC</button>

                                                    <div style="margin-top: 10px;"><img
                                                            src="{{ $userDetails->kyc_document_url }}"
                                                            style="margin-left: auto; margin-right: auto; display: block; border: 1px solid rgb(223, 223, 223); padding: 30px; border-radius: 6px; width: 80%;">
                                                    </div>
                                                </div>

                                                {{-- selfie content --}}
                                                <div class="tab-pane fade shadow rounded bg-white p-5" id="selfie"
                                                    role="tabpanel" aria-labelledby="selfie-tab">
                                                    <h4 class="font-italic mb-4">Selfie</h4>
                                                    <button data-userid="{{ $userDetails->id }}"
                                                        class="add_selfie_entry" type="submit" id="add_fds"
                                                        title="Edit Selfie"
                                                        style="color: rgb(0,128,0); border: none; background: none; width=100px; float: right;"><i
                                                            class="fa fa-portrait fa-lg"></i> Edit Selfie</button>

                                                    <div style="margin-top: 10px;"><img
                                                            src="{{ $userDetails->selfie_img_url }}"
                                                            style="margin-left: auto; margin-right: auto; display: block; border: 1px solid rgb(223, 223, 223); padding: 30px; border-radius: 6px; width: 80%;">
                                                    </div>
                                                </div>

                                                @if ($userDetails->user_type_id == 4 or $userDetails->user_type_id == 3)
                                                    {{-- Company Tin Content --}}
                                                    <div class="tab-pane fade shadow rounded bg-white p-5"
                                                        id="company-tin" role="tabpanel"
                                                        aria-labelledby="company-tin-tab">
                                                        <h4 class="font-italic mb-4">Company Tin</h4>
                                                        <button data-userid="{{ $userDetails->id }}"
                                                            class="add_company_tin_entry" type="submit"
                                                            title="Edit Company Tin"
                                                            style="color: rgb(0,128,0); border: none; background: none; width=100px; float: right;"><i
                                                                class="fa fa-solid fa-image"></i> Edit Company
                                                            Tin</button>

                                                        <div style="margin-top: 10px;"><img
                                                                src="{{ $userDetails->business->company_tin_img_url }}"
                                                                style="margin-left: auto; margin-right: auto; display: block; border: 1px solid rgb(223, 223, 223); padding: 30px; border-radius: 6px; width: 80%;">
                                                        </div>
                                                    </div>
                                                    {{-- Company Reg Content --}}
                                                    <div class="tab-pane fade shadow rounded bg-white p-5"
                                                        id="company-reg" role="tabpanel"
                                                        aria-labelledby="company-reg-tab">
                                                        <h4 class="font-italic mb-4">Company Reg</h4>
                                                        <button data-userid="{{ $userDetails->id }}"
                                                            class="add_company_reg_entry" type="submit"
                                                            title="Edit Company Reg"
                                                            style="color: rgb(0,128,0); border: none; background: none; width=100px; float: right;"><i
                                                                class="fa fa-solid fa-image"></i> Edit Company
                                                            Reg</button>

                                                        <div style="margin-top: 10px;"><img
                                                                src="{{ $userDetails->business->company_reg_img_url }}"
                                                                style="margin-left: auto; margin-right: auto; display: block; border: 1px solid rgb(223, 223, 223); padding: 30px; border-radius: 6px; width: 80%;">
                                                        </div>
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>


                            <br />

                            {{-- Transaction Report --}}
                            <section class="header">
                                <div class="container py-4">
                                    <h4 class="text-label" style="color: rgb(30, 50, 250);">Transaction
                                        Report
                                    </h4>

                                    <div class="tab">
                                        <button class="tablinks" id="defaultOpen"
                                            data-usertypeid="{{ $userDetails->user_type_id }}"
                                            data-wallet_type="FUNDS">Wallet History</button>
                                        @if ($userDetails->user_type_id == 3)
                                            <button class="tablinks"
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
                                    <div>
                                        {{-- @if ($userDetails->user_type_id == 2 or $useDetails->user_type_id == 4 or $userDetails->user_type_id == 5) --}}
                                        <div id="TransReport" class="tabcontent">
                                            <div class="card-body">

                                                <form name='filterdate' id='filterdate'>
                                                    <div class="input-group input-daterange">
                                                        <div class="form-group col-sm">
                                                            <input type="text" name="from_date" id="from_date"
                                                                readonly class="form-control"
                                                                placeholder="From Date" />
                                                        </div>&nbsp;&nbsp;
                                                        <div class="input-group-addon">to</div> &nbsp;&nbsp;
                                                        <div class="form-group col-sm">
                                                            <input type="text" name="to_date" id="to_date"
                                                                readonly class="form-control" placeholder="To Date" />
                                                        </div>
                                                        <div class="form-group col-sm">
                                                            <button type="button" name="filter" id="filter"
                                                                class="btn btn-info btn-sm filter">Filter
                                                            </button>
                                                            &nbsp;&nbsp;
                                                            <button type="button" name="export" id="export"
                                                                class="btn btn-block"
                                                                style="text-align: center;height : 35px; width: 100px; background:	#006400; color: rgb(255,255,255);">Export
                                                                ALL</button>
                                                            <button type="button" name="raiseTicket"
                                                                id="raiseTicket"
                                                                class="btn btn-block btn-fill-approve"
                                                                style="text-align: center;height : 35px; width: 110px;  color: rgb(255,255,255);">Raise
                                                                Ticket</button>
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
                            </section>

                            <br />
                            {{-- Sub Account --}}
                            @if ($userDetails->user_type_id == 4)
                                <h4 class="text-label" style="color: rgb(30, 50, 250);">Sub Account
                                </h4>
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <section class="header">
                                            <div class="container py-4">

                                                <button type="submit" class="btn-fill btn"
                                                    id='sub_account_submit_button'
                                                    style="float:right; margin-top: -20px;">Add Sub Account</button>

                                                <div class="row appendfields">
                                                </div>

                                            </div>
                                        </section>


                                        <h5 class="m-0 font-weight-bold text-primary">Wallet History</h5>
                                        <br>
                                        <form name='filterdate' id='filterdate'>
                                            <div class="input-group">
                                                <div class="input-group input-daterange col-sm">
                                                    <div class="form-group">
                                                        <input type="text" name="from_date" id="fromSubAccDate"
                                                            readonly class="form-control" placeholder="Start Date" />
                                                    </div>&nbsp;&nbsp;<br />
                                                    {{-- <div class="input-group-addon">to</div> &nbsp;&nbsp; --}}
                                                    <div class="form-group">
                                                        <input type="text" name="to_date" id="toDate" readonly
                                                            class="form-control" placeholder="To Date" />
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm">
                                                    <label>Select Sub Account</label>
                                                    <select name="sub_account_user_id" id="sub_account_userId"
                                                        class="select2 form-control custom-select" required>

                                                    </select>

                                                </div>
                                                <div class="form-group col-sm">
                                                    <button type="button" name="filter" id="sub_account_filter"
                                                        class="btn btn-info btn-sm"
                                                        style="text-align: center; height : 40px; width: 100px;">Filter</button>
                                                </div>
                                            </div>
                                        </form>


                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="subAccDataTable"
                                                    width="100%" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Date</th>
                                                            <th class="text-center">Opening Balance</th>
                                                            <th class="text-center">Closing Balance</th>
                                                            <th class="text-center">Credit Amount</th>
                                                            <th class="text-center">Debit Amount</th><br>
                                                            <th class="text-center">Transaction Id</th>
                                                            <th class="text-center">Transaction Type</th>
                                                            <th class="text-center">Description</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

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

            <!-- Edit User Details Modal-->
            <div class="modal fade" id="edit_user_details_form" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit User Details</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <form name='editUserDetails' id='editUserDetails'>
                                <div class="row">
                                    <div class="col-md-6" style="margin:0 auto; display:block;">
                                        <div class="form-group">
                                            <label class="text-label">First Name</label>
                                            <div class="input-group">
                                                <input type="text" name="first_name" class="form-control"
                                                    id="first_name" value="{{ $userDetails->first_name }}" required>

                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label class="text-label">Last Name</label>
                                            <div class="input-group">
                                                <input type="text" name="last_name" class="form-control"
                                                    id="last_name" value="{{ $userDetails->last_name }}" required>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="text-label">Date of birth</label>
                                            <div class="input-group">
                                                <input type="date" name="date_of_birth" class="form-control"
                                                    id="date_of_birth" value="{{ $userDetails->date_of_birth }}"
                                                    required>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-label">Gender</label>
                                            <div class="input-group">
                                                <select name="gender" id="gender"
                                                    class="select2 form-control custom-select" required>
                                                    <option value="{{ $userDetails->gender }}" selected="selected">
                                                        Select Gender
                                                    </option>
                                                    <option value="MALE">MALE</option>
                                                    <option value="FEMALE">FEMALE</option>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                    <label>Source Of Income</label>
                                    <select name="source_of_income_id" id="sourceOfIncome"
                                        class="select2 form-control custom-select" required>
                                    </select>
                                </div>
                                        <div class="form-group">
                                            <label class="text-label">TIN</label>
                                            <div class="input-group">
                                                <input type="text" name="personal_tin_no" class="form-control"
                                                    id="personal_tin_no" value="{{ $userDetails->personal_tin_no }}" required>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-label">Address</label>
                                            <div class="input-group">
                                                <textarea class="form-control" type="text" style="border-color: white; " name="address" id="address" required>{{ $userDetails->address }}</textarea>
                                            </div>
                                        </div>
                                        @if ($userDetails->user_type_id == 4)
                                            <div class="form-group">
                                                <label class="text-label">Business Name</label>
                                                <div class="input-group">
                                                    <input type="text" name="business_name" class="form-control"
                                                        id="business_name"
                                                        value="{{ $userDetails->business->business_name }}">

                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <br><br>
                                </div>
                                <div id="response" style="text-align:center">
                                    <button type="submit" class="btn btn-primary btn-rounded btn-fw"
                                        id='edit_button' data-user-id="" style="font-weight:500;">Update
                                    </button>
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
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
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <form enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6" style="margin:0 auto; display:block;">
                                        <div class="form-group">
                                            <div class="col-md-4 text-center">
                                                <div id="cropie-demo" style="width:250px"></div>
                                            </div>
                                            <label>Upload Profile</label>
                                            <div class="input-group">
                                                <input type="file" name="image" class="image" id="upload"
                                                    required>
                                            </div>

                                        </div>
                                    </div>
                                    <br><br>
                                </div>
                                <div style="text-align:center">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel
                                    </button>
                                </div>

                            </form>
                            <div id='response'></div>

                        </div>

                        <div class="modal-footer">

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
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
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
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
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
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span> </button>
                        </div>
                        <div class="modal-body">
                            <form name='addFunds' id='addFunds'>
                                <div class="row">
                                    <div class="col-md-6" style="margin:0 auto; display:block;">
                                        <div class="form-group">
                                            <label>Amount</label>
                                            <div class="input-group">
                                                <input type="text" name="amount" class="form-control"
                                                    id="amount" required>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Transaction Pin</label>
                                            <div class="input-group">
                                                <input type="text" name="transaction_pin" class="form-control"
                                                    id="transaction_pin" required>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
                                            <div class="input-group">
                                                <input type="text" name="description" class="form-control"
                                                    id="description" required>

                                            </div>
                                        </div>


                                    </div>

                                    <br><br>

                                </div>
                                <div style="text-align:center">
                                    <button type="submit" class="btn btn-primary btn-rounded btn-fw"
                                        id='add_funds_submit_button' data-user-id=""
                                        style="font-weight:500;">Add</button>
                                    <button class="btn btn-secondary" type="button"
                                        data-dismiss="modal">Cancel</button>
                                </div>

                            </form>


                        </div>

                        <div class="modal-footer">
                            <div id='response'></div>
                        </div>
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
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <form name='updateTransferLimitScheme' id='updateTransferLimitScheme'>
                                <div class="row">
                                    <div class="col-md-6" style="margin:0 auto; display:block;">
                                        <div class="form-group">
                                            <label>Select Scheme</label>
                                            <select class="select2 form-control custom-select"
                                                name="transfer_limit_scheme_id" id="transfer_limit_scheme_id"
                                                required>
                                            </select>
                                        </div>
                                    </div>
                                    <br><br>
                                </div>
                                <div id="response" style="text-align:center">
                                    <button type="submit" class="btn btn-primary btn-rounded btn-fw"
                                        id='submit_button' data-package-id="" style="font-weight:500;">Update
                                    </button>
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel
                                    </button>
                                </div>
                            </form>


                        </div>

                        <div class="modal-footer">

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
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <form name='updatePaymentChargePackage' id='updatePaymentChargePackage'>
                                <div class="row">
                                    <div class="col-md-6" style="margin:0 auto; display:block;">
                                        <div class="form-group">
                                            <label>Select Package Type</label>
                                            <select class="select2 form-control custom-select"
                                                name="payment_charge_package_id" id="payment_charge_package_id"
                                                required>
                                            </select>
                                        </div>

                                    </div>

                                    <br><br>

                                </div>
                                <div id="response" style="text-align:center">
                                    <button type="submit" class="btn btn-primary btn-rounded btn-fw"
                                        id='submit_button' data-package-id="" style="font-weight:500;">Update
                                    </button>
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel
                                    </button>
                                </div>
                            </form>


                        </div>

                        <div class="modal-footer">

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
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span> </button>
                        </div>
                        <div class="modal-body">
                            <form name='addKyc' id='addKyc' enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6" style="margin:0 auto; display:block;">
                                        <div class="form-group">
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

                                        <div class="form-group">
                                        <input type="text" required name="kyc_document_id" id="kyc_document_id" 
                                            class="form-control " placeholder="ID Number" />
                                        </div>
                                        <div class="form-group input-daterange">
                                        <input type="text" required name="kyc_document_expiry_date" id="kyc_document_expiry_date" readonly
                                            class="form-control" placeholder="Expiry Date" />
                                        </div>
                                        <div class="form-group">
                                            <label>Upload KYC document</label>
                                            <div class="input-group">
                                                <input type="file" name="kyc_document_image" class="form-control"
                                                    id="kyc_document_image" required>
                                            </div>
                                        </div>
                                    </div>
                                    <br><br>
                                </div>
                                <div style="text-align:center">
                                    <button type="submit" class="btn btn-primary btn-rounded btn-fw"
                                        id='submit_kyc_button' data-user-id="" style="font-weight:500;">Add</button>
                                    <button class="btn btn-secondary" type="button"
                                        data-dismiss="modal">Cancel</button>
                                </div>

                                <div id='response'></div>
                            </form>

                        </div>

                        <div class="modal-footer">

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
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span> </button>
                        </div>
                        <div class="modal-body">
                            <form name='addSelfie' id='addSelfie' enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6" style="margin:0 auto; display:block;">
                                        <div class="form-group">
                                            <label>Upload Selfie</label>
                                            <div class="input-group">
                                                <input type="file" name="selfie_image" class="form-control"
                                                    id="selfie_image" required>
                                            </div>
                                        </div>
                                    </div>
                                    <br><br>
                                </div>
                                <div style="text-align:center">
                                    <button type="submit" class="btn btn-primary btn-rounded btn-fw"
                                        id='selfie_submit_button' data-user-id=""
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
                                <input type="hidden" name="master_account_user_id" value="{{ $userDetails->id }}">
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

            <!-- Raise Ticket -->
            <div class="modal fade" id="raise_ticket_form" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel">Raise Ticket</h4>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span> </button>
                        </div>
                        <div class="modal-body">
                            <form name='RaiseTicket' id='RaiseTicket'>
                                <div class="row">
                                    <div class="col-md-6" style="margin:0 auto; display:block;">
                                        <div class="form-group">
                                            <label>Complaint Type</label>
                                            <select name="complaint_type_id" id="complaint_type_id"
                                                class="select2 form-control custom-select" required>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Transaction Id</label>
                                            <div class="input-group">
                                                <input type="text" name="transaction_id" class="form-control"
                                                    id="transaction_id" required>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
                                            <div class="input-group">
                                                <input type="text" name="user_complaint_description"
                                                    class="form-control" id="user_complaint_description" required>

                                            </div>
                                        </div>
                                    </div>
                                    <br><br>
                                </div>
                                <input type="hidden" name="user_id" value="{{ $userDetails->id }}">
                                <div id='response'></div>
                                <div style="text-align:center">
                                    <button type="submit" class="btn btn-primary btn-rounded btn-fw"
                                        id='submit_button' data-user-id="" style="font-weight:500;">Send</button>
                                </div>

                            </form>
                            <div id='RaiseTicketResponse'></div>
                        </div>

                    </div>

                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.js"></script>
        <script src="{{ asset('vendor/datatables/jquery.dataTables.js') }}"></script>

        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
        <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
        <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>

        <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>

        {{-- Date Picker --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
        <script src="{{ asset('vendor/moment/moment.min.js') }}"></script>

        {{-- Crop Image --}}
        {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script> --}}

        <script type="text/javascript">
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
                    autoclose: true,
                    orientation: "bottom left"
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

                //Export
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

                //Raise Complaint
                $('#raiseTicket').click(function() {
                    // console.log("inside export function");
                    userId = $('#storeUserId').val();
                    $('#raise_ticket_form').modal('show');
                });
                //Complaint Type
                $.ajax({
                    url: '{{ url('api/admin/complaint-type') }}',
                    type: 'get',
                    data: {
                        'request_origin': 'web'
                    },
                    success: function(data) {
                        // console.log('data');
                        $('#complaint_type_id').empty();
                        $("#complaint_type_id").append(new Option("Select Complaint Type", ""));
                        $.each(data.data, function($index, $value) {

                            $('#complaint_type_id').append('</option>' + '<option value="' + $value
                                .id +
                                '" >' +
                                $value
                                .transaction_type + ": " +
                                $value
                                .type_description + '</option>');
                        })
                    }
                });
                $('#RaiseTicket').on('submit', function(e) {
                    e.preventDefault();
                    spinner.show();
                    var formFields = $('#RaiseTicket').serialize();
                    // console.log("FORM FIELDS: " + formFields);
                    $.ajax({
                        url: '{{ url('api/complaint') }}',
                        type: 'post',
                        dataType: 'JSON',
                        data: formFields,
                        success: function(data) {
                            if (data.error_code == 0) {
                                //console.log(data);
                                $('#raise_ticket_form').modal('hide');
                                spinner.hide();
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

                            $('#RaiseTicket').closest('form').find(
                                "input[type=text],input[type=tel], textarea").val("");
                        },
                        error: function(data) {
                            // console.log("Inside function");
                            if (data.status === 422) {
                                // console.log("Inside Condition");
                                var errors = $.parseJSON(data.responseText);
                                $.each(errors, function(key, value) {
                                    // console.log(key+ " " +value);
                                    $('#RaiseTicketResponse').addClass(
                                        "alert alert-danger");

                                    if ($.isPlainObject(value)) {
                                        $.each(value, function(key, value) {
                                            // console.log(key + " " + value);
                                            $('#RaiseTicketResponse').show().append(
                                                value +
                                                "<br/>");
                                            spinner.hide();
                                        });
                                    } else {
                                        $('#RaiseTicketResponse').show().append(value +
                                            "<br/>"); //this is my div with messages
                                        spinner.hide();
                                    }
                                });
                            }

                        }

                    });
                    //   $('#add_user_form').val('');

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

                    $.ajax({
                    url: '{{ url('api/source-of-income') }}',
                    type: 'get',
                    success: function(data) {
                        // console.log('data');
                        $('#sourceOfIncome').empty();
                        $.each(data.data, function($index, $value) {

                            $('#sourceOfIncome').append('<option value="' + $value
                                .id + '" >' + $value
                                .source + '</option>');
                        })
                    }});
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

                // Update Wallet Limit
                $(".wallet_limit_class").on('click', function() {
                   var limit =  document.getElementById('wallet-limit-class-input').value ;
var userID = document.getElementById('wallet-limit-user-id').value ;
                   if(limit < 1 || limit > 100000){
                    alert("Wallet limit should be between 1 and 1000000");
                   }
                   else{
                    formFields = { "wallet_limit" : limit} ;
                           $.ajax({
                        url: '{{ url('api/user') }}/' + userID,
                        type: 'patch',
                        dataType: 'JSON',
                        data: formFields,
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

                    
                    
                    // //console.log(packageType);
                 
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

</body>

</html>
