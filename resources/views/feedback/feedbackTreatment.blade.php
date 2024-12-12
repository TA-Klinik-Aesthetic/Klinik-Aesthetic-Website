@extends('dashboard.index')

@section('content')
    <h1>Feedback Treatment</h1>

    <!-- Feedback List -->
    <div class="mb-4">
        <h3>Daftar Feedback</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Booking Treatment</th>
                    <th>Rating</th>
                    <th>Teks Feedback</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($feedbacks as $feedback)
                    <tr>
                        <td>{{ $feedback['id_booking_treatment'] }}</td>
                        <td>{{ $feedback['rating'] }}</td>
                        <td>{{ $feedback['teks_feedback'] }}</td>
                        <td>
                            @if (isset($feedback['id_booking_treatment']))
                            <a href="{{ route('feedback.feedbackTreatment.show', $feedback['id_booking_treatment']) }}" class="btn btn-primary btn-sm">Detail</a>
                        @else
                            <span class="text-danger">ID tidak ditemukan</span>
                        @endif                        
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
