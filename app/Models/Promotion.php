<?php

namespace App\Models;


use App\Enums\WalletTransactionType;
use BeyondCode\Vouchers\Models\Voucher;
use BeyondCode\Vouchers\Traits\HasVouchers;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * @property int $id
 * @property integer $voucher_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $promotion_name
 * @property string $promotion_model
 * @property Voucher $voucher
 * @property TransactionUserVoucher[] $promotionUserVouchers
 */
class Promotion extends Model
{
    use Filterable,HasVouchers;
    /**
     * @var array
     */
    protected $fillable = ['voucher_id', 'created_at', 'updated_at', 'promotion_name', 'promotion_model', 'promotion_transaction_type'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function voucher()
    {
        return $this->belongsTo('BeyondCode\Vouchers\Models\Voucher');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function promotionUserVouchers()
    {
        return $this->hasManyThrough('App\Models\TransactionUserVoucher', 'BeyondCode\Vouchers\Models\Voucher', 'id', 'user_voucher_id', 'voucher_id', 'id');
    }

    public function userVouchers()
    {

        return $this->hasMany('App\Models\UserVoucher', 'voucher_id', 'voucher_id');
    }

    public function wallet_transactions()
    {   /*Added for sake of returning voucher checks*/ /*Bind this relation with user_id or transaction_id for efficient results*/
        return $this->hasMany('App\Models\WalletTransaction', 'transaction_type', 'promotion_transaction_type');

    }
    /*Show the transaction which was redeem*/
    public function redeemed_transactions()
    {
        return $this->hasManyThrough('App\Models\WalletTransaction','App\Models\TransactionUserVoucher', 'user_voucher_id','transaction_id','voucher_id','wallet_transaction_id')
            ->where('transaction_type',WalletTransactionType::WALLET_TRANSFER)
            ->where('debit_amount','>',0);
    }


    public function scopeActiveVouchers($query)
    {
        return $query->whereHas('voucher', function ($q) {
            $q->where('expires_at', '>=', now()->endOfDay())
                ->where('data->is_active', true);
        });
    }

    public function scopeNotReedemeedByUser($query, User $user)
    {
        return $query->whereHas('promotionUserVouchers', function ($q) use ($user) {
            $q->whereDoesntHave('userVoucher', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        });

    }

    public function scopeActiveInstantVouchers($query)
    {
        return $query->whereHas('voucher', function ($q) {
            $q->where('expires_at', '>=', now()->endOfDay())
                ->where('data->voucher_type', 'INSTANT')
                ->where('data->is_active', true);
        });
    }


    public function scopeEligibleForVoucher($query, User $user)
    {

        /* min txn amount fullfilled
        with txn created between voucher.created and expiry date
        if user_id present in the voucher
            should be a biller_id in case of bills or requester id in case payments*/

        return $query->whereHas('wallet_transactions', function ($q) use ($user) {
            $q->whereHasMorph(
                'transaction',
//                VoucherModels::getValues(), /*IMP : NEW VOUCHER TRANSACTION MODELS TO BE ADDED HERE WHENEVER YOU ADD NEW TRANSACTION TYPE AS WELL AS TABLE NAME IN SWITCH CASE BELOW*/
                [FundRequest::class, Deposit::class, BillPayment::class],
                function ($query, $type) use ($user) {
                    switch ($type) {
                        case 'App\Models\BillPayment':
                            $userColumn = 'bill_payments.user_id';
                            $receipantColumn = 'bill_payments.biller_id';
                            $crdrField = 'debit_amount';
                            break;
                        case 'App\Models\FundRequest':
                            $userColumn = 'fund_requests.sender_user_id';
                            $receipantColumn = 'fund_requests.requester_user_id';
                            $crdrField = 'debit_amount';
                            break;
                        case 'App\Models\Deposit':
                            $userColumn = 'deposits.user_id';
                            $receipantColumn = 'deposits.agent_id';
                            $crdrField = 'credit_amount';
                            break;
                        case 'default':
                            Log::exception('INVALID TYPE IN SCOPE PROMOTION MODEL ->scopeEligibleForReturningVoucher() :' . $type);
                            break;
                    }
                    $query->where($userColumn, '=', $user->id)
                        ->whereColumn('wallet_transactions.' . $crdrField, '>=', 'vouchers.data->min_txn_amount')
                        ->whereColumn('wallet_transactions.created_at', '>=', 'vouchers.created_at')
                        ->whereColumn('wallet_transactions.created_at', '<=', 'vouchers.expires_at')
                        ->where(function ($conditional) use ($receipantColumn) {
                            $conditional->whereColumn($receipantColumn, 'vouchers.data->user_id')
                                ->orWhereIn($receipantColumn,User::select('id')   /*Sub account receipients*/
                                    ->whereColumn('master_account_user_id','vouchers.data->user_id'))
                                ->orWhereNull('vouchers.data->user_id');
                        });
                }
            );
        })->orWhere(function ($q) {
            $q->ActiveInstantVouchers(); /*To include Instant Vouchers*/
        })->join('vouchers', 'vouchers.id', '=', 'promotions.voucher_id');

    }


    public function scopeByUser($query, User $user)
    {
        if ($user->is_admin)
            return $query;
        if ($user->user_type_id == \App\Enums\UserType::Customer) {
            return $query->EligibleForVoucher($user)
                ->ActiveVouchers()
                ->NotReedemeedUserVoucher($user);

        }
        return $query->whereNull('id'); /*Dont show any promotions to other usertypes*/
    }

    public function scopeNotReedemeedUserVoucher($query, User $user)
    {

        return $query->whereDoesntHave('userVouchers', function ($q) use ($user) {
            $q->where('user_id', $user->id); /*Not reedemed before*/
        });
    }

}
