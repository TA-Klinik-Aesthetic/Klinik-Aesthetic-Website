<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KonsultasiController extends Controller
{
    public function indexWithDoctor()
    {
        // Mengambil data dari API
        $response = Http::get('http://localhost:8080/api/konsultasi');
        $data = $response->json();
    
        // Filter data untuk konsultasi dengan dokter
        $dataWithDoctor = collect($data['data'])->filter(function ($item) {
            return isset($item['dokter']); // Data memiliki dokter
        });
    
        // Mengirim data ke tampilan
        return view('konsultasi.tambahBooking', ['data' => $dataWithDoctor]);
    }
    
    public function indexWithoutDoctor()
    {
        // Mengambil data dari API
        $response = Http::get('http://localhost:8080/api/konsultasi');
        $data = $response->json();
    
        // Filter data untuk konsultasi tanpa dokter
        $dataWithoutDoctor = collect($data['data'])->filter(function ($item) {
            return !isset($item['dokter']); // Data tidak memiliki dokter
        });
    
        // Mengirim data ke tampilan
        return view('konsultasi.lihatBooking', ['data' => $dataWithoutDoctor]);
    }

    public function create()
    {
        // Ambil data dari API untuk dropdown
        $usersResponse = Http::get('http://localhost:8080/api/users');
        $doktersResponse = Http::get('http://localhost:8080/api/dokters');

        $users = $usersResponse->json()['data'];
        $dokters = $doktersResponse->json()['data'];

        // Debugging jika data kosong atau bermasalah
        if (empty($users) || empty($dokters)) {
            dd('Users:', $users, 'Dokters:', $dokters);
        }

        return view('konsultasi.create', compact('users', 'dokters'));
    }

    // Menyimpan data konsultasi dengan mengirimkan POST request ke API
    public function store(Request $request)
    {
        $response = Http::post('http://localhost:8080/api/konsultasi', [
            'id_user' => $request->id_user,
            'id_dokter' => $request->id_dokter,
            'waktu_konsultasi' => $request->waktu_konsultasi,
        ]);

        if ($response->successful()) {
            // Menyimpan pesan ke session
            session()->flash('success', 'Data konsultasi berhasil ditambahkan!');
            return redirect()->route('konsultasi.create'); // Redirect ke halaman form
        }

        session()->flash('error', 'Terjadi kesalahan saat menambahkan data!');
        return redirect()->back();
    }

    public function edit($id)
    {
        // Ambil data konsultasi berdasarkan ID
        $response = Http::get("http://localhost:8080/api/konsultasi/{$id}");
        $konsultasi = $response->json()['data'];

        // Ambil semua dokter
        $dokters = Http::get('http://localhost:8080/api/dokters')->json()['data'];

        return view('konsultasi.edit', compact('konsultasi', 'dokters'));
    }

    public function update(Request $request, $id)
    {
        // Kirim data dokter ke API
        $response = Http::put("http://localhost:8080/api/konsultasi/{$id}", [
            'id_dokter' => $request->id_dokter,
        ]);

        if ($response->successful()) {
            session()->flash('success', 'Data dokter berhasil diperbarui!');
            return redirect()->route('konsultasi.without-doctor');
        }

        session()->flash('error', 'Terjadi kesalahan saat memperbarui data dokter!');
        return redirect()->back();
    }
}
