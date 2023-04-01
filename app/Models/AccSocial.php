<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccSocial extends Model
{
    use HasFactory;
    protected $table = 'acc_social';
    protected $fillable = [
        'provider_user_id',
        'provider',
        'user_id',
    ];

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
