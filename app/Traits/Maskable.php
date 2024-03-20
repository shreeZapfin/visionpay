<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait Maskable
{
    /**
     * Mask the specified field.
     *
     * @param string $field
     * @return void
     */
    public function mask($field)
    {

        if($field == 'mobile_no')
            $this->$field = Str::mask($this->$field, '*', 0,4);
        if($field == 'email') {

            //$this->$field = Str::mask($this->$field, '*', -15, 10);
            $em   = explode("@", $this->$field);
            $name = implode('@',array_slice($em, 0, count($em) - 1) );
            $len  = floor(strlen($name) / 2);
            $this->$field = substr($name, 0, $len) . str_repeat('*', $len) . "@" . end($em);

        }
        return $this->$field;
    }

    /**
     * Unmask the specified field and log the user ID of who unmasked it.
     *
     * @param string $field
     * @param int $userId
     * @return void
     */
    public function unmask($field, $userId)
    {
        $this->$field = $this->original[$field];
        \Log::info("Field {$field} unmasked by user ID {$userId}");
    }
}