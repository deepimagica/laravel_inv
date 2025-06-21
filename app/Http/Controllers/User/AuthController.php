<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function getLoginPage(Request $request)
    {
        return view('user.auth.login');
    }

    public function postLoginPage(Request $request)
    {
        try {
            $data = $request->all();
            $credentials = validator($data, [
                'email' => ['required', 'email'],
                'password' => ['required'],
            ])->validate();

            if (Auth::guard('user')->attempt($credentials)) {
                $user = Auth::guard('user')->user();
                return response()->json([
                    'success' => true,
                    'message' => 'Login successful! Redirecting...',
                    'data' => [
                        'redirect_url' => route('user.dashboard'),
                    ]
                ]);
            } else {
                $user = \App\Models\User::where('email', $credentials['email'])->first();
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
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
            ], 500);
        }
    }
}
