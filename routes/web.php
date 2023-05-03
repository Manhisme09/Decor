<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BaiVietController;
use App\Http\Controllers\BinhLuanController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CskhContoller;
use App\Http\Controllers\DanhMucController;
use App\Http\Controllers\HoaDonController;
use App\Http\Controllers\KhachHangController;
use App\Http\Controllers\LoaiSPController;
use App\Http\Controllers\NhanVienController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\TaiKhoanController;
use App\Http\Controllers\ThongKeController;
use App\Http\Controllers\VoucherController;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Whoops\RunInterface;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PageController::class, 'index'])->name('TrangChu');
Route::get('dang-ky', [AuthController::class, 'userRegister'])->name('pages.dangky');
Route::post('dang-ky', [AuthController::class, 'userPostRegister'])->name('pages.postdangky');
Route::get('xac-nhan-tai-khoan/{mail_user}/{token}', [AuthController::class, 'verifyRegisterMail'])->name('verify-register-mail');
Route::get('dang-nhap', [AuthController::class, 'userLogin'])->name('pages.dangnhap');
Route::post('dang-nhap', [AuthController::class, 'postUserLogin'])->name('pages.postdangnhap');
Route::get('dang-xuat', [AuthController::class, 'userLogout'])->name('pages.dangxuat');
Route::get('san-pham/{id}', [PageController::class, 'getProduct'])->name('pages.product');
Route::get('chi-tiet-san-pham/{slug}&id={id}', [PageController::class, 'getProductDetail'])->name('pages.chitietsanpham');
Route::get('lien-he', [PageController::class, 'getLienhe'])->name('pages.lienhe');
Route::get('gio-hang', [CartController::class, 'getCart'])->name('pages.giohang');
Route::get('them-gio-hang/{id}', [CartController::class, 'addCart'])->name('pages.themgiohang');
Route::get('cap-nhat-gio-hang/{id}/{tong}', [CartController::class, 'updateCart'])->name('pages.capnhatgiohang');
Route::get('xoa/{id}', [CartController::class, 'deleteCart'])->name('pages.xoagiohang');
Route::prefix('thanh-toan')->middleware('payment')->group(function () {
    Route::get('/', [CartController::class, 'getPayment'])->name('pages.thanhtoan');
    Route::post('/', [CartController::class, 'postPayment'])->name('pages.postthanhtoan');
    Route::post('thanh-toan', [CartController::class, 'postPayment2'])->name('pages.postthanhtoan2');
    Route::get('thong-bao', [CartController::class, 'notify'])->name('pages.thongbao');
});

Route::get('thong-tin-ca-nhan', [TaiKhoanController::class, 'getUserProfile'])->name('pages.getthongtin');
Route::post('thong-tin-ca-nhan', [TaiKhoanController::class, 'postUserProfile'])->name('pages.postthongtin');
// Route::post('thong-tin-ca-nhan-google', [TaiKhoanController::class, 'postUserProfileGoogle'])->name('pages.postthongtingoogle');
Route::get('doi-mat-khau', [TaiKhoanController::class, 'getUserPassword'])->name('pages.getmatkhau');
Route::post('doi-mat-khau', [TaiKhoanController::class, 'postUserPassword'])->name('pages.postmatkhau');
Route::get('don-hang', [TaiKhoanController::class, 'getUserOrder'])->name('pages.getdonhang');
Route::get('huy-don-hang/{id}', [TaiKhoanController::class, 'getHuy'])->name('pages.Huy');
Route::get('cham-soc-khach-hang', [PageController::class, 'getCskh'])->name('pages.getcskh');
Route::post('cham-soc-khach-hang', [PageController::class, 'postCskh'])->name('pages.postcskh');

Route::post('binh-luan/{id}', [PageController::class, 'postComment'])->name('pages.postbinhluan');

Route::get('danh-sach-bai-viet', [PageController::class, 'Posts'])->name('pages.baiviet');
Route::get('chi-tiet-bai-viet/{id}', [PageController::class, 'postDetail'])->name('pages.baiviet.chitiet');


