<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhMuc extends Model
{
    use HasFactory;
    protected $table = 'danh_muc';
    protected $fillable = [
        'ten_danh_muc',
        'parent_id',
        'slug'
    ];

    public function san_pham(){
        return $this->hasMany(SanPham::class, 'danh_muc_id');
    }
}
