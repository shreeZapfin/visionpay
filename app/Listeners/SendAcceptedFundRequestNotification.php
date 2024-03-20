<?php

namespace App\Listeners;

use App\Enums\FundRequestType;
use App\Enums\NotificationEntities;
use App\Events\AcceptedFundRequestEvent;
use App\Events\ReceivedFundRequestEvent;
use App\Events\SentFundRequestAcceptedEvent;
use App\Services\PushNotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendAcceptedFundRequestNotification implements ShouldQueue
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
     * @param  SentFundRequestAcceptedEvent $event
     * @return void
     */
    public function handle(SentFundRequestAcceptedEvent $event)
    {
        if ($event->fundRequest->request_type == FundRequestType::REQUEST) {
            $title = 'Fund request accepted ' . $event->fundRequest->fund_request_id;
            $body = 'Your fund request accepted for amount :' . $event->fundRequest->amount . ' by ' . $event->fundRequest->senderUser->full_name;
            $entityData = ['entity' => NotificationEntities::FUND_REQUEST, 'entity_event' => 'ACCEPTED', 'entity_unique_id' => $event->fundRequest->fund_request_id];
            (new PushNotificationService())->sendFirebasePushNotification($title, $body, [$event->fundRequest->requester_user_id], $entityData);
        }
        if ($event->fundRequest->request_type == FundRequestType::DIRECT) {
            $title = 'Received payment ' . $event->fundRequest->amount;
            $body = 'You have received ' . $event->fundRequest->amount . ' from ' . $event->fundRequest->senderUser->full_name;
            $entityData = ['entity' => NotificationEntities::PAYMENT, 'entity_event' => 'RECEIVED', 'entity_unique_id' => $event->fundRequest->fund_request_id];
            (new PushNotificationService())->sendFirebasePushNotification($title, $body, [$event->fundRequest->requester_user_id], $entityData);
        }
        if ($event->fundRequest->request_type == FundRequestType::AGENT_WALLET_REFILL) {
            $title = 'Refilled agent wallet ' . $event->fundRequest->amount;
            $body = 'You have received ' . $event->fundRequest->amount . ' from ' . $event->fundRequest->senderUser->full_name .' in agent wallet';
            $entityData = ['entity' => NotificationEntities::FUND_REQUEST, 'entity_event' => 'ACCEPTED', 'entity_unique_id' => $event->fundRequest->fund_request_id];
            (new PushNotificationService())->sendFirebasePushNotification($title, $body, [$event->fundRequest->requester_user_id], $entityData);
        }

    }
}
