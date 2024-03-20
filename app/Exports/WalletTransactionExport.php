<?php

namespace App\Exports;

use App\Models\AgentWalletTransaction;
use App\Models\WalletTransaction;
use App\Services\AgentWalletService;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithCustomChunkSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class WalletTransactionExport implements FromQuery,WithHeadings, WithMapping, WithCustomChunkSize
{
    use Exportable;
    private $query;

    public function __construct($query)
    {
        if($query->getModel() instanceof AgentWalletTransaction)
            $this->query = $query->with('agentWallet.agent.user');
        else
            $this->query = $query->with('user');
    }


    public function query()
    {
        return $this->query;
    }

    public function map($walletTxn): array
    {

        return [
            $walletTxn->created_at,
            $walletTxn->opening_balance,
            $walletTxn->credit_amount,
            $walletTxn->debit_amount,
            $walletTxn->closing_balance,
            $walletTxn->transaction_id,
            $walletTxn->transaction_type,
            ($walletTxn instanceof WalletTransaction) ? $walletTxn->user->username : $walletTxn->agentWallet->agent->user->username,
            $walletTxn->description,
        ];
    }


    public function headings(): array
    {
        return [
            'DATE_TIME',
            'OPENING_BALANCE',
            'CREDIT_AMT',
            'DEBIT_AMT',
            'CLOSING_BALANCE',
            'TXN_ID',
            'TXN_TYPE',
            'USER',
            'DESCRIPTION',
        ];
    }


    public function chunkSize(): int
    {
        return 500;
    }

}
