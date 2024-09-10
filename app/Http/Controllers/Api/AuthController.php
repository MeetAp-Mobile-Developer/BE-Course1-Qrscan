<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Cek apakah username ada di database
        $user = User::where('username', $request->username)->first();

        // Jika user tidak ditemukan atau password salah
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'User/Password salah', // Pesan kesalahan
            ],);
        }

        // Jika username dan password benar, generate token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'msg' => 'ok',
            'id' => $user->id,
            'nama' => $user->nama,
            'token' => $token
        ]);
    }


    public function logout(Request $request)
{
    // Mendapatkan user yang sedang login dari token yang dikirim
    $user = $request->user();

    if ($user) {
        // Menghapus semua token pengguna (logout dari semua perangkat)
        $user->tokens()->delete();

        return response()->json([
            'message' => 'Logout berhasil',
        ], 200);
    } else {
        return response()->json([
            'message' => 'User tidak ditemukan atau sudah logout',
        ], 404);
    }
}


}
