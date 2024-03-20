<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\TransferLimitScheme;
use App\Models\User;
use Illuminate\Http\Request;

class TransferLimitSchemeController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(TransferLimitScheme::class, 'transfer_limit_scheme');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->request_origin == 'web')
            return datatables(TransferLimitScheme::all())->toJson();

        return ResponseFormatter::success(TransferLimitScheme::all(), 'Transfer limit scheme');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'eligible_limit_per_day' => 'required|numeric|lt:eligible_limit_per_month',
            'eligible_limit_per_month' => 'required|numeric|gt:eligible_limit_per_day',
            'name' => 'required|unique:transfer_limit_schemes,name',
        ], [
            'eligible_limit_per_day.lt' => 'Per day limit has to be less then limit per month',
            'eligible_limit_per_month.gt' => 'Per month limit has to be greater then limit per day'
        ]);

        $limit = TransferLimitScheme::create($request->all());

        return ResponseFormatter::success($limit, 'Transfer limit created succesfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TransferLimitScheme $transferLimitScheme
     * @return \Illuminate\Http\Response
     */
    public function show(TransferLimitScheme $transferLimitScheme)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TransferLimitScheme $transferLimitScheme
     * @return \Illuminate\Http\Response
     */
    public function edit(TransferLimitScheme $transferLimitScheme)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\TransferLimitScheme $transferLimitScheme
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransferLimitScheme $transferLimitScheme)
    {
        $this->validate($request, [
            'eligible_limit_per_day' => 'nullable|numeric|lt:eligible_limit_per_month|gte:' . $transferLimitScheme->eligible_limit_per_day,
            'eligible_limit_per_month' => 'nullable|numeric|gt:eligible_limit_per_day|gte:' . $transferLimitScheme->eligible_limit_per_month,
            'name' => 'nullable|unique:transfer_limit_schemes,name',
        ], [
            'eligible_limit_per_day.lt' => 'Per day limit has to be less then limit per month',
            'eligible_limit_per_month.gt' => 'Per month limit has to be greater then limit per day',
            'eligible_limit_per_day.gte' => 'Per day limit has to be greater then previous limit set :' . $transferLimitScheme->eligible_limit_per_day,
            'eligible_limit_per_month.gte' => 'Per month limit has to be greater then previous limit set :' . $transferLimitScheme->eligible_limit_per_month
        ]);


        $transferLimitScheme->eligible_limit_per_day = $request->eligible_limit_per_day ? $request->eligible_limit_per_day : $transferLimitScheme->eligible_limit_per_day;
        $transferLimitScheme->eligible_limit_per_month = $request->eligible_limit_per_month ? $request->eligible_limit_per_month : $transferLimitScheme->eligible_limit_per_month;
        $transferLimitScheme->name = $request->name ? $request->name : $transferLimitScheme->name;

        $transferLimitScheme->save();
        return ResponseFormatter::success($transferLimitScheme, 'Limit updated succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TransferLimitScheme $transferLimitScheme
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransferLimitScheme $transferLimitScheme)
    {
        $limitAssingedUserCount = User::where('transfer_limit_scheme_id', $transferLimitScheme->id)->count();

        if ($limitAssingedUserCount)
            return ResponseFormatter::error([], 'Transfer limit scheme already assigned to ' . $limitAssingedUserCount . ' users ! Please proceed with changing user limit scheme to another scheme first', 400, 1025);

        $transferLimitScheme->delete();

        return ResponseFormatter::success([], 'Transfer limit scheme deleted sucesfully');
    }

    public function showSchemesPage()
    {
        return view('Settings.scheme_list');
    }
}
