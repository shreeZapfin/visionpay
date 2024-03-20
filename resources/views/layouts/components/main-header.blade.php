
<header class="app-header header sticky">

<!-- Start::main-header-container -->
<div class="main-header-container container-fluid">

	<!-- Start::header-content-left -->
	<div class="header-content-left align-items-center">

		<!-- <div class="header-element">
			<div class="horizontal-logo">
				<a href="{{url('index')}}" class="header-logo">
					<img src="{{asset('build/assets/images/brand/desktop-logo.png')}}" alt="logo" class="desktop-logo">
					<img src="{{asset('build/assets/images/brand/toggle-logo.png')}}" alt="logo" class="toggle-logo">
					<img src="{{asset('build/assets/images/brand/desktop-dark.png')}}" alt="logo" class="desktop-dark">
					<img src="{{asset('build/assets/images/brand/toggle-dark.png')}}" alt="logo" class="toggle-dark">
				</a>
			</div>
		</div> -->

		<div class="main-header-center  d-none d-lg-block  header-link">
			<p style="margin-top: 0;margin-bottom: 0;"><b>Balance : <span id="span_balance"></span></b></p>
		</div>
		<!-- header search -->
	</div>
	<!-- End::header-content-left -->

	<!-- Start::header-content-right -->
	<div class="header-content-right">
		<!-- Start::header-element -->
		<div class="header-element header-theme-mode">
											<!-- Start::header-link|layout-setting -->
											<a href="javascript:void(0);" class="header-link layout-setting">
												<span class="light-layout">
													<!-- Start::header-link-icon -->
													<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" class="header-link-icon" viewBox="0 0 24 24">
														<g>
															<rect fill="none" height="24" width="24" />
														</g>
														<g>
															<g>
																<path
																	d="M19.78,17.51c-2.47,0-6.57-1.33-8.68-5.43C8.77,7.57,10.6,3.6,11.63,2.01C6.27,2.2,1.98,6.59,1.98,12 c0,0.14,0.02,0.28,0.02,0.42C2.61,12.16,3.28,12,3.98,12c0,0,0,0,0,0c0-3.09,1.73-5.77,4.3-7.1C7.78,7.09,7.74,9.94,9.32,13 c1.57,3.04,4.18,4.95,6.8,5.86c-1.23,0.74-2.65,1.15-4.13,1.15c-0.5,0-1-0.05-1.48-0.14c-0.37,0.7-0.94,1.27-1.64,1.64 c0.98,0.32,2.03,0.5,3.11,0.5c3.5,0,6.58-1.8,8.37-4.52C20.18,17.5,19.98,17.51,19.78,17.51z" />
																<path
																	d="M7,16l-0.18,0C6.4,14.84,5.3,14,4,14c-1.66,0-3,1.34-3,3s1.34,3,3,3c0.62,0,2.49,0,3,0c1.1,0,2-0.9,2-2 C9,16.9,8.1,16,7,16z" />
															</g>
														</g>
													</svg>
													<!-- End::header-link-icon -->
												</span>
												<span class="dark-layout">
													<!-- Start::header-link-icon -->
													<svg xmlns="http://www.w3.org/2000/svg"
														enable-background="new 0 0 24 24" class="header-link-icon"
														viewBox="0 0 24 24">
														<rect fill="none" height="24" width="24" />
														<path
															d="M12,9c1.65,0,3,1.35,3,3s-1.35,3-3,3s-3-1.35-3-3S10.35,9,12,9 M12,7c-2.76,0-5,2.24-5,5s2.24,5,5,5s5-2.24,5-5 S14.76,7,12,7L12,7z M2,13l2,0c0.55,0,1-0.45,1-1s-0.45-1-1-1l-2,0c-0.55,0-1,0.45-1,1S1.45,13,2,13z M20,13l2,0c0.55,0,1-0.45,1-1 s-0.45-1-1-1l-2,0c-0.55,0-1,0.45-1,1S19.45,13,20,13z M11,2v2c0,0.55,0.45,1,1,1s1-0.45,1-1V2c0-0.55-0.45-1-1-1S11,1.45,11,2z M11,20v2c0,0.55,0.45,1,1,1s1-0.45,1-1v-2c0-0.55-0.45-1-1-1C11.45,19,11,19.45,11,20z M5.99,4.58c-0.39-0.39-1.03-0.39-1.41,0 c-0.39,0.39-0.39,1.03,0,1.41l1.06,1.06c0.39,0.39,1.03,0.39,1.41,0s0.39-1.03,0-1.41L5.99,4.58z M18.36,16.95 c-0.39-0.39-1.03-0.39-1.41,0c-0.39,0.39-0.39,1.03,0,1.41l1.06,1.06c0.39,0.39,1.03,0.39,1.41,0c0.39-0.39,0.39-1.03,0-1.41 L18.36,16.95z M19.42,5.99c0.39-0.39,0.39-1.03,0-1.41c-0.39-0.39-1.03-0.39-1.41,0l-1.06,1.06c-0.39,0.39-0.39,1.03,0,1.41 s1.03,0.39,1.41,0L19.42,5.99z M7.05,18.36c0.39-0.39,0.39-1.03,0-1.41c-0.39-0.39-1.03-0.39-1.41,0l-1.06,1.06 c-0.39,0.39-0.39,1.03,0,1.41s1.03,0.39,1.41,0L7.05,18.36z" />
													</svg>
													<!-- End::header-link-icon -->
												</span>
											</a>
											<!-- End::header-link|layout-setting -->
										</div>
										<!-- End::header-element -->
		<button class="navbar-toggler navresponsive-toggler d-lg-none ms-auto" type="button"
			data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4"
			aria-controls="navbarSupportedContent-4" aria-expanded="false"
			aria-label="Toggle navigation">
			<span class="navbar-toggler-icon fe fe-more-vertical"></span>
		</button>
		<div class="navbar navbar-collapse responsive-navbar p-0">
			<div class="collapse navbar-collapse" id="navbarSupportedContent-4">
				<div class="d-flex align-items-center">
					<!-- Start::header-element -->
					<div class="header-element dropdown-center notifications-dropdown">
						<!-- Start::header-link|dropdown-toggle -->
						<a href="javascript:void(0);" class="header-link dropdown-toggle"
							data-bs-toggle="dropdown" aria-expanded="false">
							<svg xmlns="http://www.w3.org/2000/svg" class="header-link-icon"
								viewBox="0 0 24 24">
								<path d="M0 0h24v24H0V0z" fill="none" />
								<path
									d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2zm6-6v-5c0-3.07-1.63-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.64 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2zm-2 1H8v-6c0-2.48 1.51-4.5 4-4.5s4 2.02 4 4.5v6z" />
							</svg>
							<span
								class="badge bg-secondary rounded-pill header-icon-badge pulse pulse-secondary"
								id="notification-icon-badge">4</span>
						</a>
						<!-- End::header-link|dropdown-toggle -->
						<!-- Start::main-header-dropdown -->
						<div class="main-header-dropdown dropdown-menu dropdown-menu-end"
							data-popper-placement="none">
							<div class="p-3">
								<div class="d-flex align-items-center justify-content-between">
									<p class="mb-0 fs-15 fw-semibold">Notifications</p>
									<a href="javascript:void(0);" class="badge bg-secondary-transparent"
										id="notifiation-data">4 Items</a>
								</div>
							</div>
							<div class="dropdown-divider my-0"></div>
							<ul class="list-unstyled mb-0">
								<li class="dropdown-item mb-1">
									<div class="d-flex align-items-start">
										<div class="pe-2">
											<span class="avatar avatar-md bg-primary rounded-circle"><i
													class="ti ti-gift fs-18"></i></span>
										</div>
										<div class="flex-grow-1">
											<div
												class="d-flex align-items-start justify-content-between">
												<div>
													<a href="{{url('notify-list')}}"
														class="mb-0 fs-13 font-weight-semibold text-dark">Nile
														Robetz send to a HTML file for Upload</a>
													<div class="p-1 text-warning">
														<span class="fs-12 me-2"><i
																class="bi bi-folder2-open me-1 fs-14"></i>HTML
															File</span>
														<span class="fs-13"><i
																class="bi bi-download"></i></span>
													</div>
												</div>
												<a href="javascript:void(0);"
													class="min-w-fit-content text-muted text-opacity-75 ms-1 dropdown-item-close1"><i
														class="ti ti-x fs-16"></i></a>
											</div>
										</div>
									</div>
								</li>
								<li class="dropdown-item mb-1">
									<div class="d-flex align-items-start">
										<div class="pe-2">
											<span
												class="avatar avatar-md bg-secondary rounded-circle"><i
													class="ti ti-discount-2 fs-18"></i></span>
										</div>
										<div class="flex-grow-1">
											<div
												class="d-flex align-items-start justify-content-between">
												<div>
													<a href="{{url('notify-list')}}"
														class="mb-0 fs-13 font-weight-semibold text-dark">Conference
														meeting about client project</a>
													<div class="p-1">
														<span class="fs-11 text-muted me-3"><i
																class="bi bi-calendar me-1"></i>Monday -
															11:00 AM - 45 minutes</span>
													</div>
													<a href="{{url('profile')}}"
														class="d-flex align-items-center mt-1">
														<span class="avatar avatar-sm brround">
															<img src="{{asset('build/assets/images/users/1.jpg')}}"
																class="brround" alt="img">
														</span>
														<span class="ms-2 fs-13 text-gray-600">Nile
															Rebort</span>
													</a>
												</div>
												<a href="javascript:void(0);"
													class="min-w-fit-content text-muted text-opacity-75 ms-1 dropdown-item-close1"><i
														class="ti ti-x fs-16"></i></a>
											</div>
										</div>
									</div>
								</li>
								<li class="dropdown-item mb-1">
									<div class="d-flex align-items-start">
										<div class="pe-2">
											<span class="avatar avatar-md bg-pink rounded-circle"><i
													class="ti ti-user-check fs-18"></i></span>
										</div>
										<div class="flex-grow-1">
											<div
												class="d-flex align-items-start justify-content-between">
												<a href="{{url('notify-list')}}"
													class="mb-0 fs-13 font-weight-semibold text-dark">Taylor
													invite to a design channel</a>
												<a href="javascript:void(0);"
													class="min-w-fit-content text-muted text-opacity-75 ms-1 dropdown-item-close1"><i
														class="ti ti-x fs-16"></i></a>
											</div>
											<div class="fs-12">
												<small class="text-muted fs-12">Hi, can i change my
													commission amount?</small>
												<div class="mt-2">
													<button type="button"
														class="btn btn-primary-light btn-sm me-1 fs-11">Accept</button>
													<button type="button"
														class="btn btn-danger-light btn-sm fs-11">Reject</button>
												</div>
											</div>
										</div>
									</div>
								</li>
								<li class="dropdown-item mb-1">
									<div class="d-flex align-items-start">
										<div class="pe-2">
											<span class="avatar avatar-md bg-warning rounded-circle"><i
													class="ti ti-circle-check fs-18"></i></span>
										</div>
										<div class="flex-grow-1">
											<div
												class="d-flex align-items-start justify-content-between">
												<a href="{{url('notify-list')}}"
													class="mb-0 fs-13 font-weight-semibold text-dark">Order
													Placed <span class="text-primary">ID:
														#1116773</span></a>
												<a href="javascript:void(0);"
													class="min-w-fit-content text-muted text-opacity-75 ms-1 dropdown-item-close1"><i
														class="ti ti-x fs-16"></i></a>
											</div>
											<div
												class="d-flex align-items-center justify-conent-between fs-12">
												<span class="text-muted">Order Placed
													Successfully</span>
												<span
													class="align-self-end min-w-fit-content text-muted mg-s-5">12:46</span>
											</div>
										</div>
									</div>
								</li>
							</ul>
							<!-- <div class="dropdown-divider"></div> -->
							<div class="p-3 empty-header-item1">
								<div class="d-grid">
									<a href="{{url('notify-list')}}" class="btn btn-primary">View All</a>
								</div>
							</div>
							<div class="p-5 empty-item1 d-none">
								<div class="text-center">
									<span class="avatar avatar-xl rounded-2 bg-secondary-transparent">
										<i class="ri-notification-off-line fs-2"></i>
									</span>
									<h6 class="fw-semibold mt-3">No New Notifications</h6>
								</div>
							</div>
						</div>
						<!-- End::main-header-dropdown -->
					</div>
					<!-- End::header-element -->

					<!-- Start::header-element|main-profile-user -->
					@if (\Illuminate\Support\Facades\Auth::user()->user_type_id == \App\Enums\UserType::Admin)
					<div class="header-element main-profile-user">
						<!-- Start::header-link|dropdown-toggle -->
						<a href="javascript:void(0);" class="header-link dropdown-toggle d-flex align-items-center"
							id="mainHeaderProfile" data-bs-toggle="dropdown" aria-expanded="false">
							<span class="me-2">
								<img src="{{asset('build/assets/images/users/21.jpg')}}" alt="img" width="30"
									height="30" class="rounded-circle">
							</span>
							<div class="d-xl-block d-none lh-1">
								<h6 class="fs-13 font-weight-semibold mb-0 text-uppercase">{{isset(Auth::user()->username) && !empty(Auth::user()->username) ? Auth::user()->username : '-'}}</h6>
								<!-- <span class="op-8 fs-10">Web Designer</span> -->
							</div>
						</a>
						<!-- End::header-link|dropdown-toggle -->
						<ul class="dropdown-menu pt-0 overflow-hidden dropdown-menu-end mt-1"
							aria-labelledby="mainHeaderProfile">
							<!-- <li><a class="dropdown-item" href="{{url('profile')}}"><i
										class="ti ti-user-circle fs-18 me-2 op-7"></i>Profile</a></li> -->
							<li><a class="dropdown-item" href="{{ asset('admin-bank-details') }}">
									<i class="ti ti-user-circle fs-18 me-2 op-7"></i>Bank List </a></li>			
							<li><a class="dropdown-item" href="{{ asset('addAdminBalance') }}">
									<i class="ti ti-inbox fs-18 me-2 op-7"></i>
									Add Balance </a></li>
							<li><a class="dropdown-item" href="{{ asset('wallet-history-list') }}">
									<i class="ti ti-list fs-18 me-2 op-7"></i>
									Wallet History </a></li>
							<li> <a class="dropdown-item" href="{{ asset('transaction-pin') }}" title="Change Transaction Pin">
									<i class="ti ti-adjustments-horizontal fs-18 me-2 op-7"></i>
									Transaction Pin </a></li>
							<li>
								<hr class="dropdown-divider my-0">
							</li>
							<li><a class="dropdown-item" href="{{ asset('user/logout') }}" data-toggle="modal" data-target="#logoutModal"><i
									class="ti ti-power fs-18 me-2 op-7"></i>Sign Out</a></li>
							<li>
								<hr class="dropdown-divider my-0">
							</li>
						</ul>
					</div>
					@endif
					<!-- End::header-element|main-profile-user -->
				</div>
			</div>
		</div>

	</div>
	<!-- End::header-content-right -->
</div>
<!-- End::main-header-container -->

</header>
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
<script src="{{ asset('vendor/datatables/jquery.dataTables.js') }}"></script>
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