Route::get('login-google', [AuthController::class, 'login_google'])->name('pages.dangnhapgg');
Route::get('google/callback', [AuthController::class, 'callback_google'])->name('pages.callback');
Route::post('gui-mail', [AuthController::class, 'sendMail'])->name('pages.sendMail');
Route::get('quen-mat-khau', [AuthController::class, 'forgotPassword'])->name('pages.quenmatkhau');
Route::get('update-new-pass', [AuthController::class, 'updatePass'])->name('pages.getUpdatePass');
Route::post('update-new-pass', [AuthController::class, 'postUpdatePass'])->name('pages.postUpdatePass');
Route::get('tìm-kiem', [PageController::class, 'search'])->name('pages.timkiem');

/*=== admin ===*/

Route::get('admin/dang-nhap', [AuthController::class, 'getAdminLogin'])->name('admin.getlogin');
Route::post('admin/dang-nhap', [AuthController::class, 'postAdminLogin'])->name('admin.postlogin');
Route::prefix('admin')->middleware('admin')->group(function () {

    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('logout', [AuthController::class, 'adminLogout'])->name('admin.logout');
    Route::prefix('danh-muc')->group(function () {
        Route::get('/', [DanhMucController::class, 'index'])->name('admin.DanhMuc.index');
        Route::get('them', [DanhMucController::class, 'getThem'])->name('admin.DanhMuc.getThem');
        Route::post('them', [DanhMucController::class, 'postThem'])->name('admin.DanhMuc.postThem');
        Route::get('sua/{id}', [DanhMucController::class, 'getSua'])->name('admin.DanhMuc.getSua');
        Route::post('sua/{id}', [DanhMucController::class, 'postSua'])->name('admin.DanhMuc.postSua');
        Route::get('xoa/{id}', [DanhMucController::class, 'getXoa'])->name('admin.DanhMuc.getXoa');
    });

    Route::prefix('san-pham')->group(function () {
        Route::get('/', [SanPhamController::class, 'index'])->name('admin.SanPham.index');
        Route::get('them', [SanPhamController::class, 'getThem'])->name('admin.SanPham.getThem');
        Route::post('them', [SanPhamController::class, 'postThem'])->name('admin.SanPham.postThem');
        Route::get('sua/{id}', [SanPhamController::class, 'getSua'])->name('admin.SanPham.getSua');
        Route::post('sua/{id}', [SanPhamController::class, 'postSua'])->name('admin.Sanpham.postSua');
        Route::get('xoa/{id}', [SanPhamController::class, 'getXoa'])->name('admin.SanPham.getXoa');
    });

    Route::prefix('hoa-don')->group(function () {
        Route::get('/', [HoaDonController::class, 'index'])->name('admin.hoadon.index');
        Route::get('xac-nhan-don-hang/{id}', [HoaDonController::class, 'acceptOrder'])->name('admin.hoadon.acceptOrder');
        Route::get('bat-dau-giao-hang/{id}', [HoaDonController::class, 'startShip'])->name('admin.hoadon.startShip');
        Route::get('huy-giao-hang/{id}', [HoaDonController::class, 'cancelShip'])->name('admin.hoadon.cancelShip');
        Route::get('huy-don-hang/{id}', [HoaDonController::class, 'cancelOrder'])->name('admin.hoadon.AdmincancelOrder');
        Route::get('xac-nhan-thanh-toan/{id}', [HoaDonController::class, 'acceptPayment'])->name('admin.hoadon.acceptPayment');
        Route::get('xem-chi-tiet-hoa-don/{id}', [HoaDonController::class, 'getView'])->name('admin.hoadon.getView');
        Route::get('in-hoa-don/{id}', [HoaDonController::class, 'print'])->name('admin.hoadon.inhoadon');
    });

    Route::prefix('khach-hang')->group(function () {
        Route::get('/', [KhachHangController::class, 'index'])->name('admin.khachhang.index');
    });

    Route::prefix('nhan-vien')->group(function () {
        Route::get('/', [NhanVienController::class, 'index'])->name('admin.nhanvien.index');
        Route::get('them', [NhanVienController::class, 'getThem'])->name('admin.nhanvien.getThem');
        Route::post('them', [NhanVienController::class, 'postThem'])->name('admin.nhanvien.postThem');
        Route::get('sua/{id}', [NhanVienController::class, 'getSua'])->name('admin.nhanvien.getSua');
        Route::post('sua/{id}', [NhanVienController::class, 'postSua'])->name('admin.nhanvien.postSua');
        Route::post('dat-mat-khau/{id}', [NhanVienController::class, 'resetPass'])->name('admin.nhanvien.resetPass');
        Route::get('xoa/{id}', [NhanVienController::class, 'xoa'])->name('admin.nhanvien.xoa');
        Route::get('xuat-file-excel', [NhanVienController::class, 'export'])->name('admin.nhanvien.export');
    });

    Route::prefix('binh-luan')->group(function () {
        Route::get('/', [BinhLuanController::class, 'index'])->name('admin.binhluan.index');
        Route::get('xoa/{id}', [BinhLuanController::class, 'deleteComment'])->name('admin.binhluan.xoa');
        Route::get('tra-loi-binh-luan/{id}', [BinhLuanController::class, 'getRelyComment'])->name('admin.binhluan.gatReply');
        Route::post('tra-loi-binh-luan/{id}', [BinhLuanController::class, 'postRelyComment'])->name('admin.binhluan.postReply');
    });

    Route::prefix('bai-viet')->group(function () {
        Route::get('/', [BaiVietController::class, 'index'])->name('admin.baiviet.index');
        Route::get('them', [BaiVietController::class, 'getThem'])->name('admin.baiviet.getThem');
        Route::post('them', [BaiVietController::class, 'postThem'])->name('admin.baiviet.postThem');
        Route::get('sua/{id}', [BaiVietController::class, 'getSua'])->name('admin.baiviet.getSua');
        Route::post('sua/{id}', [BaiVietController::class, 'postSua'])->name('admin.baiviet.postSua');
        Route::get('xoa/{id}', [BaiVietController::class, 'xoa'])->name('admin.baiviet.xoa');
    });

    Route::prefix('slide')->group(function () {
        Route::get('/', [SlideController::class, 'index'])->name('admin.slide.index');
        Route::get('them', [SlideController::class, 'getThem'])->name('admin.slide.getThem');
        Route::post('them', [SlideController::class, 'postThem'])->name('admin.slide.postThem');
        Route::get('xoa/{id}', [SlideController::class, 'xoa'])->name('admin.slide.getXoa');
    });

    Route::prefix('cskh')->group(function () {
        Route::get('/', [CskhContoller::class, 'index'])->name('admin.cskh.index');
        Route::get('trang-thai-phan-hoi/{id}', [CskhContoller::class, 'repFeedback'])->name('admin.cskh.repFeedback');
    });

    Route::prefix('thong-ke')->group(function () {
        Route::get('/', [ThongKeController::class, 'index'])->name('admin.thongke.index');
        Route::get('xuat-excel', [ThongKeController::class, 'export'])->name('admin.thongke.export');
    });

    Route::prefix('thong-tin-ca-nhan')->group(function () {
        Route::get('/', [TaiKhoanController::class, 'getAdminProfile'])->name('admin.getadminprofile');
        Route::post('/', [TaiKhoanController::class, 'postAdminProfile'])->name('admin.postadminprofile');
        Route::get('thay-doi-mat-khau',[TaiKhoanController::class, 'getAdminPassword'])->name('admin.getadminpassword');
        Route::post('thay-doi-mat-khau', [TaiKhoanController::class, 'postAdminPassword'])->name('admin.postadminpassword');

    });

    Route::prefix('voucher')->group(function () {
        Route::get('/', [VoucherController::class, 'index'])->name('admin.voucher.index');
        Route::get('them', [VoucherController::class, 'getThem'])->name('admin.voucher.getThem');
        Route::post('them', [VoucherController::class, 'postThem'])->name('admin.voucher.postThem');
        Route::get('sua/{id}', [VoucherController::class, 'getSua'])->name('admin.voucher.getSua');
        Route::post('sua/{id}', [VoucherController::class, 'postSua'])->name('admin.voucher.postSua');
        Route::get('xoa/{id}', [VoucherController::class, 'xoa'])->name('admin.voucher.xoa');
    });
});
