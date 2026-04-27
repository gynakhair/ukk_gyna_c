@extends('layouts.admin')

@section('content')

<h1 class="mt-4">Data Buku</h1>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

{{-- 🔍 SEARCH --}}
<form method="GET" class="mb-3 d-flex gap-2">

    <input type="text"
           name="search"
           class="form-control"
           placeholder="Cari judul / penulis / penerbit..."
           value="{{ request('search') }}">

    <button class="btn btn-dark">
        🔍
    </button>

    <a href="/admin/buku" class="btn btn-secondary">
        Reset
    </a>

</form>

<div class="btn-group mb-3 flex-wrap" role="group">

    <a href="/admin/buku"
       class="btn {{ request('kategori') ? 'btn-outline-secondary' : 'btn-secondary' }}">
        Semua
    </a>

    <a href="/admin/buku?kategori=Bisnis"
       class="btn {{ request('kategori') == 'Bisnis' ? 'btn-secondary' : 'btn-outline-secondary' }}">
        Bisnis
    </a>

    <a href="/admin/buku?kategori=Informatika"
       class="btn {{ request('kategori') == 'Informatika' ? 'btn-secondary' : 'btn-outline-secondary' }}">
        Informatika
    </a>

    <a href="/admin/buku?kategori=Fiksi"
       class="btn {{ request('kategori') == 'Fiksi' ? 'btn-secondary' : 'btn-outline-secondary' }}">
        Fiksi
    </a>

    <a href="/admin/buku?kategori=Edukasi"
       class="btn {{ request('kategori') == 'Edukasi' ? 'btn-secondary' : 'btn-outline-secondary' }}">
        Edukasi
    </a>

    <a href="/admin/buku?kategori=Self Improvement"
       class="btn {{ request('kategori') == 'Self Improvement' ? 'btn-secondary' : 'btn-outline-secondary' }}">
        Self Improvement
    </a>

</div>

{{-- ➕ FLOATING BUTTON --}}
<a href="/admin/buku/create"
   class="btn btn-dark shadow rounded-circle"
   style="position: fixed; bottom: 30px; right: 30px; width: 60px; height: 60px;
   display:flex; align-items:center; justify-content:center; font-size: 24px;">
    +
</a>

{{-- 📚 TABLE SCROLL --}}
<div style="max-height: 450px; overflow-y: auto; border-radius: 10px;">

<table class="table table-hover align-middle">

    <thead class="table-dark" style="position: sticky; top: 0; z-index: 2;">
        <tr>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Penerbit</th>
            <th>Tahun</th>
            <th>Gambar</th>
            <th>Kategori</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>

        @forelse($buku as $item)

        <tr>

            <td>{{ $item->Judul }}</td>
            <td>{{ $item->Penulis }}</td>
            <td>{{ $item->Penerbit }}</td>
            <td>{{ $item->TahunTerbit }}</td>
            <td>
                @if($item->Gambar)
                    <img src="{{ asset('storage/'.$item->Gambar) }}"
                         width="60"
                         class="rounded shadow-sm">
                @endif
            </td>

            <td>
                {{ $item->kategori->NamaKategori ?? '-' }}
            </td>

            <td style="max-width: 250px;">
                {{ Str::limit($item->Deskripsi, 60) }}
            </td>

            <td>
                <a href="/admin/buku/{{ $item->BukuID }}/edit"
                   class="btn btn-sm btn-primary">
                    ✏
                </a>

                <form action="/admin/buku/{{ $item->BukuID }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-sm btn-danger"
                            onclick="return confirm('Yakin hapus?')">
                        🗑
                    </button>

                </form>
            </td>

        </tr>

        @empty

        <tr>
            <td colspan="8" class="text-center py-4 text-muted">
                Belum ada data buku
            </td>
        </tr>

        @endforelse

    </tbody>

</table>

</div>

@endsection
<script>
let timeout = null;

document.getElementById('searchInput').addEventListener('keyup', function () {

    clearTimeout(timeout);

    let value = this.value;

    timeout = setTimeout(function () {

        let url = new URL(window.location.href);

        url.searchParams.set('search', value);

        window.location.href = url;

    }, 300); 

});
</script>