<?php

namespace App\Http\Controllers;

use App\Helpers\FileHelper;
use App\Helpers\ResponseFormatter;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\BillerUpdateRequest;
use App\Models\Biller;
use App\Models\BillerCategory;
use Illuminate\Http\Request;

class BillerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $biller = Biller::with('billerCategory', 'user:id,first_name,last_name,pacpay_user_id,user_type_id,username,mobile_no,wallet_id', 'user.wallet')->filter($request->all());

        if ($request->request_origin == 'web')
            return datatables($biller)->toJson();

        return ResponseFormatter::success($biller->paginate($request->per_page), 'Biller list');
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
        //
        /*Created in usercontroller*/
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Biller $biller
     * @return \Illuminate\Http\Response
     */
    public function show(Biller $biller)
    {
        $biller->load('user.wallet');
        return ResponseFormatter::success($biller, 'Biller details');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Biller $biller
     * @return \Illuminate\Http\Response
     */
    public function edit(Biller $biller)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Biller $biller
     * @return \Illuminate\Http\Response
     */
    public function update(BillerUpdateRequest $request, Biller $biller)
    {

        $billerFields = $request->validated();

        foreach ($billerFields['biller_fields']['fields'] as &$field) {
            if (!isset($field['check_regex'])) {
                $field['check_regex'] = false;
            }
            if ($field['check_regex'] == '1')
                $field['check_regex'] = true;
            else
                $field['check_regex'] = false;
        }

        if(isset($billerFields['biller_img_base64']))
            $billerFields['biller_img_url'] = (new FileHelper())->storeBase64FileOnS3($billerFields['biller_img_base64'], 'biller_logos');


        $biller->update($billerFields);

        return ResponseFormatter::success($biller->refresh(), 'Biller update succesful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Biller $biller
     * @return \Illuminate\Http\Response
     */
    public function destroy(Biller $biller)
    {
        //
    }

    public function showBillerListPage()
    {
        return view('BillPayment.bill_payment');
    }

    public function getCategory(AdminRequest $request)
    {

        $data = BillerCategory::all();

        if ($request->request_origin == 'web')
            return datatables($data)->toJson();

        return ResponseFormatter::success($data, 'Biller categories');
    }


    public function storeCategory(AdminRequest $request)
    {

        $this->validate($request, ['category_name' => 'required']);

        BillerCategory::create(['category_name' => $request->category_name]);

        return ResponseFormatter::success([], 'Biller category created successfully');
    }

    public function showBillerCategory()
    {
        return view('BillPayment.biller_service_category');
    }
}
