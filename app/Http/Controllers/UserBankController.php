<?php

namespace App\Http\Controllers;

use App\Exceptions\UserBankAlreadyExistsException;
use App\Helpers\ResponseFormatter;
use App\Helpers\Utils;
use App\Http\Requests\AdminRequest;
use App\Models\AdminBankDetail;
use App\Models\Bank;
use App\Models\User;
use App\Models\UserBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserBankController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(UserBank::class, 'user_bank');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $bank = UserBank::with('bank')->where('user_id', Auth::user()->id)->get();

        return ResponseFormatter::success($bank, 'Bank details');
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
        $this->validate($request, [
            'bank_id' => 'required|exists:banks,id',
            'bank_account_no' => 'required|numeric',
            'bank_account_name' => 'required',
            'transaction_pin' => 'required'
        ]);
        if (Utils::check_transaction_pin($request->transaction_pin)) {
            $bank = Auth::user()->user_bank()->create($request->all());
        }
        return ResponseFormatter::success($bank, 'Bank created succesfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserBank $userBank
     * @return \Illuminate\Http\Response
     */
    public function show(UserBank $userBank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserBank $userBank
     * @return \Illuminate\Http\Response
     */
    public function edit(UserBank $userBank)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\UserBank $user_bank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserBank $user_bank)
    {
        $this->validate($request, [
            'bank_account_name' => 'nullable',
            'bank_account_no' => 'nullable|numeric',
            'transaction_pin' => 'required'
        ]);


        if (Utils::check_transaction_pin($request->transaction_pin)) {
            $user_bank->bank_account_name = $request->bank_account_name ? $request->bank_account_name : $user_bank->bank_account_name;
            $user_bank->bank_account_no = $request->bank_account_no ? $request->bank_account_no : $user_bank->bank_account_no;

            $user_bank->save();
        }
        return ResponseFormatter::success($user_bank, 'Bank updated succesfully');
    }

    function index_banks()
    {
        $banks = Bank::all();

        return ResponseFormatter::success($banks, 'Bank list');
    }

    function store_bank(AdminRequest $request)
    {
        $this->validate($request, [
            'bsb' => 'required',
            'swift' => 'required',
            'bank_name' => 'required'
        ]);

        $bank = Bank::create($request->all());

        return ResponseFormatter::success($bank, 'Bank created success');
    }

    public function showSystemBankPage()
    {
        return view('BankWithdrawal.system_banks');
    }
}
