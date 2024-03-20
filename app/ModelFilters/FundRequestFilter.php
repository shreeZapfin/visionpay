<?php

namespace App\ModelFilters;

use Carbon\Carbon;
use EloquentFilter\ModelFilter;

class FundRequestFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
//    public $relations = ['requesterUser' => ['name']];
    protected $camel_cased_methods = false;
    protected $drop_id = false;

    function status($status)
    {
        return $this->where('status', $status);

    }

    function from_date($date)
    {
        return $this->where('created_at', '>=', Carbon::parse($date)->startOfDay());

    }

    function to_date($date)
    {
        return $this->where('created_at', '<=', Carbon::parse($date)->endOfDay());

    }

    function request_type($type)
    {
        return $this->where('request_type', $type);

    }

    function requester_user_id($id)
    {
        return $this->where('requester_user_id', $id);

    }

    function sender_user_id($id)
    {
        return $this->where('sender_user_id', $id);

    }


    function name($name)
    {
        return
            $this->orWhereHas('requesterUser', function ($query) use ($name) {
                $query->where('first_name', 'LIKE', $name . '%')->orWhere('last_name', 'LIKE', $name . '%');
            })->orWhereHas('senderUser', function ($query) use ($name) {
                $query->where('first_name', 'LIKE', $name . '%')->orWhere('last_name', 'LIKE', $name . '%');
            });


    }

    function is_sub_account_request($boolean)
    {
        return $this->where('is_sub_account_request', $boolean);

    }

    function fund_request_id($id)
    {
        return $this->where('fund_request_id',$id);

    }


}
