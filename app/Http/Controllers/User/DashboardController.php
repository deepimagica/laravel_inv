<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function getDashboard(Request $request)
    {
        $authUser = Auth::guard('user')->user();
        $invoicesCount = $authUser->invoices()->count();
        return view('user.page.dashboard',compact('invoicesCount'));
    }

    public function userLogout(Request $request)
    {
        Auth::guard('user')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.page');
    }
}
