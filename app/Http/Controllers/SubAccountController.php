<?php

namespace App\Http\Controllers;

use App\Exceptions\SubAccountLimitExceededException;
use App\Helpers\ResponseFormatter;
use App\Helpers\Utils;
use App\Http\Requests\SubAccountCollectRequest;
use App\Models\User;
use App\Services\FundRequestService;
use App\Services\SubAccountService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;

class SubAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $sa = (new SubAccountService(Auth::user()))
            ->viewMySubAccounts($request->all());

        return ResponseFormatter::success($sa->paginate($request->per_page), 'My sub accounts list');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Auth::user()->is_admin)
            if (!Auth::user()->has_sub_accounts)
                throw new UnauthorizedException();

        $this->validate($request, [
            'username' => 'required|unique:users,username',
            'password' => [
                'required',
                'string',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
                'confirmed'
            ],
            'master_account_user_id' => Auth::user()->is_admin ? 'required' : ''
        ]);

        if (Auth::user()->is_admin) {
            if (User::where('master_account_user_id', $request->master_account_user_id)->count() >= 5)
                throw new SubAccountLimitExceededException();
            $user = User::find($request->master_account_user_id);
        } else {
            $user = Auth::user();
        }

        $sa = (new SubAccountService($user))
            ->createSubAccount($request->only('username', 'password'));

        return ResponseFormatter::success($sa, 'Sub account created sucessfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubAccount $subAccount
     * @return \Illuminate\Http\Response
     */
    public function show(SubAccount $subAccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubAccount $subAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(SubAccount $subAccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\SubAccount $subAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubAccount $subAccount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubAccount $subAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubAccount $subAccount)
    {
        //
    }

    public function collectFunds(SubAccountCollectRequest $request, User $user)
    {
        if (Utils::check_transaction_pin($request->transaction_pin)) {
            $res = (new SubAccountService(Auth::user()))->collectFundsFromSub($user);
        }

        return ResponseFormatter::success($res->only('fund_request_id', 'id'), 'Collection request successful');

    }

}
