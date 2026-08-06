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
// Route::livewire('/news', 'pages::user.news')->name('news');
// controller frontend


// Route backend
Route::livewire('/admin', 'pages::admin.dashboard')->name('admin.dashboard');


// controller backend