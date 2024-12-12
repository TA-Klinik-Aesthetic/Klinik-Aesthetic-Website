<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KategoriController extends Controller
{
    public function index()
    {
        // Mengambil data dari API
        $response = Http::get('http://localhost:8080/api/kategori/');

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

        $response = Http::post("http://localhost:8080/api/kategori", $data);

        if ($response->successful()) {
            return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan');
        }

        return back()->with('error', 'Gagal menambahkan kategori');
    }

    public function edit($id)
    {
        // Ambil data kategori berdasarkan ID
        $response = Http::get("http://localhost:8080/api/kategori/{$id}");
        $item = $response->json()['data'];

        return view('kategori.edit');
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);


        // Kirim data kategori ke API
        $response = Http::put("http://localhost:8080/api/kategori/{$id}", $data);

        if ($response->successful()) {
            session()->flash('success', 'Nama Kategori berhasil diperbarui!');
            return redirect()->route('kategori.index');
        }

        session()->flash('error', 'Terjadi kesalahan saat memperbarui kategori!');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $response = Http::delete("http://localhost:8080/api/kategori/{$id}");

        if ($response->successful()) {
            return redirect()->route('kategori.index')->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->route('kategori.index')->with('error', 'Gagal menghapus data');
        }
    }

}
