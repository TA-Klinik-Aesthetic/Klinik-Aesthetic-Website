<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DetailKonsultasiController extends Controller
{
    public function editKeluhan($id)
    {
        // Ambil data detail konsultasi berdasarkan ID
        $response = Http::get('http://localhost:8080/api/detail-konsultasi/' . $id);
        $detailKonsultasi = $response->json();
    
        // Kirim data ke halaman editKeluhan
        return view('konsultasi.editKeluhan', [
            'detailKonsultasi' => $detailKonsultasi['data'] ?? null
        ]);
    }
    
    public function updateKeluhan(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'keluhan_pelanggan' => 'required|string',
            'saran_tindakan' => 'required|string',
        ]);
    
        // Update data ke API
        $response = Http::put('http://localhost:8080/api/detail-konsultasi/' . $id, [
            'keluhan_pelanggan' => $request->keluhan_pelanggan,
            'saran_tindakan' => $request->saran_tindakan,
        ]);
    
        if ($response->successful()) {
            return redirect()->route('konsultasi.index')->with('success', 'Detail konsultasi berhasil diperbarui.');
        } else {
            return back()->with('error', 'Gagal memperbarui detail konsultasi.');
        }
    }
}
