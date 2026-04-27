@extends('admin.dashboard.layout')

@section('content')

<div class="card p-3">
    <h3>Dashboard Admin</h3>
    <p>Selamat datang, {{ auth()->user()->name }}</p>
</div>

@endsection