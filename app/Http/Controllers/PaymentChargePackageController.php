<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Http\Requests\AdminRequest;
use App\Models\PaymentChargePackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PaymentChargePackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $package = PaymentChargePackage::byUser(Auth::user())
            ->when($request->package_type, function ($query) use ($request) {
                return $query->where('package_type', $request->package_type);
            });

        if ($request->request_origin == 'web')
            return datatables($package)->toJson();


        return ResponseFormatter::success($package, 'Payment charge packages list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(AdminRequest $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request)
    {
        $this->validate($request, [
            'package_type' => 'required|in:P2P_PAYMENT,MERCHANT_PAYMENT,BILL_PAYMENT',
            'package_name' => 'required|unique:payment_charge_packages,package_name',
            'payment_charges.max_charge' => 'required|numeric',
            'payment_charges.min_charge' => 'required|numeric',
            'payment_charges.percentage_charge' => 'required|numeric',
        ]);

        $pakage = PaymentChargePackage::create([
            'package_type' => $request->package_type,
            'charges' => ['payment_charges' => $request->payment_charges],
            'package_name' => $request->package_name,
            'is_default' => false
        ]);

        return ResponseFormatter::success($pakage, 'Package created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  PaymentChargePackage $package
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRequest $request, PaymentChargePackage $paymentChargePackage)
    {
        $this->validate($request, [
            //            'package_type' => 'required|in:P2P_PAYMENT,MERCHANT_PAYMENT,BILL_PAYMENT',
            'package_name' => ['required', Rule::unique('payment_charge_packages')->ignore($paymentChargePackage)],
            'payment_charges.max_charge' => 'required|numeric|gt:payment_charges.min_charge',
            'payment_charges.min_charge' => 'required|numeric|lt:payment_charges.max_charge',
            'payment_charges.percentage_charge' => 'required|numeric',
        ]);

        $paymentChargePackage->update([
            'charges' => ['payment_charges' => $request->payment_charges],
            'package_name' => $request->package_name,
        ]);

        return ResponseFormatter::success($paymentChargePackage, 'Package update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function setAsDefault(AdminRequest $request, PaymentChargePackage $package)
    {
        $this->validate($request, [
            'package_type' => 'required|in:P2P_PAYMENT,MERCHANT_PAYMENT,BILL_PAYMENT',
        ]);

        if ($package->package_type != $request->package_type)
            throw new \Exception('Package_type and id do not match', 400);

        $package->is_default = true;

        PaymentChargePackage::where('package_type', $request->package_type)->update(['is_default' => false]);

        $package->save();

        return ResponseFormatter::success($package, 'Package set as default for package type successfully');
    }

    public function showPaymentChargePackagePage()
    {
        return view('Settings.payment_charge_package');
    }
}
