<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style=" overflow: auto">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center"
        href="{{ asset('/css/style.css') }}index.php">

        <div class="sidebar-brand-text mx-3"><img src="{{ asset('img/Capture.jpeg') }}" width="200" height="60"></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <!-- <li class="nav-item active">
                <a class="nav-link" href="{{ asset('index') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li> -->

    <!-- Divider -->
    <hr class="sidebar-divider">


    <!-- Nav Item - Pages Collapse Menu -->

    @if (\Illuminate\Support\Facades\Auth::user()->user_type_id == \App\Enums\UserType::Admin)
        <li class="nav-item active" id="home"> <a class="nav-link" href="{{ asset('index') }}"> <i
                    class="fas fa-fw fa-home"></i> <span>Home</span></a> </li>
        <li class="nav-item active" id="user"> <a class="nav-link collapsed" href="{{ asset('user') }}"
                data-toggle="collapse" data-target="#collapseUsers" aria-expanded="true" aria-controls="collapseUsers">
                <i class="fas fa-fw fa-user"></i> <span>Users</span></a>
            <div id="collapseUsers" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">

                    <a class="collapse-item" href="{{ asset('users') }}">All Users</a>
                    <a class="collapse-item" href="{{ asset('addUser') }}">Add New User</a>
                    <a class="collapse-item" href="{{ asset('verifiedUser') }}">Verified Users</a>
                    <a class="collapse-item" href="{{ asset('unVerifiedUser') }}">Unverified Users</a>
                    <a class="collapse-item" href="{{ asset('incompleteRegisterUser') }}">Incomplete Registration</a>
                </div>
            </div>
        </li>



        <li class="nav-item active" id="merchant"> <a class="nav-link collapsed" href="{{ asset('merchant') }}"
                data-toggle="collapse" data-target="#collapseMerchant" aria-expanded="true"
                aria-controls="collapseMerchant"> <i class="fas fa-fw fa-users"></i> <span>Merchants</span></a>
            <div id="collapseMerchant" class="collapse" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">

                    <a class="collapse-item" href="{{ asset('merchants') }}">All Merchant</a>
                    <a class="collapse-item" href="{{ asset('addMerchant') }}">Add New Merchant</a>
                    <a class="collapse-item" href="{{ asset('verifiedMerchant') }}">Verified Merchant</a>
                    <a class="collapse-item" href="{{ asset('unVerifiedMerchants') }}">Unverified Merchant</a>
                    <a class="collapse-item" href="{{ asset('incompleteRegisterMerchant') }}">Incomplete
                        Registration</a>
                    <a class="collapse-item" href="{{ asset('merchantSubAccount') }}">Sub Accounts</a>
                </div>
            </div>
        </li>
        <li class="nav-item active" id="admin"> <a class="nav-link collapsed" href="{{ asset('agents') }}"
                data-toggle="collapse" data-target="#collapseAgents" aria-expanded="true"
                aria-controls="collapseAgents"> <i class="fas fa-fw fa-users"></i> <span>Agents</span></a>

            <div id="collapseAgents" class="collapse" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">

                    <a class="collapse-item" href="{{ asset('agents') }}">All Agents</a>
                    <a class="collapse-item" href="{{ asset('addAgent') }}">Add New agent</a>
                    <a class="collapse-item" href="{{ asset('verifiedAgent') }}">Verified Agents</a>
                    <a class="collapse-item" href="{{ asset('unVerifiedAgents') }}">Unverified Agents</a>
                    <a class="collapse-item" href="{{ asset('incompleteRegisterAgent') }}">Incomplete
                        Registration</a>
                </div>
            </div>
        </li>

        <li class="nav-item active" id="bill_payment"> <a class="nav-link collapsed" href="{{ asset('bill_payment') }}"
                data-toggle="collapse" data-target="#collapseBillPayment" aria-expanded="true"
                aria-controls="collapseSetting">
                <i class="fas fa-fw fa-users"></i> <span>Biller</span></a>
            <div id="collapseBillPayment" class="collapse" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ asset('biller-list') }}">Billers</a>
                    {{-- <a class="collapse-item" href="{{ asset('billers') }}">Edit Biller</a> --}}
                    <a class="collapse-item" href="{{ asset('biller-category') }}">Services</a>
                    <a class="collapse-item" href="{{ asset('bill-payment-report') }}">Biller Report</a>
                    <a class="collapse-item" href="{{ asset('biller-withdrawal-funds') }}">Withdraw Funds</a>
                </div>
            </div>
        </li>

        <li class="nav-item active" id="reports"> <a class="nav-link collapsed" href="{{ asset('reports') }}"
                data-toggle="collapse" data-target="#collapseReports" aria-expanded="true"
                aria-controls="collapseReports">
                <i class="fas fa-fw fa-users"></i> <span>Reports</span></a>
            <div id="collapseReports" class="collapse" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ asset('fund-request-list') }}">Fund Request</a>
                    <a class="collapse-item" href="{{ asset('wallet-history-list') }}">Wallet History</a>
                    <a class="collapse-item" href="{{ asset('depositReport') }}">Deposit</a>
                    <a class="collapse-item" href="{{ asset('withdrawal-list') }}">Withdrawal</a>
                    <a class="collapse-item" href="{{ url('api/user/search?download_csv=1') }}">Export All Users</a>
                    {{-- <a class="collapse-item" href="{{ asset('transaction_report') }}">Transaction Report</a>
                <a class="collapse-item" href="{{ asset('full_day_report') }}">Full day report</a> --}}
                </div>
            </div>
        </li>
        <li class="nav-item active" id="rewards"> <a class="nav-link collapsed" href="{{ asset('rewards') }}"
                data-toggle="collapse" data-target="#collapseRewards" aria-expanded="true"
                aria-controls="collapseSetting">
                <i class="fas fa-fw fa-users"></i> <span>Rewards</span></a>
            <div id="collapseRewards" class="collapse" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ asset('createPromotionVoucher') }}">Create Offer</a>
                    <a class="collapse-item" href="{{ asset('all_vouchers') }}">All Vouchers</a>
                    <a class="collapse-item" href="{{ asset('reedeme_vouchers') }}">Reedemed Vouchers</a>
                </div>
            </div>
        </li>
        <li class="nav-item active" id="complaint"> <a class="nav-link collapsed" href="{{ asset('complaint') }}"
                data-toggle="collapse" data-target="#collapseComplaint" aria-expanded="true"
                aria-controls="collapseSetting">
                <i class="fas fa-fw fa-users"></i> <span>Ticket</span></a>
            <div id="collapseComplaint" class="collapse" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ asset('complaint_type') }}">Ticket Type</a>
                    <a class="collapse-item" href="{{ asset('complaint_list') }}">Ticket List</a>
                </div>
            </div>
        </li>
        <li class="nav-item active" id="appgrid"> <a class="nav-link collapsed" href="{{ asset('appgrid') }}"
                data-toggle="collapse" data-target="#collapseAppgrid" aria-expanded="true"
                aria-controls="collapseAppgrid">
                <i class="fas fa-fw fa-users"></i> <span>App Grid</span></a>
            <div id="collapseAppgrid" class="collapse" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ asset('App-Grid') }}">App Grid</a>
                </div>
            </div>
        </li>

        <li class="nav-item active" id="setting"> <a class="nav-link collapsed" href="{{ asset('setting') }}"
                data-toggle="collapse" data-target="#collapseSetting" aria-expanded="true"
                aria-controls="collapseSetting">
                <i class="fas fa-fw fa-users"></i> <span>Setting</span></a>
            <div id="collapseSetting" class="collapse" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">

                    <!--	<a class="collapse-item" href="{{ asset('operater_commission') }}">Operater Commission</a>
          <a class="collapse-item" href="{{ asset('bank_setting') }}">Bank Setting</a>
          <a class="collapse-item" href="{{ asset('country_setting') }}">Country Setting</a>
          <a class="collapse-item" href="{{ asset('city_setting') }}">City Setting</a> -->
                    <a class="collapse-item" href="{{ asset('advertisement-list') }}">Advertisement</a>
                    <a class="collapse-item" href="{{ asset('scheme-list') }}">Schemes</a>
                    <a class="collapse-item" href="{{ asset('faq-list') }}">FAQ</a>
                    <a class="collapse-item" href="{{ asset('payment_charge_package') }}">Payment Charge Package</a>
                    <a class="collapse-item" href="{{ asset('notification') }}">Notification</a>
                    <a class="collapse-item" href="{{ asset('system_settings') }}">System Settings</a>
                </div>
            </div>
        </li>

        <li class="nav-item active" id="bank_withdrawal"> <a class="nav-link collapsed"
                href="{{ asset('bank_withdrawal') }}" data-toggle="collapse" data-target="#collapseBankWithdrawal"
                aria-expanded="true" aria-controls="collapseBankWithdrawal">
                <i class="fas fa-solid fa-piggy-bank"></i><span>Bank
                    Withdrawal</span></a>
            <div id="collapseBankWithdrawal" class="collapse" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">

                    <a class="collapse-item" href="{{ asset('system_banks') }}">System Banks</a>

                </div>
            </div>
        </li>
    @endif

    @if (\Illuminate\Support\Facades\Auth::user()->user_type_id == \App\Enums\UserType::Biller)
        <li class="nav-item active" id="home"> <a class="nav-link" href="{{ asset('biller/index') }}"> <i
                    class="fas fa-fw fa-home"></i> <span>Bill Payment Report</span></a> </li>
        <li class="nav-item active" id="change_pwd"> <a class="nav-link" href="{{ asset('change-password') }}">
                <i class="fas fa-cube fa-sm fa-fw mr-2 text-gray-400"></i> <span>Change Password</span></a> </li>
        <li class="nav-item active" id="biller_profile"> <a class="nav-link" href="{{ asset('profile') }}">
                <i class="fas fa-fw fa-user"></i> <span>Profile</span></a> </li>
        <li class="nav-item active" id="logout"> <a class="dropdown-item" href="{{ asset('user/logout') }}"
                data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Logout </a> </li>
    @endif


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

</ul>
