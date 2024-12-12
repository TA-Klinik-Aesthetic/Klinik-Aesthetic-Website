<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DetailBookingTreatmentController extends Controller
{
    protected $baseApiUrl = 'http://127.0.0.1:8080/api/detailBookingTreatments';

    public function store(Request $request)
    {

        $details = [];

        foreach ($request->details as $detail) {
            $details[] = [
                'id_treatment' => $detail['id_treatment'],
                'id_dokter' => $detail['id_dokter'],
                'id_beautician' => $detail['id_beautician'],
            ];
        }
    
        $response = Http::post($this->baseApiUrl, [
            'id_user' => $request->id_user,
            'waktu_treatment' => $request->waktu_treatment,
            'status_booking_treatment' => $request->status_booking_treatment,
            'potongan_harga' => $request->potongan_harga,
            'details' => $details,
        ]);

        if ($response->successful()) {
            return back()->with('success', 'Data berhasil dikirim');
        } else {
            return back()->with('error', 'Gagal mengirim data');
        }
    }
}
