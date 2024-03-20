<?php

namespace App\Listeners;

use App\Enums\NotificationEntities;
use App\Enums\WithdrawalStatus;
use App\Events\AcceptedFundRequestEvent;
use App\Events\ReceivedFundRequestEvent;
use App\Events\SentFundRequestAcceptedEvent;
use App\Events\WithdrawalUpdatedEvent;
use App\Services\PushNotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class WithdrawalUpdatedPushNotification implements ShouldQueue
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
    public function handle(WithdrawalUpdatedEvent $event)
    {
        $title = 'Withdrawal status for ' . $event->withdrawal->withdrawal_id;
        $entityData = ['entity' => NotificationEntities::WITHDRAWAL, 'entity_unique_id' => $event->withdrawal->withdrawal_id];
        if ($event->withdrawal->status == WithdrawalStatus::BANK_WITHDRAWAL_PAID ||
            $event->withdrawal->status == WithdrawalStatus::ACCEPTED
        ) {
            $body = 'Your withdrawal for amount :' . $event->withdrawal->amount . ' is processed sucessfully';
            $entityData['entity_event'] = 'SUCCESS';
        } else if ($event->withdrawal->status == WithdrawalStatus::EXPIRED) {
            $body = 'Your withdrawal for amount :' . $event->withdrawal->amount . ' has expired';
            $entityData['entity_event'] = 'EXPIRED';
        } else if ($event->withdrawal->status == WithdrawalStatus::INITATED) {
            $event->withdrawal->load('agent_user');
            $body = 'Your withdrawal for amount :' . $event->withdrawal->amount . ' has been initiated by agent :' . $event->withdrawal->agent_user->full_name .',Please accept or reject the request';
            $entityData['entity_event'] = 'INITIATED';
        } else {
            $body = 'Your withdrawal for amount :' . $event->withdrawal->amount . ' has failed';
            $entityData['entity_event'] = 'FAILED';
        }
        (new PushNotificationService())->sendFirebasePushNotification($title, $body, [$event->withdrawal->user_id],$entityData);
    }
}
