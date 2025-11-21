<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\NavbarController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\SambutanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GaleriFotoController;
use App\Http\Controllers\VideoGaleriController;
use App\Http\Controllers\StrukturController;
use App\Http\Controllers\VisiMisiController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\SibadraController;
use App\Http\Controllers\SP4NLaporController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\TemplateSambutanController;
use App\Http\Controllers\TemplateBeritaController;

// ===============================
//  ROUTES PUBLIC
// ===============================
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/berita', [BeritaController::class, 'index'])->name('berita');
Route::get('/berita/{id}', [BeritaController::class, 'show'])->name('berita.show');

Route::get('/dokumen', [DokumenController::class, 'index'])->name('dokumen');
Route::get('/sambutan', [SambutanController::class, 'index'])->name('sambutan');
Route::get('/data-pejabat', [ProfileController::class, 'index'])->name('data-pejabat');
Route::get('/struktur', [StrukturController::class, 'index'])->name('struktur');
Route::get('/visi-misi', [VisiMisiController::class, 'index'])->name('visi-misi');
Route::get('/galeri-foto', [GaleriFotoController::class, 'index'])->name('galeri-foto');
Route::get('/galeri-video', [VideoGaleriController::class, 'index'])->name('galeri-video');
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');
Route::get('/sibadra', [SibadraController::class, 'index'])->name('sibadra');
Route::get('/sp4n-lapor', [SP4NLaporController::class, 'index'])->name('sp4n-lapor');

// Template Public
Route::get('/template/{slug}', [TemplateController::class, 'show'])->name('template.show');
Route::get('/template-sambutan/{slug}', [TemplateSambutanController::class, 'show'])->name('template.sambutan.show');
Route::get('/template-berita/{slug}', [TemplateBeritaController::class, 'show'])->name('template.berita.show');

