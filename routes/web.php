<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriBarangController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\LaporanPersetujuanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome_new');
});

// Protected routes - require authentication
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Kategori Barang routes (protected by role middleware)
    Route::resource('kategori-barang', KategoriBarangController::class)
        ->middleware('role:admin_sparepart');
    Route::get('kategori-barang/export/pdf', [KategoriBarangController::class, 'exportPdf'])
        ->name('kategori-barang.export.pdf')
        ->middleware('role:admin_sparepart');

    // Barang routes (protected by role middleware)
    Route::resource('barang', BarangController::class)
        ->middleware('role:admin_sparepart');
    Route::post('barang/recalculate-rop', [BarangController::class, 'recalculateRopAll'])
        ->name('barang.recalculate-rop.all')
        ->middleware('role:admin_sparepart');
    Route::post('barang/{barang}/recalculate-rop', [BarangController::class, 'recalculateRop'])
        ->name('barang.recalculate-rop')
        ->middleware('role:admin_sparepart');
    Route::get('barang/export/pdf', [BarangController::class, 'exportPdf'])
        ->name('barang.export.pdf')
        ->middleware('role:admin_sparepart');

    // Penjualan routes (for admin and manager)
    Route::resource('penjualan', PenjualanController::class)
        ->middleware('role:admin_sparepart,service_manager');
    Route::get('penjualan/export/pdf', [PenjualanController::class, 'exportPdf'])
        ->name('penjualan.export.pdf')
        ->middleware('role:admin_sparepart,service_manager');

    // Pembelian routes (for admin only, manager can view list)
    Route::resource('pembelian', PembelianController::class)
        ->middleware('role:admin_sparepart, service_manager');
    Route::get('pembelian/export/pdf', [PembelianController::class, 'exportPdf'])
        ->name('pembelian.export.pdf')
        ->middleware('role:admin_sparepart,service_manager');

    // Laporan Persetujuan routes (for manager)
    Route::get('/laporan-persetujuan', [LaporanPersetujuanController::class, 'index'])
        ->name('laporan-persetujuan.index')
        ->middleware('role:admin_sparepart,service_manager');
    Route::get('/laporan-persetujuan/export/pdf', [LaporanPersetujuanController::class, 'exportPdf'])
        ->name('laporan-persetujuan.export.pdf')
        ->middleware('role:admin_sparepart,service_manager');

    Route::post('/laporan-persetujuan/{pembelian}/approve', [LaporanPersetujuanController::class, 'approve'])
        ->name('laporan-persetujuan.approve')
        ->middleware('role:service_manager');

    // User Management routes (admin only)
    Route::resource('user', UserController::class);
    Route::get('user/export/pdf', [UserController::class, 'exportPdf'])->name('user.export.pdf');

    // API routes for AJAX
    Route::get('/api/pembelian/{id}', [LaporanPersetujuanController::class, 'getData']);
});

require __DIR__ . '/auth.php';

