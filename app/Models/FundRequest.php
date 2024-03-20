<?php

namespace App\Models;

use App\Enums\FundRequestStatus;
use BeyondCode\Vouchers\Traits\HasVouchers;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

/**
 * @property integer $id
 * @property integer $requester_user_id
 * @property integer $sender_user_id
 * @property int $admin_bank_id
 * @property float $amount
 * @property string $status
 * @property string $request_type
 * @property string $created_at
 * @property string $updated_at
 * @property string $transaction_ref_no
 * @property string $fund_request_id
 * @property string $reject_remark
 * @property AdminBankDetail $adminBankDetail
 * @property User senderUser
 * @property User requesterUser
 * @property WalletTransaction[] $walletTransactions
 */
class FundRequest extends Model
{   use Filterable,HasFactory,HasVouchers;
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';
    protected $primaryKey='fund_request_id';
   public $incrementing = false;
    /**
     * @var array
     */
    protected $fillable = ['requester_user_id', 'sender_user_id', 'admin_bank_id', 'amount', 'status', 'request_type', 'created_at', 'updated_at', 'transaction_ref_no', 'fund_request_id','reject_remark'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function adminBankDetail()
    {
        return $this->belongsTo('App\Models\AdminBankDetail', 'admin_bank_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function senderUser()
    {
        return $this->belongsTo('App\Models\User', 'sender_user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function requesterUser()
    {
        return $this->belongsTo('App\Models\User', 'requester_user_id');
    }



    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
//    public function walletTransactions()
//    {
//        return $this->hasMany('App\Models\WalletTransaction', 'transaction_id', 'fund_request_id');
//    }

    /**
     * Get the wallet transaction.
     */
    public function transaction()
    {
        return $this->morphMany(WalletTransaction::class, 'transaction','transaction_type','transaction_id','fund_request_id');
    }


    public function scopePendingRequests($query,$userId)
    {

        return $query->where('sender_user_id',$userId)->where('status',FundRequestStatus::REQUESTED);

    }

}
