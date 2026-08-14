<?php

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


// controller backend