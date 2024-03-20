<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Http\Requests\AdminRequest;
use App\Models\SourceOfIncome;
use Illuminate\Http\Request;

class SourceOfIncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ResponseFormatter::success(SourceOfIncome::all(), 'Sources of income');
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
    public function store(AdminRequest $request)
    {

        $si = SourceOfIncome::create(['source' => $request->source]);

        return ResponseFormatter::success($si, 'Source of income created succesfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SourceOfIncome $sourceOfIncome
     * @return \Illuminate\Http\Response
     */
    public function show(SourceOfIncome $sourceOfIncome)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SourceOfIncome $sourceOfIncome
     * @return \Illuminate\Http\Response
     */
    public function edit(SourceOfIncome $sourceOfIncome)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\SourceOfIncome $sourceOfIncome
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRequest $request, SourceOfIncome $sourceOfIncome)
    {
        $sourceOfIncome->source = $request->source;
        $sourceOfIncome->save();
        
        return ResponseFormatter::success($sourceOfIncome, 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SourceOfIncome $sourceOfIncome
     * @return \Illuminate\Http\Response
     */
    public function destroy(SourceOfIncome $sourceOfIncome)
    {
        //
    }
}
