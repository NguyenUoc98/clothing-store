<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Log;


class AuthenticatedSessionController extends Controller
{
    /**
     * Hiển thị form đăng nhập.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('login'); // Tạo view đăng nhập
    }

    /**
     * Xử lý yêu cầu đăng nhập.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Xác thực dữ liệu yêu cầu
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Kiểm tra đăng nhập cho guard 'web' (dành cho admin và staff)
        if (Auth::guard('web')->attempt($request->only('email', 'password'))) {
            $user = Auth::guard('web')->user();
            if (in_array($user->role, ['admin', 'staff'])) {
                return redirect('/categories');
            }
        }
        // Kiểm tra đăng nhập cho guard 'customer' (dành cho khách hàng)
        if (Auth::guard('customer')->attempt($request->only('email', 'password'))) {
            return redirect('/');
        }
        // Nếu xác thực thất bại, chuyển hướng về với thông báo lỗi
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Đăng xuất người dùng khỏi ứng dụng.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // Kiểm tra nếu người dùng đang đăng nhập dưới guard 'admin'
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
            return redirect('/');
        }
    
        // Kiểm tra nếu người dùng đang đăng nhập dưới guard 'customer'
        if (Auth::guard('customer')->check()) {
            Auth::guard('customer')->logout();
        }
    
        // Xóa session và tạo lại token mới
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        // Chuyển hướng đến trang đăng nhập
        return redirect('/login');
    }

    //Quên mật khẩu
    public function showForgotPasswordForm()
    {
        return view('passwords.email');
    }

    //Gửi email chứa liên kết reset mật khẩu cho người dùng
    public function sendResetLink(Request $request)
    {
        // Validate email đầu vào
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->input('email');

        // Tự động xác định provider dựa trên email
        if (User::where('email', $email)->exists()) {
            $provider = 'users'; // Dành cho admin hoặc staff
        } elseif (Customer::where('email', $email)->exists()) {
            $provider = 'customers'; // Dành cho customer
        } else {
            return back()->withErrors(['email' => 'Email address not found.']);
        }

        // Gửi liên kết reset mật khẩu
        $response = Password::broker($provider)->sendResetLink(['email' => $email]);
        // Phản hồi kết quả
        if ($response == Password::RESET_LINK_SENT) {
            return back()->with('status', 'We have emailed your password reset link!');
        }

        return back()->withErrors(['email' => 'Failed to send reset link, please try again.']);
    }


    //Form reset mat khau 
    public function showResetPasswordForm($token)
    {
        return view('passwords.reset', ['token' => $token]);
    }

    //Xử lý reset mật khẩu


    public function resetPassword(Request $request)
    {
        // Validate request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'token' => 'required',
        ]);

        $email = $request->input('email');

        // Xác định provider dựa trên email
        if (User::where('email', $email)->exists()) {
            $provider = 'users';
        } elseif (Customer::where('email', $email)->exists()) {
            $provider = 'customers';
        } else {
            return back()->withErrors(['email' => 'Email address not found.']);
        }

        // Đặt lại mật khẩu
        $response = Password::broker($provider)->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        if ($response == Password::PASSWORD_RESET) {
            return redirect('/login')->with('status', 'Password has been reset successfully!');
        }

        return back()->withErrors(['email' => 'Failed to reset password, please try again.']);
    }
}
