<?php
/**
 * Created by PhpStorm.
 * User: GameBoY
 * Date: 21-Jul-21
 * Time: 11:47 PM
 */

namespace App\Classes\Transaction;


use App\Enums\WalletTransactionType;
use App\Models\FundRequest;

class WalletTransferTransaction implements TransactionInterface
{
    protected $transactionId;
    protected $description;
    protected $amount;

    public function __construct(FundRequest $fundRequest)
    {
        $fundRequest->load('senderUser', 'requesterUser');
        $this->transactionId = $fundRequest->fund_request_id;
        $this->amount = $fundRequest->amount;
        $this->description = 'Fund transfer from ' . $fundRequest->senderUser->full_name . ' to ' . $fundRequest->requesterUser->full_name;

    }

    function get_transaction_details(): array
    {
        return [
            'transaction_id' => $this->transactionId,
            'description' => $this->description,
            'amount' => $this->amount,
            'transaction_type' => WalletTransactionType::WALLET_TRANSFER
        ];

    }

}