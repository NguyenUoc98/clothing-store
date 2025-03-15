<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Role
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Kiểm tra guard đang sử dụng, mặc định là 'web'
        $guard = $request->guard ?? 'web';  // Nếu không có guard, mặc định là 'web'
        
        // Kiểm tra xem người dùng có đăng nhập hay chưa với guard hiện tại
        if (!Auth::guard($guard)->check()) {
            return redirect('/categories')->with('error', 'Bạn cần phải đăng nhập để truy cập trang này.');
        }
    
        $user = Auth::guard($guard)->user();
    
        // Phân tách các vai trò từ $role thành một mảng
        $roles = explode('|', $role);
    
        // Kiểm tra nếu vai trò của người dùng nằm trong danh sách $roles
        if (!in_array($user->role, $roles)) {
            return redirect('/categories')->with('error', 'Bạn không có quyền truy cập trang này.');
        }
    
        return $next($request);
    }
    
}
