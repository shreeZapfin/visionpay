
				<aside class="app-sidebar sticky" id="sidebar">

					<!-- Start::main-sidebar-header -->
					<!-- <div class="main-sidebar-header">
						<a href="{{url('index')}}" class="header-logo">
							<img src="{{asset('build/assets/images/brand/desktop-logo.png')}}" alt="logo" class="desktop-logo">
							<img src="{{asset('build/assets/images/brand/toggle-logo.png')}}" alt="logo" class="toggle-logo">
							<img src="{{asset('build/assets/images/brand/desktop-dark.png')}}" alt="logo" class="desktop-dark">
							<img src="{{asset('build/assets/images/brand/toggle-dark.png')}}" alt="logo" class="toggle-dark">
						</a>
					</div> -->
					<!-- End::main-sidebar-header -->

					<!-- Start::main-sidebar -->
					<div class="main-sidebar" id="sidebar-scroll">

						<!-- Start::nav -->
						<nav class="main-menu-container nav nav-pills flex-column sub-open">
							<div class="slide-left" id="slide-left">
								<svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
									viewBox="0 0 24 24">
									<path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
								</svg>
							</div>
							<ul class="main-menu">
								<!-- Start::slide__category -->
								<li class="slide__category"><span class="category-name">Main</span></li>
								<!-- End::slide__category -->

								<!-- Start::slide -->
								<li class="slide">
									<a href="{{url('index')}}" class="side-menu__item">
										<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" height="24px"
											viewBox="0 0 24 24" width="24px" fill="#000000">
											<path d="M0 0h24v24H0V0z" fill="none" />
											<path
												d="M12 5.69l5 4.5V18h-2v-6H9v6H7v-7.81l5-4.5M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3z" />
										</svg>
										<span class="side-menu__label">Dashboard</span>
									</a>
								</li>
								<!-- End::slide -->

								@if (\Illuminate\Support\Facades\Auth::user()->user_type_id == \App\Enums\UserType::Admin)
								<!-- Start::slide -->
								<li class="slide has-sub">
									<a href="javascript:void(0);" class="side-menu__item">
										<i class="bi bi-person"></i>
										<!-- <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" height="24px"
											viewBox="0 0 24 24" width="24px" fill="#000000">
											<path d="M0 0h24v24H0V0z" fill="none"></path>
											<path
												d="M11 7h6v2h-6zm0 4h6v2h-6zm0 4h6v2h-6zM7 7h2v2H7zm0 4h2v2H7zm0 4h2v2H7zM20.1 3H3.9c-.5 0-.9.4-.9.9v16.2c0 .4.4.9.9.9h16.2c.4 0 .9-.5.9-.9V3.9c0-.5-.5-.9-.9-.9zM19 19H5V5h14v14z">
											</path>
										</svg> -->
										<span class="side-menu__label">Users</span>
										<i class="fe fe-chevron-right side-menu__angle"></i>
									</a>
									<ul class="slide-menu child1">
										<li class="slide side-menu__label1">
											<a href="{{ asset('users') }}">All Users</a>
										</li>
										<li class="slide">
											<a href="{{ asset('users') }}" class="side-menu__item">All Users</a>
										</li>
										<li class="slide has-sub">
											<a href="{{asset('addUser')}}" class="side-menu__item">Add New User
											</a>
										</li>
										<li class="slide has-sub">
											<a href="{{asset('verifiedUser')}}" class="side-menu__item">Verified Users
											</a>
										</li>
										<li class="slide has-sub">
											<a href="{{ asset('unVerifiedUser') }}" class="side-menu__item">Unverified Users
											</a>
										</li>
										<li class="slide has-sub">
											<a href="{{ asset('incompleteRegisterUser') }}" class="side-menu__item">Incomplete Registration
											</a>
										</li>
									</ul>
								</li>

								<li class="slide has-sub">
									<a href="javascript:void(0);" class="side-menu__item">
										<i class="bi bi-people"></i>
										<!-- <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" height="24px"
											viewBox="0 0 24 24" width="24px" fill="#000000">
											<path d="M0 0h24v24H0V0z" fill="none"></path>
											<path
												d="M11 7h6v2h-6zm0 4h6v2h-6zm0 4h6v2h-6zM7 7h2v2H7zm0 4h2v2H7zm0 4h2v2H7zM20.1 3H3.9c-.5 0-.9.4-.9.9v16.2c0 .4.4.9.9.9h16.2c.4 0 .9-.5.9-.9V3.9c0-.5-.5-.9-.9-.9zM19 19H5V5h14v14z">
											</path>
										</svg> -->
										<span class="side-menu__label">Merchants</span>
										<i class="fe fe-chevron-right side-menu__angle"></i>
									</a>
									<ul class="slide-menu child1">
										<li class="slide">
											<a href="{{ asset('merchants') }}" class="side-menu__item">All Merchants</a>
										</li>
										<!-- <li class="slide">
											<a href="{{ asset('addMerchant') }}" class="side-menu__item">Add New Merchant</a>
										</li> -->
										<li class="slide">
											<a href="{{ asset('verifiedMerchant') }}" class="side-menu__item">Verified Merchant</a>
										</li>
										<li class="slide">
											<a href="{{ asset('unVerifiedMerchants') }}" class="side-menu__item">Unverified Merchant</a>
										</li>
										<li class="slide">
											<a href="{{ asset('incompleteRegisterMerchant') }}" class="side-menu__item">Incomplete Registration</a>
										</li>
										<li class="slide">
											<a href="{{ asset('merchantSubAccount') }}" class="side-menu__item">Sub Accounts</a>
										</li>
									</ul>
								</li>
								<!-- Agent  -->
								<li class="slide has-sub">
									<a href="javascript:void(0);" class="side-menu__item">
										<i class="bi bi-people-fill"></i>
										<span class="side-menu__label">Agents</span>
										<i class="fe fe-chevron-right side-menu__angle"></i>
									</a>
									<ul class="slide-menu child1">
										<li class="slide">
											<a href="{{ asset('agents') }}" class="side-menu__item">All Agents</a>
										</li>
										<!-- <li class="slide">
											<a href="{{ asset('addAgent') }}" class="side-menu__item">Add New Agent</a>
										</li> -->
										<li class="slide">
											<a href="{{ asset('verifiedAgent') }}" class="side-menu__item">Verified Agents</a>
										</li>
										<li class="slide">
											<a href="{{ asset('unVerifiedAgents') }}" class="side-menu__item">Unverified Agents</a>
										</li>
										<li class="slide">
											<a href="{{ asset('incompleteRegisterAgent') }}" class="side-menu__item">Incomplete Registration</a>
										</li>
									</ul>
								</li>
								<!-- Biller  -->
								<li class="slide has-sub">
									<a href="javascript:void(0);" class="side-menu__item">
										<i class="bi bi-person-lines-fill"></i>
										<span class="side-menu__label">Biller</span>
										<i class="fe fe-chevron-right side-menu__angle"></i>
									</a>
									<ul class="slide-menu child1">
										<li class="slide">
											<a href="{{ asset('biller-list') }}" class="side-menu__item">Billers</a>
										</li>
										<!-- <li class="slide">
											<a href="{{ asset('billers') }}" class="side-menu__item">Edit Biller</a>
										</li> -->
										<li class="slide">
											<a href="{{ asset('biller-category') }}" class="side-menu__item">Services</a>
										</li>
										<li class="slide">
											<a href="{{ asset('bill-payment-report') }}" class="side-menu__item">Biller Report</a>
										</li>
										<li class="slide">
											<a href="{{ asset('biller-withdrawal-funds') }}" class="side-menu__item">Withdraw Funds</a>
										</li>
									</ul>
								</li>
								<!-- Reports  -->
								<li class="slide has-sub">
									<a href="javascript:void(0);" class="side-menu__item">
										<i class="bi bi-card-list"></i>
										<span class="side-menu__label">Reports</span>
										<i class="fe fe-chevron-right side-menu__angle"></i>
									</a>
									<ul class="slide-menu child1">
										<li class="slide">
											<a href="{{ asset('fund-request-list') }}" class="side-menu__item">Fund Request</a>
										</li>
										<li class="slide">
											<a href="{{ asset('wallet-history-list') }}" class="side-menu__item">Wallet History</a>
										</li>
										<li class="slide">
											<a href="{{ asset('depositReport') }}" class="side-menu__item">Deposit</a>
										</li>
										<li class="slide">
											<a href="{{ asset('withdrawal-list') }}" class="side-menu__item">Withdrawal</a>
										</li>
										<li class="slide">
											<a href="{{ url('api/user/search?download_csv=1') }}" class="side-menu__item">Export All Users</a>
										</li>
										<!-- <li class="slide">
											<a href="{{ asset('transaction_report') }}" class="side-menu__item">Transaction Report</a>
										</li>
										<li class="slide">
											<a href="{{ asset('full_day_report') }}" class="side-menu__item">Full day report</a>
										</li> -->
									</ul>
								</li>
								<!-- Rewards  -->
								<li class="slide has-sub">
									<a href="javascript:void(0);" class="side-menu__item">
										<i class="bi-stars"></i>
										<span class="side-menu__label">Rewards</span>
										<i class="fe fe-chevron-right side-menu__angle"></i>
									</a>
									<ul class="slide-menu child1">
										<li class="slide">
											<a href="{{ asset('createPromotionVoucher') }}" class="side-menu__item">Create Offer</a>
										</li>
										<li class="slide">
											<a href="{{ asset('all_vouchers') }}" class="side-menu__item">All Vouchers</a>
										</li>
										<li class="slide">
											<a href="{{ asset('reedeme_vouchers') }}" class="side-menu__item">Reedemed Vouchers</a>
										</li>
									</ul>
								</li>
								<!-- Ticket  -->
								<li class="slide has-sub">
									<a href="javascript:void(0);" class="side-menu__item">
										<i class="bi bi-ticket"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-ticket" viewBox="0 0 16 16">
  												<path d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6zM1.5 4a.5.5 0 0 0-.5.5v1.05a2.5 2.5 0 0 1 0 4.9v1.05a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-1.05a2.5 2.5 0 0 1 0-4.9V4.5a.5.5 0 0 0-.5-.5z"/></svg>
										</i>
										<span class="side-menu__label">Ticket</span>
										<i class="fe fe-chevron-right side-menu__angle"></i>
									</a>
									<ul class="slide-menu child1">
										<li class="slide">
											<a href="{{ asset('complaint_type') }}" class="side-menu__item">Ticket Type</a>
										</li>
										<li class="slide">
											<a href="{{ asset('complaint_list') }}" class="side-menu__item">Ticket List</a>
										</li>
									</ul>
								</li>
								<!-- App Grid  -->
								<li class="slide has-sub">
									<a href="javascript:void(0);" class="side-menu__item">
										<i class="bi bi-grid"></i>
										<span class="side-menu__label">App Grid</span>
										<i class="fe fe-chevron-right side-menu__angle"></i>
									</a>
									<ul class="slide-menu child1">
										<li class="slide">
											<a href="{{ asset('App-Grid') }}" class="side-menu__item">App Grid</a>
										</li>
									</ul>
								</li>
								<!-- Settings  -->
								<li class="slide has-sub">
									<a href="javascript:void(0);" class="side-menu__item">
										<i class="bi bi-gear-fill"></i>
										<span class="side-menu__label">Settings</span>
										<i class="fe fe-chevron-right side-menu__angle"></i>
									</a>
									<ul class="slide-menu child1">
										<li class="slide">
											<a href="{{ asset('advertisement-list') }}" class="side-menu__item">Advertisement</a>
										</li>
										<li class="slide">
											<a href="{{ asset('scheme-list') }}" class="side-menu__item">Schemes</a>
										</li>
										<li class="slide">
											<a href="{{ asset('faq-list') }}" class="side-menu__item">FAQ</a>
										</li>
										<li class="slide">
											<a href="{{ asset('payment_charge_package') }}" class="side-menu__item">Payment Charge Package</a>
										</li>
										<li class="slide">
											<a href="{{ asset('notification') }}" class="side-menu__item">Notification</a>
										</li>
										<li class="slide">
											<a href="{{ asset('system_settings') }}" class="side-menu__item">System Settings</a>
										</li>
									</ul>
								</li>
									<!-- Bank  -->
									<li class="slide has-sub">
									<a href="javascript:void(0);" class="side-menu__item">
										<i class="bi bi-bank"></i>
										<span class="side-menu__label">Bank Withdrawal</span>
										<i class="fe fe-chevron-right side-menu__angle"></i>
									</a>
									<ul class="slide-menu child1">
										<li class="slide">
											<a href="{{ asset('system_banks') }}" class="side-menu__item">System Banks</a>
										</li>
									</ul>
								</li>
								<!-- End::slide -->
								@endif

							</ul>
							<div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
									width="24" height="24" viewBox="0 0 24 24">
									<path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z">
									</path>
								</svg></div>
						</nav>
						<!-- End::nav -->

					</div>
					<!-- End::main-sidebar -->

				</aside>
