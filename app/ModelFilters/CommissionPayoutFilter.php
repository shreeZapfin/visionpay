<?php

namespace App\ModelFilters;

use Carbon\Carbon;
use EloquentFilter\ModelFilter;

class CommissionPayoutFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
//    public $relations = ['user' => 'name'];
    protected $camel_cased_methods = false;
    protected $drop_id = false;



    function agent_id($id)
    {
        return $this->where('agent_id', $id);

    }


    function from_date($date)
    {
        return $this->where('created_at', '>=', Carbon::parse($date)->startOfDay());

    }

    function to_date($date)
    {
        return $this->where('created_at', '<=', Carbon::parse($date)->endOfDay());

    }

    function name($name)
    {
        return
            $this->whereHas('agent_user', function ($query) use ($name) {
                    $query->where('first_name', 'LIKE', $name . '%')
                        ->orWhere('last_name', 'LIKE', $name . '%');
                });
    }


}
