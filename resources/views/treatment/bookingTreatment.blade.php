@extends('dashboard.index')

@section('content')
<div class="container">
    <h1 class="my-4">Booking Treatment List</h1>
    <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#addBookingModal">
        <i class="fas fa-plus"></i> Tambah Booking
    </button>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Waktu Treatment</th>
                    <th>Status</th>
                    <th>Harga Total</th>
                    <th>Potongan Harga</th>
                    <th>Harga Akhir</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $booking)
                <tr class="
                    @if($booking['status_booking_treatment'] === 'Verifikasi') bg-warning text-dark @endif
                    @if($booking['status_booking_treatment'] === 'Berhasil dibooking') bg-success text-white @endif
                    @if($booking['status_booking_treatment'] === 'Dibatalkan') bg-danger text-white @endif
                    @if($booking['status_booking_treatment'] === 'Selesai') bg-primary text-white @endif
                ">
                    <td>{{ $booking['id_booking_treatment'] }}</td>
                    <td>{{ $booking['id_user'] }}</td>
                    <td>{{ $booking['waktu_treatment'] }}</td>
                    <td>{{ $booking['status_booking_treatment'] }}</td>
                    <td>{{ number_format($booking['harga_total'], 0, ',', '.') }}</td>
                    <td>{{ number_format($booking['potongan_harga'], 0, ',', '.') }}</td>
                    <td>{{ number_format($booking['harga_akhir_treatment'], 0, ',', '.') }}</td>
                    <td>
                        <!-- Tombol Detail -->
                        <a href="{{ route('detailBooking.show', ['id' => $booking['id_detail_booking_treatment']]) }}" class="btn btn-sm btn-info">
                            <i class="fas fa-eye"></i>
                        </a>                 
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data booking treatment</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah Booking -->
<div class="modal fade" id="addBookingModal" tabindex="-1" role="dialog" aria-labelledby="addBookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"> 
        <form method="POST" action="{{ route('detailBooking.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBookingModalLabel">Tambah Booking Treatment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_user">User</label>
                        <select name="id_user" class="form-control" id="id_user" required>
                            <option value="">Pilih User</option>
                            @foreach($users as $user)
                                <option value="{{ $user['id_user'] }}">{{ $user['nama_user'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="waktu_treatment">Waktu Treatment</label>
                        <input type="datetime-local" name="waktu_treatment" class="form-control" id="waktu_treatment" required>
                    </div>
                    <div class="form-group">
                        <label for="status_booking_treatment">Status</label>
                        <select name="status_booking_treatment" class="form-control" id="status_booking_treatment" required>
                            <option value="Verifikasi">Verifikasi</option>
                            <option value="Berhasil dibooking">Berhasil dibooking</option>
                            <option value="Dibatalkan">Dibatalkan</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="potongan_harga">Potongan Harga</label>
                        <input type="number" name="potongan_harga" class="form-control" id="potongan_harga" required>
                    </div>
                    <div class="form-group">
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="id_treatment">Treatment</label>
                                <select name="details[0][id_treatment]" class="form-control" id="id_treatment" required>
                                    <option value="">Pilih Treatment</option>
                                    @foreach($treatments as $treatment)
                                        <option value="{{ $treatment['id_treatment'] }}">{{ $treatment['nama_treatment'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="id_dokter">Dokter</label>
                                <select name="details[0][id_dokter]" class="form-control" id="id_dokter">
                                    <option value="">Pilih Dokter</option>
                                    @foreach($dokters as $dokter)
                                        <option value="{{ $dokter['id_dokter'] }}">{{ $dokter['nama_dokter'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="id_beautician">Beautician</label>
                                <select name="details[0][id_beautician]" class="form-control" id="id_beautician">
                                    <option value="">Pilih Beautician</option>
                                    @foreach($beauticians as $beautician)
                                        <option value="{{ $beautician['id_beautician'] }}">{{ $beautician['nama_beautician'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
