<?php

namespace App\Http\Controllers;

use App\Classes\Transaction\TransactionFactory;
use App\Enums\UserType;
use App\Enums\WalletTransactionType;
use App\Exports\WalletTransactionExport;
use App\Helpers\ResponseFormatter;
use App\Helpers\Utils;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\PayoutAgentCommissionRequest;
use App\Http\Requests\WalletHistoryRequest;
use App\Models\Agent;
use App\Models\AgentWallet;
use App\Models\CommissionPayout;
use App\Models\FundRequest;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use App\Services\AgentWalletTransactionService;
use App\Services\CommissionPayoutService;
use App\Services\WalletService;
use App\Services\WalletTransactionDataFactories\WalletTransactionDataFactory;
use App\Services\WalletTransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Krlove\EloquentModelGenerator\Model\EloquentModel;
use Mockery\Exception;

class WalletTransactionController extends Controller
{
    function index(WalletHistoryRequest $request)
    {

        if (Auth::user()->is_admin) { /*Admin can check wallet history of all users*/

            if (isset($request->wallet_type)) /*agent wallet request*/
                $walletHistory = (new AgentWalletTransactionService())->get_wallet_transactions($request->all());
            else
                $walletHistory = (new WalletTransactionService())->get_wallet_transactions($request->all());
        } else {
            if ($request->sub_account_user_id)   /*for master accounts to be able to check wallet history of their sub accounts*/ {
                $walletHistory = (new WalletTransactionService())->get_wallet_transactions([
                        'user_id' => $request->sub_account_user_id,
                    ] + $request->validated());
            } else if (in_array(Auth::user()->user_type_id, [UserType::Customer, UserType::Merchant, UserType::Biller, UserType::SubAccount])) { /*Customer/Merchant/Biller refer to walletTransaction*/
                $walletHistory = (new WalletTransactionService())->get_wallet_transactions([
                        'user_id' => Auth::user()->id,
                    ] + $request->validated());
            } else { /*agent wallet request*/ /*Agent refer to AgentWalletTransaction*/
                $walletHistory = (new AgentWalletTransactionService())->get_wallet_transactions([
                        'user_id' => Auth::user()->id,
                    ] + $request->validated());
            }
        }

        if (isset($request->data_for_analysis)) {

            if ($walletHistory->count() == 0)
                return ResponseFormatter::success([], 'Not data found');

            $factory = (new WalletTransactionDataFactory())->getDataFactory($request->data_for_analysis);

            $data = $factory->getData($walletHistory, ['date_period' => $request->date_period, 'from_date' => $request->from_date, 'to_date' => $request->to_date]);

            return ResponseFormatter::success($data, 'Data results');
        }

        $walletHistory = $walletHistory->orderBy('id', 'desc');

        if ($request->download_csv)
            return (new WalletTransactionExport($walletHistory))
                ->download('transaction_history_' . now()->toDateTimeString() . '.csv', \Maatwebsite\Excel\Excel::CSV);

        if ($request->request_origin == 'web')
            return datatables($walletHistory)->toJson();


        return ResponseFormatter::success($walletHistory->paginate($request->per_page), 'Wallet history details');
    }

    function show_balance()
    {

        if (Auth::user()->user_type_id == UserType::Agent)
            $wallet = AgentWallet::whereHas('agent', function ($query) {
                $query->whereHas('user', function ($query) {
                    $query->where('id', Auth::user()->id);
                });
            })->get();
        else
            $wallet = Wallet::whereHas('user', function ($query) {
                $query->where('id', Auth::user()->id);
            })->get();


        return ResponseFormatter::success($wallet, 'Wallet balance');
    }

    function payoutAgentCommission(PayoutAgentCommissionRequest $request, Agent $agent)
    {

        $payout = (new CommissionPayoutService())->payoutCommission([
            'agent_id' => $agent->id,
            'amount' => $request->amount,
            'payout_type' => $request->payout_type
        ]);


        if (!$payout->exists)
            return new Exception('Commission not processed');

        return ResponseFormatter::success($payout, 'Payout processed sucessfully');
    }

