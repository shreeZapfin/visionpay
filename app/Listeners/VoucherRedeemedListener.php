<?php

namespace App\Listeners;

use App\Classes\Transaction\CashbackReceivedOnTransaction;
use BeyondCode\Vouchers\Events\VoucherRedeemed;
use Illuminate\Support\Facades\Log;

class VoucherRedeemedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    private $voucher;
    private $user;

    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  VoucherRedeemed $event
     * @return void
     */
    public function handle(VoucherRedeemed $voucherRedeemed)
    {

        Log::info('Voucher reedemed by user id '.$voucherRedeemed->user->id .' code : '.$voucherRedeemed->voucher->code);

    }
}
