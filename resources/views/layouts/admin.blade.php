<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>

    <link href="{{ asset('sbadmin/css/styles.css') }}" rel="stylesheet">
</head>

<body class="sb-nav-fixed">

<!-- TOPBAR -->
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">

    <a class="navbar-brand ps-3" href="/dashboard">Library Admin</a>

    <div class="ms-auto me-3 text-white">
        {{ auth()->user()->name }}
    </div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-danger btn-sm me-3">Logout</button>
    </form>

</nav>

<div id="layoutSidenav">

    <!-- SIDEBAR -->
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark">

            <div class="sb-sidenav-menu">
                <div class="nav">

                    <a class="nav-link" href="/dashboard">
                        Dashboard
                    </a>

                    <a class="nav-link" href="/admin/buku">
                        Kelola Buku
                    </a>

                </div>
            </div>

        </nav>
    </div>

    <!-- CONTENT -->
    <div id="layoutSidenav_content">

        <main class="p-4">

            @yield('content')

        </main>

    </div>

</div>

<script src="{{ asset('sbadmin/js/scripts.js') }}"></script>
</body>
</html>