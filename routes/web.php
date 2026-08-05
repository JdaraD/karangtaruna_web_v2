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
// controller frontend


// Route backend
Route::livewire('/admin', 'pages::admin.dashboard')->name('admin.dashboard');


// controller backend