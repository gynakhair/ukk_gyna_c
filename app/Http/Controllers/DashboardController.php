<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('/login');
        }

        // semua role pakai view yang sama (biar SB Admin konsisten)
        if ($user->role === 'admin') {
            return view('admin.dashboard.index', compact('user'));
        }

        if ($user->role === 'petugas') {
            return view('petugas.dashboard.index', compact('user'));
        }

        return view('peminjam.dashboard.index', compact('user'));
    }
}