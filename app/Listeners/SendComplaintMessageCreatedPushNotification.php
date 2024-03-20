<?php

namespace App\Listeners;

use App\Enums\NotificationEntities;
use App\Events\ComplaintMessageCreatedEvent;
use App\Services\PushNotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendComplaintMessageCreatedPushNotification implements ShouldQueue
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
     * @param  ComplaintMessageCreatedEvent $event
     * @return void
     */
    public function handle(ComplaintMessageCreatedEvent $event)
    {
        $title = 'Complaint message received ' . $event->complaintMessage->complaint_id;
        $body = $event->complaintMessage->message;
        $entityData = ['entity' => NotificationEntities::COMPLAINT, 'entity_event' => 'RESPONSE','entity_unique_id' => $event->complaintMessage->complaint_id];
        (new PushNotificationService())->sendFirebasePushNotification($title, $body, [$event->complaintMessage->message_to_user_id],$entityData);
    }
}
