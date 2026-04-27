<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {

        $user = auth()->user();

        if ($user->role === 'admin') {
            return view('admin.dashboard.index');
        }

        if ($user->role === 'petugas') {
            return view('petugas.dashboard.index');
        }

        return view('peminjam.dashboard.index');

    })->name('dashboard');

});

require __DIR__.'/auth.php';