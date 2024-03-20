<?php
/**
 * Created by PhpStorm.
 * User: GameBoY
 * Date: 03-Sep-21
 * Time: 2:10 AM
 */

namespace App\Services\WalletTransactionDataFactories;


use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InflowOutFlowWalletTransactionDataFactory implements WalletTransactionDataInterface
{

    function getData($walletTransactionQuery, $filters)
    {



        if ($filters['date_period'] == 'weekly') {

//          $data =  $walletTransactionQuery->selectRaw("
//            concat(date_format(created_at,'%M Week'),(WEEK(created_at, 3) -
//            WEEK(created_at - INTERVAL DAY(created_at)-1 DAY, 3) + 1))
//  AS date_period,(sum(credit_amount)) as total_inflow,(sum(debit_amount)) as total_outflow")
//                ->groupBy('date_period')
//                ->get();

            $data = $walletTransactionQuery->get()->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('W-Y');
            });


            $dailyArray = $this->generateWeeklyArray($filters['from_date'], $filters['to_date']);

            $dataFilledCollection = $dailyArray->merge($data);


            $populatedPeriodData = $this->populatePeriodData($dataFilledCollection);


        } else if ($filters['date_period'] == 'daily') {

//            $data =   $walletTransactionQuery->selectRaw("date_format(created_at,'%M %D %Y') as date_period,(sum(credit_amount)) as total_inflow,(sum(debit_amount)) as total_outflow")
//                ->groupByRaw('month(created_at),day(created_at)')
//                ->orderByRaw('month(created_at),day(created_at)')
//                ->get();


            $data = $walletTransactionQuery->get()->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('M-d-Y');
            });

            $dailyArray = $this->generateDailyArray($filters['from_date'], $filters['to_date']);

            $dataFilledCollection = $dailyArray->merge($data);

            $populatedPeriodData = $this->populatePeriodData($dataFilledCollection);


        } else if ($filters['date_period'] == 'monthly') {

//            $data =   $walletTransactionQuery->selectRaw("date_format(created_at,'%M %Y') as date_period,sum(credit_amount) as total_inflow,sum(debit_amount) as total_outflow")
//                ->groupByRaw('month(created_at),year(created_at)')
//                ->orderByRaw('month(created_at),year(created_at)')
//                ->get();


            $data = $walletTransactionQuery->get()->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('M-Y');
            });

            $monthlyArray = $this->generateMonthsArray($filters['from_date'], $filters['to_date']);

            $dataFilledCollection = $monthlyArray->merge($data);


            $populatedPeriodData = $this->populatePeriodData($dataFilledCollection);

        }

        return $populatedPeriodData;
    }


    function generateMonthsArray($fromDate, $toDate)
    {
        $period = CarbonPeriod::create(Carbon::parse($fromDate)->toDateString(), '1 month', Carbon::parse($toDate)->toDateString());

        $dates = new Collection();
        foreach ($period as $date) {
            $dates[$date->format('M-Y')] = new Collection();
        }
        return $dates;
    }


    function generateWeeklyArray($fromDate, $toDate)
    {
        $period = CarbonPeriod::create(Carbon::parse($fromDate)->toDateString(), '1 week', Carbon::parse($toDate)->toDateString());

        $dates = new Collection();
        foreach ($period as $date) {
            $dates[$date->format('W-Y')] = new Collection();
        }
        return $dates;
    }


    function generateDailyArray($fromDate, $toDate)
    {
        $period = CarbonPeriod::create(Carbon::parse($fromDate)->toDateString(), '1 day', Carbon::parse($toDate)->toDateString());

        $dates = new Collection();
        foreach ($period as $date) {
            $dates[$date->format('M-d-Y')] = new Collection();
        }
        return $dates;
    }


//    function captureNextPeriodOpeningBalanceIfEmpty($periods)
//    {
//
//        try {
//            foreach ($periods as $key => $period) {
//                Log::info($period);
//                if ($period->isEmpty()) {
//                    unset($periods[$key]);
//                    $this->captureNextPeriodOpeningBalanceIfEmpty($periods);
//                }
//
//                return collect([
//                    'opening_balance' => $period['opening_balance'],
//                    'closing_balance' => $period['opening_balance'],
//                    'total_inflow' => 0,
//                    'total_outflow' => 0
//                ]);
//
//            }
//        } catch (\Exception $exception) {
//
//           Log::error($exception);
//            dd($periods);
//
//        }
//    }


    function captureNextPeriodOpeningBalanceIfEmpty($periods, $dataCollected)
    {

        try {
            $nextPeriodsHavingData = $periods->filter(function ($value, $key) {
                if ($value->isNotEmpty())
                    return $value;
            });

            if ($nextPeriodsHavingData->isNotEmpty()) {
                return collect([
                    'opening_balance' => $nextPeriodsHavingData->first()->first()->opening_balance,
                    'closing_balance' => $nextPeriodsHavingData->first()->first()->opening_balance,
                    'total_inflow' => 0,
                    'total_outflow' => 0
                ]);
            } else {
                $prevPeriodsHavingData = $dataCollected->filter(function ($value, $key) {
                    if ($value->isNotEmpty())
                        return $value;
                });

                return collect([
                    'opening_balance' => $prevPeriodsHavingData->last()['closing_balance'],
                    'closing_balance' => $prevPeriodsHavingData->last()['closing_balance'],
                    'total_inflow' => 0,
                    'total_outflow' => 0
                ]);
            }
        } catch (\Exception $exception) {

            Log::error($exception);
            dd($periods);

        }
    }

    function populatePeriodData($dataFilledCollection)
    {
        $index = 0;

        foreach ($dataFilledCollection as $key => $entry) {

            if ($entry->isEmpty()) {
                $dataFilledCollection[$key] = $this->captureNextPeriodOpeningBalanceIfEmpty($dataFilledCollection->slice($index), $dataFilledCollection);
            } else {
                $dataFilledCollection[$key] = collect([
                    'opening_balance' => $entry->first()->opening_balance,
                    'closing_balance' => $entry->last()->closing_balance,
                    'total_inflow' => $entry->sum('credit_amount'),
                    'total_outflow' => $entry->sum('debit_amount')
                ]);
            }
            $index++;

        }


        return $dataFilledCollection;
    }

}