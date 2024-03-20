<?php

namespace App\ModelFilters;

use App\Models\Agent;
use App\Models\BillPayment;
use App\Models\Deposit;
use App\Models\FundRequest;
use App\Models\User;
use App\Models\Withdrawal;
use Carbon\Carbon;
use EloquentFilter\ModelFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class WalletTransactionFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = ['transaction' => ['name'], 'user' => ['user_type_id']];
    protected $camel_cased_methods = false;
    protected $drop_id = false;

    function user_id($id)
    {
        return $this->where('user_id', $id);

    }

    function from_date($date)
    {
        return $this->where('created_at', '>=', Carbon::parse($date)->startOfDay());

    }

    function to_date($date)
    {
        return $this->where('created_at', '<=', Carbon::parse($date)->endOfDay());

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
                    BillPayment::class => [
                        'user:id,first_name,last_name,pacpay_user_id,user_type_id',
                        'biller_user:users.id,first_name,last_name,pacpay_user_id,user_type_id'
                    ],
                    FundRequest::class => [
                        'requesterUser:id,first_name,last_name,pacpay_user_id,user_type_id',
                        'senderUser:id,first_name,last_name,pacpay_user_id,user_type_id'
                    ],
                    Deposit::class => ['agent_user:users.id,first_name,last_name,pacpay_user_id,user_type_id', 'user:id,first_name,last_name,pacpay_user_id,user_type_id'],
                    Withdrawal::class => ['agent_user:users.id,first_name,last_name,pacpay_user_id,user_type_id', 'user:id,first_name,last_name,pacpay_user_id,user_type_id']
                ]);
            }]);
    }

    function txn_id_equals($txnId)
    {
        return $this->where('transaction_id', $txnId)
            ->with(['transaction' => function (MorphTo $morphTo) {
                $morphTo->morphWith([
                    BillPayment::class => [
                        'user:id,first_name,last_name,pacpay_user_id,user_type_id',
                        'biller_user:users.id,first_name,last_name,pacpay_user_id,user_type_id'
                    ],
                    FundRequest::class => [
                        'requesterUser:id,first_name,last_name,pacpay_user_id,user_type_id',
                        'senderUser:id,first_name,last_name,pacpay_user_id,user_type_id'
                    ],
                    Deposit::class => ['agent_user:users.id,first_name,last_name,pacpay_user_id,user_type_id', 'user:id,first_name,last_name,pacpay_user_id,user_type_id'],
                    Withdrawal::class => ['agent_user:users.id,first_name,last_name,pacpay_user_id,user_type_id', 'user:id,first_name,last_name,pacpay_user_id,user_type_id']
                ]);
            }]);
    }

    function search_user_id($id)
    {

        return $this->whereHasMorph(
            'transaction',
            [FundRequest::class, BillPayment::class, Deposit::class, Withdrawal::class],
            function (Builder $query, $type) use ($id) {
                switch ($type) {
                    case FundRequest::class :
                        $que = $query->where('requester_user_id', $id)->orWhere('sender_user_id', $id);
                        break;
                    case BillPayment::class :
                        $que = $query->whereHas('biller_user', function ($q) use ($id) {
                            $q->where('users.id', $id);
                        });
                        break;
                    case Deposit::class :
                        $que = $query->whereHas('agent_user', function ($q) use ($id) {
                            $q->where('users.id', $id);
                        });
                        break;
                    case Withdrawal::class :
                        $que = $query->whereHas('agent_user', function ($q) use ($id) {
                            $q->where('users.id', $id);
                        });
                        break;
                    default:
                        $que = $query->whereNull('user_id');
                }
                return $que;
            }
        )->with('transaction');
    }
}