// ===============================
// AUTH
// ===============================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ===============================
// ADMIN AREA
// ===============================
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {

    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // DOKUMEN
    Route::get('/dokumen', [DokumenController::class, 'adminIndex'])->name('admin.dokumen.index');
    Route::post('/dokumen', [DokumenController::class, 'store'])->name('admin.dokumen.store');
    Route::put('/dokumen/{dokumen}', [DokumenController::class, 'update'])->name('admin.dokumen.update');
    Route::delete('/dokumen/{dokumen}', [DokumenController::class, 'destroy'])->name('admin.dokumen.destroy');

    // BERITA
    Route::get('/berita', [BeritaController::class, 'adminIndex'])->name('admin.berita.index');
    Route::post('/berita', [BeritaController::class, 'store'])->name('admin.berita.store');
    Route::get('/berita/{id}/edit', [AdminController::class, 'editBerita'])->name('admin.berita.edit');
    Route::put('/berita/{id}', [AdminController::class, 'updateBerita'])->name('admin.berita.update');
    Route::delete('/berita/{id}', [AdminController::class, 'destroyBerita'])->name('admin.berita.destroy');

    // GALERI
    Route::post('/galeri', [AdminController::class, 'storeGaleri'])->name('admin.galeri.store');
    Route::get('/galeri/{id}/edit', [AdminController::class, 'editGaleri'])->name('admin.galeri.edit');
    Route::put('/galeri/{id}', [AdminController::class, 'updateGaleri'])->name('admin.galeri.update');
    Route::delete('/galeri/{id}', [AdminController::class, 'destroyGaleri'])->name('admin.galeri.destroy');

    // VIDEO
    Route::post('/video', [AdminController::class, 'storeVideo'])->name('admin.video.store');
    Route::get('/video/{id}/edit', [AdminController::class, 'editVideo'])->name('admin.video.edit');
    Route::put('/video/{id}', [AdminController::class, 'updateVideo'])->name('admin.video.update');
    Route::delete('/video/{id}', [AdminController::class, 'destroyVideo'])->name('admin.video.destroy');

    // CAROUSEL
    Route::post('/carousel', [AdminController::class, 'storeCarousel'])->name('admin.carousel.store');
    Route::get('/carousel/{id}/edit', [AdminController::class, 'editCarousel'])->name('admin.carousel.edit');
    Route::put('/carousel/{id}', [AdminController::class, 'updateCarousel'])->name('admin.carousel.update');
    Route::delete('/carousel/{id}', [AdminController::class, 'destroyCarousel'])->name('admin.carousel.destroy');

    // NAVBAR
    Route::post('/navbar', [AdminController::class, 'storeNavbar'])->name('admin.navbar.store');
    Route::get('/navbar/{id}/edit', [AdminController::class, 'editNavbar'])->name('admin.navbar.edit');
    Route::put('/navbar/{id}', [AdminController::class, 'updateNavbar'])->name('admin.navbar.update');
    Route::delete('/navbar/{id}', [AdminController::class, 'destroyNavbar'])->name('admin.navbar.destroy');

    // SAMBUTAN
    Route::post('/sambutan', [AdminController::class, 'storeSambutan'])->name('admin.sambutan.store');
    Route::get('/sambutan/{id}/edit', [AdminController::class, 'editSambutan'])->name('admin.sambutan.edit');
    Route::put('/sambutan/{id}', [AdminController::class, 'updateSambutan'])->name('admin.sambutan.update');

    // PROFILE / PEJABAT
    Route::post('/pejabat', [AdminController::class, 'storePejabat'])->name('admin.pejabat.store');
    Route::get('/pejabat', [AdminController::class, 'getPejabats'])->name('admin.pejabat.get');
    Route::get('/pejabat/{id}/edit', [AdminController::class, 'editPejabat'])->name('admin.pejabat.edit');
    Route::put('/pejabat/{id}', [AdminController::class, 'updatePejabat'])->name('admin.pejabat.update');
    Route::delete('/pejabat/{id}', [AdminController::class, 'destroyPejabat'])->name('admin.pejabat.destroy');

    // STRUKTUR
    Route::post('/struktur', [AdminController::class, 'storeStruktur'])->name('admin.struktur.store');
    Route::get('/struktur/{id}/edit', [AdminController::class, 'editStruktur'])->name('admin.struktur.edit');
    Route::put('/struktur/{id}', [AdminController::class, 'updateStruktur'])->name('admin.struktur.update');
    Route::delete('/struktur/{id}', [AdminController::class, 'destroyStruktur'])->name('admin.struktur.destroy');

    // TEMPLATE PAGE
    Route::post('/template/store', [AdminController::class, 'storeTemplatePage'])->name('admin.template.store');
    Route::get('/template/{id}/edit', [TemplateController::class, 'edit'])->name('admin.template.edit');
    Route::put('/template/{id}', [TemplateController::class, 'update'])->name('admin.template.update');
    Route::delete('/template/{id}', [TemplateController::class, 'destroy'])->name('admin.template.destroy');

    // TEMPLATE SAMBUTAN
    Route::get('/template-sambutan', [TemplateSambutanController::class, 'index'])->name('admin.template-sambutan.index');
    Route::post('/template-sambutan', [TemplateSambutanController::class, 'store'])->name('admin.template-sambutan.store');
    Route::get('/template-sambutan/{id}/edit', [TemplateSambutanController::class, 'edit'])->name('admin.template-sambutan.edit');
    Route::put('/template-sambutan/{id}', [TemplateSambutanController::class, 'update'])->name('admin.template-sambutan.update');
    Route::delete('/template-sambutan/{id}', [TemplateSambutanController::class, 'destroy'])->name('admin.template-sambutan.destroy');
    Route::patch('/template-sambutan/{id}/toggle-status', [TemplateSambutanController::class, 'toggleStatus'])->name('admin.template-sambutan.toggle-status');

    // TEMPLATE BERITA
    Route::get('/template-berita', [TemplateBeritaController::class, 'index'])->name('admin.template-berita.index');
    Route::post('/template-berita', [TemplateBeritaController::class, 'store'])->name('admin.template-berita.store');
    Route::get('/template-berita/{id}/edit', [TemplateBeritaController::class, 'edit'])->name('admin.template-berita.edit');
    Route::put('/template-berita/{id}', [TemplateBeritaController::class, 'update'])->name('admin.template-berita.update');
    Route::delete('/template-berita/{id}', [TemplateBeritaController::class, 'destroy'])->name('admin.template-berita.destroy');
    Route::patch('/template-berita/{id}/toggle-status', [TemplateBeritaController::class, 'toggleStatus'])->name('admin.template-berita.toggle-status');
});

// Fallback
Route::fallback(function () {
    return redirect('/');
});
