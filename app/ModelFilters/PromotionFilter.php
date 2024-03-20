<?php

namespace App\ModelFilters;

use Carbon\Carbon;
use EloquentFilter\ModelFilter;

class PromotionFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    protected $camel_cased_methods = false;
    protected $drop_id = false;

    function is_active($status)
    {
        return $this->whereHas('voucher', function ($q) use ($status) {
            $q->where('data->is_active', $status);
        });
    }

    function user_id($id)
    {
        return $this->whereHas('voucher', function ($q) use ($id) {
            $q->where('data->user_id', $id);
        });
    }

    function voucher_for($model)
    {
        return $this->whereHas('voucher', function ($q) use ($model) {
            $q->where('data->voucher_for', $model);
        });

    }

    function created_between($dates)
    {
        $dates[1] = Carbon::parse($dates[1])->endOfDay();
        return $this->whereBetween('promotions.created_at', $dates);

    }

    function voucher_id($id)
    {
        return $this->where('voucher_id', $id)->with([
            'redeemed_transactions.debitedUser:users.id,username,mobile_no,pacpay_user_id,first_name,last_name,user_type_id',
            'redeemed_transactions.creditedUser:users.id,username,mobile_no,pacpay_user_id,first_name,last_name,user_type_id'
        ]);
    }


}
