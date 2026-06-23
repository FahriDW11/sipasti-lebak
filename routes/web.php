<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\NapiController as AdminNapiController;
use App\Http\Controllers\Admin\PembinaController as AdminPembinaController;
use App\Http\Controllers\Admin\KegiatanController as AdminKegiatanController;
use App\Http\Controllers\Admin\LogKegiatanController as AdminLogKegiatanController;
use App\Http\Controllers\Pembina\DashboardController as PembinaDashboardController;
use App\Http\Controllers\Pembina\NapiController as PembinaNapiController;
use App\Http\Controllers\Pembina\LogKegiatanController as PembinaLogKegiatanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SearchController;


// Untuk Admin
Route::middleware(['auth','role:admin'])
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('/napi', AdminNapiController::class);
        Route::resource('/pembina', AdminPembinaController::class);
        Route::resource('/kegiatan', AdminKegiatanController::class);
        Route::resource('/log-kegiatan', AdminLogKegiatanController::class)->only(['index', 'show']);
        Route::post('/pembina/{id}/assign-napi', [AdminPembinaController::class, 'assignNapi'])->name('pembina.assign-napi');
    });

//untuk pembina
Route::middleware(['auth','role:pembina'])
    ->prefix('pembina')
    ->as('pembina.')
    ->group(function () {
        Route::get('/', [PembinaDashboardController::class, 'index'])->name('pembina.dashboard');
        Route::resource('/napi', PembinaNapiController::class)->only(['index','show']);
        Route::resource('/log-kegiatan', PembinaLogKegiatanController::class);
    });

// untuk user
Route::get('/', function () {
    $napiCount = App\Models\Napi::count();
    $pembinaCount = App\Models\Pembina::count();
    $logKegiatanCount = App\Models\Log_kegiatan::count();
    return view('index', compact('napiCount', 'pembinaCount', 'logKegiatanCount'));
})->name('landing');

Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::post('/search/{id}', [SearchController::class, 'searchDetail'])->name('search.detail');

// Auth routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
