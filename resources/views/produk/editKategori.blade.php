@extends('dashboard.index')

@section('content')
    <div class="container">
        <h2>Edit Kategori</h2>

        <!-- Menampilkan pesan sukses atau error -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('kategori.update', $kategori['id_kategori']) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama_kategori">Nama Kategori</label>
                <input type="text" name="nama_kategori" id="nama_kategori" class="form-control"
                    value="{{ old('nama_kategori', $kategori['nama_kategori']) }}" required>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Update Kategori</button>
            <a href="{{ route('kategori.index') }}" class="btn btn-secondary mt-3">Cancel</a>
        </form>
    </div>
@endsection
