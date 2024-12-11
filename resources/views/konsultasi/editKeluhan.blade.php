@extends('dashboard.index')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">Edit Keluhan dan Saran Tindakan</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if (isset($data['id_detail_konsultasi']))
        <form action="{{ route('konsultasi.updateKeluhan', $data['id_detail_konsultasi']) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="keluhan_pelanggan">Keluhan Pelanggan</label>
                <textarea class="form-control" id="keluhan_pelanggan" name="keluhan_pelanggan" required>{{ $data['keluhan_pelanggan'] }}</textarea>
            </div>

            <div class="form-group">
                <label for="saran_tindakan">Saran Tindakan</label>
                <textarea class="form-control" id="saran_tindakan" name="saran_tindakan" required>{{ $data['saran_tindakan'] }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">Update</button>
        </form>
    @else
        <p>Data tidak ditemukan.</p>
    @endif
@endsection
