<?php

namespace App\Listeners;

use App\Classes\Transaction\CashbackReceivedOnTransaction;
use App\Enums\NotificationEntities;
use App\Events\UserEventCreated;
use App\Services\PushNotificationService;
use BeyondCode\Vouchers\Events\VoucherRedeemed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class UserEventCreatedNotificationListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  VoucherRedeemed $event
     * @return void
     */
    public function handle(UserEventCreated $userEventCreated)
    {
        $title =  ucfirst(strtolower(str_replace("_", " ", $userEventCreated->userEvent->event)));
        $body = $userEventCreated->userEvent->remark;
        $entityData = ['entity' => NotificationEntities::GENERAL,'entity_event' => $userEventCreated->userEvent->event];
        (new PushNotificationService())->sendFirebasePushNotification($title, $body, [$userEventCreated->userEvent->user_id], $entityData);

    }
}
