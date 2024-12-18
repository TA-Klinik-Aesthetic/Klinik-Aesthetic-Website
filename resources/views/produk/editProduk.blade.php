@extends('dashboard.index')

@section('content')
    <div class="container">
        <h2>Edit Produk</h2>

        <!-- Menampilkan pesan sukses atau error -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('produk.update', $produk['id_produk']) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nama Produk -->
            <div class="form-group">
                <label for="nama_produk">Nama Produk</label>
                <input type="text" name="nama_produk" id="nama_produk" class="form-control" 
                    value="{{ old('nama_produk', $produk['nama_produk']) }}" required>
            </div>

            <!-- Deskripsi Produk -->
            <div class="form-group">
                <label for="deskripsi_produk">Deskripsi Produk</label>
                <textarea name="deskripsi_produk" id="deskripsi_produk" class="form-control" rows="4" required>{{ old('deskripsi_produk', $produk['deskripsi_produk']) }}</textarea>
            </div>

            <!-- Harga Produk -->
            <div class="form-group">
                <label for="harga_produk">Harga Produk</label>
                <input type="number" name="harga_produk" id="harga_produk" class="form-control" 
                    value="{{ old('harga_produk', $produk['harga_produk']) }}" required>
            </div>

            <!-- Stok Produk -->
            <div class="form-group">
                <label for="stok_produk">Stok Produk</label>
                <input type="number" name="stok_produk" id="stok_produk" class="form-control" 
                    value="{{ old('stok_produk', $produk['stok_produk']) }}" required>
            </div>

            <!-- Status Produk -->
            <div class="form-group">
                <label for="status_produk">Status Produk</label>
                <select name="status_produk" id="status_produk" class="form-control" required>
                    <option value="Tersedia" {{ old('status_produk', $produk['status_produk']) == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="Habis" {{ old('status_produk', $produk['status_produk']) == 'Habis' ? 'selected' : '' }}>Habis</option>
                </select>
            </div>

            <!-- Kategori Produk (Dropdown) -->
            <div class="form-group">
                <label for="id_kategori">Kategori Produk</label>
                <select name="id_kategori" id="id_kategori" class="form-control" required>
                    @foreach($kategoriList as $kategori)
                        <option value="{{ $kategori['id_kategori'] }}" 
                            {{ old('id_kategori', $produk['id_kategori']) == $kategori['id_kategori'] ? 'selected' : '' }}>
                            {{ $kategori['nama_kategori'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Gambar Produk -->
            <div class="form-group">
                <label for="gambar_produk">Gambar Produk</label>
                <input type="url" name="gambar_produk" id="gambar_produk" class="form-control" 
                    value="{{ old('gambar_produk', $produk['gambar_produk']) }}">
            </div>

            <!-- Tombol Submit -->
            <button type="submit" class="btn btn-primary mt-3">Perbarui Produk</button>
            <a href="{{ route('produk.index') }}" class="btn btn-secondary mt-3">Batal</a>
        </form>
    </div>
@endsection
