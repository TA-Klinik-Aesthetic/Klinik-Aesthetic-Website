@extends('dashboard.index')

@section('content')
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">List Jenis Treatment</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Jenis Treatment</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Jenis Treatment</th>
                            <th>Nama Jenis Treatment</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="treatmentTableBody">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const apiURL = 'http://backend-klinik-aesthetic-production.up.railway.app/api/jenisTreatments';
    
        fetch(apiURL)
            .then(response => response.json())
            .then(data => {
                const tableBody = document.getElementById('treatmentTableBody');
                const treatments = data.data;
    
                // Clear existing rows
                tableBody.innerHTML = '';
    
                // Populate table with data
                treatments.forEach(item => {
                    const row = document.createElement('tr');
    
                    row.innerHTML = `
                        <td>${item.id_jenis_treatment}</td>
                        <td>${item.nama_jenis_treatment}</td>
                        <td>
                            <button class="btn btn-primary btn-sm" title="View">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn btn-warning btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-danger btn-sm" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    `;
    
                    tableBody.appendChild(row);
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    });
</script>
    
</div>
@endsection
