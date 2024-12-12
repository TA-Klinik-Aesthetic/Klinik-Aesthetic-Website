{{-- @extends('dashboard.index')

@section('content')
<div class="container">
    <h1 class="my-4 d-flex justify-content-between align-items-center">
        Booking Treatment List
        <button class="btn btn-primary" data-toggle="modal" data-target="#addBookingModal">Tambah Booking</button>
    </h1>

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
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data booking treatment</td>
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
                        <label for="id_user">User   ID</label>
                        <input type="number" name="id_user" class="form-control" id="id_user" required>
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
                        <input type="number" name="potongan_harga" class="form-control" id="potongan_harga" required >
                    </div>
                    <div class="form-group">
                        <label for="details">Treatments</label>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="id_treatment">ID Treatment</label>
                                <input type="number" name="details[0][id_treatment]" class="form-control" id="id_treatment" required>
                            </div>
                            <div class="col-md-4">
                                <label for="id_dokter">ID Dokter</label>
                                <input type="number" name="details[0][id_dokter]" class="form-control" id="id_dokter" required>
                            </div>
                            <div class="col-md-4">
                                <label for="id_beautician">ID Beautician</label>
                                <input type="number" name="details[0][id_beautician]" class="form-control" id="id_beautician" required>
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
@endsection --}}

@extends('dashboard.index')

@section('content')
<div class="container">
    <h1 class="my-4 d-flex justify-content-between align-items-center">
        Booking Treatment List
        <button class="btn btn-primary" data-toggle="modal" data-target="#addBookingModal">Tambah Booking</button>
    </h1>

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
                        <a href="#" class="btn btn-sm btn-info">Lihat</a>
                        <a href="#" class="btn btn-sm btn-primary">Edit</a>
                        <form action="#" method="POST" style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
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
                        <label for="id_user">User    ID</label>
                        <input type="number" name="id_user" class="form-control" id="id_user" required>
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
                        <input type="number" name="potongan_harga" class="form-control" id="potongan_harga" required >
                    </div>
                    <div class="form-group">
                        <label for="details">Treatments</label>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="id_treatment">ID Treatment</label>
                                <input type="number" name="details[0][id_treatment]" class="form-control" id="id_treatment" required>
                            </div>
                            <div class="col-md-4">
                                <label for="id_dokter">ID Dokter</label>
                                <input type="number" name="details[0][id_dokter]" class="form-control" id="id_dokter" required>
                            </div>
                            <div class="col-md-4">
                                <label for="id_beautician">ID Beautician</label>
                                <input type="number" name="details[0][id_beautician]" class="form-control" id="id_beautician" required>
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