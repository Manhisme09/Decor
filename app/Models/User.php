<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     *
     */
    protected $table = 'users';
    protected $fillable = [
        'name','email', 'password', 'role', 'customer_token','status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function admin(){
        return $this->hasOne(Admin::class, 'user_id');
    }

    public function khach_hang(){
        return $this->hasOne(KhachHang::class, 'user_id');
    }

    public function binh_luan(){
        return $this->hasMany(BinhLuan::class, 'user_id');
    }

    public function register($data){
        $user = new User();
        $user->role = 5;
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->name = $data['ho_ten'];
        $user->register_token = $data['register_token'];
        $user->save();

        $khachHang = new KhachHang();
        $khachHang->user_id = $user->id;
        $khachHang->ho_ten = $data['ho_ten'];
        $khachHang->ngay_sinh = $data['ngay_sinh'];
        $khachHang->dia_chi = $data['dia_chi'];
        $khachHang->dien_thoai = $data['dien_thoai'];
        $khachHang->save();
    }
}
