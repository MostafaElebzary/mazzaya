<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    protected $redirectTo = '/admin/';

    public function renderLogin()
    {
        if (Auth::guard('admins')->check()) {
            return redirect($this->redirectTo);
        }
        return view('Admin.auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => 'required|string|max:255',
            "password" => 'required|string|min:6',
        ]);
        if (!is_array($validator) && $validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $email = $request->get('email');
        $password = $request->get('password');
        $remember = $request->get('remember') ? true : false;

        $logged_in = Auth::guard('admins')
                ->attempt(['email' => $email, 'password' => $password, 'is_active' => 1], $remember)
            || Auth::guard('admins')->attempt(['name' => $email, 'password' => $password, 'status' => 1],
                $remember);
        if ($logged_in) {
            return redirect($this->redirectTo);
        } else {
            return redirect()->back()->withErrors([__('خطأ في تسجيل الدخول.تأكد من بيانات التسجيل وأعد المحاولة.')]);
        }
    }
}
