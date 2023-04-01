<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietHoaDon extends Model
{
    use HasFactory;
    protected $table = 'chi_tiet_hoa_don';
    protected $fillable = [
        'hoa_don_id',
        'san_pham_id',
        'so_luong',
        'don_gia',
        'giam_gia',
        'thanh_tien'
    ];

    public function hoa_don(){
        return $this->belongsTo(HoaDon::class, 'hoa_don_id');
    }

    public function san_pham(){
        return $this->belongsTo(SanPham::class, 'san_pham_id');
    }
}
