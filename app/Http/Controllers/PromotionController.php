<?php

namespace App\Http\Controllers;

use App\Enums\NotificationEntities;
use App\Enums\UserType;
use App\Enums\VoucherModels;
use App\Helpers\ResponseFormatter;
use App\Http\Requests\AdminRequest;
use App\Models\FundRequest;
use App\Models\Promotion;
use App\Models\User;
use App\Models\UserVoucher;
use App\Services\PushNotificationService;
use App\Services\ReedeemVoucherService;
use BeyondCode\Vouchers\Facades\Vouchers;
use BeyondCode\Vouchers\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        /*Admin*/
        /*Display all promotions*/
        /*Display active promotions*/
        /*Display expired promotions*/
        /*Customer*/
        /*Display available active promotions*/
        $this->validate($request, [
            'created_between.0' => 'nullable|date_format:Y-m-d',
            'created_between.1' => 'nullable|date_format:Y-m-d',
            'voucher_id' => 'nullable'
        ]);

        $promotions = Promotion::with('voucher')->filter($request->all())->orderBy('id', 'desc');

        if ($request->request_origin == 'web')
            return datatables($promotions)->toJson();


        return ResponseFormatter::success($promotions->paginate($request->per_page), 'All Promotions');
    }

    public function index_reedemeed_vouchers(Request $request)
    {
        /*Admin*/
        /*Customer*/

        $this->validate($request, [
            'redeemed_between.0' => 'nullable|date_format:Y-m-d',
            'redeemed_between.1' => 'nullable|date_format:Y-m-d',
            'voucher_id' => 'nullable'
        ]);


        $reedemedVouchers = UserVoucher::with([
            'voucher',
            'transactionUserVoucher.userTransaction.transaction','transactionUserVoucher.userCashbackTransaction',
            'user:id,first_name,last_name,pacpay_user_id,user_type_id,username'
        ])->ByUser(Auth::user());

        if (isset($request->redeemed_between)) {
            $dates = $request->redeemed_between;

            $dates[1] = Carbon::parse($dates[1])->endOfDay();

            $reedemedVouchers->whereBetween('redeemed_at', $dates);
        }

        $request->whenHas('voucher_id', function () use (&$reedemedVouchers, $request) {
            $reedemedVouchers->where('voucher_id', $request->voucher_id)->with([
                'transactionUserVoucher.userTransaction.creditedUser',
                'transactionUserVoucher.userTransaction.debitedUser'
            ]);
        });


        if ($request->request_origin)
            return datatables($reedemedVouchers)->toJson();


        return ResponseFormatter::success($reedemedVouchers->paginate($request->per_page), 'Reedemed vouchers');
    }


    public function index_reedemable_vouchers(Request $request)
    {
        $this->validate($request, [
            'created_between.0' => 'nullable|date_format:Y-m-d',
            'created_between.1' => 'nullable|date_format:Y-m-d'
        ]);


        $promotions = Promotion::with('voucher')->filter($request->all())->ByUser(Auth::user());


        if ($request->request_origin == 'web')
            return datatables($promotions)->toJson();


        return ResponseFormatter::success($promotions->paginate($request->per_page), 'Vouchers eligible for redemption');
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
    public function store(AdminRequest $request)
    {
        $this->validate($request, [
            'promotion_name' => 'required',
            'voucher_for' => 'required|in:FUND_REQUEST,BILL_PAYMENT,DEPOSIT,MERCHANT_PAYMENT', /*always add entry in VoucherModels enum when you add here*/
            'expiry_date' => 'required|after:today',
            'min_txn_amount' => 'required|numeric|min:0',
            'cashback_type' => 'required|in:PERCENTAGE,FIXED_AMOUNT',
            'cashback_amount' => 'required|numeric',
            'voucher_type' => 'required|in:INSTANT,RETURNING',
            'reward_upto_max_amount' => 'nullable|required_if:cashback_type,PERCENTAGE',
            'voucher_description' => 'required',
            'user_id' => 'nullable',
        ]);


        /*voucher_for,expiry , min amount , cashback type*/

        $model = VoucherModels::asArray()[$request->voucher_for];
        $promotionArray = array_merge($request->only(['promotion_name']), (['promotion_model' => $model['class'], 'promotion_transaction_type' => $model['transaction_type']]));

        $promotion = Promotion::create($promotionArray);

        $voucher = Vouchers::create($promotion, 1, $request->all() + ['is_active' => false], Carbon::parse($request->expiry_date)->endOfDay())[0];

        $promotion->voucher_id = $voucher->id;
        $promotion->save();

        return ResponseFormatter::success($promotion->load('voucher'), 'Voucher created success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,Promotion $promotion)
    {
        $cb = (new ReedeemVoucherService())->getEligibleCashbackOnVoucher($promotion->voucher,$request->txn_amount);
        $promotion->setAttribute('transaction_cashback_applicable',$cb);
        return ResponseFormatter::success($promotion->load('voucher'), 'Voucher details');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRequest $request, Promotion $promotion)
    {
        $this->validate($request, [
            'promotion_name' => 'nullable',
            'expiry_date' => 'nullable|after:today',
            'min_txn_amount' => 'nullable|numeric|min:0',
            'cashback_type' => 'nullable|in:PERCENTAGE,FIXED_AMOUNT',
            'cashback_amount' => 'nullable|numeric',
            'reward_upto_max_amount' => 'nullable|required_if:cashback_type,PERCENTAGE',
            'voucher_description' => 'nullable',
            'is_active' => 'nullable|boolean'
        ]);


        $promotion->promotion_name = ($request->promotion_name) ? $request->promotion_name : $promotion->promotion_name;

        $voucher = $promotion->voucher;

        $voucher->expires_at = ($request->expiry_date) ? $request->expiry_date : $voucher->expires_at;

        $voucherData = json_decode($voucher->data);

        $voucherData->promotion_name = ($request->promotion_name) ? $request->promotion_name : $voucherData->promotion_name;
        $voucherData->expiry_date = ($request->expiry_date) ? $request->expiry_date : $voucherData->expiry_date;
        $voucherData->min_txn_amount = ($request->min_txn_amount) ? $request->min_txn_amount : $voucherData->min_txn_amount;
        $voucherData->cashback_type = ($request->cashback_type) ? $request->cashback_type : $voucherData->cashback_type;
        $voucherData->cashback_amount = ($request->cashback_amount) ? $request->cashback_amount : $voucherData->cashback_amount;
        $voucherData->reward_upto_max_amount = ($request->reward_upto_max_amount) ? $request->reward_upto_max_amount : $voucherData->reward_upto_max_amount;
        $voucherData->is_active = isset($request->is_active) ? (($request->is_active) ? true : false) : $voucherData->is_active;
        $voucherData->voucher_description = isset($request->voucher_description) ? $request->voucher_description : $voucherData->voucher_description;

        $voucher->data = $voucherData;

        $promotion->save();
        $voucher->save();


        if (isset($request->is_active))
            if ($request->is_active == true) { /*Send push notification to all customers*/
                $entityData = ['entity' => NotificationEntities::VOUCHER, 'entity_event' => 'voucher_created', 'entity_unique_id' => $voucher->id];
                $ids = User::select('id')->where('user_type_id', UserType::Customer)->get()->pluck('id')->toArray();
                (new PushNotificationService())->sendFirebasePushNotification('New voucher for you !' . $voucherData->promotion_name, $voucherData->voucher_description, $ids, $entityData);
            }


        return ResponseFormatter::success($promotion->load('voucher'), 'Voucher updated success');
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


    public function showVoucherPage()
    {
        return view('Rewards.all_vouchers');
    }

    public function showReedemeVoucherPage()
    {
        return view('Rewards.reedemed_voucher');
    }

    public function showVoucherIdPage(Promotion $promotion)
    {

        $promotion->load([
            'redeemed_transactions.debitedUser:users.id,username,mobile_no,pacpay_user_id,first_name,last_name,user_type_id',
            'redeemed_transactions.creditedUser:users.id,username,mobile_no,pacpay_user_id,first_name,last_name,user_type_id',
            'voucher'
        ]);

        return view('Rewards.voucher_details')->with('voucher_details', $promotion);
    }
}
