<?php

namespace App\Http\Controllers;

use App\Classes\Transaction\TransactionFactory;
use App\Enums\WalletTransactionType;
use App\Exceptions\InsufficientWalletBalanceException;
use App\Helpers\ResponseFormatter;
use App\Helpers\Utils;
use App\Http\Requests\BillPaymentRequest;
use App\Models\Biller;
use App\Models\BillPayment;
use App\Services\WalletService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BillPaymentsController extends Controller
{


    function index(Request $request)
    {
        $bp = BillPayment::byUser(Auth::user())
            ->with('biller:biller_name,id','user')
            ->filter($request->all());

        if ($request->request_origin == 'web')
            return datatables($bp)->toJson();

        return ResponseFormatter::success($bp->paginate($request->per_page), 'Bill payments list');
    }


    function payBill(BillPaymentRequest $request, Biller $biller)
    {

        /*create bill payment with amount and biller fields*/
        /*debit user wallet*/
        /*credit biller wallet*/

        if (Utils::check_transaction_pin($request->transaction_pin))
            DB::transaction(function () use ($request, $biller, &$billPayment) {

                $keyAllFields = collect($request->validated()['biller_fields']['fields'])->keyBy(function ($field, $key) {

                    if ($key == 0)
                        return 'primary_field';

                    return $field['name'];
                })->all();


                $billPayment = BillPayment::create([
                    'biller_fields' => $keyAllFields,
                    'user_id' => Auth::user()->id,
                    'biller_id' => $biller->id,
                    'bill_payment_id' => 'BP' . Utils::transaction_id_generator()
                ]);

                $userWallet = Auth::user()->wallet;
                $billerWallet = $billPayment->biller->user->wallet;

                if (!(new WalletService($userWallet))->is_wallet_balance_sufficient($keyAllFields['amount']['value']))
                    throw new InsufficientWalletBalanceException();


                $transactionDetails = (new TransactionFactory($billPayment))->get_transaction_type(WalletTransactionType::BILL_PAYMENT);

                (new WalletService($userWallet))->debit_wallet($transactionDetails->get_transaction_details());
                (new WalletService($billerWallet))->credit_wallet($transactionDetails->get_transaction_details());
            });


        return ResponseFormatter::success($billPayment, 'Bill payment processed succesfully');
    }

    public function showBillerReportPage()
    {
        return view('BillPayment.bill_payment_report');
    }
}
