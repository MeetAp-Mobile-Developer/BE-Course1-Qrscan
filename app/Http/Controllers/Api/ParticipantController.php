<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Participant;
use Illuminate\Support\Facades\Mail;
use App\Mail\ParticipantRegistered;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ParticipantController extends Controller
{
    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:participants,email',
            'phone' => 'required|string|max:20',
        ]);

        // Simpan data peserta
        $participant = Participant::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
        ]);

        // Generate QR Code
        $qrCode = QrCode::format('png')->size(200)->generate($participant->id);

        // Kirim email dengan QR Code
        Mail::to($participant->email)->send(new ParticipantRegistered($participant, $qrCode));

        return response()->json(['message' => 'Participant registered successfully!'], 201);
    }
}
