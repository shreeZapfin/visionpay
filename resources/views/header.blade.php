<meta name="csrf-token" content="{{ csrf_token() }}">





<!-- Custom fonts for this template-->
<link href="{{ asset('https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css') }}" rel="stylesheet"
    media="screen" />
<link href="{{ asset('http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css') }}" rel="stylesheet">
{{-- <link rel="stylesheet"
        href="{{ asset('http://fortawesome.github.io/Font-Awesome/3.2.1/assets/font-awesome/css/font-awesome.css') }}"> --}}
<link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
<!-- Custom fonts for this template-->
<link
    href="{{ asset('https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i') }}"
    rel="stylesheet">
<!-- <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet" media="screen" /> -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">

<!-- Custom styles for this template-->
<link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">


{{-- sweetalert --}}
<link rel="stylesheet"
    href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.css') }}">

<link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">

<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i></button>

    <p style="margin-top: 0;margin-bottom: 0;"><b>Balance : <span id="span_balance"></span></b></p>
    <!-- Topbar Navbar -->

    @if (\Illuminate\Support\Facades\Auth::user()->user_type_id == \App\Enums\UserType::Admin)
        <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
                <a class="nav-link dropdown-toggle" href="{{ asset('#') }}" id="searchDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-search fa-fw"></i> </a>
                <!-- Dropdown - Messages -->
                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                    aria-labelledby="searchDropdown">
                    <form class="form-inline mr-auto w-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small"
                                placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>


            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="{{ asset('#') }}" id="userDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">Pacpay Admin</span>
                    <img class="img-profile rounded-circle" src="{{ asset('img/undraw_profile.svg') }}"> </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="{{ asset('admin-bank-details') }}">
                        <i class="fas fa-bank fa-sm fa-fw mr-2 text-gray-400"></i>
                        Bank List </a>
                    <a class="dropdown-item" href="{{ asset('addAdminBalance') }}">
                        <i class="fas fa-dollar-sign fa-sm fa-fw mr-2 text-gray-400"></i>
                        Add Balance </a>
                    <a class="dropdown-item" href="{{ asset('wallet-history-list') }}">
                        <i class="fas fa-history fa-sm fa-fw mr-2 text-gray-400"></i>
                        Wallet History </a>
                    <a class="dropdown-item" href="{{ asset('transaction-pin') }}" title="Change Transaction Pin">
                        <i class="fas fa-history fa-sm fa-fw mr-2 text-gray-400"></i>
                        Transaction Pin </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ asset('user/logout') }}" data-toggle="modal"
                        data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout </a>
                </div>
            </li>
        </ul>
    @endif


</nav>

<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="{{ asset('user/logout') }}">Logout</a>
            </div>
        </div>
    </div>
</div>





<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<!-- Core plugin JavaScript-->
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>


<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Custom scripts for all pages-->
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
<!-- Page level plugins -->
{{-- <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script> --}}
<!-- Page level custom scripts -->
{{-- <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.js"></script>
{{-- Date Picker --}}
<script src="{{ asset('vendor/moment/moment.min.js') }}"></script>


<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function() {


        //Get wallet Balance
        $.ajax({
            url: '{{ url('api/wallet-balance') }}',
            headers: {
                'Content-Type': 'application/json'
            },
            type: 'GET',
            dataType: 'JSON',
            success: function(response) {
                $('#span_balance').html(response.data[0].balance);
            },
            error: function(error) {
                alert(error);
            },
        });

    })
</script>
