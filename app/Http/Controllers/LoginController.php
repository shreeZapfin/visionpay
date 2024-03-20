<?php

namespace App\Http\Controllers;

use App\Enums\ApiEventEnum;
use App\Enums\UserType;
use App\Exceptions\AccountBlockedException;
use App\Exceptions\LoginTokenExistsException;
use App\Helpers\ResponseFormatter;
use App\Http\Requests\LoginOtpRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\PasswordChangeRequest;
use App\Models\User;
use App\Services\TwilioOtpService;
use App\Services\UserEventService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;

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
                return redirect($this->redirectToUserTypePage());
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

        if ($request->agent_access) {

            if (!$user->user_permission()->first()->agent_access)
                throw new UnauthorizedException();

            //            if ($user->tokens()->where('abilities', '["agent-access"]')->count() >= 1 AND App::environment() != 'local')  #ToDo Enable when live
            //                throw new LoginTokenExistsException();

        }

        //        if ($user->tokens()->where('abilities','<>','["agent-access"]')->count() >= 1 AND App::environment() != 'local' AND !$request->agent_access)  #ToDo Enable when live
        //            throw new LoginTokenExistsException();

        $userData = [
            'id' => $user->id,
            'token' => ($request->agent_access) ? $user->createToken($request->device_name, ['agent-access'])->plainTextToken
                : $user->createToken($request->device_name)->plainTextToken,
            'is_verified' => $user->is_verified
        ];

        if (!$user->is_registration_completed)
            return ResponseFormatter::success($userData, 'User registration not completed', 1410);

        if (!$user->is_kyc_verified)
            return ResponseFormatter::success($userData, 'User kyc not verified', 1411);

        (new UserEventService($user))->createEvent([
            'remark' => 'User has logged in',
            'event' => ApiEventEnum::INITIATED_LOGIN,
            'action_user_id' => $user->id,
            'data' => ['ip' => $request->getClientIp()],
            'is_system_logged_event' => true
        ]);

        return ResponseFormatter::success($userData);
    }


    function loginWithOtp(LoginOtpRequest $request)
    {


        $user = User::where(function ($query) use ($request) {
            $query->orWhere('username', $request->username)
                ->orWhere('mobile_no', $request->username)
                ->orWhere('email', $request->username);
        })->first();

        if (!$user)
            throw ValidationException::withMessages([
                'username' => ['The provided credentials are incorrect.'],
            ]);


        if ($request->sent_otp_to == 'mobile_no')
            $otpVerified = (new TwilioOtpService())->verifyOtp($request->otp, $user->mobile_no);
        else
            $otpVerified = (new TwilioOtpService())->verifyOtpEmail($request->otp, $user->email);


        if (!$otpVerified)
            return ResponseFormatter::error([], 'Invalid otp', 400, 1409);


        if ($user->account_blocked)
            throw new AccountBlockedException();

        $user->tokens()->delete();

        $userData = [
            'id' => $user->id,
            'token' => $user->createToken($request->device_name)->plainTextToken,
            'is_verified' => $user->is_verified
        ];

        if (!$user->is_registration_completed)
            return ResponseFormatter::success($userData, 'User registration not completed', 1410);

        if (!$user->is_kyc_verified)
            return ResponseFormatter::success($userData, 'User kyc not verified', 1411);

        (new UserEventService($user))->createEvent([
            'remark' => 'User has logged in',
            'event' => ApiEventEnum::INITIATED_LOGIN,
            'action_user_id' => $user->id,
            'data' => ['ip' => $request->getClientIp()],
            'is_system_logged_event' => true
        ]);


        return ResponseFormatter::success($userData);
    }


    function logout(Request $request)
    {
        (new UserEventService(Auth::user()))->createEvent([
            'remark' => 'User has logged out',
            'event' => ApiEventEnum::INITIATED_LOGOUT,
            'action_user_id' => Auth::user()->id,
            'data' => ['ip' => $request->getClientIp()],
            'is_system_logged_event' => true
        ]);


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
            'password' => [
                'required',
                'string',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
                'confirmed'
            ]
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

        if (isset($request->mobile_no)) {
            $isValidOtp = (new TwilioOtpService())->verifyOtp($request->otp, $request->mobile_no);
            $user = User::where('mobile_no', $request->mobile_no)->first();
        } else {
            $isValidOtp = (new TwilioOtpService())->verifyOtpEmail($request->otp, $request->email_id);
            $user = User::where('email', $request->email_id)->first();
        }

        if ($isValidOtp) {

            $user->update(['password' => bcrypt($request->password)]);
            $user->tokens()->delete();
            return ResponseFormatter::success([], 'Password changed success! Please login with new password');
        } else
            return ResponseFormatter::error([], 'Invalid otp', 400, 1409);
    }

    function redirectToUserTypePage()
    {
        switch (Auth::user()->user_type_id) {
            case UserType::Admin:
                $this->redirectTo = 'index';
                return $this->redirectTo;
                break;
            case UserType::Staff:
                $this->redirectTo = 'index';
                return $this->redirectTo;
                break;
            case UserType::Biller:
                $this->redirectTo = 'biller/index';
                return $this->redirectTo;
                break;
            case UserType::Customer:
                $this->redirectTo = 'user/index';
                return $this->redirectTo;
                break;
            default:
                $this->redirectTo = '/login';
                return $this->redirectTo;
        }
    }
}
