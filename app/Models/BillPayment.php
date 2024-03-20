<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $biller_id
 * @property integer $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property mixed $biller_fields
 * @property Biller $biller
 * @property string $bill_payment_id
 * @property User $user
 */
class BillPayment extends Model
{
    use Filterable;
    /**
     * @var array
     */
    protected $fillable = ['biller_id', 'user_id', 'created_at', 'updated_at', 'biller_fields', 'bill_payment_id'];

    protected $casts = ['biller_fields' => 'array'];

    /*Below 3 attributes Added so that polymorph from wallet_transaction works properly*/
    protected $keyType = 'string';
    protected $primaryKey = 'bill_payment_id';
    public $incrementing = false;


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function biller()
    {
        return $this->belongsTo('App\Models\Biller');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasOneThrough
     */
    public function biller_user()
    {
        return $this->hasOneThrough('App\Models\User', 'App\Models\Biller', 'id', 'id', 'biller_id', 'user_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }


    public function scopeByUser($query, User $user)
    {
        if ($user->is_admin)
            return $query;
        return $query->where('user_id', $user->id);
    }

    /**
     * Get the wallet transaction.
     */
    public function transaction()
    {
        return $this->morphMany(WalletTransaction::class, 'transaction', 'transaction_type', 'transaction_id', 'bill_payment_id');
    }
}
