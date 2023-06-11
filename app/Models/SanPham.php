<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    use HasFactory;
    protected $table = 'san_pham';
    protected $fillable = [
        'danh_muc_id',
        'ten_san_pham',
        'slug',
        'so_luong',
        'da_ban',
        'gia_ban',
        'hinh_anh',
        'thuoc_tinh',
        'mo_ta'
    ];

    public function danh_muc(){
        return $this->belongsTo(DanhMuc::class, 'danh_muc_id');
    }

    public function binh_luan(){
        return $this->hasMany(BinhLuan::class, 'san_pham_id');
    }

    public function chi_tiet_hoa_don(){
        return $this->hasMany(ChiTietHoaDon::class, 'san_pham_id');
    }

    public function image(){
        return $this->hasMany(Image::class, 'product_id');
    }
}
