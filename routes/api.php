<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|

Middlewares
auth:sanctum : Default user authentication

throttle:send-otp
throttle:verify-otp
    Both above middlewares provide rate-limiting to otp

'can:view,user', 'can:viewAny,App\Models\User', 'can:update,user'
    Used for UserPolicies authorization

voucher.validity : Used for routes where user wishes to add a voucher for discount this middleware checks the validity of voucher
        ***Note : Whenever you add this middleware to a route add the request()->route()->uri() to ReedeemVoucherService->getVoucherFor() function

*/


Route::post('user/login', [\App\Http\Controllers\LoginController::class, 'login']);
Route::post('user/login-with-otp', [\App\Http\Controllers\LoginController::class, 'loginWithOtp']);

Route::post('user/forgot-password', [\App\Http\Controllers\LoginController::class, 'forgotPassword']);


Route::post('user', [\App\Http\Controllers\UserController::class, 'store'])->middleware('throttle:create-user');

Route::apiResource('country', \App\Http\Controllers\CountryController::class);

Route::apiResource('city', \App\Http\Controllers\CityController::class);


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('user/business-types', [\App\Http\Controllers\UserController::class, 'businessTypes']);
Route::get('user/merchant-types', [\App\Http\Controllers\UserController::class, 'merchantTypes']);
Route::resource('/source-of-income', \App\Http\Controllers\SourceOfIncomeController::class);

Route::get('user/prevalidate', [\App\Http\Controllers\UserController::class, 'prevalidate']);

Route::post('otp/send', [\App\Http\Controllers\OtpController::class, 'sendOtp'])->middleware('throttle:send-otp');
Route::post('otp/verify', [\App\Http\Controllers\OtpController::class, 'verifyOtp'])->middleware('throttle:verify-otp');


