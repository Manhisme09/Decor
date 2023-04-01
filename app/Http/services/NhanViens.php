<?php
namespace App\Http\services;

use App\Models\Admin;

class NhanViens{
    public function create(){
        return Admin::orderBy('id', 'asc')->paginate(10);
    }
}
?>
