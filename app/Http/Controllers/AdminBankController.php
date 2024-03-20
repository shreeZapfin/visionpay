<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\AdminBankDetail;
use Illuminate\Http\Request;
use Twilio\Rest\Client;

class AdminBankController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(AdminBankDetail::class, 'admin_bank_detail');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ResponseFormatter::success(AdminBankDetail::all(), 'Admin bank details');
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
            'bank_name' => 'required',
            'account_no' => 'required|numeric|unique:admin_bank_details,account_no',
            'swift' => 'required',
            'bsb' => 'required',
        ]);

        $bank = AdminBankDetail::create($request->all());

        return ResponseFormatter::success($bank, 'Bank created succesfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdminBankDetail $adminBankDetail
     * @return \Illuminate\Http\Response
     */
    public function show(AdminBankDetail $adminBankDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdminBankDetail $adminBankDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(AdminBankDetail $adminBankDetail)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\AdminBankDetail $admin_bank_detail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdminBankDetail $admin_bank_detail)
    {
        $this->validate($request, [
            'bank_name' => 'nullable',
            'account_no' => 'nullable|numeric|unique:admin_bank_details,account_no',
            'swift' => 'nullable',
            'bsb' => 'nullable',
        ]);


        $admin_bank_detail->bank_name = $request->bank_name ? $request->bank_name : $admin_bank_detail->bank_name;
        $admin_bank_detail->account_no = $request->account_no ? $request->account_no : $admin_bank_detail->account_no;
        $admin_bank_detail->swift = $request->swift ? $request->swift : $admin_bank_detail->swift;
        $admin_bank_detail->bsb = $request->bsb ? $request->bsb : $admin_bank_detail->bsb;

        $admin_bank_detail->save();
        return ResponseFormatter::success($admin_bank_detail, 'Bank updated succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdminBankDetail $adminBankDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdminBankDetail $adminBankDetail)
    {
        $adminBankDetail->delete();
        return ResponseFormatter::success([], 'Bank deleted succesfully');
    }


    //Display Bank
    public function showAdminBankPage()
    {
        return view('AdminBank.admin_bank_list');
    }

    //Edit Bank

    public function editBank(AdminBankDetail $adminBankDetail)
    {
        return view('AdminBank.update_bank_detail')->with('editBankDetails', $adminBankDetail);
    }

    public function testAPi(){
        $sid = 'AC88bb91a88b6718d07622c2480021cd01';
        $token = 'c59568d5f7691fdf86a31ba412e2c039';
        $twilio = new Client($sid, $token);
        // VA01118ef57415c78bd15c43c62025384c by vinay
        //VA54d6b92148f7f8cd5c8cc37707b9f2ef by app
        // $service = $twilio->verify->v2->services
        //                             ->create("My First Verify Service");
        // $verification = $twilio->verify->v2->services("VA54d6b92148f7f8cd5c8cc37707b9f2ef")
        //                            ->verifications
        //                            ->create("+918007113149", "sms");

    
        $verification_check = $twilio->verify->v2->services("VA54d6b92148f7f8cd5c8cc37707b9f2ef")
        ->verificationChecks
        ->create([
                     "to" => "+918007113149",
                     "code" => "072132"
                 ]
        );
                     

        echo'<pre>';
        print($verification_check->status);    
        dd("OK");    
    }
}
