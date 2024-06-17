<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request){
        return view("admin.login.index");
    }
    public function checkLogin(Request $request){ 
 // Lấy giá trị từ request
 $loginField = $request->input('username');
 $password = $request->input('password');

 // Kiểm tra xem người dùng nhập username hay email
 $credentials = filter_var($loginField, FILTER_VALIDATE_EMAIL) 
     ? ['email' => $loginField, 'password' => $password] 
     : ['username' => $loginField, 'password' => $password];

 // Thử đăng nhập
 if (Auth::attempt($credentials)) {
     // Xác thực thành công
     return redirect()->intended('/admin/dashboard'); // Chuyển hướng đến trang dashboard sau khi đăng nhập thành công
 }

 // Xác thực thất bại
 return back()->withErrors([
     'email' => 'Tên đăng nhập, email hoặc mật khẩu không đúng.',
 ]);
    }

}
