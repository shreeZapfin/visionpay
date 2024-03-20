<?php

namespace App\Exports;

use App\Helpers\UserType;
use App\Models\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithCustomChunkSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class UsersExport implements FromQuery, WithHeadings, WithMapping, WithCustomChunkSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;
    private $filters;
    private $i = 1;

    public function __construct(array $filters)
    {
        $this->filters = $filters;
    }


    public function query()
    {
        return User::with(['city', 'verifiedBy', 'userType', 'business.merchantCategory', 'business.businessType'])->filter($this->filters);
    }

    public function map($user): array
    {

        return [
            $this->i++,
            $user->username,
            $user->mobile_no,
            $user->email,
            $user->first_name,
            $user->last_name,
            $user->date_of_birth,
            $user->gender,
            $user->address,
            $user->selfie_img_url,
            $user->profile_pic_img_url,
            $user->kyc_document_url,
            $user->kyc_document_type,
            (isset($user->city_id)) ? $user->city->city_name : 'n/a',
            $user->user_type,
            $user->pacpay_user_id,
            ($user->is_kyc_verified) ? 'Yes' : 'No',
            ($user->verifiedBy) ? $user->verifiedBy->first_name . ' ' . $user->verifiedBy->last_name : '',
            $user->verified_at,
            ($user->is_registration_completed) ? 'Yes' : 'No',
            ($user->account_blocked) ? 'Yes' : 'No',
            ($user->is_verified) ? 'Yes' : 'No',
            ($user->has_sub_accounts) ? 'Yes' : 'No',
            $user->created_at,
            $user->updated_at,
            isset($user->business->business_name) ? $user->business->business_name: 'N/A',
            isset($user->business->company_tin_no) ? $user->business->company_tin_no:'N/A',
            isset($user->business->merchantCategory->category_name) ? $user->business->merchantCategory->category_name :'N/A',
            isset($user->business->businessType->business_type) ? $user->business->businessType->business_type:'N/A'
        ];

    }


    public function headings(): array
    {
        return [
            '#',
            'USER_NAME',
            'MOBILE_NO',
            'EMAIL',
            'FIRST_NAME',
            'LAST_NAME',
            'DATE_OF_BIRTH',
            'GENDER',
            'ADDRESS',
            'SELFIE_IMAGE_URL',
            'PROFILE_PIC_IMG_URL',
            'KYC_DOCUMENT_URL',
            'KYC_DOCUMENT_TYPE',
            'CITY',
            'USER_TYPE',
            'PACPAY_USER_ID',
            'IS_KYC_VERIFIED',
            'KYC_VERIFIED_BY',
            'KYC_VERIFIED_ON',
            'IS_REGISTRATION_COMPLETE',
            'ACCOUNT_BLOCKED',
            'IS_OTP_VERIFIED',
            'HAS_SUB_ACCOUNTS',
            'CREATED_AT',
            'LAST_UPDATED_AT',
            'BUSINESS_NAME',
            'COMPANY_TIN_NO',
            'MERCHANT_CATEGORY',
            'BUSINESS_TYPE'
        ];
    }


    public function chunkSize(): int
    {
        return 500;
    }

}
