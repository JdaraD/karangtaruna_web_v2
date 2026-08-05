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
// controller frontend


// Route backend
Route::livewire('/admin', 'pages::admin.dashboard')->name('admin.dashboard');


// controller backend