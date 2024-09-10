<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ParticipantRegistered extends Mailable
{
    use Queueable, SerializesModels;

    public $participant;
    public $qrCode;

    public function __construct($participant, $qrCode)
    {
        $this->participant = $participant;
        $this->qrCode = $qrCode;
    }

    public function build()
    {
        return $this->view('emails.participant_registered')
                    ->with([
                        'participantName' => $this->participant->name,
                        'qrCode' => $this->qrCode,
                    ]);
    }
}
