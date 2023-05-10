<?php

namespace App\Http\Requests\Approval;

use App\Models\Invoice as Model;
use App\Models\Withholding;
use App\Models\InvoiceType;
use App\Models\Department;
use App\Models\Currency;
use App\Models\Interco;
use App\Models\Vendor;
use App\Models\Term;
use App\Models\Sbu;
use App\Models\Tax;
use App\Models\VendorSite;

class Validator
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules($model = null): array
    {
        return [
            'approval_status' => ['required'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [];
    }

    /**
     * Sanitize input requests using the SanitizesInput trait.
     *
     * @return array
     */
    public function filters(): array
    {
        return [];
    }
}
