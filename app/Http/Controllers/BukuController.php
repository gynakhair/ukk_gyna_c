<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\KategoriBuku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX (ADMIN + SEARCH + FILTER)
    |--------------------------------------------------------------------------
    */
    public function index(Request $request)
    {
        $query = Buku::with('kategori');

        // 🔍 SEARCH (FIX: pakai group biar gak bentrok filter)
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('Judul', 'like', '%'.$request->search.'%')
                  ->orWhere('Penulis', 'like', '%'.$request->search.'%')
                  ->orWhere('Penerbit', 'like', '%'.$request->search.'%');
            });
        }

        if ($request->kategori) {
            $query->whereHas('kategori', function ($q) use ($request) {
                $q->where('NamaKategori', $request->kategori);
            });
        }

        $buku = $query->get();
        $kategori = KategoriBuku::all(); // 🔥 WAJIB biar view gak error

        return view('admin.buku.index', compact('buku', 'kategori'));
    }

    /*
    |--------------------------------------------------------------------------
    | PETUGAS VIEW
    |--------------------------------------------------------------------------
    */
    public function indexPetugas()
    {
        $buku = Buku::with('kategori')->get();

        return view('petugas.buku.index', compact('buku'));
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        $kategori = KategoriBuku::all();

        return view('admin.buku.create', compact('kategori'));
    }

    /*
    |--------------------------------------------------------------------------
    | STORE (FIX UPLOAD GAMBAR)
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([
            'Judul' => 'required',
            'Penulis' => 'required',
            'Penerbit' => 'required',
            'TahunTerbit' => 'required',
            'KategoriID' => 'required',
        ]);

        // 📸 UPLOAD GAMBAR
        $namaFile = null;

        if ($request->hasFile('Gambar')) {
            $file = $request->file('Gambar');
            $namaFile = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('storage'), $namaFile);
        }

        Buku::create([
            'Judul' => $request->Judul,
            'Penulis' => $request->Penulis,
            'Penerbit' => $request->Penerbit,
            'TahunTerbit' => $request->TahunTerbit,
            'Deskripsi' => $request->Deskripsi,
            'Gambar' => $namaFile,
            'KategoriID' => $request->KategoriID,
        ]);

        return redirect()->route('admin.buku.index')
            ->with('success', 'Buku berhasil ditambahkan');
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        $kategori = KategoriBuku::all();

        return view('admin.buku.edit', compact('buku', 'kategori'));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);

        $buku->update([
            'Judul' => $request->Judul,
            'Penulis' => $request->Penulis,
            'Penerbit' => $request->Penerbit,
            'TahunTerbit' => $request->TahunTerbit,
            'Deskripsi' => $request->Deskripsi,
            'KategoriID' => $request->KategoriID,
        ]);

        return redirect()->route('admin.buku.index')
            ->with('success', 'Buku berhasil diupdate');
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        Buku::destroy($id);

        return redirect()->route('admin.buku.index')
            ->with('success', 'Buku berhasil dihapus');
    }
}