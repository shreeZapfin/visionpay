<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    \Artisan::call('config:cache');
    \Artisan::call('view:clear');
    \Artisan::call('route:clear');
    dd("Cache is cleared");
});

Route::get('getMobile', [App\Http\Controllers\LoginController::class, 'getMobile']);
Route::post('submitMobile', [\App\Http\Controllers\LoginController::class, 'submitMobile'])->name('submitMobile');
Route::get('verifyOtp', [App\Http\Controllers\LoginController::class, 'verifyOtp']);
Route::post('verifyUserOtp', [App\Http\Controllers\LoginController::class, 'verifyUserOtp']);

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');


Route::get('/push-notificaiton', [\App\Http\Controllers\WebNotificationController::class, 'index'])->name('push-notificaiton');
Route::post('/store-token', [\App\Http\Controllers\WebNotificationController::class, 'storeToken'])->name('store.token');
Route::post('/send-web-notification', [\App\Http\Controllers\WebNotificationController::class, 'sendWebNotification'])->name('send.web-notification');

Auth::routes();

//Login
Route::get('/login', [App\Http\Controllers\LoginController::class, 'show'])->name('login');
Route::post('/login', [App\Http\Controllers\LoginController::class, 'login']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => ['auth', 'web', 'admin_web']], function () {
    Route::get('/index', function () {
        return view('index');
    });

    Route::get('/users', [App\Http\Controllers\UserController::class, 'showCustomerPage']);
    Route::get('/getUser/{Id}', [App\Http\Controllers\UserController::class, 'getUser']);

    Route::get('/merchants', [App\Http\Controllers\UserController::class, 'showMerchantPage']);
    Route::get('/agents', [App\Http\Controllers\UserController::class, 'showAgentPage']);
    Route::get('/billerinfo/editBiller/{user}', [App\Http\Controllers\UserController::class, 'editBillers']);
    Route::get('/billers', [App\Http\Controllers\UserController::class, 'showBillerPage']);

    Route::get('user/logout', [App\Http\Controllers\LoginController::class, 'logoutWeb']);

    // Route::get('merchant/{user}/editMerchant', [App\Http\Controllers\UserController::class, 'editMerchant']);
    //Verified Users
    Route::get('/verifiedUser', [App\Http\Controllers\UserController::class, 'showVerifiedUserPage']);
    Route::get('/verifiedMerchant', [App\Http\Controllers\UserController::class, 'showVerifiedMerchantPage']);
    Route::get('/verifiedAgent', [App\Http\Controllers\UserController::class, 'showVerifiedAgentPage']);
    Route::get('/verifiedBiller', [App\Http\Controllers\UserController::class, 'showVerifiedBillerPage']);

    //UnVerified Users
    Route::get('/unVerifiedUser', [App\Http\Controllers\UserController::class, 'showUnVerifiedUserPage']);
    Route::get('/unVerifiedMerchants', [App\Http\Controllers\UserController::class, 'showUnVerifiedMerchantPage']);
    Route::get('/unVerifiedAgents', [App\Http\Controllers\UserController::class, 'showUnVerifiedAgentPage']);
    Route::get('/unVerifiedBillers', [App\Http\Controllers\UserController::class, 'showUnVerifiedBillerPage']);

    //Incomplete Registration
    Route::get('/incompleteRegisterUser', [App\Http\Controllers\UserController::class, 'showIncompleteRegisterUserPage']);
    Route::get('/incompleteRegisterMerchant', [App\Http\Controllers\UserController::class, 'showIncompleteRegisterMerchantPage']);
    Route::get('/incompleteRegisterAgent', [App\Http\Controllers\UserController::class, 'showIncompleteRegisterAgentPage']);
    Route::get('/incompleteRegisterBiller', [App\Http\Controllers\UserController::class, 'showIncompleteRegisterBillerPage']);

    //Merchant Sub Account
    Route::get('/merchantSubAccount', [App\Http\Controllers\UserController::class, 'showMerchantSubAccountPage']);

    //Add Admin Balance
    Route::get('/addAdminBalance', function () {
        return view('admin_add_balance');
    });

    //Add Users
    Route::get('/addUser', function () {
        return view('users.add_new_user');
    });
    Route::get('/addMerchant', function () {
        return view('merchants.add_new_merchant');
    });
    Route::get('/addAgent', function () {
        return view('agents.add_new_agent');
    });
    Route::get('/addBiller', function () {
        return view('Biller.add_new_biller');
    });

    //Admin Bank
    Route::get('/admin-bank-details', [App\Http\Controllers\AdminBankController::class, 'showAdminBankPage']);
    Route::get('/addAdminBank', function () {
        return view('AdminBank.add_new_bank');
    });

    //Fund Request
    Route::get('/fund-request-list', [App\Http\Controllers\FundRequestController::class, 'showFundRequestPage']);

    //Admin Wallet History
    Route::get('/wallet-history-list', [App\Http\Controllers\WalletTransactionController::class, 'showWalletHistoryPage']);
    Route::get('/admin-commission', function () {
        return view('Reports.admin_commission');
    });
    Route::get('/admin-withdrawal', function () {
        return view('Reports.admin_withdrawal');
    });

    //Add Advertisement
    Route::get('/advertisement-list', [App\Http\Controllers\AdvertisementController::class, 'showAdvertisementPage']);

    Route::get('/add-advertisement', function () {
        return view('Settings.add_advertisement');
    });

    Route::get('/scheme-list', [App\Http\Controllers\TransferLimitSchemeController::class, 'showSchemesPage']);

    //FAQ
    Route::get('/faq-list', [App\Http\Controllers\Website\FAQController::class, 'showFaqPage']);

    //Deposit and withdrawal Report
    Route::get('/depositReport', [App\Http\Controllers\DepositController::class, 'showDepositReportPage']);
    Route::get('/withdrawal-list', [App\Http\Controllers\WithdrawalController::class, 'showWithdrawalListPage']);

    //Bill Payment
    Route::get('/biller-list', [App\Http\Controllers\BillerController::class, 'showBillerListPage']);
    Route::get('/biller-category', [App\Http\Controllers\BillerController::class, 'showBillerCategory']);
    Route::get('/bill-payment-report', [App\Http\Controllers\BillPaymentsController::class, 'showBillerReportPage']);
    Route::get('/biller-withdrawal-funds', [App\Http\Controllers\WithdrawalController::class, 'showBillerWithdrawalFundsPage']);


    //Rewards
    Route::get('/all_vouchers', [App\Http\Controllers\PromotionController::class, 'showVoucherPage']);
    Route::get('/createPromotionVoucher', function () {
        return view('Rewards.create_promotion_offer');
    });
    Route::get('/reedeme_vouchers', [App\Http\Controllers\PromotionController::class, 'showReedemeVoucherPage']);

    //Complaint
    Route::get('/complaint_type', [App\Http\Controllers\ComplaintTypeController::class, 'showComplaintTypePage']);
    Route::get('/complaint_list', [App\Http\Controllers\ComplaintController::class, 'showComplaintListPage']);

    //Notification
    Route::get('/notification', [App\Http\Controllers\WebNotificationController::class, 'showAdminBankPage']);

    //App Grid
    Route::get('/App-Grid', [App\Http\Controllers\AppGridController::class, 'showAppGridPage']);


    Route::get('/payment_charge_package', [App\Http\Controllers\PaymentChargePackageController::class, 'showPaymentChargePackagePage']);

    Route::get('/system_settings', [App\Http\Controllers\SystemSettingController::class, 'showSystemSettingsPage']);

    //Bank Withdrawal
    Route::get('/system_banks', [App\Http\Controllers\UserBankController::class, 'showSystemBankPage']);

    Route::get('/voucher-detail/{promotion}', [App\Http\Controllers\PromotionController::class, 'showVoucherIdPage']);


    Route::get('/qr-design', function () {
        return view('qr')->with('userDetails', \App\Models\User::find(2));
    });

    //Transaction Pin
    Route::get('/transaction-pin', function () {
        return view('transaction_pin');
    });
});


