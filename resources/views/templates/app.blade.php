<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Landing' }}</title> <!-- Mengambil title dinamis, atau default jika tidak ada -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    {{-- stack : wadah penampung content dinamis namun optional biasanya untuk wadah styling tambahan atau script tambahan --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('assest/images/apotek.png') }}">
    @stack('style')

</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-lg-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">APOTEK</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                @if(Auth::check())
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link  {{ Route::is('Welcome') ? 'active' : '' }} " aria-current="page"
                            href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  {{ Route::is('landing_page') ? 'active ' : '' }}"
                            href="{{ route('landing_page') }}">Landing</a>
                    <li class="nav-item">
                        <a class="nav-link  {{ Route::is('medicine') ? 'active ' : '' }}"
                        href="{{ route('medicine') }}">Data Obat</a>
                    </li>
                    @if( Auth::User()->role == 'admin')
                    <li class="nav-item">
                        <a class="nav-link  {{ Route::is('Users') ? 'active ' : '' }}"
                        href="{{ route('Users') }}">Kelola Akun</a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link "
                        href="{{ route('logout') }}">Logout</a>
                    </li>
                </ul>
                <form class="d-flex" role="search" action="{{ route('medicine') }}" method = 'get'>
                    <input class="form-control me-2" type="text" placeholder="Search" aria-label="Search" name="search">
                    <button class="btn btn-outline-dark" type="submit">Search</button>
                </form>
                @endif
            </div>
        </div>
    </nav>
    @yield('content-dinamis')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    @stack('script')
</body>

</html>