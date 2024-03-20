<?php

namespace App\Observers;

use App\Events\WithdrawalUpdatedEvent;
use App\Models\Withdrawal;

class WithdrawalObserver
{
    /**
     * Handle the Withdrawal "created" event.
     *
     * @param  \App\Models\Withdrawal $withdrawal
     * @return void
     */
    public function created(Withdrawal $withdrawal)
    {
        WithdrawalUpdatedEvent::dispatch($withdrawal);
    }

    /**
     * Handle the Withdrawal "updated" event.
     *
     * @param  \App\Models\Withdrawal $withdrawal
     * @return void
     */
    public function updated(Withdrawal $withdrawal)
    {
        WithdrawalUpdatedEvent::dispatch($withdrawal);
    }

    /**
     * Handle the Withdrawal "deleted" event.
     *
     * @param  \App\Models\Withdrawal $withdrawal
     * @return void
     */
    public function deleted(Withdrawal $withdrawal)
    {
        //
    }

    /**
     * Handle the Withdrawal "restored" event.
     *
     * @param  \App\Models\Withdrawal $withdrawal
     * @return void
     */
    public function restored(Withdrawal $withdrawal)
    {
        //
    }

    /**
     * Handle the Withdrawal "force deleted" event.
     *
     * @param  \App\Models\Withdrawal $withdrawal
     * @return void
     */
    public function forceDeleted(Withdrawal $withdrawal)
    {
        //
    }
}
