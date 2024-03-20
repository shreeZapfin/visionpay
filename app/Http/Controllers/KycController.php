<?php

namespace App\Http\Controllers;

use App\Helpers\FileHelper;
use App\Helpers\ResponseFormatter;
use App\Http\Requests\BusinessDocumentUploadRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KycController extends Controller
{
    function uploadKycDocument(Request $request, User $user)
    {
        $this->validate($request, [
            'kyc_document_image' => 'required|image',
            'kyc_document_type' => 'required|in:DRIVING_LICENSE,VOTERID,PASSPORT',
            'kyc_document_id' => 'required',
            'kyc_document_expiry_date' => 'required|date_format:Y-m-d'
        ]);

        //dd($request->all());
        $user->kyc_document_url = (new FileHelper())->storeFileOnS3($request->file('kyc_document_image'), 'kyc_documents');

        $user->kyc_document_type = $request->kyc_document_type;
        $user->kyc_document_id = $request->kyc_document_id;
        $user->kyc_document_expiry_date = $request->kyc_document_expiry_date;

        $user->save();
        return ResponseFormatter::success();
    }

    function uploadSelfieImage(Request $request, User $user)
    {
        $this->validate($request, [
            'selfie_image' => 'required|image',
        ]);

        $user->selfie_img_url = (new FileHelper())->storeFileOnS3($request->file('selfie_image'), 'selfie_images');

        $user->save();

        return ResponseFormatter::success();
    }


    function uploadCompanyTinImage(BusinessDocumentUploadRequest $request, User $user)
    {
        $this->validate($request, [
            'company_tin_image' => 'required|image',
        ]);
        $user->load('business');

        $user->business->company_tin_img_url = (new FileHelper())->storeFileOnS3($request->file('company_tin_image'), 'company_tin_images');

        $user->business->save();

        return ResponseFormatter::success();
    }

    function uploadCompanyRegistrationImage(BusinessDocumentUploadRequest $request, User $user)
    {
        $this->validate($request, [
            'company_reg_image' => 'required|image',
        ]);
        $user->load('business');
        $user->business->company_reg_img_url = (new FileHelper())->storeFileOnS3($request->file('company_reg_image'), 'company_registration_images');

        $user->business->save();

        return ResponseFormatter::success();
    }

    function uploadProfilePicImage(Request $request, User $user)
    {
        $this->validate($request, [
            'profile_pic_image' => 'required_without:profile_pic_base64|image',
            'profile_pic_base64' => 'required_without:profile_pic_image'
        ]);

        if (isset($request->profile_pic_image))
            $user->profile_pic_img_url = (new FileHelper())->storeFileOnS3($request->file('profile_pic_image'), 'profile-pics');
        else
            $user->profile_pic_img_url = (new FileHelper())->storeBase64FileOnS3($request->profile_pic_base64, 'profile-pics');

        $user->save();

        return ResponseFormatter::success();

    }

}
