<?php

namespace App\Http\Controllers;

use App\Enums\UserType;
use App\Exports\UsersExport;
use App\Helpers\ResponseFormatter;
use App\Helpers\Utils;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\DownloadQrRequest;
use App\Http\Requests\PasswordChangeRequest;
use App\Http\Requests\SearchUserRequest;
use App\Http\Requests\UserRegistrationRequest;
use App\Models\BusinessType;
use App\Models\MerchantCategory;
use App\Models\User;
use App\Services\TwilioOtpService;
use App\Services\UserService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return ResponseFormatter::success($user->load('business', 'wallet', 'paymentChargePackage', 'biller'), 'User details');
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

    public function getUser($Id)
    {
        $userDetails = User::where('id',$Id)->first();
       return $userDetails;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRegistrationRequest $request)
    {
        $user = (new UserService())->addUser($request->validated());
        $token = $user->createToken($request->device_name)->plainTextToken;
        return ResponseFormatter::success($user->only('mobile_no', 'id', 'pacpay_user_id') + ['token' => $token], 'User created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user->load(
            'city.country',
            'wallet',
            'business.businessType',
            'business.merchantCategory',
            'paymentChargePackage',
            'userEvents',
            'biller'
        );
        return ResponseFormatter::success($user);
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user->load('transferLimitScheme');
        $user->load('business');
        /*  $user->load('country');
        $user->load('city'); */
        return view('user_detail')->with('userDetails', $user);
    }

   

    public function editBillers(User $user)
    {

        return view('BillPayment.biller_detail')->with('billerDetails', $user);
    }

    public function editUnverifiedUser(User $user)
    {
        return view('UserDetailsAlert')->with('userDetails', $user);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRegistrationRequest $request, User $user)
    {

        $user = (new UserService())->updateUser($user, $request->validated());

        return ResponseFormatter::success($user->only('mobile_no', 'id', 'pacpay_user_id'), 'User updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Show the specified resource page.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    //Display Users
    public function showCustomerPage()
    {
        return view('users.user');
    }

    public function showAgentPage()
    {
        return view('agents.agents');
    }

    public function showBillerPage()
    {
        return view('BillPayment.editBiller');
    }

    public function showMerchantPage()
    {
        return view('merchants.merchant');
    }

    //Verified User
    public function showVerifiedUserPage()
    {
        return view('users.verified_user');
    }

    public function showVerifiedMerchantPage()
    {
        return view('merchants.verified_merchant');
    }

    public function showVerifiedAgentPage()
    {
        return view('agents.verified_agents');
    }

    public function showVerifiedBillerPage()
    {
        return view('Biller.verified_biller');
    }


    //Unverified User
    public function showUnVerifiedUserPage()
    {
        return view('users.unverified_user');
    }

    public function showUnVerifiedMerchantPage()
    {
        return view('merchants.unverified_merchant');
    }

    public function showUnVerifiedAgentPage()
    {
        return view('agents.unverified_agent');
    }

    public function showUnVerifiedBillerPage()
    {
        return view('Biller.unverified_biller');
    }

    //Incomplete Register
    public function showIncompleteRegisterUserPage()
    {
        return view('users.incomplete_registration');
    }

    public function showIncompleteRegisterMerchantPage()
    {
        return view('merchants.incomplete_registration_merchant');
    }

    public function showIncompleteRegisterAgentPage()
    {
        return view('agents.incomplete_registration_agent');
    }

    public function showIncompleteRegisterBillerPage()
    {
        return view('Biller.incomplete_registration_biller');
    }

    //Sub AccountList
    public function showMerchantSubAccountPage()
    {
        return view('merchants.merchant_sub_account');
    }


    public function search(SearchUserRequest $request)
    {

        if ($request->download_csv) {
            return (new UsersExport($request->all()))->download('user_search_' . now()->toDateTimeString() . '.csv', \Maatwebsite\Excel\Excel::CSV);
        }

        $userFilterQuery = User::with([
            'city', 'wallet', 'business', 'agent.agentWallets', 'paymentChargePackage', 'biller',
            'master_account:id,profile_pic_img_url,user_type_id', 'master_account.business:business_name,user_id'
        ])->filter($request->all())->orderByDesc('id');

        if ($request->request_origin == 'web')
            return datatables()->eloquent($userFilterQuery)->addColumn('full_name', function (User $user) {
                return $user->full_name;
            })->toJson();

        return ResponseFormatter::success($userFilterQuery->paginate($request->per_page));
    }


    public function businessTypes()
    {
        return ResponseFormatter::success(BusinessType::all());
    }

    public function merchantTypes()
    {
        return ResponseFormatter::success(MerchantCategory::all());
    }


    public function changeTxnPin(Request $request)
    {
        $this->validate($request, [
            'otp' => 'required|digits:6',
            'transaction_pin' => 'required|confirmed|digits:4',
        ]);

        $isValidOtp = (new TwilioOtpService())->verifyOtp($request->otp, Auth::user()->mobile_no);

        if ($isValidOtp) {
            User::find(Auth::user()->id)->update(['transaction_pin' => bcrypt($request->transaction_pin)]);
            return ResponseFormatter::success([], 'Pin changed success!');
        } else
            return ResponseFormatter::error([], 'Invalid otp', 400, 1409);
    }

    public function accountBlockStatus(AdminRequest $request, User $user)
    {
        $this->validate($request, ['account_blocked' => 'required|boolean']);

        $user->account_blocked = $request->account_blocked;
        $user->save();
        if ($request->account_blocked)
            $user->tokens()->delete();
        return ResponseFormatter::success([], 'User block status changed succesfully');
    }

    public function blockWalletBalance(AdminRequest $request, User $user)
    {

        $this->validate($request, ['amount' => 'required|numeric']);

        if ($user->user_type_id == UserType::Agent) {
            $user->agent->agentFundsWallet->blocked_balance = $request->amount;
            $user->agent->agentFundsWallet->save();
        } else {
            $user->wallet->blocked_balance = $request->amount;
            $user->wallet->save();
        }
        return ResponseFormatter::success([], 'User wallet blocked balance update success');
    }

    public function viewQr()
    {
        $qr = \SimpleSoftwareIO\QrCode\Facades\QrCode::size(200)
            ->format('png')
            ->backgroundColor(255, 255, 255)
            ->merge('/public/img/qr_logo.png', 0.4)
            ->errorCorrection('H')
            ->generate(Auth::user()->qr_code_info);

        return response($qr)->header('Content-type', 'image/png')->setStatusCode(200);
    }

    public function downloadQr(DownloadQrRequest $request, User $user)
    {
        $pdf = Pdf::loadView('qr', ['userDetails' => $user->toArray()]);
        return $pdf->download($user->username . '_qr.pdf');
    }


    public function prevalidate(Request $request)
    {
        $this->validate($request, [
            'mobile_no' => 'required_without:username|digits_between:7,10',
            'username' => 'required_without:mobile_no'
        ]);


        $user = User::query();

        $request->whenFilled('mobile_no', function () use (&$user, $request) {
            $user->where('mobile_no', $request->mobile_no);
        })->whenFilled('username', function () use (&$user, $request) {
            $user->where('username', $request->username);
        });

        $user = $user->first();

        $exists = false;

        if ($user)
            $exists = true;

        return ResponseFormatter::success(['exists' => $exists]);
    }

    function changeUserIdentifier(Request $request)
    {

        if (Auth::user()->is_admin)
            throw ValidationException::withMessages([
                'message' => ['Action not allowed'],
            ]);


        $this->validate($request, [
            'new_mobile_no' => 'required_without:new_email|digits_between:7,10|unique:users,mobile_no',
            'new_email' => 'required_without:new_mobile_no|email|unique:users,email',
            'password' => 'required',
            'txn_pin' => 'required|digits:4',
            'otp' => 'required|digits:6' #Request triggered from POST {url}/api/otp/send
        ]);

        if ($request->has('new_mobile_no') AND $request->has('new_email'))
            throw ValidationException::withMessages([
                'new_mobile_no' => ['Only either of mobile no or email can be changed at a time'],
                'new_email' => ['Only either of mobile no or email can be changed at a time'],
            ]);


        $user = Auth::user();

        if (Hash::check($request->password, $user->password))
            if (Utils::check_transaction_pin($request->txn_pin)) {

                if ($request->has('new_mobile_no'))
                    if ((new TwilioOtpService())->verifyOtp($request->otp, $request->new_mobile_no)) {
                        $user->mobile_no = $request->new_mobile_no;
                    } else
                        return ResponseFormatter::error([], 'Invalid otp', 400, 1409);


                if ($request->has('new_email'))
                    if ((new TwilioOtpService())->verifyOtpEmail($request->otp, $request->new_email)) {
                        $user->email = $request->email;
                    } else
                        return ResponseFormatter::error([], 'Invalid otp', 400, 1409);

                $user->save();
                return ResponseFormatter::success([], 'Changed credentials succesfully');
            }

        throw ValidationException::withMessages([
            'password' => ['The provided credentials are incorrect.'],
        ]);

    }
}
