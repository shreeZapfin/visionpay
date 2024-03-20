<?php

namespace App\ModelFilters;

use App\Models\Deposit;
use App\Models\FundRequest;
use App\Models\Withdrawal;
use EloquentFilter\ModelFilter;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class AgentWalletTransactionFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
//    public $relations = ['transaction' => ['name']];
    protected $camel_cased_methods = false;
    protected $drop_id = false;

    function user_id($id)
    {
        return $this->whereHas('agentWallet', function ($query) use ($id) {
            $query->whereHas('agent', function ($query) use ($id) {
                $query->where('user_id', $id);
            });
        });
    }

    function from_date($date)
    {
        return $this->where('created_at', '>=', $date);

    }

    function to_date($date)
    {
        return $this->where('created_at', '<=', $date);

    }

    function txn_type($txnType)
    {
        return $this->where('transaction_type', $txnType);

    }

    function debit_amount_gt($amount)
    {
        return $this->where('debit_amount', '>', $amount);

    }

    function debit_amount_lt($amount)
    {
        return $this->where('debit_amount', '<', $amount);

    }

    function txn_id($txnId)
    {
        return $this->where('transaction_id', 'LIKE', $txnId . '%')
            ->with(['transaction' => function (MorphTo $morphTo) {
                $morphTo->morphWith([
                    FundRequest::class => [
                        'requesterUser:id,first_name,last_name,pacpay_user_id,user_type_id',
                        'senderUser:id,first_name,last_name,pacpay_user_id,user_type_id'
                    ],
                    Deposit::class => ['agent_user:users.id,first_name,last_name,pacpay_user_id,user_type_id', 'user:id,first_name,last_name,pacpay_user_id,user_type_id'],
                    Withdrawal::class => ['agent_user:users.id,first_name,last_name,pacpay_user_id,user_type_id', 'user:id,first_name,last_name,pacpay_user_id,user_type_id']
                ]);
            }]);
    }

    function wallet_type($type)
    {
        return $this->whereHas('agentWallet', function ($query) use ($type) {
            $query->where('wallet_type', $type);
        });
    }

}
