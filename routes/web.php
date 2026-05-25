<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TahananController as AdminTahananController;
use App\Http\Controllers\Admin\PembinaController as AdminPembinaController;
use App\Http\Controllers\Admin\KegiatanController as AdminKegiatanController;
use App\Http\Controllers\Admin\LogKegiatanController as AdminLogKegiatanController;
use App\Http\Controllers\Pembina\TahananController as PembinaTahananController;
use App\Http\Controllers\Pembina\LogKegiatanController as PembinaLogKegiatanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SearchController;


// Untuk Admin
Route::middleware(['auth','role:admin'])
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {
        Route::get('/', fn() => view('admin.dashboard'))->name('admin.dashboard');
        Route::resource('/tahanan', AdminTahananController::class);
        Route::resource('/pembina', AdminPembinaController::class);
        Route::resource('/kegiatan', AdminKegiatanController::class);
        Route::resource('/log-kegiatan', AdminLogKegiatanController::class)->only(['index', 'show']);
        Route::post('/pembina/{id}/assign-tahanan', [AdminPembinaController::class, 'assignTahanan'])->name('pembina.assign-tahanan');
    });

//untuk pembina
Route::middleware(['auth','role:pembina'])
    ->prefix('pembina')
    ->as('pembina.')
    ->group(function () {
        Route::get('/', fn() => view('pembina.dashboard'))->name('pembina.dashboard');
        Route::resource('/tahanan', PembinaTahananController::class)->only(['index','show']);
        Route::resource('/log-kegiatan', PembinaLogKegiatanController::class);
    });

// untuk user
Route::get('/', fn() => view('index'))->name('landing');
Route::get('/search', [SearchController::class, 'search'])->name('search');

// Auth routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
