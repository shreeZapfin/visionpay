<?php

namespace App\Http\Controllers;

use App\Enums\UserType;
use App\Events\ComplaintMessageCreatedEvent;
use App\Helpers\ResponseFormatter;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\CustomerRequest;
use App\Http\Requests\ResolveComplaintRequest;
use App\Models\Complaint;
use App\Models\ComplaintMessage;
use App\Models\ComplaintType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $complaints = Complaint::with('walletTransaction.transaction', 'complaintType')
            ->byUser(Auth::user())
            ->filter($request->all())
            ->orderBy('id', 'desc');

        if ($request->request_origin == 'web')
            return datatables($complaints)->toJson();

        return ResponseFormatter::success($complaints->paginate($request->per_page), 'Complaints raised list');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {

        $userId = ($request->user_id) ? $request->user_id : Auth::user()->id;

        $this->validate($request, [
            'complaint_type_id' => 'required',
            'transaction_id' => 'nullable|unique:complaints,transaction_id',
            'user_complaint_description' => 'required',
            'user_id' => 'nullable|exists:users,id'
        ]);

        if ($request->transaction_id == null) {
            $complaintTypeCount = ComplaintType::where('id', $request->complaint_type_id)
                ->where('transaction_type', '<>', 'GENERAL_COMPLAINT')
                ->count();

            if ($complaintTypeCount)
                throw ValidationException::withMessages(['transaction_id' => 'Transaction id is required when complaint type id is not General complaint !']);
        }


        $complaint = Complaint::create([
            'complaint_type_id' => $request->complaint_type_id,
            'transaction_id' => $request->transaction_id,
            'user_complaint_description' => $request->user_complaint_description,
            'complaint_status' => 'PENDING',
            'user_id' => $userId
        ]);

        ComplaintMessage::create([
            'complaint_id' => $complaint->id,
            'message_from_user_id' =>  $userId,
            'message_to_user_id' => User::where('user_type_id', UserType::Admin)->first()->id,
            'message' => $request->user_complaint_description
        ]);

        return ResponseFormatter::success($complaint, 'Complaint raise successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Complaint $complaint
     * @return \Illuminate\Http\Response
     */
    public function show(Complaint $complaint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Complaint $complaint
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Complaint $complaint)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Complaint $complaint
     * @return \Illuminate\Http\Response
     */
    public function resolveComplaint(ResolveComplaintRequest $request, Complaint $complaint)
    {
        $complaint->complaint_status = 'RESOLVED';
        $complaint->admin_resolution_description = $request->resolution_description;
        $complaint->resolved_at = now();
        $complaint->resolved_by = Auth::user()->id;
        $complaint->save();

        return ResponseFormatter::success($complaint, 'Complaint resolved success');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Complaint $complaint
     * @return \Illuminate\Http\Response
     */
    public function destroy(Complaint $complaint)
    {
        //
    }

    public function updateComplaintMessage(Request $request, Complaint $complaint)
    {
        $this->authorize('addMessage', $complaint);
        $message = ComplaintMessage::create([
            'complaint_id' => $complaint->id,
            'message_from_user_id' => Auth::user()->id,
            'message_to_user_id' => (Auth::user()->is_admin) ? $complaint->user_id : User::where('user_type_id', UserType::Admin)->first()->id,
            'message' => $request->message
        ]);
        ComplaintMessageCreatedEvent::dispatch($message);

        return ResponseFormatter::success($complaint, 'Complaint message sent');
    }


    public function getComplaintMessages(Request $request, Complaint $complaint)
    {

        $this->authorize('viewMessage', $complaint);
        $complaintMessages = ComplaintMessage::where('complaint_id', $complaint->id)->orderByDesc('id');

        if ($request->request_origin == 'web')
            return datatables($complaintMessages)->toJson();

        return ResponseFormatter::success($complaintMessages->paginate($request->per_page), 'Complaint message list');
    }


    public function showComplaintListPage()
    {
        return view('Complaint.complaint_list');
    }

    public function msg(User $complaint)
    {
        return view('Complaint.chat')->with('complaintDetails', $complaint);
    }
}
