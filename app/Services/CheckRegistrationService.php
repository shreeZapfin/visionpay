<?php
/**
 * Created by PhpStorm.
 * User: GameBoY
 * Date: 16-Jul-21
 * Time: 4:28 AM
 */

namespace App\Services;


use App\Enums\UserType;
use App\Models\User;

class CheckRegistrationService
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;

    }


    function checkIfUserRegistrationComplete()
    {
        if ($this->checkIfBasicDetailsCompleted() AND
            $this->checkIfKycDocumentUploaded() AND
            $this->checkIfSelfieImageUploaded())
            return true;

        return false;

    }

    function checkIfBasicDetailsCompleted()
    {
        if ($this->user->first_name == null || $this->user->last_name == null ||
            $this->user->date_of_birth == null || $this->user->gender == null ||
            $this->user->address == null || $this->user->transaction_pin == null || $this->user->city_id == null)
            return false;

        if (in_array($this->user->user_type_id, [UserType::Agent, UserType::Merchant])) {
            if ($this->checkIfBusinessDetailsCompleted())
//                if ($this->checkIfBusinessDocumentUpload())
                    return true;

            return false;
        }
        return true;
    }

    function checkIfKycDocumentUploaded()
    {
        if ($this->user->kyc_document_url == null)
            return false;

        return true;

    }

    function checkIfSelfieImageUploaded()
    {

        if ($this->user->selfie_img_url == null)
            return false;

        return true;
    }

    function checkIfBusinessDetailsCompleted()
    {
        $this->user->load('business');
        if (!isset($this->user->business))
            return false;

        if ($this->user->business->business_name == null ||
            $this->user->business->business_type_id == null ||
            $this->user->business->merchant_category_id == null ||
            $this->user->business->company_tin_no == null)
            return false;
        return true;

    }

    function checkIfBusinessDocumentUpload()
    {
        if ($this->user->business->company_reg_img_url == null ||
            $this->user->business->company_tin_img_url == null)
            return false;
        return true;

    }

}