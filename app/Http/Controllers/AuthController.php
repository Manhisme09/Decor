<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Models\KhachHang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Socialite;
use App\Models\AccSocial;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailPassword;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\AdminLoginRequest;
use Brian2694\Toastr\Facades\Toastr;
use Str;

use function PHPUnit\Framework\returnSelf;

class AuthController extends Controller
{
    public function getAdminLogin()
    {
        return view('admin.layouts.login');
    }

    public function postAdminLogin(AdminLoginRequest $request)
    {
        $remember = $request->has('remember') ? true : false;
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 'active'], $remember)) {
            Toastr::success('Đăng nhập thành công', 'Thành công');
            return redirect()->route('admin.index');
        } else {
            Toastr::error('Tài khoản hoặc mật khẩu không chính xác!');
            return redirect()->back();
        }
    }

    public function adminLogout()
    {
        Auth::logout();
        return redirect()->route('admin.getlogin');
    }

    public function userRegister()
    {
        return view('pages.layouts.dangky');
    }

    public function userPostRegister(RegisterRequest $request)
    {
        $register_token = Str::random(10);
        $data = [
            'email' => $request->get('email'),
            'ho_ten' => $request->get('ho_ten'),
            'ngay_sinh' => $request->get('ngay_sinh'),
            'dia_chi' => $request->get('dia_chi'),
            'dien_thoai' => $request->get('dien_thoai'),
            'password' => bcrypt($request->get('password')),
            'register_token' =>  $register_token,
            'role' =>  UserRole::User,
        ];


        $user = new User();
        $user->role = $data['role'];
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

        Mail::send('pages.active-account', compact('data'), function ($email) use ($data) {
            $email->from($data['email'],'FURNIBUY')->subject('Xác nhận tài khoản');
            $email->to($data['email'], $data['ho_ten']);
        });

        return redirect()->back()->with('thongbao', 'Chúc mừng bạn đã đăng ký thành công. Vui lòng kiểm tra email và làm theo hướng dẫn để hoàn thành việc đăng ký tài khoản của bạn.');
    }

    public function verifyRegisterMail($mail_user, $token)
    {
        $account = User::where('email', $mail_user)->first();
        if ($account->register_token === $token) {
            $account->status = 'active';
            $account->update();
            return redirect()->route('pages.dangnhap')->with('thongbao', 'Xác nhận tài khoản thành công, bạn có thể đăng nhập vào hệ thống');
        } else {
            return redirect()->route('pages.dangnhap')->with('loi', 'Mã xác nhận không hợp lệ');
        }
    }

    public function userLogin()
    {
        return view('pages.layouts.dangnhap');
    }

    public function postUserLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'Vui lòng nhập email',
            'password.required' => 'Vui lòng nhập mật khẩu',
        ]);
        $remember = $request->has('remember') ? true : false;
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 'active'], $remember)) {
            return redirect()->route('TrangChu');
        } else {
            return redirect()->back()->with('loi', 'Tài khoản hoặc mật khẩu không chính xác!');
        }
    }

    public function userLogout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        return redirect()->route('pages.dangnhap');
    }


    public function login_google()
    {
        return Socialite::driver('google')->redirect();
    }
    public function callback_google()
    {
        $users = Socialite::driver('google')->stateless()->user();
        // return $users->name;
        $authUser = $this->findOrCreateUser($users, 'google');
        if ($authUser) {
            $account_name = User::with('khach_hang')->where('id', $authUser->user_id)->first();
            // dd($account_name->email);
            Session::put('user_login', $account_name->khach_hang->ho_ten);
            Session::put('phone', $account_name->khach_hang->dien_thoai);
            Session::put('email', $account_name->email);
            Session::put('address', $account_name->khach_hang->dia_chi);
            Session::put('date', $account_name->khach_hang->ngay_sinh);
            Session::put('login', true);
            Session::put('id', $account_name->id);
        } elseif ($customer_new) {
            $account_name = User::with('khach_hang')->where('id', $authUser->user_id)->first();
            // dd($account_name->email);
            Session::put('user_login', $account_name->khach_hang->ho_ten);
            Session::put('phone', $account_name->khach_hang->dien_thoai);
            Session::put('email', $account_name->email);
            Session::put('address', $account_name->khach_hang->dia_chi);
            Session::put('date', $account_name->khach_hang->ngay_sinh);
            Session::put('login', true);
            Session::put('id', $account_name->id);
        }
        return redirect()->route('TrangChu')->with('message', 'Đăng nhập Admin thành công');
    }

    public function findOrCreateUser($users, $provider)
    {
        $authUser = AccSocial::where('provider_user_id', $users->id)->first();
        if ($authUser) {
            return $authUser;
        } else {
            $customer_new = new AccSocial([
                'provider_user_id' => $users->id,
                'provider' => strtoupper($provider)
            ]);

            $orang = User::where('email', $users->email)->first();

            if (!$orang) {
                $orang = User::create([
                    'name' => $users->name,
                    'email' => $users->email,
                    'admin_password' => '',
                    'role' => '5',
                    'status' => 'active',
                ]);
                $khach_hang = KhachHang::create([
                    'user_id' => $orang->id,
                    'ho_ten' => $users->name,
                    'dia_chi' => ' ',
                    'dien_thoai' => ' ',
                ]);
            }
            $customer_new->users()->associate($orang, $khach_hang);
            $customer_new->save();
            return $customer_new;
        }

        // $account_name = User::where('id', $hieu->user_id)->first();
        // Session::put('user_login', $account_name->name);
        // Session::put('id', $account_name->id);
        // return redirect()->route('TrangChu')->with('message', 'Đăng nhập Admin thành công');

    }

    public function sendMail(Request $request)
    {
        $data = $request->all();
        $title = 'Lấy lại mật khẩu';
        $customer = User::where('email', $data['email'])->where('role', 5)->get();
        foreach ($customer as $item) {
            $customer_id = $item->id;
        }
        if ($customer) {
            $countCustomer = $customer->count();
            if ($countCustomer === 0) {
                return redirect()->back()->with('err', 'Email chưa được đăng ký');
            } else {
                $token_random = Str::random();
                $customer = User::find($customer_id);
                $customer->customer_token = $token_random;
                $customer->save();

                $to_email = $data['email'];
                $linkReset = url('/update-new-pass?email=' . $to_email . '&token=' . $token_random);
                $data = array("name" => $title, "body" => $linkReset, 'email_account' => $data['email']);
                Mail::send('pages.sendMail', ['data' => $data], function ($message) use ($title, $data) {
                    $message->from($data['email_account'], 'FURNIBUY')->subject($title);
                    $message->to($data['email_account'], $title);
                });

                return redirect()->back()->with('message', 'Gửi mail thành công. Vui lòng vào mail để đặt lại mật khẩu');
            }
        }

        Mail::to($to_email)->send(new SendMailPassword);

        return redirect()->route('pages.dangnhap');
    }

    public function forgotPassword()
    {
        return view('pages.checkout.quenmatkhau');
    }

    public function updatePass()
    {
        return view('pages.checkout.matkhaumoi');
    }

    public function postUpdatePass(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|min:6',
        ], [
            'password.required' => 'Vui lòng nhập mật khẩu!',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự!',
        ]);
        $data = $request->all();
        $token_random = Str::random();
        $customer = User::where('email', $data['email'])->where('customer_token', $data['token'])->get();
        $count = $customer->count();
        if ($count > 0) {
            foreach ($customer as $item) {
                $customer_id = $item->id;
            }
            $reset = User::find($customer_id);
            $reset->password = bcrypt($data['password']);
            $reset->customer_token = $token_random;
            $reset->save();
            return redirect()->route('pages.dangnhap')->with('thongbao', 'Mật khẩu đã được cập nhật thành công mời bạn đăng nhập');
        } else {
            return redirect()->route('pages.dangnhap')->with('loi', 'Vui lòng nhập lại email vì link đã quá hạn');
        }
    }
}
