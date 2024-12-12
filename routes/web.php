<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\JenisTreatmentController;
use App\Http\Controllers\FeedbackKonsultasiController;
use App\Http\Controllers\FeedbackTreatmentController;

use App\Http\Controllers\DetailBookingTreatmentController;
use App\Http\Controllers\BookingTreatmentController;

use App\Http\Controllers\PembelianProdukController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('users-pages.landingpage');
});

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/user/home', function () {
    if (!session()->has('user') || session('user.role') !== 'pelanggan') {
        return redirect()->route('login.form');
    }
    return view('users-pages.home');
})->name('user.home');

Route::get('/dashboard', function () {
    if (!session()->has('user')) {
        return redirect()->route('login.form');
    }

    $role = session('user.role');
    if (!in_array($role, ['dokter', 'beautician', 'front office'])) {
        return redirect()->route('login.form');
    }

    return view('dashboard.dashboard');
})->name('dashboard');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/home', function () {
    return view('users-pages.home');
})->name('users.home');

Route::get('/konsultasi', function () {
    return view('users-pages.konsultasi');
})->name('users.konsultasi');

Route::get('/konsultasi/with-doctor', [KonsultasiController::class, 'indexWithDoctor'])->name('konsultasi.with-doctor');
Route::get('/konsultasi/without-doctor', [KonsultasiController::class, 'indexWithoutDoctor'])->name('konsultasi.without-doctor');
Route::get('/konsultasi/create', [KonsultasiController::class, 'create'])->name('konsultasi.create');
Route::post('/konsultasi', [KonsultasiController::class, 'store'])->name('konsultasi.store');
Route::get('/konsultasi/{id}/edit', [KonsultasiController::class, 'edit'])->name('konsultasi.edit');
Route::put('/konsultasi/{id}', [KonsultasiController::class, 'update'])->name('konsultasi.update');
Route::delete('/konsultasi/{id}', [KonsultasiController::class, 'destroy'])->name('konsultasi.destroy');
Route::get('/konsultasi/{id}/detail', [KonsultasiController::class, 'show'])->name('konsultasi.show');
Route::get('/konsultasi/edit-keluhan/{id}', [KonsultasiController::class, 'editKeluhan'])->name('konsultasi.editKeluhan');
Route::put('/konsultasi/edit-keluhan/{id}', [KonsultasiController::class, 'updateKeluhan'])->name('konsultasi.updateKeluhan');













Route::get('/treatment/types', function () {
    return view('treatment.listJenisTreatment');
});

Route::prefix('treatment')->group(function () {
    Route::get('/types', [JenisTreatmentController::class, 'index'])->name('jenisTreatment.index');

    Route::get('/lists', [TreatmentController::class, 'index'])->name('treatment.index');
});


Route::prefix('treatment')->group(function () {
    Route::get('/', [TreatmentController::class, 'index'])->name('treatment.index');
    Route::get('/{id}', [TreatmentController::class, 'show'])->name('treatment.show');
    Route::post('/', [TreatmentController::class, 'store'])->name('treatment.store');
    Route::put('/{id}', [TreatmentController::class, 'update'])->name('treatment.update');
    Route::delete('/{id}', [TreatmentController::class, 'destroy'])->name('treatment.destroy');
});

Route::prefix('jenis-treatment')->group(function () {
    Route::get('/', [JenisTreatmentController::class, 'index'])->name('jenisTreatment.index');
    Route::get('/{id}', [JenisTreatmentController::class, 'show'])->name('jenisTreatment.show');
    Route::post('/', [JenisTreatmentController::class, 'store'])->name('jenisTreatment.store');
    Route::put('/{id}', [JenisTreatmentController::class, 'update'])->name('jenisTreatment.update');
    Route::delete('/{id}', [JenisTreatmentController::class, 'destroy'])->name('jenisTreatment.destroy');
});

Route::get('/feedback/konsultasi', [FeedbackKonsultasiController::class, 'index'])->name('feedback.feedbackKonsultasi.index');
Route::get('/feedback/konsultasi/{id}', [FeedbackKonsultasiController::class, 'show'])->name('feedback.feedbackKonsultasi.show');
Route::put('/feedback/konsultasi/{id}', [FeedbackKonsultasiController::class, 'update'])->name('feedback.feedbackKonsultasi.update');
Route::delete('/feedback/konsultasi/{id}', [FeedbackKonsultasiController::class, 'destroy'])->name('feedback.feedbackKonsultasi.destroy');

Route::get('/feedback/treatment/{id}/detail', [FeedbackKonsultasiController::class, 'show'])
    ->name('feedback.feedbackKonsultasi.detail');

Route::get('/feedback/treatment', [FeedbackTreatmentController::class, 'index'])->name('feedback.feedbackTreatment.index');
Route::get('/feedback/treatment/{id}', [FeedbackTreatmentController::class, 'show'])->name('feedback.feedbackTreatment.show');
Route::put('/feedback/treatment/{id}', [FeedbackTreatmentController::class, 'update'])->name('feedback.feedbackTreatment.update');
Route::delete('/feedback/treatment/{id}', [FeedbackTreatmentController::class, 'destroy'])->name('feedback.feedbackTreatment.destroy');

Route::get('/feedback/treatment/{id}/detail', [FeedbackTreatmentController::class, 'show'])
    ->name('feedback.feedbackTreatment.detail');


Route::prefix('booking')->name('bookingTreatment.')->group(function () {
    Route::get('/', [BookingTreatmentController::class, 'index'])->name('index');
    Route::get('/{id}', [BookingTreatmentController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [BookingTreatmentController::class, 'edit'])->name('edit');
    Route::delete('/{id}', [BookingTreatmentController::class, 'destroy'])->name('destroy');
});


Route::prefix('detailBooking')->name('detailBooking.')->group(function () {
    Route::post('/store', [DetailBookingTreatmentController::class, 'store'])->name('store');
    Route::get('/{id}', [DetailBookingTreatmentController::class, 'show'])->name('show');
    Route::put('/{id}', [DetailBookingTreatmentController::class, 'update'])->name('update');
    Route::delete('/{id}', [DetailBookingTreatmentController::class, 'destroy'])->name('destroy');
});

// Route untuk halaman pembelian produk
Route::get('/pembelian-produk', [PembelianProdukController::class, 'index'])->name('pembelianProduk.index');
Route::get('pembelian-produk/create', [PembelianProdukController::class, 'create'])->name('pembelian-produk.create'); // Menampilkan form tambah pembelian
Route::post('pembelian-produk/store', [PembelianProdukController::class, 'store'])->name('pembelian-produk.store'); // Menyimpan data pembelian
Route::get('/pembelian-produk/{id}', [PembelianProdukController::class, 'show'])->name('pembelian-produk.show');// Rute untuk menampilkan detail pembelian produk