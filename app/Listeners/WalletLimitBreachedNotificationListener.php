<?php

namespace App\Listeners;

use App\Enums\NotificationEntities;
use App\Events\WalletLimitBreachedEvent;
use App\Services\PushNotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class WalletLimitBreachedNotificationListener implements ShouldQueue
{
    use InteractsWithQueue;
    public $connection = 'redis';
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
     * @param  WalletLimitBreachedEvent  $event
     * @return void
     */
    public function handle(WalletLimitBreachedEvent $event)
    {
        Log::info('Running wallet limit breached notification listener'.json_encode($event));
        /*Inform the recipient that limit is breached and cannot accept more transactions*/
        $title = 'Your wallet limit is exceeded !';
        $body = 'Please withdraw funds or get limit increased from customer support.';
        $entityData = ['entity' => NotificationEntities::WALLET, 'entity_event' => 'USER_WALLET_LIMIT_BREACHED', 'entity_unique_id' => $event->limit_breached_user->id];
        (new PushNotificationService())->sendFirebasePushNotification($title, $body, [$event->limit_breached_user->id], $entityData);
    }
}
