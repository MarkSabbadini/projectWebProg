<!DOCTYPE html>
<html>

<head>
    <title>@yield('title')</title>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, 
              user-scalable=no">


    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo.png') }}">


    <!-- Fogli di stile -->
    <link rel="stylesheet" href="{{ url('/') }}/css/bootstrap.min.css">
    <link href="{{ url('/') }}/css/myStyle.css" rel="stylesheet">
    <link href="{{ url('/') }}/css/themeStyle.css" rel="stylesheet">

    <!-- jQuery e plugin JavaScript  -->
    <!-- <script src="http://code.jquery.com/jquery.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="{{ url('/') }}/js/bootstrap.js"></script>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-blue">
        <div class="container">
            <a class="titolo_navbar" href="{{ route('home') }}">U.S. CORTENO GOLGI</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
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
                            <li><a class="dropdown-item" href="{{ route('squadre') }}">Le nostre squadre</a></li>
                            <li><a class="dropdown-item" href="{{ route('risultati') }}">Risultati e classifiche</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('torneo') }}">Torneo estivo</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown btn">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Eventi Sportivi
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('raduno.index') }}">Raduno Scialpinistico</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('caspolata.index') }}">Caspolata</a></li>
                            @if(isset($_SESSION['logged']) && $_SESSION['role'] === 'admin')
                                <li><a class="dropdown-item" href="{{ route('evento.create') }}">Inserisci un nuovo
                                        evento</a></li>
                            @endif
                        </ul>
                    </li>
                    <li class="nav-item btn">
                        <a class="nav-link" aria-current="page" href="{{ route('contatti') }}">Contatti</a>
                    </li>
                </ul>

                <!-- DROPDOWN PER UTENTE NORMALE -->
                @if((isset($_SESSION['logged'])) && ($_SESSION['role'] === 'registered_user'))
                    <li class="nav-item dropdown btn">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Area Personale
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('profilo') }}"><i
                                        class="bi bi-person-circle me-1"></i> Profilo</a></li>
                            <li><a class="dropdown-item" href="{{ route('mieIscrizioni') }}"><i
                                        class="bi bi-list-check me-1"></i> Le mie iscrizioni</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="GET" action="{{ route('user.logout') }}">
                                    @csrf
                                    <button class="dropdown-item" type="submit"><i class="bi bi-box-arrow-right me-1"></i>
                                        Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif


                @if(!isset($_SESSION['logged']))
                    <li class="nav-item btn">
                        <a class="nav-link" href="{{ route('user.login') }}">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Login
                        </a>
                    </li>
                @endif

                @if(isset($_SESSION['logged']) && $_SESSION['role'] === 'admin')
                    <li class="nav-item btn">
                        <a class="nav-link" href="{{ route('user.logout') }}">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Logout
                        </a>
                    </li>
                @endif

                <ul class="navbar-nav">
                    @if(isset($_SESSION['logged']) && $_SESSION['role'] === 'registered_user')
                        <li class="nav-item"><i>Benvenuto {{ $_SESSION['loggedName'] }}</i></li>
                    @elseif(isset($_SESSION['logged']) && $_SESSION['role'] === 'admin')
                        <li class="nav-item"><i>Benvenuto admin {{ $_SESSION['loggedName'] }}</i></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <header class="py-1 bg-image-full" style="background-image: url('{{ asset('img/sfondi/sfondo1.jpg') }}')">
        <!-- NB py-1 classe del contenitore dell'img-->
        <div class="text-center my-5">
            <img class="img-fluid rounded-circle mb-4 logo-small" src="{{ asset('img/logo.png') }}" alt="..." />
            <h1 class="text-white fs-3 fw-bolder scritta-img">UNIONE SPORTIVA CORTENO GOLGI</h1>
        </div>
    </header>

    <div class="container-fluid">
        <header class="header-sezione">
            <h1>
                @yield('title')
            </h1>
        </header>
    </div>

    <div class="container-fluid myContainer">
        @yield('body')
    </div>

    <footer class="bg-body-secondary text-center">
        <div class="container">
            <div class="row">
                <div class="col">
                    <p>Unione Sportiva Corteno Golgi</p>
                </div>
                <div class="col">
                    <a href="https://www.instagram.com/u.s._cortenogolgi/" target="_blank" class="social-icon"><i
                            class="bi bi-instagram"></i></a>
                    <a href="https://www.instagram.com/u.s._cortenogolgi/" target="_blank" class="social-icon"><i
                            class="bi bi-facebook"></i></a>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>