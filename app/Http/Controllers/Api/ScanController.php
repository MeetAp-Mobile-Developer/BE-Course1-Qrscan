<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Scan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScanController extends Controller
{

    public function index(Request $request)
    {

        // Cek apakah pengguna sudah login
        if (!Auth::check()) {
            return response()->json([
                'message' => 'Token tidak valid atau pengguna sudah logout',
            ],401); // 401 Unauthorized
        }
        // Ambil ID pengguna yang sedang login
        $userId = Auth::id();

        // Tentukan data yang akan dikembalikan berdasarkan ID pengguna
        if ($userId == 1) {
            // Misalnya ID 1 adalah "panitia" dan hanya melihat data tertentu
            $scans = Scan::whereIn('id_scan', [1, 2, 3])->get();
        } else {
            // Pengguna lain melihat semua data
            $scans = Scan::all();
        }

        return response()->json($scans);
    }
}
