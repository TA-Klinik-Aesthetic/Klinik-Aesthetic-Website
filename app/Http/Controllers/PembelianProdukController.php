<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PembelianProdukController extends Controller
{
    public function index()
    {
        // Fetch product purchases
        $pembelianResponse = Http::get('http://localhost:8080/api/products-purchase/pembelian');
        $pembelianProduk = $pembelianResponse->json();

        // Fetch user data
        $userResponse = Http::get('http://127.0.0.1:8080/api/users');
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
        $userResponse = Http::get('http://127.0.0.1:8080/api/users');
        $users = $userResponse->json()['data'];

        // Fetch products
        $productResponse = Http::get('http://127.0.0.1:8080/api/produk');
        $products = $productResponse->json();

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
        $response = Http::post('http://localhost:8080/api/products-purchase/pembelian', $data);

        if ($response->ok()) {
            return redirect()->route('pembelianProduk.index')->with('success', 'Data berhasil ditambahkan!');
        } else {
            return back()->withErrors('Gagal menambahkan data. Silakan coba lagi.');
        }
    }

    public function show($id)
    {
        // Fetch the detail of the purchase
        $purchaseResponse = Http::get("http://127.0.0.1:8080/api/products-purchase/pembelian/$id");
        $pembelian = $purchaseResponse->json();
    
        // Fetch users
        $userResponse = Http::get('http://127.0.0.1:8080/api/users');
        $users = $userResponse->json()['data'];
    
        // Fetch products
        $productResponse = Http::get('http://127.0.0.1:8080/api/produk');
        $products = $productResponse->json();
    
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
    
}
