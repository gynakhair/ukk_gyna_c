<h1>ADMIN - DATA BUKU</h1>

<a href="{{ route('buku.create') }}">Tambah Buku</a>

@foreach($buku as $item)
    <p>{{ $item->Judul }} - {{ $item->Penulis }}</p>
@endforeach