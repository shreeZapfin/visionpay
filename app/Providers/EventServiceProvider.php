<?php

namespace App\Providers;

use App\Events\ComplaintMessageCreatedEvent;
use App\Events\ReceivedFundRequestEvent;
use App\Events\SentFundRequestAcceptedEvent;
use App\Events\SentFundRequestRejectedEvent;
use App\Events\UserEventCreated;
use App\Events\WalletLimitBreachedEvent;
use App\Events\WithdrawalUpdatedEvent;
use App\Listeners\SendAcceptedFundRequestNotification;
use App\Listeners\SendComplaintMessageCreatedPushNotification;
use App\Listeners\SendReceivedFundRequestNotification;
use App\Listeners\SendRejectedFundRequestNotification;
use App\Listeners\UserEventCreatedNotificationListener;
use App\Listeners\VoucherRedeemedListener;
use App\Listeners\WalletLimitBreachedEventLoggerListener;
use App\Listeners\WalletLimitBreachedNotificationListener;
use App\Listeners\WithdrawalUpdatedPushNotification;
use App\Models\Deposit;
use App\Models\User;
use App\Models\WalletTransaction;
use App\Models\Withdrawal;
use App\Observers\DepositObserver;
use App\Observers\UserObserver;
use App\Observers\WalletTransactionObserver;
use App\Observers\WithdrawalObserver;
use BeyondCode\Vouchers\Events\VoucherRedeemed;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ReceivedFundRequestEvent::class => [
            SendReceivedFundRequestNotification::class,
        ],
        SentFundRequestAcceptedEvent::class => [
            SendAcceptedFundRequestNotification::class,
        ],
        SentFundRequestRejectedEvent::class => [
            SendRejectedFundRequestNotification::class,
        ],
        VoucherRedeemed::class => [
            VoucherRedeemedListener::class
        ],
        ComplaintMessageCreatedEvent::class => [
            SendComplaintMessageCreatedPushNotification::class
        ],
        WithdrawalUpdatedEvent::class => [
            WithdrawalUpdatedPushNotification::class
        ],
        UserEventCreated::class => [
            UserEventCreatedNotificationListener::class
        ],
        WalletLimitBreachedEvent::class => [
//            WalletLimitBreachedNotificationListener::class,
            WalletLimitBreachedEventLoggerListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);

        Deposit::observe(DepositObserver::class);

        WalletTransaction::observe(WalletTransactionObserver::class);

        Withdrawal::observe(WithdrawalObserver::class);
    }
}
