<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(AuthRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials , true)) {
            return redirect()->intended('dashboard')->with('success', 'تم تسجيل الدخول بنجاح.');
        }

        return back()->withErrors([
            'email' => 'البريد الإلكتروني أو كلمة المرور غير صحيحة.',
        ])->withInput($request->only('email'));   
    }
}
