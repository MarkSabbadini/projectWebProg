<!DOCTYPE html>
<html>

<head>
    <title>@yield('title')</title>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, 
              user-scalable=no">

    <!-- Fogli di stile -->
    <link rel="stylesheet" href="{{ url('/') }}/css/bootstrap.min.css">
    <link href="{{ url('/') }}/css/style.css" rel="stylesheet">

    <!-- jQuery e plugin JavaScript  -->
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="{{ url('/') }}/js/bootstrap.js"></script>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="titolo_navbar" href="#">U.S. CORTENO GOLGI</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item btn">
                        <a class="nav-link @yield('active_home')" aria-current="page"
                            href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item dropdown btn">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Chi Siamo
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('direttivo') }}">Direttivo</a></li>
                            <li><a class="dropdown-item" href="{{ route('storia') }}">Storia</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown btn">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Calcio
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('direttivo') }}">Le nostre squadre</a></li>
                            <li><a class="dropdown-item" href="{{ route('storia') }}">Risultati e classifiche</a></li>
                            <li><a class="dropdown-item" href="{{ route('storia') }}">Torneo estivo</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown btn">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Eventi Sportivi
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('direttivo') }}">Raduno Scialpinistico</a></li>
                            <li><a class="dropdown-item" href="{{ route('storia') }}">Caspolata</a></li>
                        </ul>
                    </li>
                    <li class="nav-item btn">
                        <a class="nav-link" aria-current="page" href="{{ route('contatti') }}">Contatti</a>
                    </li>
                </ul>


                <div class="logo">
                    <img class="img-thumbnail img-responsive" src="{{ url('/') }}/img/logo.png">
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <header class="header-sezione">
            <h1>
                @yield('title')
            </h1>
        </header>
    </div>

    <div class="container-fluid">
        @yield('body')
    </div>

    <footer class="bg-body-secondary text-center">
        <div class="container">
            <div class="row">
                <div class="col">
                    <p>Unione Sportiva Corteno Golgi</p>
                </div>
                <div class="col">
                    <a href="https://www.instagram.com/u.s._cortenogolgi/" target="_blank" class="social-icon"><i class="bi bi-instagram"></i></a>
                    <a href="https://www.instagram.com/u.s._cortenogolgi/" target="_blank" class="social-icon"><i class="bi bi-facebook"></i></a>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>