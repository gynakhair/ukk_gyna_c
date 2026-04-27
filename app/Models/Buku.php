<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'bukus';
    protected $primaryKey = 'BukuID';

    protected $fillable = [
        'Judul',
        'Penulis',
        'Penerbit',
        'TahunTerbit',
        'Deskripsi',
        'Gambar',
        'KategoriID'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELASI KE KATEGORI
    |--------------------------------------------------------------------------
    */
    public function kategori()
    {
        return $this->belongsTo(KategoriBuku::class, 'KategoriID');
    }
}