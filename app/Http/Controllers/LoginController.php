<?php

namespace App\Http\Controllers;

use App\Enums\UserType;
use App\Exceptions\AccountBlockedException;
use App\Helpers\ResponseFormatter;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\PasswordChangeRequest;
use App\Models\User;
use App\Services\TwilioOtpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Twilio\Rest\Client;
use App\Models\UserAuthentication;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    protected $redirectTo;

    function show()
    {

        return view('auth/login22');
    }


    function login(LoginRequest $request)
    {

        if ($request->device_name == 'web') {
            if (Auth::attempt(['email' => $request->username, 'password' => $request->password])) {
                return $this->getMobile($request);

                // return redirect($this->redirectToUserTypePage());
            }
        }

        $user = User::where(function ($query) use ($request) {
            $query->orWhere('username', $request->username)
                ->orWhere('mobile_no', $request->username)
                ->orWhere('email', $request->username);
        })->first();


        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'username' => ['The provided credentials are incorrect.'],
            ]);
        }

        if ($user->account_blocked)
            throw new AccountBlockedException();

        $userData = [
            'id' => $user->id,
            'token' => $user->createToken($request->device_name)->plainTextToken,
            'is_verified' => $user->is_verified
        ];

        if (!$user->is_registration_completed)
            return ResponseFormatter::success($userData, 'User registration not completed', 1410);

        if (!$user->is_kyc_verified)
            return ResponseFormatter::success($userData, 'User kyc not verified', 1411);


        return ResponseFormatter::success($userData);
    }

    function logout()
    {
        Auth::user()->currentAccessToken()->delete();

        return ResponseFormatter::success([], 'Logged out device success');
    }


    function logoutWeb()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/login');
    }


    function changeLoginPassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $oldPass = $request->old_password;

        if (Hash::check($oldPass, Auth::user()->password)) {
            Auth::user()->tokens()->delete();
            User::find(Auth::user()->id)->update(['password' => bcrypt($request->password)]);
            return ResponseFormatter::success([], 'Password changed success! Please login with new password');
        } else
            return ResponseFormatter::error([], 'Old password is incorrect', 400, 1409);
    }


    function forgotPassword(PasswordChangeRequest $request)
    {
        $isValidOtp = (new TwilioOtpService())->verifyOtp($request->otp, $request->mobile_no);

        if ($isValidOtp) {
            $user = User::where('mobile_no', $request->mobile_no)->first();
            $user->update(['password' => bcrypt($request->password)]);
            $user->tokens()->delete();
            return ResponseFormatter::success([], 'Password changed success! Please login with new password');
        } else
            return ResponseFormatter::error([], 'Invalid otp', 400, 1409);
    }

    // function redirectToUserTypePage()
    // {
    //     switch (Auth::user()->user_type_id) {
    //         case UserType::Admin:
    //             $this->redirectTo = 'index';
    //             return $this->redirectTo;
    //             break;
    //         case UserType::Biller:
    //             $this->redirectTo = 'biller/index';
    //             return $this->redirectTo;
    //             break;
    //         case UserType::Customer:
    //             $this->redirectTo = 'user/index';
    //             return $this->redirectTo;
    //             break;
    //         default:
    //             $this->redirectTo = '/login';
    //             return $this->redirectTo;
    //     }
    // }

    public function getMobile($request){
        
        $username = $request['username'];
        $device_name = $request['device_name'];
        $password = $request['password'];

        $user = User::where(function ($query) use ($request) {
            $query->orWhere('username', $request->username)
                ->orWhere('mobile_no', $request->username)
                ->orWhere('email', $request->username);
        })->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'username' => ['The provided credentials are incorrect.'],
            ]);
        }
        return view('mfa.getMobile')->with(['user'=>$user,'username'=>$username,'device_name'=>$device_name,'username'=>$username,'password'=>$password]);
    }

    public function submitMobile(Request $request){
        $mobile_number = $request['countrycode'];
        $user_details = $request['user_details'];
        $device_name = $request['device_name'];
        $username = $request['username'];
        $password = $request['password'];
        $sid = "AC88bb91a88b6718d07622c2480021cd01";
        $token = "c59568d5f7691fdf86a31ba412e2c039";
        $twilio = new Client($sid, $token);
        $saveUserDetails = new UserAuthentication();

        $verification = $twilio->verify->v2->services("VAad23f90584218150afc65fdbe3e095dc")
                                        ->verifications
                                        ->create("$mobile_number", "sms");
        $saveUserDetails->mobile_no = $mobile_number;
        $saveUserDetails->status =  $verification->status;
        $saveUserDetails->save();
        return view('mfa.verifyOtp')->with(['saveUserDetails'=>$saveUserDetails,'user_details'=>$user_details,'username'=>$username,'password'=>$password,'device_name'=>$device_name]);
    }

    public function verifyOtp(Request $request){
        return view('mfa.verifyOtp');
    }

    public function verifyUserOtp(Request $request){
        $mobile = $request['mobile'];
        $otp = $request['verify_otp'];
        $username = $request['username'];
        $password = $request['password'];
        $device_name = $request['device_name'];
        $user = json_decode($request['user_details']);
        $sid = "AC88bb91a88b6718d07622c2480021cd01";
        $token = "c59568d5f7691fdf86a31ba412e2c039";
        $twilio = new Client($sid, $token);

        $verification_check = $twilio->verify->v2->services("VAad23f90584218150afc65fdbe3e095dc")
                                                ->verificationChecks
                                                ->create([
                                                            "to" => "$mobile",
                                                            "code" => "$otp"
                                                        ]
                                                );
            dd($verification_check->status);
        // $verification_check = 'approved';
        if($verification_check->status == 'approved'){

            switch (Auth::user()->user_type_id) {
                case UserType::Admin:
                    $this->redirectTo = 'index';
                    return ResponseFormatter::success($this->redirectTo);
                    break;
                case UserType::Biller:
                    $this->redirectTo = 'biller/index';
                    // return $this->redirectTo;
                    return ResponseFormatter::success($this->redirectTo);
                    break;
                case UserType::Customer:
                    $this->redirectTo = 'user/index';
                    // return $this->redirectTo;
                    return ResponseFormatter::success($this->redirectTo);
                    break;
                default:
                    $this->redirectTo = '/login';
                    return ResponseFormatter::success($this->redirectTo);
                    // return $this->redirectTo;
            }
        }else{
            return ResponseFormatter::success($user,'Please enter correct OTP', 400);
            }                                        
    }
}
