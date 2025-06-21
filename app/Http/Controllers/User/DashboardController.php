<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function getDashboard(Request $request)
    {
        return view('user.page.dashboard');
    }

    public function userLogout(Request $request)
    {
        Auth::guard('user')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.page');
    }

    public function getInvoice()
    {
        return view('user.page.invoice');
    }

    public function getCreateInvoiceForm()
    {
        return view('user.page.create-invoice');
    }
}
