@extends('dashboard.index')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">Tambah Booking</h1>
    <a href="{{ route('konsultasi.create') }}" class="btn btn-success mb-4"><i class="fas fa-plus"></i>   Tambah Booking</a>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Pelanggan</th>
                            <th>Waktu Konsultasi</th>
                            <th>Dokter</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data->reverse() as $item)
                            <tr>
                                <td>{{ $item['user']['nama_user'] ?? 'Tidak ada nama pelanggan' }}</td>
                                <td>{{ $item['waktu_konsultasi'] }}</td>
                                <td>{{ $item['dokter']['nama_dokter'] }}</td>
                                <td>
                                    <!-- Tombol Detail -->
                                    <a href="{{ route('konsultasi.show', $item['id_konsultasi']) }}"
                                        class="btn btn-primary">Detail</a>

                                        <a href="{{ route('konsultasi.editKeluhan', $item['detail_konsultasi']['id_detail_konsultasi']) }}"
                                        class="btn btn-warning">Edit</a>

                                    <form action="{{ route('konsultasi.destroy', $item['id_konsultasi']) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
