<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\DetailKonsultasiController;


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


Route::get('/managemenTreatment', function () {
    return view('managemenTreatment');
});

Route::get('/treatment/types', function () {
    return view('treatment.listJenisTreatment');
});


Route::prefix('treatment')->group(function () {
    Route::get('/types', [TreatmentController::class, 'index'])->name('treatment.index');
    Route::get('/types/{id}', [TreatmentController::class, 'show'])->name('treatment.show');
    Route::post('/types', [TreatmentController::class, 'store'])->name('treatment.store');
    Route::put('/types/{id}', [TreatmentController::class, 'update'])->name('treatment.update');
    Route::delete('/types/{id}', [TreatmentController::class, 'destroy'])->name('treatment.destroy');
});


// Kategorizes
Route::prefix('kategori')->group(function () {
    Route::get('/', [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/create', [KategoriController::class, 'create'])->name('kategori.create');
    Route::post('/', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
});

// Produkiezz
Route::prefix('produk')->group(function () {
    Route::get('/', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('/create', [ProdukController::class, 'create'])->name('produk.create');
    Route::post('/', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::put('/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');
});
