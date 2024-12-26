@extends('dashboard.index')

@section('content')
<div class="container">
    <h1 class="mb-4">Detail Penjualan Produk</h1>

    <div class="mb-3">
        <strong>Nama User:</strong> 
        {{ $users[array_search($pembelian['id_user'], array_column($users, 'id_user'))]['nama_user'] ?? 'Tidak Diketahui' }}
    </div>
    <div class="mb-3">
        <strong>Tanggal Pembelian:</strong> {{ $pembelian['tanggal_pembelian'] }}
    </div>
    <div class="mb-3">
        <strong>Harga Total:</strong> {{ number_format($pembelian['harga_total'], 2, ',', '.') }}
    </div>
    <div class="mb-3">
        <strong>Potongan Harga:</strong> {{ number_format($pembelian['potongan_harga'], 2, ',', '.') }}
    </div>
    <div class="mb-3">
        <strong>Harga Akhir:</strong> {{ number_format($pembelian['harga_akhir'], 2, ',', '.') }}
    </div>

    <h2 class="mt-4">Detail Produk</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Jumlah Produk</th>
                <th>Harga Pembelian</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pembelian['detail_pembelian'] as $detail)
            <tr>
                <td>
                    {{ $products[array_search($detail['id_produk'], array_column($products, 'id_produk'))]['nama_produk'] ?? 'Tidak Diketahui' }}
                </td>
                <td>{{ $detail['jumlah_produk'] }}</td>
                <td>{{ number_format($detail['harga_pembelian_produk'], 2, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ url('/pembelian-produk') }}" class="btn btn-primary">Kembali</a>
</div>
@endsection
