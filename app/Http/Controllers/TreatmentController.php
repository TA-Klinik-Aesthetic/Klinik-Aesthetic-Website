<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TreatmentController extends Controller
{
    private $baseApiUrl = 'http://backend-klinik-aesthetic-production.up.railway.app/api/jenisTreatments';

    /**
     * Menampilkan semua jenis treatment
     */
    public function index()
    {
        $response = Http::get($this->baseApiUrl);

        if ($response->successful()) {
            $data = $response->json();
            return view('treatment.listJenisTreatment', ['jenisTreatments' => $data['data']]);
        } else {
            return back()->with('error', 'Gagal mengambil data jenis treatment.');
        }
    }

    /**
     * Menampilkan detail jenis treatment berdasarkan ID
     */
    public function show($id)
    {
        $response = Http::get("{$this->baseApiUrl}/{$id}");

        if ($response->successful()) {
            $data = $response->json();
            return response()->json($data);
        } else {
            return response()->json(['error' => 'Gagal mengambil data jenis treatment.'], $response->status());
        }
    }

    /**
     * Menyimpan data jenis treatment baru (POST)
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_jenis_treatment' => 'required|string|max:255',
        ]);

        $response = Http::post($this->baseApiUrl, $validatedData);

        if ($response->successful()) {
            return back()->with('success', 'Jenis treatment berhasil ditambahkan.');
        } else {
            return back()->with('error', 'Gagal menambahkan jenis treatment.');
        }
    }

    /**
     * Mengupdate data jenis treatment berdasarkan ID (PUT)
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_jenis_treatment' => 'required|string|max:255',
        ]);

        $response = Http::put("{$this->baseApiUrl}/{$id}", $validatedData);

        if ($response->successful()) {
            return back()->with('success', 'Jenis treatment berhasil diperbarui.');
        } else {
            return back()->with('error', 'Gagal memperbarui jenis treatment.');
        }
    }

    /**
     * Menghapus data jenis treatment berdasarkan ID (DELETE)
     */
    public function destroy($id)
    {
        $response = Http::delete("{$this->baseApiUrl}/{$id}");

        if ($response->successful()) {
            return back()->with('success', 'Jenis treatment berhasil dihapus.');
        } else {
            return back()->with('error', 'Gagal menghapus jenis treatment.');
        }
    }
}
