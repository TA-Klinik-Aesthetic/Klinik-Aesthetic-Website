<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TreatmentController extends Controller
{
    // protected $baseApiUrl = 'http://backend-klinik-aesthetic-production.up.railway.app/api/treatments';
    protected $baseApiUrl = 'https://backend-klinik-aesthetic-production.up.railway.app/api/treatments';


    public function index()
    {
        $response = Http::get($this->baseApiUrl);
        $treatments = $response->json()['data'] ?? [];

        return view('treatment.listTreatment', ['treatments' => $treatments]);
    }

    public function show($id)
    {
        $response = Http::get("{$this->baseApiUrl}/{$id}");
        $treatment = $response->json()['data'] ?? null;

        if ($treatment) {
            return view('treatment.detailTreatment', ['treatment' => $treatment]);
        } else {
            return back()->with('error', 'Data treatment tidak ditemukan');
        }
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $response = Http::post($this->baseApiUrl, $data);

        if ($response->successful()) {
            return redirect()->route('treatment.index')->with('success', 'Treatment berhasil ditambahkan');
        }

        return back()->with('error', 'Gagal menambahkan treatment');
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $response = Http::put("{$this->baseApiUrl}/{$id}", $data);

        if ($response->successful()) {
            return redirect()->route('treatment.index')->with('success', 'Treatment berhasil diperbarui');
        }

        return back()->with('error', 'Gagal memperbarui treatment');
    }

    public function destroy($id)
    {
        $response = Http::delete("{$this->baseApiUrl}/{$id}");

        if ($response->successful()) {
            return redirect()->route('treatment.index')->with('success', 'Treatment berhasil dihapus');
        }

        return back()->with('error', 'Gagal menghapus treatment');
    }
}
