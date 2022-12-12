<?php

namespace App\Http\Requests\Workflow;

use App\Models\Workflow as Model;
use App\Models\User;

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
            'user_id'   => ['required','exists:'.User::class.',id'],
            'sequence'  => ['required'],
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
            'description'   => 'trim|empty_string_to_null',
        ];
    }
}
