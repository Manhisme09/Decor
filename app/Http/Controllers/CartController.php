<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\Cart;
use App\Models\HoaDon;
use App\Models\KhachHang;
use App\Models\ChiTietHoaDon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class CartController extends Controller
{
    public function getCart()
    {
        return view('pages.giohang');
    }

    public function addCart(Request $request, $id)
    {
        $sanPham = SanPham::find($id);
        if ($sanPham != null) {
            $oldCart = Session('Cart') ? Session('Cart') : null;
            $newCart = new Cart($oldCart);
            $newCart->addCart($sanPham, $id);
            $request->session()->put('Cart', $newCart);
        }
        Toastr::success('Sản phẩm đã được thêm vào giỏ hàng !', 'Thành công');
        return view('pages.giohang', compact('newCart'));
    }

    public function updateCart(Request $request, $id, $tong)
    {
        $oldCart = Session('Cart') ? Session('Cart') : null;
        $newCart = new Cart($oldCart);
        $newCart->UpdateItemCart($id, $tong);
        $request->Session()->put('Cart', $newCart);
        Toastr::success('Cập nhật giỏ hàng thành công !', 'Thành công');
        return redirect()->route('pages.giohang');
    }

    public function deleteCart(Request $request, $id)
    {
        $oldCart = Session('Cart') ? Session('Cart') : null;
        $newCart = new Cart($oldCart);
        $newCart->deleteItemCart($id);
        if (count($newCart->sanpham) > 0) {
            $request->Session()->put('Cart', $newCart);
        } else {
            $request->Session()->forget('Cart');
        }
        Toastr::success('Đã xoá sản phẩm khỏi giỏ hàng !', 'Thành công');
        return redirect()->route('pages.giohang');
    }

    public function getPayment()
    {
        return view('pages.thanhtoan');
    }

    public function postPayment(Request $request)
    {
        if ($request->checkout == 'delivery') {
            $this->validate($request, [
                'ho_ten' => 'required',
                'ngay_sinh' => 'required|date|before:today',
                'dien_thoai' => 'required|numeric',
                'dia_chi' => 'required',
            ], [
                'ho_ten.required' => 'Bạn chưa nhập họ tên',
                'ngay_sinh.required' => 'Bạn chưa nhập ngày sinh',
                'ngay_sinh.date' => 'Nhập ngày sinh không hợp lệ!',
                'ngay_sinh.before' => 'Ngày sinh không được lớn hơn ngày hôm nay!',
                'dien_thoai.required' => 'Bạn chưa nhập số điện thoại',
                'dien_thoai.numerric' => 'Số điện thoại phải là số',
                'dia_chi.required' => 'Bạn chưa nhập địa chỉ',
            ]);

            $khachhang = KhachHang::find(Auth::user()->khach_hang->id);
            $khachhang->ho_ten = $request->ho_ten;
            $khachhang->ngay_sinh = $request->ngay_sinh;
            $khachhang->dien_thoai = $request->dien_thoai;
            $khachhang->dia_chi = $request->dia_chi;
            $khachhang->save();

            $cart = \Session::get('Cart');
            $hoadon = new HoaDon();
            $hoadon->khach_hang_id = $khachhang->id;
            $hoadon->ngay_lap = \Carbon\Carbon::now();
            $hoadon->tong_tien = $cart->tonggia;
            $hoadon->save();

            foreach ($cart->sanpham as $key => $value) {
                $cthd = new ChiTietHoaDon();
                $cthd->hoa_don_id = $hoadon->id;
                $cthd->san_pham_id = $key;
                $cthd->so_luong = $value['so_luong'];
                $cthd->don_gia = $value['gia_ban'] / $value['so_luong'];
                $cthd->thanh_tien = $value['so_luong'] * ($value['gia_ban'] / $value['so_luong']);
                $cthd->save();
            }

            $request->Session()->forget('Cart');
            return redirect()->route('pages.thongbao');
        } else if($request->checkout == 'vnpay') {
            $cart = \Session::get('Cart');
            $latestOrder = HoaDon::latest()->firstOrFail();
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = "http://127.0.0.1:8000/thanh-toan/thong-bao";
            $vnp_TmnCode = "SJPAQTL1";//Mã website tại VNPAY
            $vnp_HashSecret = "AABNLUVNABGRZWLMPGIAGSCBZHKFAEAR"; //Chuỗi bí mật

            $vnp_TxnRef = $latestOrder->id + 1; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = "Thanh toán hóa đơn2";
            $vnp_OrderType = "Manh House2";
            $vnp_Amount = $cart->tonggia * 100;
            $vnp_Locale = "VN";
            $vnp_BankCode = "NCB";
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef,
            );

            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
                $inputData['vnp_Bill_State'] = $vnp_Bill_State;
            }

            //var_dump($inputData);
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }
            $returnData = array('code' => '00'
                , 'message' => 'success'
                , 'data' => $vnp_Url);
                if (isset($_POST['redirect'])) {
                    header('Location: ' . $vnp_Url);
                    die();
                } else {
                    echo json_encode($returnData);
                }
        } else {
            Toastr::error('Vui lòng chọn hình thức thanh toán!');
            return redirect()->back();
        }
    }

    public function notify(Request $request)
    {
        $vnpay = false;
        if ($request->get('vnp_ResponseCode') == '00') {
            $vnpay = true;
            $khachhang = KhachHang::find(Auth::user()->khach_hang->id);
            $khachhang->ho_ten = Auth::user()->khach_hang->ho_ten;
            $khachhang->ngay_sinh = Auth::user()->khach_hang->ngay_sinh;
            $khachhang->dien_thoai = Auth::user()->khach_hang->dien_thoai;
            $khachhang->dia_chi = Auth::user()->khach_hang->dia_chi;
            $khachhang->save();

            $cart = \Session::get('Cart');
            $hoadon = new HoaDon();
            $hoadon->khach_hang_id = $khachhang->id;
            $hoadon->ngay_lap = \Carbon\Carbon::now();
            $hoadon->tong_tien = $cart->tonggia;
            $hoadon->status = 2;
            $hoadon->save();

            foreach ($cart->sanpham as $key => $value) {
                $cthd = new ChiTietHoaDon();
                $cthd->hoa_don_id = $hoadon->id;
                $cthd->san_pham_id = $key;
                $cthd->so_luong = $value['so_luong'];
                $cthd->don_gia = $value['gia_ban'] / $value['so_luong'];
                $cthd->thanh_tien = $value['so_luong'] * ($value['gia_ban'] / $value['so_luong']);
                $cthd->save();
            }
            $request->Session()->forget('Cart');
        }
        return view('pages.thongbao', compact('vnpay'));
    }
}
