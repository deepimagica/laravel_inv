<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    public function getDashboardPage()
    {
        return view('admin.page.dashboard');
    }

    public function getUsers(Request $request)
    {
        if ($request->ajax()) {
            $query = User::select(['id', 'name', 'email', 'created_at']);
            return DataTables::eloquent($query)
                ->editColumn('created_at', function ($user) {
                    return $user->created_at->format('Y-m-d H:i');
                })
                ->make(true);
        }
        return view('admin.page.users_list');
    }

    public function adminLogOut()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login.page');
    }
}
