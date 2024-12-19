@extends('dashboard.index')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Jadwal Praktik Beautician</h1>

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#jadwalModal">Tambah Jadwal</button>

    @if ($grouped && $grouped->isNotEmpty())
        @foreach ($grouped as $hari => $jadwals)
            <h3>{{ ucfirst($hari) }}</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID Beautician</th>
                        <th>Nama Beautician</th>
                        <th>Tanggal</th>
                        <th>Jam Mulai</th>
                        <th>Jam Selesai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jadwals as $jadwal)
                    <tr>
                        <td>{{ $jadwal['id_beautician'] }}</td>
                        <td>{{ $jadwal['beautician']['nama_beautician'] ?? 'Tidak Diketahui' }}</td>
                        <td>{{ $jadwal['tgl_kerja'] }}</td>
                        <td>{{ $jadwal['jam_mulai'] }}</td>
                        <td>{{ $jadwal['jam_selesai'] }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#jadwalModal" 
                                    data-id="{{ $jadwal['id_jadwal_praktik_beautician'] }}"
                                    data-id-beautician="{{ $jadwal['id_beautician'] }}"
                                    data-hari="{{ $jadwal['hari'] }}"
                                    data-tgl-kerja="{{ $jadwal['tgl_kerja'] }}"
                                    data-jam-mulai="{{ $jadwal['jam_mulai'] }}"
                                    data-jam-selesai="{{ $jadwal['jam_selesai'] }}">
                                Edit
                            </button>
                            <form action="{{ route('jadwal-beautician.destroy', $jadwal['id_jadwal_praktik_beautician']) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach
    @else
        <p class="text-muted">Belum ada jadwal yang tersedia.</p>
    @endif

    <!-- Modal -->
    <div class="modal fade" id="jadwalModal" tabindex="-1" aria-labelledby="jadwalModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('jadwal-beautician.store') }}" method="POST" id="jadwalForm">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="jadwalModalLabel">Tambah/Edit Jadwal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="jadwalId">
                        <div class="mb-3">
                            <label for="idBeautician" class="form-label">ID Beautician</label>
                            <input type="number" class="form-control" name="id_beautician" id="idBeautician" required>
                        </div>
                        <div class="mb-3">
                            <label for="hari" class="form-label">Hari</label>
                            <input type="text" class="form-control" name="hari" id="hari" required>
                        </div>
                        <div class="mb-3">
                            <label for="tglKerja" class="form-label">Tanggal Kerja</label>
                            <input type="date" class="form-control" name="tgl_kerja" id="tglKerja" required>
                        </div>
                        <div class="mb-3">
                            <label for="jamMulai" class="form-label">Jam Mulai</label>
                            <input type="time" class="form-control" name="jam_mulai" id="jamMulai" required>
                        </div>
                        <div class="mb-3">
                            <label for="jamSelesai" class="form-label">Jam Selesai</label>
                            <input type="time" class="form-control" name="jam_selesai" id="jamSelesai" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const modal = document.getElementById('jadwalModal');
    modal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const id = button.getAttribute('data-id');
        const idBeautician = button.getAttribute('data-id-beautician');
        const hari = button.getAttribute('data-hari');
        const tglKerja = button.getAttribute('data-tgl-kerja');
        const jamMulai = button.getAttribute('data-jam-mulai');
        const jamSelesai = button.getAttribute('data-jam-selesai');

        document.getElementById('jadwalId').value = id || '';
        document.getElementById('idBeautician').value = idBeautician || '';
        document.getElementById('hari').value = hari || '';
        document.getElementById('tglKerja').value = tglKerja || '';
        document.getElementById('jamMulai').value = jamMulai || '';
        document.getElementById('jamSelesai').value = jamSelesai || '';
    });
</script>
@endsection
