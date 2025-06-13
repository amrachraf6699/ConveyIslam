<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $languages_count = Language::count();
        $admins_count = User::count();

        return view('dashboard.index' , compact('languages_count', 'admins_count'));
    }
}
