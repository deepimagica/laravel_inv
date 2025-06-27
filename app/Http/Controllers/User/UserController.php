<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getProfilePage()
    {
        $user = Auth::guard('user')->user();
        return view('user.page.profile', compact('user'));
    }

    // public function changePassword(Request $request)
    // {
    //     try {
    //         $user = Auth::guard('user')->user();
    //         $validator = Validator::make($request->all(), [
    //             'current_password' => 'required',
    //             'new_password' => [
    //                 'required',
    //                 'string',
    //                 'min:8',
    //                 'confirmed',
    //                 'regex:/[a-z]/',
    //                 'regex:/[A-Z]/',
    //                 'regex:/[0-9]/',
    //                 'regex:/[@$!%*?&^#]/',
    //             ],
    //         ], [
    //             'new_password.regex' => 'Password must contain at least one lowercase letter, one uppercase letter, one number, and one special character.',
    //         ]);

    //         $validator->after(function ($validator) use ($request, $user) {
    //             if (!Hash::check($request->current_password, $user->password)) {
    //                 $validator->errors()->add('current_password', 'Current password is incorrect.');
    //             }

    //             if ($user && Hash::check($request->new_password, $user->password)) {
    //                 $validator->errors()->add('new_password', 'New password cannot be the same as the current password.');
    //             }
    //         });

    //         if ($validator->fails()) {
    //             throw new \Illuminate\Validation\ValidationException($validator);
    //         }

    //         $user->password = Hash::make($request->new_password);
    //         $user->save();

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Password changed successfully.'
    //         ]);
    //     } catch (\Illuminate\Validation\ValidationException $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Validation error.',
    //             'errors' => $e->errors(),
    //         ], 422);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'An unexpected error occurred. Please try again later.',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }

    public function changePassword(Request $request)
    {
        try {
            $user = Auth::guard('user')->user();
            $data = $request->validate([
                'current_password' => 'required',
                'new_password' => [
                    'required',
                    'string',
                    'min:8',
                    'confirmed',
                    'different:current_password',
                    'regex:/[a-z]/',
                    'regex:/[A-Z]/',
                    'regex:/[0-9]/',
                    'regex:/[@$!%*?&^#]/',
                ],
            ], [
                'new_password.regex' => 'Password must include uppercase, lowercase, number, and special character.',
            ]);

            if (!Hash::check($data['current_password'], $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Current password is incorrect.',
                    'errors' => ['current_password' => ['Current password is incorrect.']],
                ], 422);
            }

            $user->update([
                'password' => Hash::make($data['new_password'])
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Password changed successfully.'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
