<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Helpers\Utils;
use App\Http\Requests\StoreDepositRequest;
use App\Models\Deposit;
use App\Services\DepositService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepositController extends Controller
{
    function index(Request $request)
    {

        $deposit = Deposit::byUser(Auth::user())->with('agent_user:users.id,first_name,last_name,pacpay_user_id,user_type_id', 'user:id,first_name,last_name,pacpay_user_id,user_type_id')->filter($request->all());


        if ($request->request_origin == 'web')
            return datatables($deposit)->toJson();

        return ResponseFormatter::success($deposit->paginate($request->per_page), 'Deposit details');
    }


    function store(StoreDepositRequest $request)
    {
        if (Utils::check_transaction_pin($request->transaction_pin)) {
            $deposit = (new DepositService())->processDeposit($request->validated() + ['agent_id' => Auth::user()->agent->id]);
        }

        return ResponseFormatter::success($deposit->only('deposit_id'), 'Deposit succesfully processed');
    }

    public function showDepositReportPage()
    {
        return view('Reports.deposit_report');
    }
}
