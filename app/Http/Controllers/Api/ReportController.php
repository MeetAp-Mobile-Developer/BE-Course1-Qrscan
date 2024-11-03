<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('download')&& $request->get('download') == 'csv') {
            return $this->downloadCsv();
        }

        $attendance = Attendance::with(["scan:id_scan,title", "participant:id,name,email,phone"])
            ->orderBy("created_at", "desc")
            ->get();

        return view("report", compact("attendance"));
    }

    private function downloadCsv()
    {
        // Menggunakan StreamedResponse untuk mendownload file CSV
        $response = new StreamedResponse(function () {
            // Membuka output sebagai stream
            $handle = fopen('php://output', 'w');

            // Menuliskan header kolom CSV
            fputcsv($handle, ['ID', 'Nama', 'Email', 'Phone', 'Scan Title', 'Tanggal']);

            // Mengambil data attendance dengan relasi
            $attendance = Attendance::with(['scan:id_scan,title', 'participant:id,name,email,phone'])
                ->orderBy('created_at', 'desc')
                ->get();

            // Menuliskan data ke dalam file CSV
            foreach ($attendance as $item) {
                fputcsv($handle, [
                    $item->id,
                    $item->participant->name ?? '-',
                    $item->participant->email ?? '-',
                    $item->participant->phone ?? '-',
                    $item->scan->title ?? '-',
                    $item->created_at->toDateTimeString(),
                ]);
            }

            // Menutup handle file
            fclose($handle);
        });

        // Mengatur header agar browser secara otomatis mengunduh file
        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="reportScan.csv"');

        return $response;
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
