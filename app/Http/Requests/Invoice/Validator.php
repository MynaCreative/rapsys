<?php

namespace App\Http\Requests\Invoice;

use App\Models\Invoice as Model;
use App\Models\InvoiceType;
use App\Models\Currency;
use App\Models\Interco;
use App\Models\Vendor;
use App\Models\Term;
use App\Models\Sbu;

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
            'invoice_number'        => ['required','unique:'. Model::class.',invoice_number'. ($model ? ','.$model->id : '')],
            'sbu_id'                => ['required','exists:'.Sbu::class.',id'],
            'invoice_type_id'       => ['required','exists:'.InvoiceType::class.',id'],
            'currency_id'           => ['required','exists:'.Currency::class.',id'],
            'interco_id'            => ['required','exists:'.Interco::class.',id'],
            'term_id'               => ['required','exists:'.Term::class.',id'],
            'vendor_id'             => ['required','exists:'.Vendor::class.',id'],
            'posting_date'          => ['required','date'],
            'invoice_date'          => ['required','date'],
            'invoice_receipt_date'  => ['required','date'],
            // 'total_amount'          => ['required','gt:0'],
            'note'                  => ['required'],
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