Route::group(['middleware' => ['auth', 'web', 'biller_web']], function () {
    Route::get('biller/index', [App\Http\Controllers\BillPaymentsController::class, 'showBillerReportPage']);

    Route::get('/change-password', function () {
        return view('BillerPanel.change_password');
    });
    Route::get('/profile', function () {
        return view('BillerPanel.biller_profile');
    });
});

//User Dashboard
Route::group(['middleware' => ['auth', 'web', 'customer_web']], function () {

    Route::get('user/index', function () {
        return view('CustomerPanel.user_dashboard');
    });
    Route::get('customer/index', function () {
        return view('CustomerPanel.customer_index');
    });
});

Route::get('/forgot-password', function () {
    return view('forgot_password');
});

//Landing Pge
Route::get('/index/pacpay', function () {
    return view('landing_page');
});

Route::get('/chat-design', function () {
    return view('Complaint.chat-design');
});

Route::get('/qr-design', function () {
    return view('qr');
});

Route::get('/img-crop', function () {
    return view('imageCrop');
});

/* Route::get('image-crop', [ImageController::class, "imageCrop"]);
Route::post('image-crop', [ImageController::class, "imageCropPost"])->name("imageCrop"); */
Route::get('crop-image-upload', [CropImageController::class, "index"]);
Route::post('crop-image-upload ', [CropImageController::class, "uploadCropImage"]);
