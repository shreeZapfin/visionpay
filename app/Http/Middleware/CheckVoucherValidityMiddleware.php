<?php

namespace App\Http\Middleware;

use App\Enums\VoucherModels;
use App\Services\ReedeemVoucherService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckVoucherValidityMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if ($request->has('voucher_code') and isset($request->voucher_code)) {
            $voucherFor = $this->getVoucherFor();
            $request->request->add(['voucher_for' => $voucherFor]);  /*IMP : This array is further checked upon in ReedeemVoucherService class*/
            if ((new ReedeemVoucherService())->checkValidVoucher($request->voucher_code, $voucherFor['voucher_redeemed_by_user_id']))
                return $next($request);
        }

        return $next($request);
//        Log::exception('Unexpected result from ReedeemVoucherService->checkValidVoucher Request : ' . json_encode($request->all()));
//        throw new \Exception('Something went wrong', 500);
    }


    function getVoucherFor()
    {
        /*Note : Keep adding routes here when middle ware CheckVoucherValidityMiddleware is used for more routes*/
        $voucherFor = null;
        switch (request()->route()->uri()) {
            case 'api/send-funds' :
                $voucherFor = VoucherModels::FUND_REQUEST;
                $receipeintUserId = request()->send_to;
                $voucherRedeedemedByUserId = Auth::user()->id;
                break;
            case 'api/user/deposit':
                $voucherFor = VoucherModels::DEPOSIT;
                $receipeintUserId = Auth::user()->agent->id;
                $voucherRedeedemedByUserId = request()->user_id; /*Agent is depositing funds for a particular user hence voucher redemption on behalf of user*/
                break;

            case 'api/bill-payment/{biller}/pay':
                $voucherFor = VoucherModels::BILL_PAYMENT;
                $receipeintUserId = request()->route()->biller->id;
                $voucherRedeedemedByUserId = Auth::user()->id;
                break;

            default:
                throw new \Exception('Invalid voucher for found Request : ' . request()->route()->uri());

        }
        $voucherFor['recepient_user_id'] = $receipeintUserId;
        $voucherFor['voucher_redeemed_by_user_id'] = $voucherRedeedemedByUserId;
        return $voucherFor; /*IMP : This array is further checked upon in ReedeemVoucherService class*/

    }
}
