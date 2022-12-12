<?php

namespace App\Http\Requests\Invoice;

use App\Models\Invoice as Model;
use App\Models\Vendor;
use App\Models\Term;

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
            'term_id'               => ['required','exists:'.Term::class.',id'],
            'vendor_id'             => ['required','exists:'.Vendor::class.',id'],
            'posting_date'          => ['required','date'],
            'invoice_date'          => ['required','date'],
            'invoice_receipt_date'  => ['required','date'],
            'invoice_number'        => ['required'],
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
        return [
            'name'          => 'trim|empty_string_to_null',
            'description'   => 'trim|empty_string_to_null',
        ];
    }
}
