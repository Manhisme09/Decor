<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $table = 'admin';
    protected $fillable = [
        'user_id',
        'ho_ten',
        'gioi_tinh',
        'ngay_sinh',
        'dia_chi',
        'dien_thoai',
    ];
     public function users(){
         return $this->belongsTo(User::class,'user_id');
     }

     public function hoa_don(){
         return $this->hasMany(HoaDon::class, 'admin_id');
     }
}
