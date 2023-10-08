<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileUserRequest extends FormRequest
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
        ];
    }

    public function messages()
    {
        return [
            'ho_ten.required' => __('validation.required.ho_ten'),
            'ngay_sinh.required' => __('validation.required.ngay_sinh'),
            'dia_chi.required' => __('validation.required.dia_chi'),
            'dien_thoai.required' => __('validation.required.dien_thoai'),
            'ngay_sinh.date' => __('validation.ngay_sinh.date'),
            'ngay_sinh.before' => __('validation.ngay_sinh.before'),
            'dien_thoai.before' => __('validation.dien_thoai.numeric'),
            'dien_thoai.before' => __('validation.dien_thoai.min'),
        ];
    }
}
