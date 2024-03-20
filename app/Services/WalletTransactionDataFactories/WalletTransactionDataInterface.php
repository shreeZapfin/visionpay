<?php
/**
 * Created by PhpStorm.
 * User: GameBoY
 * Date: 03-Sep-21
 * Time: 2:07 AM
 */

namespace App\Services\WalletTransactionDataFactories;


interface WalletTransactionDataInterface
{

    function getData($walletTransactionQuery,$filters);

}