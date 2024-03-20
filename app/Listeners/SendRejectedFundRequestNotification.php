<?php

namespace App\Listeners;

use App\Enums\NotificationEntities;
use App\Events\RejectedFundRequestEvent;
use App\Events\SentFundRequestRejectedEvent;
use App\Services\PushNotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendRejectedFundRequestNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SentFundRequestRejectedEvent  $event
     * @return void
     */
    public function handle(SentFundRequestRejectedEvent $event)
    {
        $title = 'Fund request rejected '.$event->fundRequest->fund_request_id;
        $body = 'Your fund request rejected for amount :' . $event->fundRequest->amount .' by '.$event->fundRequest->senderUser->full_name;

        $entityData = ['entity' => NotificationEntities::FUND_REQUEST, 'entity_event' => 'REJECTED','entity_unique_id' => $event->fundRequest->fund_request_id];
        (new PushNotificationService())->sendFirebasePushNotification($title, $body, [$event->fundRequest->requester_user_id],$entityData);
    }
}
