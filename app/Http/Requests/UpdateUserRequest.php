<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return auth()->check();
    }


    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->route('id'),
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('User name is required'),
            // name, email .required => Because HTML input = required. Message is not shown
            'email.required' => __('User email is required'),
            'email.unique' => __('this_email_is_already_taken'),
        ];
    }
}
