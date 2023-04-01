<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BinhLuan extends Model
{
    use HasFactory;
    protected $table = 'binh_luan';
    protected $fillable = [
        'user_id',
        'san_pham_id',
        'noi_dung',
        'status',
    ];
    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function san_pham(){
        return $this->belongsTo(SanPham::class, 'san_pham_id');
    }
}
