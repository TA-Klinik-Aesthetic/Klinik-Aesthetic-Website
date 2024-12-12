@extends('dashboard.index')

@section('content')
    <h1>Detail Feedback Treatment</h1>

    <form action="{{ route('feedback.treatment.update', $feedback['id_booking_treatment']) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="rating">Rating</label>
            <input type="number" name="rating" id="rating" class="form-control" value="{{ $feedback['rating'] }}" required>
        </div>
        <div class="form-group">
            <label for="teks_feedback">Teks Feedback</label>
            <textarea name="teks_feedback" id="teks_feedback" class="form-control" required>{{ $feedback['teks_feedback'] }}</textarea>
        </div>
        <div class="form-group">
            <label for="balasan_feedback">Balasan Feedback</label>
            <textarea name="balasan_feedback" id="balasan_feedback" class="form-control">{{ $feedback['balasan_feedback'] }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>

    <form action="{{ route('feedback.treatment.delete', $feedback['id_booking_treatment']) }}" method="POST" class="mt-3">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus feedback ini?')">Hapus</button>
    </form>
@endsection