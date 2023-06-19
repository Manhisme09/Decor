<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => [
                'required',
                'email',
                'unique:users',
            ],
            'ho_ten' => [
                'required',
            ],
            'ngay_sinh' => [
                'required',
                'date',
                'before:today',
            ],
            'dia_chi' => [
                'required',
            ],
            'dien_thoai' => [
                'required',
                'numeric',
                'min:10',
            ],
            'password' => [
                'required',
                'min:6',
            ],
            'passwordAgain' => [
                'required',
                'same:password',
            ]
        ];
    }

    public function messages()
    {
        return [
            'email.required' => __('validation.required.email'),
            'ho_ten.required' => __('validation.required.ho_ten'),
            'ngay_sinh.required' => __('validation.required.ngay_sinh'),
            'dia_chi.required' => __('validation.required.dia_chi'),
            'dien_thoai.required' => __('validation.required.dien_thoai'),
            'password.required' => __('validation.required.password'),
            'passwordAgain.required' => __('validation.required.passwordAgain'),
            'email.email' => __('validation.email.email'),
            'email.unique' => __('validation.email.unique'),
            'ngay_sinh.date' => __('validation.ngay_sinh.date'),
            'ngay_sinh.before' => __('validation.ngay_sinh.before'),
            'dien_thoai.numeric' => __('validation.dien_thoai.numeric'),
            'dien_thoai.min' => __('validation.dien_thoai.min'),
            'password.min' => __('validation.password.min'),
            'passwordAgain.same' => __('validation.passwordAgain.same'),

        ];
    }
}
