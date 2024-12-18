<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KategoriController extends Controller
{
    public function index()
    {
        // Mengambil data dari API
        $response = Http::get('https://backend-klinik-aesthetic-production.up.railway.app/api/kategori/');

        // Periksa apakah permintaan API berhasil
        if ($response->successful()) {
            $kategoriProduk = $response->json(); // Ambil data JSON
        } else {
            $kategoriProduk = []; // Jika gagal, gunakan array kosong
        }

        // Mengirim data ke tampilan
        return view('produk.listKategori', compact('kategoriProduk'));
    }

    public function create()
    {
        return view('produk.createKategori'); // Menampilkan view form tambah kategori
    }

    // Menyimpan kategori baru
    public function store(Request $request)
    {
        $data = $request->all();

        $response = Http::post("https://backend-klinik-aesthetic-production.up.railway.app/api/kategori", $data);

        if ($response->successful()) {
            return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan');
        }

        return back()->with('error', 'Gagal menambahkan kategori');
    }

    public function edit($id)
    {
        $response = Http::get("https://backend-klinik-aesthetic-production.up.railway.app/api/kategori/{$id}");

        if ($response->successful()) {
            // Ambil data langsung dari respons
            $kategori = $response->json();
            return view('produk.editKategori', compact('kategori'));
        }

        return redirect()->route('kategori.index')->with('error', 'Kategori tidak ditemukan.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        // Kirim data kategori untuk diperbarui ke API
        $response = Http::put("https://backend-klinik-aesthetic-production.up.railway.app/api/kategori/{$id}", [
            'nama_kategori' => $validated['nama_kategori'],
        ]);

        // Cek apakah API memberikan respons yang sukses
        if ($response->successful()) {
            return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui.');
        }

        // Jika gagal, tampilkan pesan kesalahan yang lebih detail
        $errorMessage = $response->json()['message'] ?? 'Gagal memperbarui kategori.';
        return back()->with('error', $errorMessage);
    }

    public function destroy($id)
    {
        $response = Http::delete("https://backend-klinik-aesthetic-production.up.railway.app/api/kategori/{$id}");

        if ($response->successful()) {
            return redirect()->route('kategori.index')->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->route('kategori.index')->with('error', 'Gagal menghapus data');
        }
    }
}
