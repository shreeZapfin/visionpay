<?php

namespace App\Models;

use App\Enums\WalletTransactionType;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $transaction_id
 * @property float $opening_balance
 * @property float $closing_balance
 * @property float $credit_amount
 * @property float $debit_amount
 * @property string $transaction_type
 * @property integer $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $description
 * @property FundRequest $fundRequest
 */
class WalletTransaction extends Model
{
    use Filterable;
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['transaction_id', 'opening_balance', 'closing_balance', 'credit_amount', 'debit_amount', 'transaction_type', 'user_id', 'created_at', 'updated_at', 'description'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fundRequest()
    {
        return $this->belongsTo('App\Models\FundRequest', 'transaction_id', 'fund_request_id');
    }

    /**
     * Get the parent transaction model (fund request or rechange etc).
     */
    public function transaction()
    {
        return $this->morphTo(__FUNCTION__, 'transaction_type', 'transaction_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function creditedUser()
    {
        return $this->hasOneThrough('App\Models\User', 'App\Models\WalletTransaction','transaction_id','id','transaction_id','user_id')
            ->where('credit_amount','>',0)
            ->whereIn('transaction_type',[WalletTransactionType::WALLET_TRANSFER,WalletTransactionType::BILL_PAYMENT]);
    }

    public function debitedUser()
    {
        return $this->hasOneThrough('App\Models\User', 'App\Models\WalletTransaction','transaction_id','id','transaction_id','user_id')
            ->where('debit_amount','>',0)
            ->whereIn('transaction_type',[WalletTransactionType::WALLET_TRANSFER,WalletTransactionType::BILL_PAYMENT]);
    }


    public function getReceipientUserOfWalletTxn()
    {
        $txn = $this->transaction()->first();

        if ($txn instanceof FundRequest) { /*Fund request has sender and requester*/
            $user = $txn->requesterUser()->first();
            if ($user->is_sub_account)  /*if receiver was a sub account return the master account to authorize this refund*/
                $user = $user->master_account()->first();

            return $user;
        }
        if ($txn instanceof BillPayment) {
            $user = $txn->biller_user()->first();
            return $user;
        }
        return null;
    }

}
