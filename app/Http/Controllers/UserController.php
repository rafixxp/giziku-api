<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'required',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->role);

        if($user){
            return response()->json([
               'message' => 'User berhasil ditambahkan !',
               'user' => $user
            ], 201);
        }
        else{
            return response()->json([
                'message' => 'User gagal ditambahkan !',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        if($user){
            return response()->json([
                'message' => 'User ditemukan !',
                'user' => $user
            ], 200);
        }
        else{
            return response()->json([
                'message' => 'User tidak ditemukan !',
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'phone_number' => 'required',
            'password' => 'required|string|min:8',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->role);

        if($user){
            return response()->json([
               'message' => 'User berhasil diupdate !',
               'user' => $user
            ], 201);
        }
        else{
            return response()->json([
                'message' => 'User gagal diupdate !',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::where('id', $id)->delete();

        if($user){
            return response()->json([
                'message' => 'User berhasil dihapus !'
            ], 200);
        }
        else{
            return response()->json([
                'message' => 'User gagal dihapus !'
            ], 500);
        }
    }
}
