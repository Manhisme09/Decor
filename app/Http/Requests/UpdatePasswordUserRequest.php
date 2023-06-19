<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'oldPassword' => [
                'required',
            ],
            'password' => [
                'required',
                'min:6',
            ],
            'passwordAgain' => [
                'required',
                'same:password',
            ],
        ];
    }

    public function messages()
    {
        return [
            'oldPassword.required' => __('validation.required.password'),
            'password.required' => __('validation.required.password'),
            'passwordAgain.required' => __('validation.required.passwordAgain'),
            'password.min' => __('validation.password.min'),
            'passwordAgain.same' => __('validation.passwordAgain.same'),

        ];
    }
}
