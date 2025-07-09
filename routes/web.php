<?php

use App\Http\Controllers\LapanganController;
use App\Http\Controllers\LapanganPublicController;
use App\Http\Controllers\PengajuanLapanganController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SesiSewaController;
use App\Http\Controllers\SewaLapanganController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\UserController;
use App\Models\SesiSewaLapangan;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/mockup-jadwal', function () {
    return view('jadwal-lapangan');
});

Route::get('/mockup-pembayaran', function () {
    return view('pembayaran-sewa');
});

Route::get('/mockup-riwayat', function () {
    return view('riwayat-sewa');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/lapangan', [LapanganPublicController::class, 'index'])->name('lapangan.index');
Route::get('/lapangan/{slug}', [LapanganPublicController::class, 'show'])->name('lapangan.show');

Route::get('/pengajuan-lapangan', [PengajuanLapanganController::class, 'create'])->name('pengajuan');
Route::post('/pengajuan-lapangan', [PengajuanLapanganController::class, 'store'])->name('pengajuan.store');

Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::get('/dashboard/pengajuan', [SuperAdminController::class, 'listPengajuan'])->name('pengajuan.index');
    Route::post('/dashboard/pengajuan/{id}/approve', [SuperAdminController::class, 'approvePengajuan'])->name('pengajuan.approve');
    Route::delete('/dashboard/pengajuan/{id}/reject', [SuperAdminController::class, 'rejectPengajuan'])->name('pengajuan.reject');

    Route::get('/dashboard/user', [UserController::class, 'index'])->name('superadmin.index');
    Route::get('dashboard/user/{id}/edit', [UserController::class, 'edit'])->name('superadmin.edit');
    Route::put('dashboard/user/{id}', [UserController::class, 'update'])->name('superadmin.update');
    Route::delete('dashboard/user/{id}', [UserController::class, 'destroy'])->name('superadmin.destroy');

    Route::get('/dashboard/saldo', [SuperAdminController::class, 'saldo'])->name('superadmin.saldo');
});

Route::middleware(['auth', 'role:admin_lapangan'])->group(function () {
    Route::resource('lapangan-admin', LapanganController::class);
    Route::get('/sesi', [SesiSewaController::class, 'index'])->name('sesi.index');
    Route::get('/sesi/create', [SesiSewaController::class, 'create'])->name('sesi.create');
    Route::post('/sesi', [SesiSewaController::class, 'store'])->name('sesi.store');
    Route::get('/sesi/{id}/edit', [SesiSewaController::class, 'edit'])->name('sesi.edit');
    Route::put('/sesi/{id}', [SesiSewaController::class, 'update'])->name('sesi.update');
    Route::delete('/sesi/{id}', [SesiSewaController::class, 'destroy'])->name('sesi.destroy');
    Route::get('/admin/booking/manual', [SewaLapanganController::class, 'createManual'])->name('manual.create');
    Route::post('/admin/booking/manual', [SewaLapanganController::class, 'storeManual'])->name('manual.store');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/sewa/{sesi_id}/store', [SewaLapanganController::class, 'store'])->name('sewa.store');
});

Route::middleware(['auth', 'role:admin_lapangan'])->group(function () {
    Route::post('/booking/{id}/approve', [SewaLapanganController::class, 'approve'])->name('booking.approve');
    Route::get('/scan-checkin', [SewaLapanganController::class, 'scanView'])->name('scan.view');
    Route::post('/scan-checkin/process', [SewaLapanganController::class, 'scanProcess'])->name('scan.process');
    Route::get('/admin/bookings', [SewaLapanganController::class, 'adminBookingIndex'])->name('admin.bookings');
    Route::get('/admin/dompet', [SewaLapanganController::class, 'dompetAdmin'])->name('admin.dompet');
});

Route::middleware(['auth'])->get('/booking-saya', [SewaLapanganController::class, 'userBookings'])->name('booking.saya');

Route::middleware(['auth'])->get('/checkout/{sesi}', function ($sesiId) {
    $sesi = SesiSewaLapangan::with('lapangan')->findOrFail($sesiId);
    return view('booking.checkout', compact('sesi'));
})->name('sewa.checkout');


require __DIR__.'/auth.php';