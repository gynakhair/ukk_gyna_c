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

    Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

    Route::middleware(['role:admin,petugas'])->group(function () {

        // ADMIN BUKU
    });

    /*
    |--------------------------------------------------------------------------
    | PEMINJAM (USER APP)
    |--------------------------------------------------------------------------
    */
    

});

require __DIR__.'/auth.php';