<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $voucher_id
 * @property string $redeemed_at
 * @property User $user
 * @property Voucher $voucher
 * @property TransactionUserVoucher[] $promotionUserVouchers
 */
class UserVoucher extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_voucher';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'voucher_id', 'redeemed_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function voucher()
    {
        return $this->belongsTo('BeyondCode\Vouchers\Models\Voucher');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactionUserVoucher()
    {
        return $this->hasMany('App\Models\TransactionUserVoucher','user_voucher_id','voucher_id');
    }


    public function scopeByUser($query, User $user)
    {

        if ($user->is_admin)
            return $query;

        return $query->where('user_id', $user->id);

    }
}
