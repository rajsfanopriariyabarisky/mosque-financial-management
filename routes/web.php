<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\InfaqController;
use App\Http\Controllers\InsidentalController;
use App\Http\Controllers\KasController;
use App\Http\Controllers\KontribusiController;
use App\Http\Controllers\LainnyaController;
use App\Http\Controllers\OperasionalController;
use App\Http\Controllers\ParkirController;
use App\Http\Controllers\PengajianController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QurbanController;
use App\Http\Controllers\QurbanJamaahController;
use App\Http\Controllers\RabController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ZakatController;
use App\Http\Controllers\ZakatJamaahController;
use App\Http\Controllers\KulinerController;
use App\Http\Controllers\Admin\KulinerController as AdminKulinerController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('sedekah', [DashboardController::class, 'indexHome'])->name('dashboards.indexHome');

Route::get('datakeuangan', [KasController::class, 'indexHome'])->name('kas.indexHome');

Route::get('/tentang-kami', function () {
    return view('about');
})->name('tentang.kami');

Route::get('/kontak', function () {
    return view('contact');
})->name('kontak');

// Rute user
Route::prefix('donatur')->name('donatur.')->group(function () {
    Route::get('/kuliner', [KulinerController::class, 'index'])->name('kuliner.index');
    Route::get('/kuliner/{id}', [KulinerController::class, 'show'])->name('kuliner.show');
    });

Route::middleware('auth')->group(function () {
    Route::get('/donatur', function () {
        return view('home_donatur');
    })->name('home_donatur');});

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('zakat_jamaah', ZakatJamaahController::class);
    Route::get('zakat_jamaah/riwayat/users', [ZakatJamaahController::class, 'riwayatUsers'])->name('zakat_jamaah.riwayat_users');
    Route::get('zakat_jamaah/{zakatJamaah}/download-pdf', [ZakatJamaahController::class, 'downloadPdf'])->name('zakat_jamaah.download_pdf');
    Route::post('zakat_jamaah/callback', [ZakatJamaahController::class, 'callback'])->name('zakat_jamaah.callback');
    Route::post('zakat_jamaah/{zakatJamaah}/verify-payment', [ZakatJamaahController::class, 'verifyPayment'])->name('zakat_jamaah.verify_payment');

    Route::resource('donasi', DonasiController::class);
    Route::post('donasi/callback', [DonasiController::class, 'callback'])->name('donasi.callback');
    Route::post('/donasi/{donasi}/verify', [DonasiController::class, 'verifyPayment'])->name('donasi.verify');
    Route::get('riwayat-user', [DonasiController::class, 'riwayatUsers'])->name('donasi.riwayat_users');
    Route::get('/donasi/{donasi}/download-pdf', [DonasiController::class, 'downloadPdf'])->name('donasi.download-pdf');




    Route::resource('qurban_jamaah', QurbanJamaahController::class);
    Route::get('qurban_jamaah/riwayat/users', [QurbanJamaahController::class, 'riwayatUsers'])->name('qurban_jamaah.riwayat_users');
    Route::get('qurban_jamaah/{qurbanJamaah}/download-pdf', [QurbanJamaahController::class, 'downloadPdf'])->name('qurban_jamaah.download_pdf');
    Route::post('qurban_jamaah/callback', [QurbanJamaahController::class, 'callback'])->name('qurban_jamaah.callback');
    Route::post('qurban_jamaah/{qurbanJamaah}/verify-payment', [QurbanJamaahController::class, 'verifyPayment'])->name('qurban_jamaah.verify_payment');


Route::middleware(['auth', RoleMiddleware::class . ':ketua,admin'])->group(function () {
    Route::resource('dashboard', DashboardController::class);

    Route::get('/profile/admin', [ProfileController::class, 'editAdmin'])->name('profile.edit.admin');
    Route::patch('/profile/admin', [ProfileController::class, 'updateAdmin'])->name('profile.update.admin');
    Route::delete('/profile/admin', [ProfileController::class, 'destroyAdmin'])->name('profile.destroy.admin');

    Route::resource('kas', KasController::class)->except('show');
    Route::get('kas/view_pdf', [KasController::class, 'view_pdf'])->name('kas.view_pdf');
    Route::get('/kas/riwayat-bulanan', [KasController::class, 'riwayatBulanan'])->name('kas.riwayat_bulanan');

    Route::get('/buku-kas', [KasController::class, 'indexBukuKas'])->name('buku-kas.index');
    Route::get('/buku-kas/{id}', [KasController::class, 'showBukuKas'])->name('buku-kas.show');
    Route::post('/buku-kas/simpan', [KasController::class, 'simpanBukuKas'])->name('buku-kas.simpan');
    Route::post('/buku-kas/{id}/setujui', [KasController::class, 'setujuiBukuKas'])->name('buku-kas.setujui');

    // Route baru untuk persetujuan dan penolakan
    Route::post('/kas/setujui', [KasController::class, 'setujui'])->name('kas.setujui');
    Route::post('/kas/tolak', [KasController::class, 'tolak'])->name('kas.tolak');

    Route::resource('rabs', RabController::class)->except('show');
    Route::get('rabs/view_pdf', [RabController::class, 'view_pdf'])->name('rabs.view_pdf');
    Route::post('/rabs/setujui', [RabController::class, 'setujui'])->name('rabs.setujui');
    Route::post('/rabs/tolak', [RabController::class, 'tolak'])->name('rabs.tolak');

    Route::resource('users', UserController::class);

    Route::get('riwayat_donasi', [DonasiController::class, 'riwayatPembayaran'])->name('donasi.riwayat_donasi');

    Route::resource('infaq', InfaqController::class);
    Route::resource('zakat', ZakatController::class);
    Route::resource('qurban', QurbanController::class);
    Route::resource('parkir', ParkirController::class);
    Route::resource('kontribusi', KontribusiController::class);
    Route::resource('insidental', InsidentalController::class);

    Route::resource('operasional', OperasionalController::class);
    Route::resource('pengajian', PengajianController::class);
    Route::resource('lainnya', LainnyaController::class);
    // Rute admin
    Route::prefix('admin')->middleware(['auth', RoleMiddleware::class . ':admin,ketua'])->group(function () {
    Route::resource('kuliner', AdminKulinerController::class)->names('admin.kuliner');
    });

});


require __DIR__.'/auth.php';
