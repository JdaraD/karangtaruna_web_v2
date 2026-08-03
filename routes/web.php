<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route frontend
Route::livewire('/', 'pages::user.home')->name('home');
Route::livewire('/about', 'pages::user.about-us')->name('about-us');
// controller frontend


// Route backend
Route::livewire('/admin', 'pages::admin.dashboard')->name('admin.dashboard');


// controller backend