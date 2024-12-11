@extends('dashboard.index')

@section('content')
    <h1>Detail Jenis Treatment</h1>

    <table class="table table-bordered">
        <tr><th>ID</th><td>{{ $jenisTreatment['id_jenis_treatment'] }}</td></tr>
        <tr><th>Nama Jenis Treatment</th><td>{{ $jenisTreatment['nama_jenis_treatment'] }}</td></tr>
        <tr><th>Daftar Treatment</th>
            <td>
                <ul>
                    @foreach($jenisTreatment['treatment'] as $treatment)
                        <li>{{ $treatment['nama_treatment'] }}</li>
                    @endforeach
                </ul>
            </td>
        </tr>
    </table>
@endsection
