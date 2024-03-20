<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $user_voucher_id
 * @property string $promotion_model
 * @property int $model_id
 * @property Promotion $promotion
 * @property UserVoucher $userVoucher
 */
class TransactionUserVoucher extends Model
{

    public $timestamps = false;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'transaction_user_voucher';

    /**
     * @var array
     */
    protected $fillable = ['user_voucher_id', 'wallet_transaction_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function promotion()
    {
        return $this->belongsTo('App\Models\Promotion', 'promotion_model', 'promotion_model');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userVoucher()
    {
        return $this->belongsTo('App\Models\UserVoucher');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function userTransaction()
    {
        return $this->hasOne('App\Models\WalletTransaction', 'transaction_id', 'wallet_transaction_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function userCashbackTransaction()
    {
        return $this->hasOne('App\Models\WalletTransaction', 'transaction_id', 'wallet_transaction_id')->where('transaction_type','CASHBACK');
    }



}
