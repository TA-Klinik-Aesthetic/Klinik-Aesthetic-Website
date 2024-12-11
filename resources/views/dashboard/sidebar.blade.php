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

    <!-- Divider -->
    <hr class="sidebar-divider">
    
    <!-- Nav Item - Treatment -->
    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" data-target="#collapseTreatment"
            aria-expanded="true" aria-controls="collapseTreatment">
            <span>Treatment</span>
        </a>
        <div id="collapseTreatment" class="collapse" aria-labelledby="headingTreatment" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- Menggunakan nama rute -->
                <a class="collapse-item" href="{{ route('jenisTreatment.index') }}">Jenis Treatment</a>
                <a class="collapse-item" href="{{ route('treatment.index') }}">List Treatment</a>
                <a class="collapse-item" href="{{ route('booking.index') }}">Booking Treatment</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Feedback -->
    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" data-target="#collapseFeedback"
            aria-expanded="true" aria-controls="collapseFeedback">
            <span>Feedback</span>
        </a>
        <div id="collapseFeedback" class="collapse" aria-labelledby="headingFeedback" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- Menggunakan nama rute -->
                <a class="collapse-item" href="{{ route('feedback.feedbackKonsultasi.index') }}">Feedback Konsultasi</a>
                <a class="collapse-item" href="{{ route('feedback.feedbackTreatment.index') }}">Feedback Treatments</a>
            </div>
        </div>
    </li>

</ul>
<!-- End of Sidebar -->
