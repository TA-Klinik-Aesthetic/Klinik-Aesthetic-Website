@extends('dashboard.index')

@section('content')
    <h1>Detail Treatment</h1>

    <table class="table table-bordered">
        <tr><th>ID</th><td>{{ $treatment['id_treatment'] }}</td></tr>
        <tr><th>Nama</th><td>{{ $treatment['nama_treatment'] }}</td></tr>
        <tr><th>Jenis</th><td>{{ $treatment['jenis_treatment']['nama_jenis_treatment'] }}</td></tr>
        <tr><th>Deskripsi</th><td>{{ $treatment['deskripsi_treatment'] }}</td></tr>
        <tr><th>Biaya</th><td>Rp {{ number_format($treatment['biaya_treatment']) }}</td></tr>
        <tr><th>Gambar</th><td><img src="{{ $treatment['gambar_treatment'] }}" width="200px"></td></tr>
    </table>
@endsection
