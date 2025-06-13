<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\UpdatePassowrdRequest;
use Hash;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function logout(Request $request)
    {
        auth()->logout();

        return redirect()->route('login')->with('success', 'تم تسجيل الخروج بنجاح.');
    }

    public function updatePassword(UpdatePassowrdRequest $request)
    {
        $user = auth()->user();

        if(!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'كلمة المرور الحالية غير صحيحة.']);
        }

        $user->update([
            'password' => $request->new_password,
        ]);

        return redirect()->back()->with('success', 'تم تحديث كلمة المرور بنجاح.');
    }
}
