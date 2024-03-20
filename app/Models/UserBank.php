<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property int $bank_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $bank_account_no
 * @property string $swift
 * @property string $bsb
 * @property string $bank_account_name
 * @property Bank $bank
 */
class UserBank extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['bank_id', 'created_at', 'updated_at', 'bank_account_no', 'swift', 'bsb', 'bank_account_name', 'user_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bank()
    {
        return $this->belongsTo('App\Models\Bank');
    }

    function getBankDetailsArr()
    {
        return [
            'bank_name' => $this->bank->bank_name,
            'bank_account_no' => $this->bank_account_no,
            'bank_account_name' => $this->bank_account_name,
            'swift' => $this->bank->swift,
            'bsb' => $this->bank->bsb,
            'bank_reference_no' => null
        ];

    }
}
