<?php

namespace App\Http\Requests\Invoice;

use Illuminate\Foundation\Http\FormRequest;
use Elegant\Sanitizer\Laravel\SanitizesInput;

use App\Models\Invoice as Model;
use App\Models\InvoiceType;
use App\Models\Currency;
use App\Models\Interco;
use App\Models\Vendor;
use App\Models\Term;
use App\Models\Sbu;

class Draft extends FormRequest
{
    use SanitizesInput;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'invoice_number'        => ['required'],
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

            'items'                 => ['array']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return (new Validator())->messages();
    }

    /**
     * Sanitize input requests using the SanitizesInput trait.
     *
     * @return array
     */
    public function filters(): array
    {
        return (new Validator())->filters();
    }

    /**
    * Sanitized input data
    *
    * @return array
    */
    public function sanitizedData()
    {
        $sanitized = $this->all();
        return $sanitized;
    }
}
