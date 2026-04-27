<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

    <link href="{{ asset('sbadmin/css/styles.css') }}" rel="stylesheet">
</head>

<body class="sb-nav-fixed">

<!-- TOP NAVBAR -->
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand ps-3">WikraBook</a>

    <form method="POST" action="{{ route('logout') }}" class="ms-auto me-3">
        @csrf
        <button class="btn btn-danger btn-sm">Logout</button>
    </form>
</nav>

<div id="layoutSidenav">

    <!-- SIDEBAR -->
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark">

            <div class="sb-sidenav-menu">
                <div class="nav">

                    <a class="nav-link" href="/dashboard">Dashboard</a>
                    <a class="nav-link" href="/buku">Data Buku</a>

                </div>
            </div>

        </nav>
    </div>

    <!-- CONTENT -->
    <div id="layoutSidenav_content">
        <main class="p-4">

            <h4>Halo, {{ auth()->user()->name }}</h4>

            @yield('content')

        </main>
    </div>

</div>

<script src="{{ asset('sbadmin/js/scripts.js') }}"></script>

</body>
</html>