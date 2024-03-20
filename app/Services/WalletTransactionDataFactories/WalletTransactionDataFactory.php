<?php
/**
 * Created by PhpStorm.
 * User: GameBoY
 * Date: 03-Sep-21
 * Time: 2:08 AM
 */

namespace App\Services\WalletTransactionDataFactories;


class WalletTransactionDataFactory
{

    function getDataFactory($type){
        if($type=='inflow_outflow')
            return (new InflowOutFlowWalletTransactionDataFactory());
        if($type=='master_transaction_list')
            return (new MasterTransactionListDataFactory());

    }

}