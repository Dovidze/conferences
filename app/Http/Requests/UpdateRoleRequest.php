<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return auth()->check() && auth()->user()->role && auth()->user()->role->name === 'administrator';
    }

    public function rules()
    {
        return [
            'role_id' => 'required|exists:roles,id',
        ];
    }

    public function messages()
    {
        return [
            'role_id.required' => __('Role ID is required'),
            'role_id.exists' => __('The selected role ID is invalid'),
        ];
    }
}
