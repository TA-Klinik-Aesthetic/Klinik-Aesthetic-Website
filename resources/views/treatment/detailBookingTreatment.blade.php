@extends('dashboard.index')

@section('content')
<div class="container">
    <h1 class="mb-4">Detail Booking Treatment</h1>

    <!-- Notifikasi -->
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @elseif(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <div class="card mb-4">
        <div class="card-body">
            <h5>Informasi Booking</h5>
            <p><strong>ID Booking:</strong> {{ $detail['id_booking_treatment'] }}</p>
            <p><strong>Tanggal Booking:</strong> {{ date('d-m-Y H:i:s', strtotime($detail['created_at'])) }}</p>
        </div>
    </div>

    <!-- Tabel Detail Treatment -->
    <div class="card">
        <div class="card-header">
            <h5>Detail Treatment</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Treatment</th>
                        <th>Biaya Treatment</th>
                        <th>Dokter</th>
                        <th>Beautician</th>
                        <th>Potongan Harga</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>{{ $detail['treatment']['nama_treatment'] ?? '-' }}</td>
                        <td>{{ number_format($detail['treatment']['biaya_treatment'], 0, ',', '.') }}</td>
                        <td>{{ $detail['dokter']['nama_dokter'] ?? '-' }}</td>
                        <td>{{ $detail['beautician']['nama_beautician'] ?? '-' }}</td>
                        <td>
                            @php
                            $potongan_harga = isset($detail['treatment']['biaya_treatment']) 
                                ? $detail['treatment']['biaya_treatment'] * 0.1 
                                : 0;
                            @endphp
                            {{ number_format($potongan_harga, 0, ',', '.') }}
                        </td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal">
                                Edit
                            </button>
                            <form action="{{ route('detailBooking.destroy', $detail['id_detail_booking_treatment']) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('detailBooking.update', $detail['id_detail_booking_treatment']) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Detail Treatment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="biaya_treatment">Biaya Treatment</label>
                            <input type="number" name="biaya_treatment" id="biaya_treatment" class="form-control" value="{{ $detail['treatment']['biaya_treatment'] }}" required>
                        </div>
                        <div class="form-group">
                            <label for="potongan_harga">Potongan Harga</label>
                            <input type="number" name="potongan_harga" id="potongan_harga" class="form-control" value="{{ $potongan_harga }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
