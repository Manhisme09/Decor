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
use Illuminate\Support\Carbon;
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
        $user = User::query()->where('email', $request->email)->first();
        $timeNow = Carbon::now();
        // $timeNow = Carbon::parse('2023-07-15 10:30:00');
        $register_token = base64_encode($request->email . config('services.split_token') . $timeNow);

        if ($user && $user->getAttribute('register_token')){
            list($email, $time) = explode(config('services.split_token'), base64_decode($user->getAttribute('register_token')));
            $timeNextTwoDays = Carbon::parse($time)->addDays(config('services.verification_time'));
            if ($timeNextTwoDays->lte($timeNow)) {
                $user->register_token = $register_token;
                $user->save();
                $this->sendEmailRegister($user);
                return redirect()->route('pages.dangnhap');
            }

            $this->sendEmailRegister($user);

        } else {

            $user = new User();
            $user->role = UserRole::User;
            $user->email =  $request->get('email');
            $user->password = bcrypt($request->get('password'));
            $user->name = $request->get('ho_ten');
            $user->register_token = $register_token;
            $user->save();

            $khachHang = new KhachHang();
            $khachHang->user_id = $user->id;
            $khachHang->ho_ten = $request->get('ho_ten');
            $khachHang->ngay_sinh = $request->get('ngay_sinh');
            $khachHang->dia_chi = $request->get('dia_chi');
            $khachHang->dien_thoai = $request->get('dien_thoai');
            $khachHang->save();

            $this->sendEmailRegister($user);
        }
        return redirect()->route('pages.dangnhap');
    }

    public function sendEmailRegister($user)
    {
        Mail::send('pages.active-account', compact('user'), function ($email) use ($user) {
            $email->from(config('services.email_root'),'MANH HOUSE')->subject('Xác nhận tài khoản');
            $email->to($user['email'], $user['name']);
        });
        Toastr::success('Chúc mừng bạn đã đăng ký thành công. Vui lòng kiểm tra email và làm theo hướng dẫn để hoàn thành việc đăng ký tài khoản của bạn !', 'Thành công');
    }

    public function verifyRegisterMail($token)
    {
        list($email, $time) = explode(config('services.split_token'), base64_decode($token));
        $account = User::where('email', $email)->where('status', 'deactive')->first();
        $timeNextTwoDays = Carbon::parse($time)->addDays(config('services.verification_time'));
        $isNotExpired = $timeNextTwoDays->gt(Carbon::now());
        if (!$isNotExpired) {
            Toastr::error('Liên kết đã hết hạn. Vui lòng đăng ký lại.');
            return redirect()->route('pages.dangky');
        }
        $account->status = 'active';
        $account->update();
        Toastr::success('Xác nhận tài khoản thành công, bạn có thể đăng nhập vào hệ thống !', 'Thành công');
        return redirect()->route('pages.dangnhap');
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
            Toastr::success('Đăng nhập thành công!', 'Thành công');
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
        $authUser = $this->findOrCreateUser($users, 'google');
        if ($authUser) {
            $account_name = User::with('khach_hang')->where('id', $authUser->user_id)->first();
            auth()->login($account_name, true);
            Toastr::success('Đăng nhập thành công!', 'Thành công');
            return redirect()->route('TrangChu');
        } else {
            return redirect()->back();
        }
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
                    'role' => '5',
                    'status' => 'active',
                ]);
                KhachHang::create([
                    'user_id' => $orang->id,
                    'ho_ten' => $users->name,
                ]);
            }
            $customer_new->users()->associate($orang);
            $customer_new->save();
            return $customer_new;
        }
    }

    public function sendMail(Request $request)
    {
        $data = $request->all();
        $title = 'Đặt lại mật khẩu';
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

                $linkReset = url('/update-new-pass?token=' . $token_random);
                $data = array("name" => $title, "body" => $linkReset, 'email_account' => $data['email']);
                Mail::send('pages.sendMail', ['data' => $data], function ($message) use ($title, $data) {
                    $message->from($data['email_account'], 'MANH HOUSE')->subject($title);
                    $message->to($data['email_account'], $title);
                });

                Toastr::success('Gửi mail thành công. Vui lòng vào mail để đặt lại mật khẩu !', 'Thành công');
                return redirect()->back();
            }
        }

        // Mail::to($to_email)->send(new SendMailPassword);

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
        $customer = User::where('customer_token', $data['token'])->get();
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
