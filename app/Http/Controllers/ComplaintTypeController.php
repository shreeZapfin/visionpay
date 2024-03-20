<?php

namespace App\Http\Controllers;

use App\Enums\WalletTransactionType;
use App\Helpers\ResponseFormatter;
use App\Http\Requests\AdminRequest;
use App\Models\ComplaintType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ComplaintTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $query = ComplaintType::query();
        $transactionType = $request->transaction_type;
        $query->when(($transactionType != null), function ($query) use($transactionType) {
            return $query->where('transaction_type', $transactionType);
        }, function ($query) {
            return $query;
        });

        if ($request->request_origin == 'web')
            return datatables($query)->toJson();

        return ResponseFormatter::success($query->paginate($request->per_page), 'Complaint types');
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
            'transaction_type' => Rule::in(array_merge(WalletTransactionType::getValues(), ['GENERAL_COMPLAINT'])),
            'type_description' => 'required'
        ]);


        $complaintType = ComplaintType::create($request->all());

        return ResponseFormatter::success($complaintType, 'Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ComplaintType $complaintType
     * @return \Illuminate\Http\Response
     */
    public function show(ComplaintType $complaintType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\ComplaintType $complaintType
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRequest $request, ComplaintType $complaintType)
    {
        $complaintType->transaction_type = $request->transaction_type;
        $complaintType->type_description = $request->type_description;
        $complaintType->save();
        return ResponseFormatter::success($complaintType, 'Update success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ComplaintType $complaintType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ComplaintType $complaintType)
    {
        //
    }

    public function showComplaintTypePage()
    {
        return view('Complaint.complaint_type_list');
    }
}
