<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class BillerFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];
    protected $camel_cased_methods = false;
    protected $drop_id = false;


    function biller_name($name)
    {
        return $this->whereBeginsWith('biller_name', $name);
    }

    function biller_category_id($id)
    {
        return $this->where('biller_category_id', $id);
    }

    function is_active($boolean)
    {
        return $this->where('is_active', $boolean);
    }

    function user_id($id)
    {
        return $this->where('user_id', $id);
    }
}
