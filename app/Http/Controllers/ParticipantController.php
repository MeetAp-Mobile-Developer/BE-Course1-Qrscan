<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Participant;
use Illuminate\Http\Request;
use Milon\Barcode\DNS2D;

class ParticipantController extends Controller
{
    public function register()
    {
        return view("participant.register-participant");
    }

    public function register_store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:participants,email',
            'phone' => 'required|string|max:20|min:8',
        ]);

        $participant = new Participant();
        $participant->name = $request->name;
        $participant->email = $request->email;
        $participant->phone = $request->phone;

        $result = $participant->save();

        // TODO : bikin qr code dan PDF lalu kirim email

        return redirect("/participant/register")->with('status', 'data berhasil disimpan, silahkan cek email anda');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
