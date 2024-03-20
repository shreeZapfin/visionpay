<?php

namespace App\Listeners;

use App\Enums\FundRequestType;
use App\Enums\NotificationEntities;
use App\Events\ReceivedFundRequestEvent;
use App\Services\PushNotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendReceivedFundRequestNotification implements ShouldQueue
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
     * @param  ReceivedFundRequestEvent $event
     * @return void
     */
    public function handle(ReceivedFundRequestEvent $event)
    {

        if($event->fundRequest->request_type==FundRequestType::REQUEST) {
            $title = 'Fund request received ' . $event->fundRequest->fund_request_id;
            $entityData = ['entity' => NotificationEntities::FUND_REQUEST, 'entity_event' => 'RECEIVED','entity_unique_id' => $event->fundRequest->fund_request_id];
            $body = $event->fundRequest->requesterUser->full_name . ' requested for amount :' . $event->fundRequest->amount;
            (new PushNotificationService())->sendFirebasePushNotification($title, $body, [$event->fundRequest->sender_user_id],$entityData);
        }
    }
}
