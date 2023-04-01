<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoaDon extends Model
{
    use HasFactory;
    protected $table = 'hoa_don';
    protected $fillable = [
        'admin_id',
        'khach_hang_id',
        'ngay_lap',
        'tong_tien',
        'status',
    ];

    public function admin(){
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function khach_hang(){
        return $this->belongsTo(KhachHang::class, 'khach_hang_id');
    }

    public function chi_tiet_hoa_don(){
        return $this->hasMany(ChiTietHoaDon::class, 'hoa_don_id');
    }
}
