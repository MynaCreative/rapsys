<?php

namespace App\Http\Requests\Permission;

use App\Models\Permission as Model;
use App\Models\PermissionGroup;

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
            'permission_group_id'   => ['required','exists:'.PermissionGroup::class.',id'],
            'name'                  => ['required','unique:'. Model::class.',name'. ($model ? ','.$model->id : '')],
            'label'                 => ['required','unique:'. Model::class.',label'. ($model ? ','.$model->id : '')],
            'guard_name'            => ['required']
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
