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

    public function show($id)
    {
        $response = Http::get("{$this->baseApiUrl}/{$id}");

        if ($response->successful()) {
            $data = $response->json();

            $data['potongan_harga'] = $data['treatment']['biaya_treatment'] * 0.1;

            return view('treatment.detailBookingTreatment', ['detail' => $data]);
        } else {
            return back()->with('error', 'Gagal mengambil data detail');
        }

    }
    
    public function update(Request $request, $id)
    {
        $response = Http::put("{$this->baseApiUrl}/{$id}", [
            'harga_akhir_treatment' => $request->harga_akhir_treatment,
            'potongan_harga' => $request->potongan_harga,
        ]);

        if ($response->successful()) {
            return back()->with('success', 'Data berhasil diperbarui');
        } else {
            return back()->with('error', 'Gagal memperbarui data');
        }
    }

    public function destroy($id)
    {
        $response = Http::delete("{$this->baseApiUrl}/{$id}");

        if ($response->successful()) {
            return back()->with('success', 'Data berhasil dihapus');
        } else {
            return back()->with('error', 'Gagal menghapus data');
        }
    }
}
