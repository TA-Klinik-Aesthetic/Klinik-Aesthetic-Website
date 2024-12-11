@extends('dashboard.index')

@section('content')
<div class="container">
    <h1 class="my-4">Booking Treatment List</h1>

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
@endsection
