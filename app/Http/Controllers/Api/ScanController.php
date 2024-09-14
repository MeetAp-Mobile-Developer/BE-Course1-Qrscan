<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Participant;
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
            ], 401); // 401 Unauthorized
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

    public function scan_qr(Request $request)
    {
        $request->validate([
            'id_scan' => 'required',
            'qr_content' => 'required',
        ]);

        $user = Auth::user();

        $is_id_scan = Scan::where("id_scan", $request->id_scan)->first();

        if (!$is_id_scan) {
            return response()->json([
                "status" => "fail",
                "message" => "id scan not found",
                "errors" => [
                    "id_scan" => "Not Found"
                ]
            ], 404);
        }

        $is_participant = Participant::where("qr_content", $request->qr_content)->first();

        if (!$is_participant) {
            return response()->json([
                "status" => "fail",
                "message" => "participant not found",
                "errors" => [
                    "qr_content" => "Not Found"
                ]
            ], 404);
        }

        $attandance = new Attendance();
        $attandance->participant_id = $is_participant->id;
        $attandance->id_scan = $is_id_scan->id_scan;
        $attandance->scan_at = now();
        $attandance->scan_by = $user->id;

        $attandance->save();

        if ($attandance) {
            return response()->json([
                "status" => "success",
                "message" => $is_id_scan->title ." - ". $request->qr_content . " Success",
            ], 200);
        } else {
            return response()->json([
                "status" => "fail",
                "message" => "error when saving data",
            ], 422);
        }
    }
}
