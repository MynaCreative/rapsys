<?php

namespace App\Http\Requests\Area;

use Illuminate\Foundation\Http\FormRequest;
use Elegant\Sanitizer\Laravel\SanitizesInput;

class Update extends FormRequest
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
        return (new Validator())->rules($this->area);
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
