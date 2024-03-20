<?php

namespace App\Events;

use App\Models\AgentWallet;
use App\Services\WalletServiceFactory;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class WalletLimitBreachedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $wallet, $txnDetails, $limit_breached_user;

    public function __construct($wallet, array $txnDetails)
    {
        $this->wallet = $wallet;
        $this->txnDetails = $txnDetails;
        if ($wallet instanceof AgentWallet)
            $this->limit_breached_user = $wallet->agent->user;
        else
            $this->limit_breached_user = $wallet->user;
    }
}
