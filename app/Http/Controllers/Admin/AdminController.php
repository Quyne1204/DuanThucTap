<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function login()
    {
        return view('dashboard.login');
    }

    public function loginPost(Request $request)
    {
        $user = $request->only('email', 'password');
        if (Auth::attempt($user)) {
            return redirect()->route('homeadmin');
        }
        $error = 'Sai thông tin đăng nhập!';
        return redirect()->back()->withErrors(['error' => $error])->with('error', $error);
    }

    function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
