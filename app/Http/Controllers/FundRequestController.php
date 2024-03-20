<?php

namespace App\Http\Controllers;

use App\Enums\FundRequestStatus;
use App\Enums\FundRequestType;
use App\Exceptions\FundRequestAlreadyProcessedException;
use App\Helpers\ResponseFormatter;
use App\Helpers\UserType;
use App\Helpers\Utils;
use App\Http\Requests\AcceptFundRequest;
use App\Http\Requests\CreateFundRequestRequest;
use App\Http\Requests\SendFundsDirectRequest;
use App\Models\FundRequest;
use App\Models\User;
use App\Services\FundRequestService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FundRequestController extends Controller
{
    function index(Request $request)
    {
        $request->validate([
            'is_received_or_sent' => 'required|in:received,sent',
            'from_date' => 'nullable|date_format:Y-m-d',
            'to_date' => 'nullable|date_format:Y-m-d',
            'status' => 'nullable|in:ACCEPTED,REQUESTED,REJECTED',
            'type' => 'nullable|in:DIRECT,REQUEST'
        ]);

        $user = (Auth::user()->user_type_id == UserType::Staff) ? #If staff managing the request
            User::where('user_type_id', UserType::Admin)->first() #Its the admin funds requests which need to be shown
            : Auth::user(); #Else show the authenticated users fund requests

        $receivedOrSentFilter = ($request->is_received_or_sent == 'received') ? ['sender_user_id' => $user->id]
            : ['requester_user_id' => $user->id];

        $fundRequestQuery = (new FundRequestService())->getFundRequest($request->all() + $receivedOrSentFilter)
            ->with([
                'senderUser:id,pacpay_user_id,first_name,last_name,user_type_id,profile_pic_img_url,username',
                'requesterUser:id,pacpay_user_id,first_name,last_name,user_type_id,profile_pic_img_url,username',
                'adminBankDetail'
            ])
            ->orderBy('id', 'desc');


        if ($request->request_origin == 'web')
            return datatables($fundRequestQuery)->toJson();

        return ResponseFormatter::success($fundRequestQuery->paginate($request->per_page), 'Fund request details');
    }

    function create(CreateFundRequestRequest $request)
    {

        $fundRequest = (new FundRequestService())->createFundRequest($request->validated() + ['requester_user_id' => Auth::user()->id]);

        return ResponseFormatter::success($fundRequest->only('fund_request_id', 'id'), 'Fund request sent');
    }

    function accept(AcceptFundRequest $request, FundRequest $fundrequest)
    {
        $this->authorize('update', $fundrequest);

        if ($fundrequest->status != FundRequestStatus::REQUESTED)
            throw new FundRequestAlreadyProcessedException();

        if (Utils::check_transaction_pin($request->transaction_pin))
            $fundRequest = (new FundRequestService())->acceptFundRequest($fundrequest);

        return ResponseFormatter::success($fundRequest->only('fund_request_id', 'id'), 'Fund request accepted');
    }

    function reject(Request $request, FundRequest $fundrequest)
    {
        $this->authorize('update', $fundrequest);


        if ($fundrequest->status != FundRequestStatus::REQUESTED)
            throw new FundRequestAlreadyProcessedException();


        $fundRequest = (new FundRequestService())->rejectFundRequest($fundrequest, $request->reject_remark);

        return ResponseFormatter::success($fundRequest->only('fund_request_id', 'id'), 'Fund request rejected');
    }

    function sendFundsDirectly(SendFundsDirectRequest $request)
    {

        if (Utils::check_transaction_pin($request->transaction_pin))
            $sendFunds = (new FundRequestService())->sendFundsDirect($request->validated() + [
                    'sender_user_id' => (Auth::user()->user_type_id == UserType::Staff) ? #If staff managing the request
                        User::where('user_type_id', UserType::Admin)->first()->id #Send the admins id as fund request sender id
                        : Auth::user()->id #Else send the authenticated users id
                ]);


        return ResponseFormatter::success($sendFunds->only('fund_request_id', 'id'), 'Funds sent');
    }


    public function showFundRequestPage()
    {
        return view('Reports.fund_request');
    }
}
