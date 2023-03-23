<?php

namespace App\Http\Requests\Vendor;

use App\Models\Vendor as Model;
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
            'sbu_id'   => ['required','exists:'.Sbu::class.',id'],
            'code' => ['required','unique:'. Model::class.',code'. ($model ? ','.$model->id : '')],
            'name' => ['required'],
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
