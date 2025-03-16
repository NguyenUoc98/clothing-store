<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Token;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerificationMail;

class RegisteredUserController extends Controller
{
    // Hiển thị form đăng ký
    public function create()
    {
        return view('createaccount'); // Tạo view đăng ký
    }

    // Xử lý đăng ký và đăng nhập người dùng
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'phone' => 'required|string|regex:/^[0-9]{10,15}$/|unique:customers',
            'password' => [
                'required',
                'string',
                'confirmed',
                'min:8',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&]/',
            ],
        ]);
        // dd($request->all());
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);
        $token = Str::random(60);

        Token::create([
            'customer_id' => $customer->id,
            'type' => 'email_verification',
            'token' => $token,
            'expires_at' => now()->addMinutes(30),
        ]);

        try {
            Mail::to($customer->email)->send(new EmailVerificationMail($token));
            Auth::guard('customer')->login($customer);
        } catch (\Exception $e) {
            return back()->with('error', 'Could not send verification email. Please try again later.');
        }

        return redirect()->route('home')->with('status', 'Vui lòng kiểm tra email để hoàn tất việc đăng ký.');

        
    }
    public function verifyEmail(Request $request)
{
    // Kiểm tra token hợp lệ
    $token = Token::where('token', $request->query('token'))
        ->where('type', 'email_verification')
        ->where('expires_at', '>', now())
        ->first();

    // Nếu không tìm thấy token hợp lệ
    if (!$token) {
        return redirect('/')->with('error', 'Invalid or expired token. Please try registering again.');
    }

    // Lấy thông tin khách hàng từ token
    $customer = Customer::find($token->customer_id);

    // Nếu không tìm thấy khách hàng
    if (!$customer) {
        return redirect('/')->with('error', 'Customer not found.');
    }

    // Kiểm tra xem email đã được xác nhận chưa
    if ($customer->email_verified_at) {
        return redirect('/')->with('info', 'Your email has already been verified.');
    }

    // Cập nhật trạng thái xác nhận email
    $customer->email_verified_at = now();
    $customer->save();

    // Xóa token đã sử dụng
    $token->delete();

    // Chuyển hướng người dùng đến trang login sau khi xác nhận thành công
    return redirect()->route('login')->with('success', 'Email verified successfully! You can now log in.');
}
}
