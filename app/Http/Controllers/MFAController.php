<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Auth;
use App\Models\UserAuthentication;
class MFAController extends Controller
{
    // public function getMobile(){
    //     return view('mfa.getMobile');
    // }

    // public function submitMobile(Request $request){
    //     // dd($request->all());
    //     $sid = "AC88bb91a88b6718d07622c2480021cd01";
    //     $token = "c59568d5f7691fdf86a31ba412e2c039";
    //     $twilio = new Client($sid, $token);
    //     $saveUserDetails = new UserAuthentication();
    //     $saveUserDetails->user_id = Auth::user()->id;

    //     // $verification = $twilio->verify->v2->services("VA01118ef57415c78bd15c43c62025384c")
    //     //                                 ->verifications
    //     //                                 ->create("+918007113149", "sms");
    //     $saveUserDetails->mobile_no = "+918007113149";
    //     $saveUserDetails->status = $verification->status;
    //     $saveUserDetails->save();
    //     return redirect('');   
    // }

    // public function verifyOtp(Request $request){
    //     return view('mfa.verifyOtp');
    // }

    // public function verifyUserOtp(Request $request){
    //     $sid = "AC88bb91a88b6718d07622c2480021cd01";
    //     $token = "c59568d5f7691fdf86a31ba412e2c039";
    //     $twilio = new Client($sid, $token);

    //     $verification_check = $twilio->verify->v2->services("VA01118ef57415c78bd15c43c62025384c")
    //                                             ->verificationChecks
    //                                             ->create([
    //                                                         "to" => "+918007113149",
    //                                                         "code" => "123456"
    //                                                     ]
    //                                             );

    //     print($verification_check->status);
    //     dd("OS");
    //     dd($request->all());
    //     dd("verifyUserOtp");
    // }
}
