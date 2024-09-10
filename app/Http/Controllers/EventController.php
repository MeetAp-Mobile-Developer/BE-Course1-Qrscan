<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Participant;
use App\Models\QrCode;
use SimpleSoftwareIO\QrCode\Facades\QrCode as QrCodeFacade;
use Illuminate\Support\Facades\Mail;
use App\Mail\ParticipantRegisteredMail;

class EventController extends Controller
{
    public function register(Request $request)
    {
        $event = Event::create([
            'name' => $request->input('event_name'),
            'date' => $request->input('event_date'),
        ]);

        $participant = Participant::create($request->only(['name', 'email', 'phone']));

        // Generate QR Code
        $qrCodePath = 'qr_codes/' . uniqid() . '.png';
        QrCodeFacade::format('png')->size(200)->generate($participant->id, public_path($qrCodePath));

        $qrCode = QrCode::create([
            'event_id' => $event->id,
            'participant_id' => $participant->id,
            'path' => $qrCodePath,
        ]);

        // Send email with QR Code attachment
        Mail::to($participant->email)->send(new ParticipantRegisteredMail($participant, $qrCodePath));

        return response()->json([
            'message' => 'Participant registered successfully',
            'qr_code_path' => $qrCodePath,
        ]);
    }

    public function listScans()
    {
        $scans = QrCode::with('participant', 'event')->get();

        return response()->json([
            'scans' => $scans,
        ]);
    }
}

