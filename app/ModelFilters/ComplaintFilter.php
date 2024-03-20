<?php

namespace App\ModelFilters;

use Carbon\Carbon;
use EloquentFilter\ModelFilter;

class ComplaintFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = ['user' => ['search']];
    protected $camel_cased_methods = false;
    protected $drop_id = false;

    /*'complaint_type_id', 'created_at', 'updated_at', 'transaction_id', 'user_complaint_description', 'complaint_status', 'admin_resolution_description', 'resolved_at'*/

    function raised_between($dates)
    {
        $dates[0] = Carbon::parse($dates[0])->startOfDay();
        return $this->whereBetween('created_at', $dates);

    }

    function complaint_type_id($id)
    {
        return $this->where('complaint_type_id', $id);
    }

    function transaction_id($txnId)
    {

        return $this->whereBeginsWith('transaction_id', $txnId);
    }

    function complaint_status($status)
    {
        return $this->where('complaint_status', $status);
    }

    function resolved_between($dates)
    {
        $dates[0] = Carbon::parse($dates[0])->startOfDay();
        return $this->whereBetween('resolved_at', $dates);

    }


}
