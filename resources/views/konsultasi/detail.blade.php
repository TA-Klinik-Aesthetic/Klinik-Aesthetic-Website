@extends('dashboard.index')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">Detail Konsultasi</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <table class="table">
                <tr>
                    <th>Nama Pelanggan</th>
                    <td>{{ $konsultasi['nama_user'] }}</td>
                </tr>
                <tr>
                    <th>Nama Dokter</th>
                    <td>{{ $konsultasi['nama_dokter'] }}</td>
                </tr>
                <tr>
                    <th>Waktu Konsultasi</th>
                    <td>{{ $konsultasi['waktu_konsultasi'] ?? 'Tidak tersedia' }}</td>
                </tr>
                <tr>
                    <th>Keluhan Pelanggan</th>
                    <td>{{ $konsultasi['detail_konsultasi']['keluhan_pelanggan'] ?? 'Tidak ada keluhan' }}</td>
                </tr>
                <tr>
                    <th>Saran Tindakan</th>
                    <td>{{ $konsultasi['detail_konsultasi']['saran_tindakan'] ?? 'Tidak ada saran' }}</td>
                </tr>
            </table>
            <a href="{{ route('konsultasi.with-doctor') }}" class="btn btn-secondary mt-3">Kembali</a>
        </div>
    </div>
@endsection
