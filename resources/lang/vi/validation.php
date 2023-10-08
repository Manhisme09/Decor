<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */
    'required' => [
        'email' => 'Vui lòng nhập email',
        'ho_ten' => 'Vui lòng nhập họ tên',
        'ngay_sinh' => 'Vui lòng nhập ngày sinh',
        'dia_chi' => 'Vui lòng nhập địa chỉ',
        'dien_thoai' => 'Vui lòng nhập điện thoại',
        'password' => 'Vui lòng nhập mật khẩu',
        'passwordAgain' => 'Vui lòng nhập lại mật khẩu',

    ],
    'email' => [
        'unique' => ':attribute đã được đăng ký.',
        'email' => 'Địa chỉ email không hợp lệ',
    ],
    'ngay_sinh' => [
        'date' => 'Nhập ngày sinh không hợp lệ!',
        'before' => 'Ngày sinh không được lớn hơn ngày hôm nay!',
    ],
    'dien_thoai' => [
        'numeric' => 'Số điện thoại không hợp lệ',
        'min' => 'Số điện thoại phải có ít nhất :min ký tự',
    ],
    'password' => [
        'min' => 'Mật khẩu phải có ít nhất :min ký tự',
    ],
    'passwordAgain' => [
        'same' => 'Xác nhận mật khẩu không chính xác',
    ],
];
