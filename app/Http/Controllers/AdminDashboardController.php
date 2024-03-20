<?php

namespace App\Http\Controllers;

use App\Enums\UserType;
use App\Enums\WalletTransactionType;
use App\Enums\WithdrawalStatus;
use App\Helpers\ResponseFormatter;
use App\Http\Requests\AdminRequest;
use App\Models\Deposit;
use App\Models\FundRequest;
use App\Models\User;
use App\Models\WalletTransaction;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    function metrics(AdminRequest $request)
    {
        /*Earnings annual*/
        /*Earnings monthly*/
        /*Pending requests*/
        /*Withdrawal today*/
        /*Total customers*/
        /*Total merchants*/
        /*Total agents*/
        /*Deposits today*/


        return ResponseFormatter::success([
            'annual_earning_amount' => WalletTransaction::whereHas('User', function ($q) {
                $q->where('user_type_id', UserType::AdminCommission);
            })->whereYear('created_at', now()->year)
                ->sum('credit_amount'),
            'monthly_earning_amount' => WalletTransaction::whereHas('User', function ($q) {
                $q->where('user_type_id', UserType::AdminCommission);
            })->whereMonth('created_at', now()->month)
                ->sum('credit_amount'),
            'pending_fund_request_count' => FundRequest::pendingRequests(Auth::user()->id)->count(),
            'pending_kyc_verification_count' => User::filter(['is_pending_verification' => true])->count(),
            'withdrawals_today_amount' => [
                'bank_withdrawal' => Withdrawal::whereDate('created_at', today()->toDateString())
                    ->where(['is_bank_withdrawal' => false, 'status' => WithdrawalStatus::ACCEPTED])
                    ->sum('amount'),
                'agent_withdrawal' => Withdrawal::whereDate('created_at', today()->toDateString())
                    ->where(['is_bank_withdrawal' => true, 'status' => WithdrawalStatus::BANK_WITHDRAWAL_PAID])
                    ->sum('amount'),
            ],
            'deposits_today_amount' => Deposit::filter(['from_date' => today(), 'to_date' => today()])->sum('amount'),
            'users_count' => [
                'customer_count' => User::verifiedUsers()->filter(['user_type_id' => UserType::Customer])->count(),
                'merchant_count' => User::verifiedUsers()->filter(['user_type_id' => UserType::Merchant])->count(),
                'agent_count' => User::filter(['user_type_id' => UserType::Agent])->count(),
            ]
        ], 'Business Metric list');

    }
}
