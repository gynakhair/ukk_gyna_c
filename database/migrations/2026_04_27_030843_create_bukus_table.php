<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('bukus', function (Blueprint $table) {
            $table->id('BukuID');
            $table->string('Judul');
            $table->string('Penulis');
            $table->string('Penerbit');
            $table->year('TahunTerbit');
            $table->text('Deskripsi')->nullable();
            $table->string('Gambar')->nullable();
            $table->foreignId('KategoriID')->constrained('kategori_bukus', 'KategoriID');
            $table->timestamps();
        });
    }

};
