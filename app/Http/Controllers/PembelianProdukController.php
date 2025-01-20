<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PembelianProdukController extends Controller
{
    public function index()
    {
        // Fetch product purchases
        $pembelianResponse = Http::get('https://backend-klinik-aesthetic-production.up.railway.app/api/products-purchase/pembelian');
        $pembelianProduk = $pembelianResponse->json();

        // Fetch user data
        $userResponse = Http::get('https://backend-klinik-aesthetic-production.up.railway.app/api/users');
        $users = collect($userResponse->json()['data']); // Adjust to access the 'data' key

        // Map id_user to user name
        foreach ($pembelianProduk as &$pembelian) {
            $user = $users->firstWhere('id_user', $pembelian['id_user']); // Match id_user
            $pembelian['nama_user'] = $user ? $user['nama_user'] : 'Tidak Diketahui';
        }

        return view('pembelian-produk.pembelian', compact('pembelianProduk'));
    }

    public function create()
    {
        // Fetch users
        $userResponse = Http::get('https://backend-klinik-aesthetic-production.up.railway.app/api/users');
        $users = $userResponse->json()['data'];

        // Fetch products
        $productResponse = Http::get('https://backend-klinik-aesthetic-production.up.railway.app/api/produk');
        $products = $productResponse->json('data');

        return view('pembelian-produk.createPembelian', compact('users', 'products'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_user' => 'required|integer',
            'produk' => 'required|array',
            'produk.*.id_produk' => 'required|integer',
            'produk.*.jumlah_produk' => 'required|integer',
            'potongan_harga' => 'required|numeric',
        ]);

        // Kirim data ke API
        $response = Http::post('https://backend-klinik-aesthetic-production.up.railway.app/api/products-purchase/pembelian', $data);

        if ($response->ok()) {
            return redirect()->route('pembelianProduk.index')->with('success', 'Data berhasil ditambahkan!');
        } else {
            return back()->withErrors('Gagal menambahkan data. Silakan coba lagi.');
        }
    }

    public function show($id)
    {
        // Fetch the detail of the purchase
        $purchaseResponse = Http::get("https://backend-klinik-aesthetic-production.up.railway.app/api/products-purchase/pembelian/$id");
        $pembelian = $purchaseResponse->json();
    
        // Fetch users
        $userResponse = Http::get('https://backend-klinik-aesthetic-production.up.railway.app/api/users');
        $users = $userResponse->json()['data'];
    
        // Fetch products
        $productResponse = Http::get('https://backend-klinik-aesthetic-production.up.railway.app/api/produk');
        $products = $productResponse->json('data');
    
        // Check if the API responses are successful
        if ($purchaseResponse->successful() && $userResponse->successful() && $productResponse->successful()) {
            return view('pembelian-produk.detailPembelian', [
                'pembelian' => $pembelian,
                'users' => $users,
                'products' => $products
            ]);
        }
    
        // Redirect back with error if any API fails
        return redirect()->back()->with('error', 'Gagal mengambil data pembelian, pengguna, atau produk.');
    }

    public function edit($id)
    {
        $purchaseResponse = Http::get("https://backend-klinik-aesthetic-production.up.railway.app/api/products-purchase/pembelian/$id");
        $pembelian = $purchaseResponse->json();
    
        // Map detail_pembelian ke produk
        $pembelian['produk'] = collect($pembelian['detail_pembelian'])->map(function ($detail) {
            return [
                'id_produk' => $detail['id_produk'],
                'jumlah_produk' => $detail['jumlah_produk']
            ];
        })->toArray();
    
        $productResponse = Http::get('https://backend-klinik-aesthetic-production.up.railway.app/api/produk');
        $products = $productResponse->json();
    
        if ($purchaseResponse->successful() && $productResponse->successful()) {
            return view('pembelian-produk.editPembelianProduk', [
                'pembelian' => $pembelian,
                'products' => $products
            ]);
        }
    
        return redirect()->back()->with('error', 'Gagal mengambil data pembelian, pengguna, atau produk.');
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'potongan_harga' => 'required|numeric',
            'produk' => 'required|array',
            'produk.*.id_produk' => 'required|integer',
            'produk.*.jumlah_produk' => 'required|integer',
        ]);

        // Kirim data ke API
        $response = Http::put("https://backend-klinik-aesthetic-production.up.railway.app/api/products-purchase/pembelian/$id", $data);

        if ($response->ok()) {
            return redirect()->route('pembelianProduk.index')->with('success', 'Data berhasil diperbarui!');
        } else {
            return back()->withErrors('Gagal memperbarui data. Silakan coba lagi.');
        }
    }
    
}
