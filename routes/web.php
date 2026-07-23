<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route frontend
Route::livewire('/', 'pages::user.home')->name('home');


// controller frontend


// Route backend
Route::livewire('/admin', 'pages::admin.dashboard')->name('admin.dashboard');


// controller backend