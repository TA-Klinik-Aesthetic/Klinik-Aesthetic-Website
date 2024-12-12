<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProdukController extends Controller
{
    // Menampilkan daftar produk
    public function index()
    {
        $response = Http::get('http://localhost:8080/api/produk'); // Ganti URL ini sesuai API Anda

        if ($response->successful()) {
            $produkList = $response->json();
        } else {
            $produkList = []; // Jika gagal, gunakan array kosong
        }

        return view('produk.listProduk', compact('produkList'));
    }

    // Menampilkan form untuk membuat produk baru
    public function create()
    {
        return view('produk.create');
    }

    // Menyimpan data produk baru
    public function store(Request $request)
    {
        $response = Http::post('http://localhost:8080/api/produk', $request->all());

        if ($response->successful()) {
            return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
        }

        return back()->with('error', 'Gagal menambahkan produk.');
    }

    // Menampilkan form edit produk
    public function edit($id)
    {
        $response = Http::get("http://localhost:8080/api/produk/$id");

        if ($response->successful()) {
            $produk = $response->json();
            return view('produk.edit', ['produk' => $produk]);
        }

        return back()->with('error', 'Gagal mengambil data produk.');
    }

    // Memperbarui data produk
    public function update(Request $request, $id)
    {
        $response = Http::put("http://localhost:8080/api/produk/$id", $request->all());

        if ($response->successful()) {
            return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
        }

        return back()->with('error', 'Gagal memperbarui produk.');
    }

    // Menghapus produk
    public function destroy($id)
    {
        $response = Http::delete("http://localhost:8080/api/produk/$id");

        if ($response->successful()) {
            return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
        }

        return back()->with('error', 'Gagal menghapus produk.');
    }
}
