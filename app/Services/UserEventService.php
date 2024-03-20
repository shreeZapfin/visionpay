<?php
/**
 * Created by PhpStorm.
 * User: Ashay
 * Date: 16-07-2022
 * Time: 11:18 PM
 */

namespace App\Services;


use App\Events\UserEventCreated;
use App\Models\User;

class UserEventService
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /*array */
    /*'action_user_id', 'event', 'remark','data'*/
    function createEvent(array $arr)
    {
        $ue = $this->user->userEvents()->create($arr);
        UserEventCreated::dispatch($ue);

        return $ue;

    }


}