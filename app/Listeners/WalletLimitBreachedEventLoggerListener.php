<?php

namespace App\Listeners;

use App\Events\WalletLimitBreachedEvent;
use App\Services\UserEventService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class WalletLimitBreachedEventLoggerListener implements ShouldQueue
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
     * @param  WalletLimitBreachedEvent $event
     * @return void
     */
    public function handle(WalletLimitBreachedEvent $event)
    {
        Log::info('Running wallet limit breached LOGGER listener'.json_encode($event));
        /*Add event log for transaction failure for user so that admin can view it*/
        (new UserEventService($event->limit_breached_user))->createEvent([
            'remark' => 'Transaction failed due to recipient wallet limit exceeded',
            'event' => 'USER_WALLET_LIMIT_BREACHED',
            'action_user_id' => $event->txnDetails['auth_user_id'],
            'data' => $event->txnDetails
        ]);

    }
}
