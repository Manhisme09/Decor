<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaiViet extends Model
{
    use HasFactory;
    protected $table = 'bai_viet';
    protected $fillable = [
        'image',
        'tieu_de',
        'noi_dung',
    ];
}
