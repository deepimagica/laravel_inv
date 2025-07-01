<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class LoginController extends Controller
{
    public function getLoginPage()
    {
        return view('admin.auth.login');
    }

    public function postLoginPage(Request $request)
    {
        try {
            $data = $request->all();
            $credentials = Validator::make($data,[
                'email' => 'required|email',
                'password' => 'required'
            ])->validate();

            if (Auth::guard('admin')->attempt($credentials)) {
                $user = Auth::guard('admin')->user();
                return response()->json([
                    'success' => true,
                    'message' => 'Login successful! Redirecting...',
                    'data' => [
                        'redirect_url' => route('admin.dashboard'),
                    ]
                ]);
            } else {
                $user = Admin::where('email', $credentials['email'])->first();
                return response()->json([
                    'success' => false,
                    'message' => 'Mismatched! Invalid credential.',
                ], 401);
            }
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            dd($e);
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
            ], 500);
        }
    }
}
