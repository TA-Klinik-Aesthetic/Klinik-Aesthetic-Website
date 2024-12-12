@extends('dashboard.index')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Jadwal Praktik Dokter</h1>

    <button class="btn btn-primary mb-3" onclick="showAddModal()">Tambah Jadwal</button>

    <div id="jadwalTable"></div>

    <!-- Modal -->
    <div class="modal fade" id="jadwalModal" tabindex="-1" aria-labelledby="jadwalModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="jadwalModalLabel">Tambah/Edit Jadwal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="jadwalForm">
                        <input type="hidden" id="jadwalId">
                        <div class="mb-3">
                            <label for="idDokter" class="form-label">ID Dokter</label>
                            <input type="number" class="form-control" id="idDokter" required>
                        </div>
                        <div class="mb-3">
                            <label for="hari" class="form-label">Hari</label>
                            <input type="text" class="form-control" id="hari" required>
                        </div>
                        <div class="mb-3">
                            <label for="tglKerja" class="form-label">Tanggal Kerja</label>
                            <input type="date" class="form-control" id="tglKerja" required>
                        </div>
                        <div class="mb-3">
                            <label for="jamMulai" class="form-label">Jam Mulai</label>
                            <input type="time" class="form-control" id="jamMulai" required>
                        </div>
                        <div class="mb-3">
                            <label for="jamSelesai" class="form-label">Jam Selesai</label>
                            <input type="time" class="form-control" id="jamSelesai" required>
                        </div>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        loadJadwal();
    });

    function loadJadwal() {
        axios.get('http://127.0.0.1:8080/api/jadwal-dokter')
            .then(response => {
                const data = response.data;
                const grouped = data.reduce((acc, jadwal) => {
                    if (!acc[jadwal.hari]) {
                        acc[jadwal.hari] = [];
                    }
                    acc[jadwal.hari].push(jadwal);
                    return acc;
                }, {});

                let html = '';
                for (const [hari, jadwals] of Object.entries(grouped)) {
                    html += `<h3>${hari}</h3>`;
                    html += '<table class="table table-bordered">';
                    html += '<thead><tr><th>ID Dokter</th><th>Nama Dokter</th><th>Tanggal</th><th>Jam Mulai</th><th>Jam Selesai</th><th>Aksi</th></tr></thead>';
                    html += '<tbody>';

                    jadwals.forEach(jadwal => {
                        html += `<tr>
                            <td>${jadwal.id_dokter}</td>
                            <td>${jadwal.dokter?.nama_dokter || 'Tidak Diketahui'}</td>
                            <td>${jadwal.tgl_kerja}</td>
                            <td>${jadwal.jam_mulai}</td>
                            <td>${jadwal.jam_selesai}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" onclick='showEditModal(${JSON.stringify(jadwal)})'>Edit</button>
                                <button class="btn btn-danger btn-sm" onclick="deleteJadwal(${jadwal.id_jadwal_praktik_dokter})">Hapus</button>
                            </td>
                        </tr>`;
                    });

                    html += '</tbody></table>';
                }

                document.getElementById('jadwalTable').innerHTML = html;
            })
            .catch(error => {
                console.error(error);
            });
    }

    function showAddModal() {
        document.getElementById('jadwalForm').reset();
        document.getElementById('jadwalId').value = '';
        new bootstrap.Modal(document.getElementById('jadwalModal')).show();
    }

    function showEditModal(jadwal) {
        // const jadwal = JSON.parse(decodeURIComponent(jadwalData));
        document.getElementById('jadwalId').value = jadwal.id_jadwal_praktik_dokter;
        document.getElementById('idDokter').value = jadwal.id_dokter;
        document.getElementById('hari').value = jadwal.hari;
        document.getElementById('tglKerja').value = jadwal.tgl_kerja;
        document.getElementById('jamMulai').value = jadwal.jam_mulai;
        document.getElementById('jamSelesai').value = jadwal.jam_selesai;
        new bootstrap.Modal(document.getElementById('jadwalModal')).show();
    }

    document.getElementById('jadwalForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const id = document.getElementById('jadwalId').value;
        const data = {
            id_dokter: document.getElementById('idDokter').value,
            hari: document.getElementById('hari').value,
            tgl_kerja: document.getElementById('tglKerja').value,
            jam_mulai: document.getElementById('jamMulai').value,
            jam_selesai: document.getElementById('jamSelesai').value,
        };

        const url = id ? `http://127.0.0.1:8080/api/jadwal-dokter/${id}` : 'http://127.0.0.1:8080/api/jadwal-dokter';
        const method = id ? 'put' : 'post';

        axios[method](url, id ? { ...data, id_jadwal_praktik_dokter: id } : data)
            .then(() => {
                // Tutup modal setelah sukses menyimpan
                const modalElement = document.getElementById('jadwalModal');
                const modal = bootstrap.Modal.getInstance(modalElement);
                modal.hide();

                // Reload data jadwal
                loadJadwal();
            })
            .catch(error => {
                console.error(error);
            });
    });


    function deleteJadwal(id) {
        if (confirm('Apakah Anda yakin ingin menghapus jadwal ini?')) {
            axios.delete(`http://127.0.0.1:8080/api/jadwal-dokter/${id}`)
                .then(() => {
                    loadJadwal();
                })
                .catch(error => {
                    console.error(error);
                });
        }
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection