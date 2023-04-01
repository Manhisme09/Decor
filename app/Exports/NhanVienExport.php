<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\User;
use App\Models\Admin;


class NhanVienExport implements FromCollection,WithHeadings,WithMapping

{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct()
    {
    }
    public function collection()
    {
        return $nhan_vien = User::with('admin')->where('role',2)->get();
    }


    /**
     * Returns headers for report
     * @return array
     */
    public function headings(): array {
        return [
            'ID',
            'Họ tên',
            'Email',
            "Ngày sinh",
            "Giới tính",
            "Số điện thoại",
            'Địa chỉ',

        ];
    }

    public function map($nhan_vien): array {
        return [
            ($nhan_vien->admin->id)-1,
            $nhan_vien->admin->ho_ten,
            $nhan_vien->email,
            $nhan_vien->admin->ngay_sinh,
            $nhan_vien->admin->gioi_tinh,
            $nhan_vien->admin->dien_thoai,
            $nhan_vien->admin->dia_chi,
        ];
    }


}
