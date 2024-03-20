<?php

namespace App\ModelFilters;

use Carbon\Carbon;
use EloquentFilter\ModelFilter;

class BillPaymentFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = ['biller' => 'biller_name'];
    protected $camel_cased_methods = false;
    protected $drop_id = false;

    function from_date($date)
    {
        return $this->where('created_at', '>=', Carbon::parse($date)->startOfDay());

    }

    function to_date($date)
    {
        return $this->where('created_at', '<=', Carbon::parse($date)->endOfDay());

    }

    function primary_field($number)
    {
        $this->whereBeginsWith('biller_fields->primary_field->value',$number);
    }

    function biller_id($billerId)
    {
        $this->where('biller_id', $billerId);
    }

    function user_id($userId)
    {
        $this->where('user_id', $userId);
    }

    function bill_payment_id($id)
    {
        $this->where('bill_payment_id', $id);
    }
}
