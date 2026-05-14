<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TahananController;
use App\Http\Controllers\PembinaController;


Route::resource('tahanan', TahananController::class);
Route::resource('pembina', PembinaController::class);
// Route::resource('kegiatan', KegiatanController::class);
// Route::resource('login', LoginController::class);





// // Untuk User
// Route::get('/', fn() => view('welcome'));
// Route::get('/search', fn() => view('welcome'));
// Route::get('/detail/{id}', fn($id) => view('welcome', compact('id')));

// // Untuk Pembina
// Route::get('/pembina', fn() => view('pembina.dashboard'));
// Route::get('/pembina/kegiatan', fn() => view('pembina.dashboard'));
// Route::get('/pembina/tahanan', fn() => view('pembina.tahanan'));
// Route::get('/pembina/tahanan/{id}', fn($id) => view('pembina.detail', compact('id')));

// // Untuk Admin
// Route::get('/admin', fn() => view('admin.dashboard'));   
// Route::get('/admin/pembina', fn() => view('admin.pembina'));
// Route::get('/admin/tahanan', fn() => view('admin.tahanan'));
