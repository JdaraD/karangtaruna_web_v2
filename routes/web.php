<?php

use App\Http\Controllers\admin\anggotaController;
use App\Http\Controllers\admin\BannerController;
use App\Http\Controllers\admin\identityController;
use App\Http\Controllers\admin\kategoriUsahaController;
use App\Http\Controllers\admin\kontakAdminController;
use App\Http\Controllers\admin\kontakBantuanController;
use App\Http\Controllers\admin\legalController;
use App\Http\Controllers\admin\misiController;
use App\Http\Controllers\admin\NewsController;
use App\Http\Controllers\admin\pasalController;
use App\Http\Controllers\admin\productController;
use App\Http\Controllers\admin\runningTextController;
use App\Http\Controllers\admin\StrukturOrgController;
use App\Http\Controllers\admin\tentangController;
use App\Http\Controllers\admin\valueController;
use App\Http\Controllers\admin\visiController;
use App\Http\Controllers\admin\wilayahKolaborasiController;
use App\Http\Controllers\SliderController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route frontend
Route::livewire('/', 'pages::user.home')->name('home');
Route::livewire('/about', 'pages::user.about-us')->name('about-us');
Route::livewire('/struktur-karar', 'pages::user.struktur-katar')->name('struktur-katar');
Route::livewire('/legal', 'pages::user.legal')->name('legal');
Route::livewire('/kegiatan', 'pages::user.kegiatan')->name('kegiatan');
Route::livewire('/kegiatan-detail', 'pages::user.kegiatan-detail')->name('kegiatan-detail');
Route::livewire('/usaha-mandiri', 'pages::user.usaha-mandiri')->name('usahamandiri');
Route::livewire('/kategori-detail', 'pages::user.kategori-detail')->name('kategori-detail');
Route::livewire('/detail-product', 'pages::user.detail-product')->name('detail-product');
Route::livewire('/foto', 'pages::user.foto')->name('foto');
Route::livewire('/foto-detail', 'pages::user.foto-detail')->name('foto-detail');
Route::livewire('/video', 'pages::user.video')->name('video');
Route::livewire('/video-detail', 'pages::user.video-detail')->name('video-detail');
Route::livewire('/event', 'pages::user.event')->name('event');
Route::livewire('/news', 'pages::user.news')->name('news');
Route::livewire('/kolaborasi', 'pages::user.kolaborasi')->name('kolaborasi');
Route::livewire('/detail-kolaborasi', 'pages::user.detail-kolaborasi')->name('detail-kolaborasi');


// controller frontend


Route::livewire('/login', 'pages::auth.login')->name('login');
Route::livewire('/registrasi', 'pages::auth.registrasi')->name('registrasi');

// Route backend
Route::livewire('/admin', 'pages::admin.dashboard')->name('admin.dashboard');
Route::livewire('/admin.about-us', 'pages::admin.about-us')->name('admin.about-us');
Route::livewire('/admin.struktur', 'pages::admin.struktur')->name('admin.struktur');
Route::livewire('/admin.legal', 'pages::admin.legal')->name('admin.legal');
Route::livewire('/admin.kegiatan', 'pages::admin.kegiatan')->name('admin.kegiatan');
Route::livewire('/admin.usaha', 'pages::admin.usaha')->name('admin.usaha');
Route::livewire('/admin.kolaborasi', 'pages::admin.kolaborasi')->name('admin.kolaborasi');
Route::livewire('/admin.foto', 'pages::admin.foto')->name('admin.foto');
Route::livewire('/admin.video', 'pages::admin.video')->name('admin.video');
Route::livewire('/admin.event', 'pages::admin.event')->name('admin.event');
Route::livewire('/admin.news', 'pages::admin.news')->name('admin.news');
Route::livewire('/admin.banner', 'pages::admin.banner')->name('admin.banner');
Route::livewire('/admin.kontak', 'pages::admin.kontak')->name('admin.kontak');
Route::livewire('/admin.running-text', 'pages::admin.running-text')->name('admin.running-text');


// controller backend
Route::resource('/admin/runningTextController', runningTextController::class);
Route::resource('/admin/kontakAdmin', kontakAdminController::class);
Route::resource('/admin/kontakBantuan', kontakBantuanController::class);
Route::resource('/admin/banner', BannerController::class);
Route::resource('/admin/slider', SliderController::class);
Route::post('/admin/news', [NewsController::class, 'store'])->name('admin.news.store');
Route::post('/admin/tentang', [tentangController::class, 'store'])->name('admin.tentang.store');
Route::post('/admin/identity', [identityController::class, 'store'])->name('admin.identity.store');
Route::post('/admin/visi', [visiController::class, 'store'])->name('admin.visi.store');
Route::post('/admin/misi', [misiController::class, 'store'])->name('admin.misi.store');
Route::post('/admin/value', [valueController::class, 'store'])->name('admin.value.store');
Route::post('/admin/legal', [legalController::class, 'store'])->name('admin.legal.store');
Route::post('/admin/pasal', [pasalController::class, 'store'])->name('admin.pasal.store');
Route::post('/admin/struktur', [StrukturOrgController::class, 'store'])->name('admin.struktur.store');
Route::post('/admin/anggota', [anggotaController::class, 'store'])->name('admin.anggota.store');
Route::post('/admin/kategoriUsaha', [kategoriUsahaController::class, 'store'])->name('admin.kategoriUsaha.store');
Route::post('/admin/product', [productController::class, 'store'])->name('admin.product.store');
Route::post('/admin/wilayah-kolaborasi', [wilayahKolaborasiController::class, 'store'])->name('admin.wilayah-kolaborasi.store');