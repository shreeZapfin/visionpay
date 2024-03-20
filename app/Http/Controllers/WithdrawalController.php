<?php

namespace App\Http\Controllers;

use App\Enums\WithdrawalStatus;
use App\Exceptions\NotValidForBankWithdrawalException;
use App\Helpers\ResponseFormatter;
use App\Helpers\Utils;
use App\Http\Requests\AcceptWithDrawRequest;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\BankWithdrawalRequest;
use App\Http\Requests\WithdrawRequest;
use App\Models\SystemSetting;
use App\Models\User;
use App\Models\Withdrawal;
use App\Services\WithdrawalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WithdrawalController extends Controller
{


    function index(Request $request)
    {
        $withdrawals = Withdrawal::byUser(Auth::user())
            ->with('agent_user:users.id,first_name,last_name,pacpay_user_id,user_type_id', 'user:id,first_name,last_name,pacpay_user_id,user_type_id', 'user.biller')
            ->filter($request->all());


        if ($request->request_origin == 'web')
            return datatables($withdrawals)->toJson();

        return ResponseFormatter::success($withdrawals->paginate($request->per_page)->append('withdrawal_charge'), 'Withdrawal list');
    }


    function initiateWithdrawal(WithdrawRequest $request)
    {

        /*check txn pin*/
        if (Utils::check_transaction_pin($request->transaction_pin)) {
            $withdrawal = (new WithdrawalService())->intiateWithdrawal($request->validated() +
                ['agent_id' => Auth::user()->agent->id, 'status' => WithdrawalStatus::INITATED, 'wdType' => 'agent_withdrawal_charges', 'is_bank_withdrawal' => false]);

            return ResponseFormatter::success($withdrawal, 'Withdrawal initiated');
        }
    }


    function acceptWithdrawal(AcceptWithDrawRequest $request, Withdrawal $withdrawal)
    {
        if ($withdrawal->status != WithdrawalStatus::INITATED)
            return ResponseFormatter::error([], 'Withdrawal request is already processed', 400, 1028);

        if (Utils::check_transaction_pin($request->transaction_pin)) {
            $withdrawal = (new WithdrawalService())->acceptWithdrawal($withdrawal);
            return ResponseFormatter::success($withdrawal, 'Withdrawal processed succesfully');
        }
    }


    function withdrawToBankRequest(BankWithdrawalRequest $request)
    {
        if (Utils::check_transaction_pin($request->transaction_pin)) {

            $withdrawal = (new WithdrawalService())->createWithdrawToBankRequest($request->validated() + [
                'user_id' => Auth::user()->id,
                'status' => WithdrawalStatus::BANK_WITHDRAWAL_REQUEST,
                'is_bank_withdrawal' => true,
                'wdType' => 'bank_withdrawal_charges'
            ]);
        }

        return ResponseFormatter::success($withdrawal, 'Withdrawal request succesful');
    }

    function processBankRequest(AdminRequest $request, Withdrawal $withdrawal)
    {
        $this->validate($request, [
            'status' => 'required|in:BANK_WITHDRAWAL_PAID,BANK_WITHDRAWAL_FAILED',
            'bank_reference_no' => 'required_if:status,BANK_WITHDRAWAL_PAID',
            'remark' => 'nullable'
        ]);

        if ($withdrawal->status != WithdrawalStatus::BANK_WITHDRAWAL_REQUEST)
            throw new NotValidForBankWithdrawalException();


        (new WithdrawalService())->processBankWithdrawal($withdrawal, $request->all());

        return ResponseFormatter::success($withdrawal->refresh(), 'Withdrawal updated succesfully');
    }

    function adminWithdrawal(User $user, AdminRequest $request)
    {
        $this->validate($request, ['amount' => 'required|numeric', 'transaction_pin' => 'required', 'remark' => 'nullable']);

        if (Utils::check_transaction_pin($request->pin)) {
            $wt = (new WithdrawalService())->adminWithdrawal($user, $request->amount, $request->remark);

            return ResponseFormatter::success($wt, 'Admin withdrawal success');
        }
    }


    public function showWithdrawalListPage()
    {
        return view('Reports.withdrawal_report');
    }

    public function showBillerWithdrawalFundsPage()
    {
        return view('BillPayment.withdrawal_biller_funds');
    }
}
