@extends('dashboard.index')


@section('content')
    <h1>List Jenis Treatment</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Jenis Treatment</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jenisTreatments as $jenis)
                <tr>
                    <td>{{ $jenis['id_jenis_treatment'] }}</td>
                    <td>{{ $jenis['nama_jenis_treatment'] }}</td>
                    <td>
                        <button class="btn btn-primary btn-sm">View</button>
                        <button class="btn btn-warning btn-sm">Edit</button>
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection