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

        if ($user->role === 'admin') {
            return view('admin.dashboard.index');
        }

        if ($user->role === 'petugas') {
            return view('petugas.dashboard.index');
        }

        return view('peminjam.dashboard.index');
    }
}