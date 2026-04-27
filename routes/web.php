<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;



Route::get('/', function () {
    return Auth::check()
        ? redirect('/dashboard')
        : redirect('/login');
});

Route::get('/register', function () {
    return view('auth.register');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ADMIN
    Route::prefix('admin')->middleware('role:admin')->group(function () {
        Route::get('/buku', [BukuController::class, 'index'])->name('admin.buku.index');
        Route::get('/buku/create', [BukuController::class, 'create'])->name('admin.buku.create');
        Route::post('/buku', [BukuController::class, 'store'])->name('admin.buku.store');
        Route::get('/buku/{id}/edit', [BukuController::class, 'edit'])->name('admin.buku.edit');
        Route::put('/buku/{id}', [BukuController::class, 'update'])->name('admin.buku.update');
        Route::delete('/buku/{id}', [BukuController::class, 'destroy'])->name('admin.buku.destroy');
    });

    // PETUGAS
    Route::prefix('petugas')->middleware('role:petugas')->group(function () {
        Route::get('/buku', [BukuController::class, 'indexPetugas'])->name('petugas.buku.index');
    });

});

require __DIR__.'/auth.php';