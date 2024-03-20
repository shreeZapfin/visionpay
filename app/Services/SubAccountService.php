<?php
/**
 * Created by PhpStorm.
 * User: GameBoY
 * Date: 12-Mar-22
 * Time: 1:42 AM
 */

namespace App\Services;


use App\Enums\UserType;
use App\Exceptions\InsufficientWalletBalanceException;
use App\Exceptions\InsufficientWithdrawalableBalanceException;
use App\Models\SubAccountWallet;
use App\Models\User;

class SubAccountService
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    function viewMySubAccounts($filters)
    {
        $subUsers = $this->user->sub_accounts()->with('wallet');
        return $subUsers->when(isset($filters['username']), function ($q) use ($filters) {
            $q->where('username', 'LIKE', $filters['username'].'%');
        });
    }

    function createSubAccount($arr)
    {
        $arr['user_type_id'] = UserType::SubAccount;
        $arr['master_account_user_id'] = $this->user->id;
        return (new UserService())->addUser($arr);
    }

    function collectFundsFromSub(User $subAccountUser)
    {
        $subAccountUser->load('wallet');

        if ($subAccountUser->wallet->balance == 0)
            throw new InsufficientWalletBalanceException();

        $arr = [
            'amount' => $subAccountUser->wallet->balance,
            'sender_user_id' => $subAccountUser->id,
            'send_to' => $subAccountUser->master_account_user_id,
            'description' => 'Collect request',
            'is_sub_account_request' => true,
        ];

        $sendFunds = (new FundRequestService())->sendFundsDirect($arr);

        return $sendFunds;
    }

    function updateSubAccounts($arr)
    {
        $subAccounts = $this->user->sub_accounts();

        $subAccounts->orderBy('id')->chunk(10, function ($users) use ($arr) {
            foreach ($users as $user) {
                (new UserService())->updateUser($user, $arr);
            }
        });
    }


}