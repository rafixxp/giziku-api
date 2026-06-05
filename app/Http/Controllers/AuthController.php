<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

        if(Auth::attempt($request->only('email', 'password'))){
            $user = Auth::user();
            $token = auth()->user()->createToken('user-token')->plainTextToken;
            
            return response()->json([
                'user' => $user,
                'token' => $token
            ]);
        }
    }

    public function signup(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'phone_number' => 'required|numeric',
                'password' => 'required|confirmed',
                'password_confirmation' => 'required'
            ],
            [
                'name.required' => 'Nama lengkap wajib diisi',
                'email.required' => 'Email wajib diisi',
                'email.email' => 'Format email tidak valid',
                'email.unique' => 'Email sudah terdaftar',
                'phone_number.required' => 'Nomor telepon wajib diisi',
                'phone_number.numeric' => 'Format nomor telepon harus angka',
                'password.required' => 'Password wajib diisi',
                'password.confirmed' => 'Konfirmasi password tidak sama!',
                'password_confirmation.required' => 'Konfirmasi password wajib diisi'
            ]
        );

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password)
        ]);

        Auth::login($user);
        $token = $user->createToken('user-token')->plainTextToken;

        return response()->json([
            'message' => 'User berhasil didaftarkan',
            'user' => $user,
            'token' => $token
        ]);
    }
}