Route::middleware('auth:sanctum')->group(function () {
    Route::post('user/change-password', [\App\Http\Controllers\LoginController::class, 'changeLoginPassword']);
    Route::post('user/change-transaction-pin', [\App\Http\Controllers\UserController::class, 'changeTxnPin']);

    Route::post('user/change-user-identifier',[\App\Http\Controllers\UserController::class, 'changeUserIdentifier']);

    Route::patch('user/fcm-token', [\App\Http\Controllers\FcmTokenController::class, 'update']);
    Route::delete('user/fcm-token/{fcm_token}', [\App\Http\Controllers\FcmTokenController::class, 'delete']);

    Route::post('user/logout', [\App\Http\Controllers\LoginController::class, 'logout']);
    Route::get('user', [\App\Http\Controllers\UserController::class, 'index']);
    Route::get('user/search', [\App\Http\Controllers\UserController::class, 'search']);
    Route::get('user/deposit', [\App\Http\Controllers\DepositController::class, 'index']);
    Route::post('user/deposit', [\App\Http\Controllers\DepositController::class, 'store'])->middleware(['voucher.validity']);

    Route::get('user/withdrawal', [\App\Http\Controllers\WithdrawalController::class, 'index']);
    Route::patch('user/withdrawal/bank-request/{withdrawal}', [\App\Http\Controllers\WithdrawalController::class, 'processBankRequest'])->middleware('log_api_event');
    Route::post('user/withdrawal/bank-request', [\App\Http\Controllers\WithdrawalController::class, 'withdrawToBankRequest']);
    Route::post('user/withdrawal/intiate', [\App\Http\Controllers\WithdrawalController::class, 'initiateWithdrawal']);
    Route::post('user/withdrawal/{withdrawal}/accept', [\App\Http\Controllers\WithdrawalController::class, 'acceptWithdrawal']);
    Route::post('user/withdrawal/{user}/admin-withdrawal', [\App\Http\Controllers\WithdrawalController::class, 'adminWithdrawal']);

    Route::get('user/qr', [\App\Http\Controllers\UserController::class, 'viewQr']);
    Route::get('user/qr/download/{user}', [\App\Http\Controllers\UserController::class, 'downloadQr']);


    Route::get('user-event', [\App\Http\Controllers\UserEventController::class, 'index']);
    Route::post('user-event/{user}', [\App\Http\Controllers\UserEventController::class, 'updateEvent']);

    Route::post('user/staff', [\App\Http\Controllers\UserController::class, 'storeStaff']);

    Route::middleware(['can:view,user', 'can:viewAny,App\Models\User', 'can:update,user','log_api_event'])->group(function () {
        Route::post('user/kyc-document/{user}', [\App\Http\Controllers\KycController::class, 'uploadKycDocument']);
        Route::post('user/selfie-image/{user}', [\App\Http\Controllers\KycController::class, 'uploadSelfieImage']);
        Route::post('user/profile-pic/{user}', [\App\Http\Controllers\KycController::class, 'uploadProfilePicImage']);
        Route::post('user/business/company-tin-image/{user}', [\App\Http\Controllers\KycController::class, 'uploadCompanyTinImage']);
        Route::post('user/business/company-reg-image/{user}', [\App\Http\Controllers\KycController::class, 'uploadCompanyRegistrationImage']);
        Route::resource('user', \App\Http\Controllers\UserController::class)->except('store', 'businessTypes', 'merchantTypes', 'index');
    });
    Route::post('sub-account/wallet/{user}/collect', [\App\Http\Controllers\SubAccountController::class,'collectFunds']);
    Route::apiResource('sub-account', \App\Http\Controllers\SubAccountController::class);
    Route::apiResource('admin-bank-details', \App\Http\Controllers\AdminBankController::class);
    Route::get('banks', [\App\Http\Controllers\UserBankController::class, 'index_banks']);
    Route::post('banks', [\App\Http\Controllers\UserBankController::class, 'store_bank']);
    Route::patch('banks', [\App\Http\Controllers\UserBankController::class, 'update_bank']);
    Route::apiResource('user-bank', \App\Http\Controllers\UserBankController::class);
    Route::apiResource('transfer-limit-schemes', \App\Http\Controllers\TransferLimitSchemeController::class);

    Route::get('fund-request', [\App\Http\Controllers\FundRequestController::class, 'index']);
    Route::post('fund-request/create', [\App\Http\Controllers\FundRequestController::class, 'create'])->middleware('log_api_event');
    Route::patch('fund-request/{fundrequest}/accept', [\App\Http\Controllers\FundRequestController::class, 'accept'])->middleware('log_api_event');
    Route::patch('fund-request/{fundrequest}/reject', [\App\Http\Controllers\FundRequestController::class, 'reject'])->middleware('log_api_event');




    Route::post('send-funds', [\App\Http\Controllers\FundRequestController::class, 'sendFundsDirectly'])->middleware(['log_api_event','voucher.validity']);

    Route::get('wallet-history', [\App\Http\Controllers\WalletTransactionController::class, 'index']);
    Route::get('wallet-balance', [\App\Http\Controllers\WalletTransactionController::class, 'show_balance']);
    Route::get('wallet/user-stats', [\App\Http\Controllers\WalletTransactionController::class, 'userTransactionStats']);

    Route::post('wallet-transaction/{wallettransaction:transaction_id}/refund', [\App\Http\Controllers\WalletTransactionController::class, 'refundWalletTransaction']);

    //Admin apis
    Route::get('admin/business-metrics', [\App\Http\Controllers\AdminDashboardController::class, 'metrics']);
    Route::post('admin/wallet/refill', [\App\Http\Controllers\WalletTransactionController::class, 'refillAdminBalance']);
    Route::post('agent/{agent}/payout', [\App\Http\Controllers\WalletTransactionController::class, 'payoutAgentCommission']);

    Route::get('agent/commission-payout', [\App\Http\Controllers\WalletTransactionController::class, 'getPayouts']);
    Route::apiResource('admin/complaint-type', \App\Http\Controllers\ComplaintTypeController::class);

    Route::patch('admin/user/{user}/account-block', [\App\Http\Controllers\UserController::class, 'accountBlockStatus'])->middleware('log_api_event');
    Route::patch('admin/user/{user}/wallet-balance-block', [\App\Http\Controllers\UserController::class, 'blockWalletBalance'])->middleware('log_api_event');


    Route::resource('/faqs/categories', \App\Http\Controllers\Admin\FAQ\CategoriesController::class);
    Route::get('faqs/order', 'OrderController@index');
    Route::post('faqs/order', 'OrderController@updateOrder');
    Route::resource('/faqs', \App\Http\Controllers\Admin\FAQ\FAQsController::class);


    Route::group(['prefix' => 'faq', 'namespace' => 'FAQ\Controllers\Website'], function () {
        Route::get('', [\App\Http\Controllers\Website\FAQController::class, 'index']);
        Route::post('/question/{faq}/{type?}', 'FAQController@incrementClick');
    });
    Route::post('/advertisement/{advertisement}', [\App\Http\Controllers\AdvertisementController::class, 'update']);
    Route::patch('/advertisement/{advertisement}/status', [\App\Http\Controllers\AdvertisementController::class, 'updateStatus']);
    Route::patch('/advertisement/order', [\App\Http\Controllers\AdvertisementController::class, 'changeOrder']);
    Route::resource('/advertisement', \App\Http\Controllers\AdvertisementController::class)->except('update');

    Route::post('/alert', [\App\Http\Controllers\AlertsController::class, 'sendAlert'])->middleware('log_api_event');


    Route::get('/notification', [\App\Http\Controllers\AlertsController::class, 'indexNotificationLog']);
    Route::get('/biller-category', [\App\Http\Controllers\BillerController::class, 'getCategory']);
    Route::post('/biller-category', [\App\Http\Controllers\BillerController::class, 'storeCategory']);
    Route::apiResource('/biller', \App\Http\Controllers\BillerController::class)->only('index', 'show', 'update');

    Route::get('/bill-payment', [\App\Http\Controllers\BillPaymentsController::class, 'index']);
    Route::post('/bill-payment/{biller}/pay', [\App\Http\Controllers\BillPaymentsController::class, 'payBill'])->middleware(['log_api_event','voucher.validity']);


    Route::get('/promotion/reedemed-vouchers', [\App\Http\Controllers\PromotionController::class, 'index_reedemeed_vouchers']);
    Route::get('/promotion/reedemable-vouchers', [\App\Http\Controllers\PromotionController::class, 'index_reedemable_vouchers']);


    Route::apiResource('/promotion', \App\Http\Controllers\PromotionController::class)->only('index', 'store', 'update','show');

    Route::get('/system-settings', [\App\Http\Controllers\SystemSettingController::class, 'index']);
    Route::patch('/system-settings', [\App\Http\Controllers\SystemSettingController::class, 'update']);
    Route::patch('complaint/{complaint}/resolve', [\App\Http\Controllers\ComplaintController::class, 'resolveComplaint']);
    Route::patch('complaint/{complaint}/message', [\App\Http\Controllers\ComplaintController::class, 'updateComplaintMessage']);
    Route::get('complaint/{complaint}/message', [\App\Http\Controllers\ComplaintController::class, 'getComplaintMessages']);
    Route::apiResource('complaint', \App\Http\Controllers\ComplaintController::class)->middleware('log_api_event');
    Route::patch('payment-charge-package/{package}/set-default', [\App\Http\Controllers\PaymentChargePackageController::class, 'setAsDefault']);
    Route::apiResource('payment-charge-package', \App\Http\Controllers\PaymentChargePackageController::class);


    Route::get('app-grid',[\App\Http\Controllers\AppGridController::class,'getGrid']);
    Route::patch('app-grid',[\App\Http\Controllers\AppGridController::class,'updateGrid']);
    Route::post('image/upload',[\App\Http\Controllers\CropImageController::class,'uploadCropImage']);

    Route::patch('user/permission/{user}',[\App\Http\Controllers\UserPermissionController::class,'updatePermission'])->middleware('log_api_event');



});
