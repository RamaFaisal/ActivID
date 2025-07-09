<?php

use App\Http\Controllers\KonserController;
use App\Http\Controllers\LapanganController;
use App\Http\Controllers\LapanganPublicController;
use App\Http\Controllers\PemesananTiketKonserController;
use App\Http\Controllers\PengajuanKonserController;
use App\Http\Controllers\PengajuanLapanganController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicKonserController;
use App\Http\Controllers\ScanQRController;
use App\Http\Controllers\SesiSewaController;
use App\Http\Controllers\SewaLapanganController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\TiketKonserAdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerifikasiTiketController;
use App\Models\PemesananTiketKonser;
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
    Route::get('/dashboard/pengajuan-lapangan', [SuperAdminController::class, 'listPengajuan'])->name('pengajuan.index');
    Route::post('/dashboard/pengajuan-lapangan/{id}/approve', [SuperAdminController::class, 'approvePengajuan'])->name('pengajuan.approve');
    Route::delete('/dashboard/pengajuan-lapangan/{id}/reject', [SuperAdminController::class, 'rejectPengajuan'])->name('pengajuan.reject');

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

    Route::get('/booking/manual', [SewaLapanganController::class, 'createManual'])->name('manual.create');
    Route::post('/booking/manual', [SewaLapanganController::class, 'storeManual'])->name('manual.store');
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

// Konser
Route::get('/konser', [PublicKonserController::class, 'index'])->name('konser.public.index');
Route::get('/konser/{slug}', [PublicKonserController::class, 'show'])->name('konser.public.show');


Route::get('/pengajuan-konser', [PengajuanKonserController::class, 'create'])->name('pengajuan.konser.create');
Route::post('/pengajuan-konser', [PengajuanKonserController::class, 'store'])->name('pengajuan.konser.store');

Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::get('dashboard/pengajuan-konser', [SuperAdminController::class, 'listPengajuanKonser'])->name('pengajuanKonser.index');
    Route::post('dashboard/pengajuan-konser/{id}/approve', [SuperAdminController::class, 'approveKonser'])->name('pengajuanKonser.approve');
    Route::post('dashboard/pengajuan-konser/{id}/reject', [SuperAdminController::class, 'rejectKonser'])->name('pengajuanKonser.reject');

    Route::get('/verifikasi-konser', [SuperAdminController::class, 'pengajuanKonser'])->name('superadmin.konser.index');
    Route::post('/verifikasi-konser/{id}/approve', [SuperAdminController::class, 'approve'])->name('superadmin.konser.approve');
    Route::post('/verifikasi-konser/{id}/reject', [SuperAdminController::class, 'reject'])->name('superadmin.konser.reject');
});

Route::middleware(['auth', 'role:admin_konser'])->group(function () {
    Route::get('/konser-admin', [KonserController::class, 'index'])->name('konser-admin.index');
    Route::get('/konser-admin/create', [KonserController::class, 'create'])->name('konser-admin.create');
    Route::post('/konser-admin', [KonserController::class, 'store'])->name('konser-admin.store');
    Route::get('/konser-admin/{id}/edit', [KonserController::class, 'edit'])->name('konser-admin.edit');
    Route::put('/konser-admin/{id}', [KonserController::class, 'update'])->name('konser-admin.update');
    Route::delete('/konser-admin/{id}', [KonserController::class, 'destroy'])->name('konser-admin.destroy');

    Route::get('/tiket-admin', [TiketKonserAdminController::class, 'index'])->name('admin-tiket.index');
    Route::get('/tiket-admin/create', [TiketKonserAdminController::class, 'create'])->name('admin-tiket.create');
    Route::post('/tiket-admin', [TiketKonserAdminController::class, 'store'])->name('admin-tiket.store');
    Route::get('/tiket-admin/{id}/edit', [TiketKonserAdminController::class, 'edit'])->name('admin-tiket.edit');
    Route::put('/tiket-admin/{id}', [TiketKonserAdminController::class, 'update'])->name('admin-tiket.update');
    Route::delete('/tiket-admin/{id}', [TiketKonserAdminController::class, 'destroy'])->name('admin-tiket.destroy');

    Route::get('/verifikasi-pemesanan', [VerifikasiTiketController::class, 'index'])->name('admin.verifikasi.index');
    Route::post('/verifikasi/{id}', [VerifikasiTiketController::class, 'verifikasi'])->name('admin.verifikasi.proses');

    Route::get('/scan', fn() => view('konser.verifikasi.scanqr'))->name('scan.index');
    Route::get('/scan/{kode}', [ScanQRController::class, 'check'])->name('scan.qr');

    Route::get('/admin-konser/saldo', [KonserController::class, 'adminKonser'])->name('admin.saldo');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/konser/{slug}/pesan', [PemesananTiketKonserController::class, 'create'])->name('pemesanan.tiket.create');
    Route::post('/konser/{slug}/pesan', [PemesananTiketKonserController::class, 'store'])->name('pemesanan.tiket.store');

    // Route::get('/tiket-saya', [PemesananTiketKonser::class, 'BookingTiket'])->middleware('auth')->name('tiket.saya');
});

Route::get('/tiket-saya', function () {
    $pesanan = PemesananTiketKonser::with(['jenisTiket.konser'])->where('id_user', auth()->id())->get();
    return view('konser.pemesanan.index', compact('pesanan'));
})->middleware('auth')->name('tiket.saya');



require __DIR__.'/auth.php';