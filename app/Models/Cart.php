<?php
namespace App\Models;
class Cart
{
    public $sanpham = null;
    public $tonggia = 0;
    public $tongsoluong = 0;

    public function __construct($cart) {
        if ($cart) {
            $this->sanpham = $cart->sanpham;
            $this->tonggia = $cart->tonggia;
            $this->tongsoluong = $cart->tongsoluong;
        }
    }

    public function addCart($sanpham, $id) {
        $sanphamInfo = ['id' => $sanpham->id, 'danh_muc' => $sanpham->danh_muc->ten_danh_muc, 'ten_danh_muc' => $sanpham->ten_san_pham, 'gia_ban'=>$sanpham->gia_ban, 'so_luong' => $sanpham->so_luong];
        $newsanpham = ['so_luong' => 0, 'gia_ban' => $sanpham->gia_ban, 'sanphamInfo' => $sanpham];
        if ($this->sanpham) {
            if (array_key_exists($id, $this->sanpham)) {
                $newsanpham = $this->sanpham[$id];
            }
        }
        if($newsanpham['so_luong'] < $sanpham->so_luong){
        $newsanpham['so_luong']++;
        $newsanpham['gia_ban'] = $newsanpham['so_luong'] * $sanpham->gia_ban;
        $this->sanpham[$id] = $newsanpham;
        $this->tonggia += $sanpham->gia_ban;
        $this->tongsoluong++;
        }
}

    public function deleteItemCart($id) {
        $this->tongsoluong -= $this->sanpham[$id]['so_luong'];
        $this->tonggia -= $this->sanpham[$id]['gia_ban'];
        unset($this->sanpham[$id]);
    }

    public function UpdateItemCart($id, $tong) {
        $this->tongsoluong -= $this->sanpham[$id]['so_luong'];
        $this->tonggia -= $this->sanpham[$id]['gia_ban'];

        $this->sanpham[$id]['so_luong'] = $tong;
        $this->sanpham[$id]['gia_ban'] = $tong * $this->sanpham[$id]['sanphamInfo']->gia_ban;

        $this->tongsoluong += $this->sanpham[$id]['so_luong'];
        $this->tonggia += $this->sanpham[$id]['gia_ban'];
    }
}
