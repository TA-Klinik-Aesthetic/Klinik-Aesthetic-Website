<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="mx-3">Klinik Aesthetic</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('dashboard') }}">
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Konsultasi -->
    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" data-target="#collapseKonsultasi" aria-expanded="true"
            aria-controls="collapseKonsultasi">
            <span>Konsultasi</span>
        </a>
        <div id="collapseKonsultasi" class="collapse" aria-labelledby="headingKonsultasi" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ url('/konsultasi/without-doctor') }}">Lihat Booking</a>
                <a class="collapse-item" href="{{ url('/konsultasi/with-doctor') }}">Tambah Booking</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Treatment -->
    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" data-target="#collapseTreatment" aria-expanded="true"
            aria-controls="collapseTreatment">
            <span>Treatment</span>
        </a>
        <div id="collapseTreatment" class="collapse" aria-labelledby="headingTreatment" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ url('/treatment/list') }}">List Jenis</a>
                <a class="collapse-item" href="{{ url('/treatment/list') }}">List Treatment</a>
                <a class="collapse-item" href="{{ url('/treatment/booking') }}">Booking Treatment</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Produk -->
    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" data-target="#collapseProduk" aria-expanded="true"
            aria-controls="collapseProduk">
            <span>Produk</span>
        </a>
        <div id="collapseProduk" class="collapse" aria-labelledby="headingProduk" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ url('/treatment/list') }}">List Kategori</a>
                <a class="collapse-item" href="{{ url('/produk/list') }}">List Produk</a>
                <a class="collapse-item" href="{{ url('/produk/tambah') }}">Tambah Penjualan</a>
            </div>
        </div>
    </li>
        <!-- Nav Item - Jadwal -->
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" data-target="#collapseJadwal" aria-expanded="true"
                aria-controls="collapseJadwal">
                <span>Jadwal</span>
            </a>
            <div id="collapseJadwal" class="collapse" aria-labelledby="headingJadwal" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ url('/treatment/list') }}">Jadwal Dokter</a>
                    <a class="collapse-item" href="{{ url('/produk/list') }}">Jadwal Beautician</a>
                </div>
            </div>
        </li>

</ul>
<!-- End of Sidebar -->
