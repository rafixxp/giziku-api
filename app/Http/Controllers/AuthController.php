<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
use App\Models\User;

class AuthController extends Controller
{
    public function signin(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required'
            ],
            [
                'email.required' => 'Email wajib diisi',
                'email.email' => 'Format email tidak valid',
                'password.required' => 'Password wajib diisi',
            ]
        );

        if(Auth::attempt($request->only('email','password'))){
            $user = Auth::user();
            $origin = $request->header('Origin');

            $allowed = [
                'admin' => env('ADMIN_URL'),
                'nutritionist' => env('NUTRITIONIST_URL')
            ];

            foreach($allowed as $role => $url){
                if(!$user->hasRole($role) && $origin !== $url){                    
                    $token = $user->createToken('user-token')->plainTextToken;
                    return response()->json([
                        "status" => "success",
                        "message" => "Signin successfully"
                    ])->cookie('session_token', base64_encode($token), 60 * 24, '/', 'localhost', true, true, false, 'Lax');
                }
            }
        }
        else{
            return response()->json([
                'status' => 'error',
                'message' => 'Email atau password salah !'
            ], 401);
        }
    }

    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required',
            'password' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('nutritionist');

        if($user){
            return response()->json([
                'status' => 'success',
                'message' => 'Register successfully !',
                'data' => $user
            ], 200);
        }
        else{
            return response()->json([
                'status' => 'error',
                'message' => 'Register failed !',
            ], 401);
        }
    }

    public function signout(Request $request)
    {
        $token = base64_decode($request->cookie('session_token'));

        if($token){
            $accessToken = PersonalAccessToken::findToken($token);
            
            if($accessToken){
                $accessToken->delete();
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Sign out successfully'
        ], 200);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed'
        ]);

        $user = auth()->user();

        if(!Hash::check($request->old_password, $user->password)){
            return response()->json([
                'status' => 'error',
                'message' => 'Old password does`nt match'
            ],403);
        }

        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Password updated successfully !'
        ]);
    }
}
