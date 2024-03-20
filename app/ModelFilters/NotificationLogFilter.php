<?php

namespace App\ModelFilters;

use Carbon\Carbon;
use EloquentFilter\ModelFilter;

class NotificationLogFilter extends ModelFilter
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

    function created_between($dates)
    {
        $dates[0] = Carbon::parse($dates[0])->startOfDay();
        $dates[1] = Carbon::parse($dates[1])->endOfDay();
        return $this->whereBetween('created_at', $dates);

    }

    function entity($name)
    {
        return $this->where('entity', $name);
    }

    function entity_event($event)
    {
        return $this->where('entity_event', $event);
    }

    function entity_unique_id($id)
    {
        return $this->where('entity_unique_id', $id);
    }

    function user_id($id)
    {
        return $this->where('user_id', $id);
    }


}
