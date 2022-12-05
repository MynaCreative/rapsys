<?php

namespace App\Http\Requests\User;

use App\Models\User as Model;
use App\Models\UserGroup;

class Validator 
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules($model = null): array
    {
        $password_rule = !optional($model)->id ? ['required'] : [];
        return [
            'name'      => ['required','unique:'. Model::class.',name'. ($model ? ','.$model->id : '')],
            'username'  => ['required','unique:'. Model::class.',username'. ($model ? ','.$model->id : '')],
            'email'     => ['required','unique:'. Model::class.',email'. ($model ? ','.$model->id : ''), 'email'],
            'roles_id'  => ['required','array'],
            'password'  => $password_rule,
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
