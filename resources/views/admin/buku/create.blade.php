@extends('layouts.admin')

@section('content')

<h1 class="mt-4">Tambah Buku</h1>

<div class="card shadow p-4 mt-3">

    <form action="/admin/buku" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">

            <div class="col-md-6 mb-3">
                <label>Judul</label>
                <input type="text" name="Judul" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Penulis</label>
                <input type="text" name="Penulis" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Penerbit</label>
                <input type="text" name="Penerbit" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Tahun Terbit</label>
                <input type="number" name="TahunTerbit" class="form-control" required>
            </div>

            <div class="col-md-12 mb-3">
                <label>Deskripsi</label>
                <textarea name="Deskripsi" class="form-control" rows="3"></textarea>
            </div>

            <div class="col-md-6 mb-3">
                <label>Gambar</label>
                <input type="file" name="Gambar" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>Kategori</label>
                <select name="KategoriID" class="form-control" required>

                    <option value="">-- Pilih Kategori --</option>

                    @foreach($kategori as $k)
                        <option value="{{ $k->KategoriID }}">
                            {{ $k->NamaKategori }}
                        </option>
                    @endforeach

                </select>
            </div>

        </div>

        <button class="btn btn-success">
             Simpan Buku
        </button>

        <a href="/admin/buku" class="btn btn-secondary">
            Kembali
        </a>

    </form>

</div>

@endsection