    function getPayouts(Request $request)
    {

        $payouts = CommissionPayout::with('agent_user:first_name,last_name,users.id,user_type_id')->filter($request->all());

        if ($request->request_origin == 'web')
            return datatables($payouts)->toJson();


        return ResponseFormatter::success($payouts->paginate($request->per_page), 'Commission payouts');

    }


    function refillAdminBalance(AdminRequest $request)
    {
        $this->validate($request, ['amount' => 'required|numeric']);

        $adminWallet = Wallet::whereHas('user', function ($query) {
            $query->where('user_type_id', UserType::Admin);
        })->first();

        $txnModel = new WalletTransaction;
        $txnModel->amount = $request->amount;

        $transactionDetails = (new TransactionFactory($txnModel))->get_transaction_type(WalletTransactionType::ADMIN_WALLET_REFILL);

        (new WalletService($adminWallet))->credit_wallet($transactionDetails->get_transaction_details());


        return ResponseFormatter::success([], 'Admin wallet refilled succesfully');
    }


    //Display Wallet History
    public function showWalletHistoryPage()
    {
        return view('Reports.admin_wallet_history');
    }

    public function refundWalletTransaction(WalletTransaction $wallettransaction,Request $request)
    {

        if (Utils::check_transaction_pin($request->transaction_pin)) {
            $refundTxns = (new WalletTransactionService())->refund_wallet_txn($wallettransaction);

            return ResponseFormatter::success($refundTxns, 'Refund success');
        }
    }


    function userTransactionStats(Request $request)
    {

        $userId = Auth::user()->id;


        if (Auth::user()->is_admin)  /*Let admin choose a user if requested*/
            $userId = $request->user_id;


        $allUserTxnWithUserId = DB::table('wallet_transactions')
            ->selectRaw('wt.user_id,max(wallet_transactions.id)')
            ->join('wallet_transactions as wt', 'wt.transaction_id', 'wallet_transactions.transaction_id')
            ->whereColumn('wt.user_id', '<>', 'wallet_transactions.user_id')
            ->whereColumn('wt.transaction_type', 'wallet_transactions.transaction_type')
            ->where('wallet_transactions.user_id', $userId)
            ->where('wallet_transactions.debit_amount', '>', 0)
            ->whereIn('wallet_transactions.transaction_type', [WalletTransactionType::WALLET_TRANSFER, WalletTransactionType::BILL_PAYMENT])
            ->groupBy('wt.user_id')
            ->havingRaw('max(wallet_transactions.id)')
            ->orderByRaw('max(wallet_transactions.id) DESC')
            ->limit(5);


        $recentTUsers = User::
        joinSub($allUserTxnWithUserId, 'recent_users', function ($join) {
            $join->on('users.id', '=', 'recent_users.user_id');
        });


        $allUserTxnWithUserId = DB::table('wallet_transactions')
            ->selectRaw('wt.user_id,count(wallet_transactions.id) as no_of_txn')
            ->join('wallet_transactions as wt', 'wt.transaction_id', 'wallet_transactions.transaction_id')
            ->whereColumn('wt.user_id', '<>', 'wallet_transactions.user_id')
            ->whereColumn('wt.transaction_type', 'wallet_transactions.transaction_type')
            ->where('wallet_transactions.user_id', $userId)
            ->where('wallet_transactions.debit_amount', '>', 0)
            ->whereIn('wallet_transactions.transaction_type', [WalletTransactionType::WALLET_TRANSFER, WalletTransactionType::BILL_PAYMENT])
            ->groupBy('wt.user_id')
            ->orderByRaw('no_of_txn DESC')
            ->limit(5);

        $mostTusers = User::
        joinSub($allUserTxnWithUserId, 'most_txn_users', function ($join) {
            $join->on('users.id', '=', 'most_txn_users.user_id');
        });


        return ResponseFormatter::success([
            'recent_users' => $recentTUsers->get(),
            'most_transacted_users' => $mostTusers->get()
        ]);
    }

}
