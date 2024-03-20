<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Http\Requests\AdminRequest;
use App\Models\SystemSetting;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;

class SystemSettingController extends Controller
{
    function index()
    {
        return ResponseFormatter::success(SystemSetting::all());
    }

    function update(AdminRequest $request)
    {

        $this->validate($request, [
            'agent_withdrawal_charges.max_charge' => 'required|gt:agent_withdrawal_charges.min_charge|numeric',
            'agent_withdrawal_charges.min_charge' => 'required|lt:agent_withdrawal_charges.max_charge|numeric',
            'bank_withdrawal_charges.max_charge' => 'required|gt:bank_withdrawal_charges.min_charge|numeric',
            'bank_withdrawal_charges.min_charge' => 'required|lt:bank_withdrawal_charges.max_charge|numeric',
            'withdrawal_ranges.*.max_range' => 'required|numeric',
            'withdrawal_ranges.*.min_range' => 'required|numeric',
            'withdrawal_ranges.*.commission' => 'required|numeric',
            'monthly_customer_deposit_limit' => 'required|numeric',
            'monthly_merchant_deposit_limit' => 'required|numeric',
            'agent_deposit_commission' => 'required|numeric',
            'daily_withdrawal_limit' => 'required|numeric',
            'min_withdrawal_limit' => 'required|numeric'
        ]);
        if (!$this->validateWithdrawalRanges($request->withdrawal_ranges))
            throw \Illuminate\Validation\ValidationException::withMessages([
                'withdrawal_ranges' => ['The max amount of previous range must be 1 less then min amount of next range.'],
            ]);

        $settings = SystemSetting::first();

        $settings->withdrawal_charges = ['agent_withdrawal_charges' => $request->agent_withdrawal_charges, 'bank_withdrawal_charges' => $request->bank_withdrawal_charges];
        $settings->withdrawal_commission_tiers = ['withdrawal_ranges' => $request->withdrawal_ranges];
        $settings->monthly_customer_deposit_limit = $request->monthly_customer_deposit_limit;
        $settings->monthly_merchant_deposit_limit = $request->monthly_merchant_deposit_limit;
        $settings->agent_deposit_commission = $request->agent_deposit_commission;
        $settings->daily_withdrawal_limit = $request->daily_withdrawal_limit;
        $settings->min_withdrawal_limit = $request->min_withdrawal_limit;
        $settings->save();

        return ResponseFormatter::success($settings, 'Update settings success');
    }


    function validateWithdrawalRanges($ranges)
    {
        $rangeCollect = collect($ranges)
            ->sortBy('min_range');
        $isValid = true;

        if ($rangeCollect->first()['min_range'] < 0)
            return false;


        $rangeCollect->each(function ($range, $index) use ($rangeCollect, &$isValid) {
            if (isset($rangeCollect[$index + 1]['min_range']))
                if (($range['max_range'] + 1) != $rangeCollect[$index + 1]['min_range']) {
                    $isValid = false;
                }
        });
        return $isValid;
    }

    public function showSystemSettingsPage()
    {
        $systemsettings = SystemSetting::first();
        return view('Settings.system_settings', compact('systemsettings'));
    }
}
