<?php

namespace App\Http\Requests\Tax;

use App\Models\Tax as Model;

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
            'code' => ['required','unique:'. Model::class.',code'. ($model ? ','.$model->id : '')],
            'name' => ['required'],
            'deduction' => ['required','decimal:2'],
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
