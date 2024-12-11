@extends('dashboard.index')

@section('content')
    <h1>List Treatment</h1>

    <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#tambahTreatmentModal">
        <i class="fas fa-plus"></i> Tambah Treatment
    </button>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Treatment</th>
                <th>Jenis Treatment</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($treatments as $treatment)
                <tr>
                    <td>{{ $treatment['id_treatment'] }}</td>
                    <td>{{ $treatment['nama_treatment'] }}</td>
                    <td>{{ $treatment['jenis_treatment']['nama_jenis_treatment'] }}</td>
                    <td>
                        <a href="{{ route('treatment.show', $treatment['id_treatment']) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-eye"></i>
                        </a>

                        <a href="{{ route('treatment.update', $treatment['id_treatment']) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-pencil-alt"></i>
                        </a>

                        <form action="{{ route('treatment.destroy', $treatment['id_treatment']) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus treatment ini?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="modal fade" id="tambahTreatmentModal" tabindex="-1" role="dialog" aria-labelledby="tambahTreatmentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('treatment.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahTreatmentModalLabel">Tambah Treatment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="id_jenis_treatment">ID Jenis Treatment</label>
                            <input type="number" name="id_jenis_treatment" class="form-control" id="id_jenis_treatment" required>
                        </div>
                        <div class="form-group">
                            <label for="nama_treatment">Nama Treatment</label>
                            <input type="text" name="nama_treatment" class="form-control" id="nama_treatment" required>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi_treatment">Deskripsi Treatment</label>
                            <textarea name="deskripsi_treatment" class="form-control" id="deskripsi_treatment" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="biaya_treatment">Biaya Treatment</label>
                            <input type="number" name="biaya_treatment" class="form-control" id="biaya_treatment" required>
                        </div>
                        <div class="form-group">
                            <label for="estimasi_treatment">Estimasi Treatment (HH:MM:SS)</label>
                            <input type="text" name="estimasi_treatment" class="form-control" id="estimasi_treatment" required>
                        </div>
                        <div class="form-group">
                            <label for="gambar_treatment">Gambar Treatment (URL)</label>
                            <input type="url" name="gambar_treatment" class="form-control" id="gambar_treatment" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
