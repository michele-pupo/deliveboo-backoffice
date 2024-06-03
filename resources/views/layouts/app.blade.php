<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="icon" type="image/png" href="{{ asset('storage/branding/deliveboo.svg') }}">

    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Fonts -->

    {{-- ------------------------------ --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    {{-- ------------------- --}}

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

    {{-- chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app">

        {{-- NAV --}}
        <nav class="navbar navbar-expand-md">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('http://localhost:5174/') }}">
                    <div class="logo_laravel">
                        <!-- link logo -->
                        <img src="{{ asset('storage/branding/deliveboo.svg') }}" style="width: 100px" alt="">
                    </div>
                </a>

                <button class="navbar-toggler my-burger" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <i class="fa-solid fa-burger"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            {{-- <a class="nav-link" href="{{url('/') }}">{{ __('Home') }}</a> --}}
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto gap-3 ">
                        <!-- Authentication Links -->
                        @guest
                            <ul class="navbar-nav me-auto">
                                <li class="nav-item">
                                    <a class="nav-link " href="{{ route('home') }}">{{ __('Home') }}</a>
                                </li>
                                
                                <li class="nav-item">
                                    <a class="nav-link " href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link " href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            </ul>
                            @else
                            <ul class="navbar-nav me-auto">
                                <li class="nav-item">
                                    <a class="nav-link " href="{{ route('home') }}">{{ __('Home') }}</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link  dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>
    
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item text-secondary rounded-2"
                                            href="{{ url('dashboard') }}">{{ __('Dashboard') }}</a>
                                        <a class="dropdown-item text-secondary rounded-2"
                                            href="{{ url('profile') }}">{{ __('Profile') }}</a>
                                        <a class="dropdown-item text-secondary rounded-2" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
    
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        {{-- MAIN --}}
        <main class="all">
            @yield('content')
        </main>

        {{-- FOOTER --}}
        <footer id="footer">
            <div class="my-footer d-flex align-items-center justify-content-center flex-column">
                <div class="row w-100 pt-4 p-4 d-flex flex-wrap justify-content-center gap-3">

                    <!-- Colonna 1 -->
                    <div class="my-col col-sm-4 col-md-4 col-lg-2 col-12 p-3 text-center mb-4 ">
                        <h5 class="text-uppercase">Discover Deliveboo</h5>
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-white text-decoration-none ">Who we are</a></li>
                            <li><a href="#" class="text-white text-decoration-none ">Restaurants</a></li>
                            <li><a href="#" class="text-white text-decoration-none ">Design</a></li>
                            <li><a href="#" class="text-white text-decoration-none ">Become our partner</a></li>
                            <li><a href="#" class="text-white text-decoration-none ">Programmig</a></li>
                            <li><a href="#" class="text-white text-decoration-none ">Work with us</a></li>
                        </ul>
                    </div>

                    <!-- Colonna 2 -->
                    <div class="my-col col-sm-4 col-md-4 col-lg-2  col-12 p-3 text-center mb-4">
                        <h5 class="text-uppercase">Legal Notices</h5>
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-white text-decoration-none ">Terms and Conditions</a>
                            </li>
                            <li><a href="#" class="text-white text-decoration-none ">Privacy Police</a></li>
                            <li><a href="#" class="text-white text-decoration-none ">Cookies</a></li>
                            <li><a href="#" class="text-white text-decoration-none ">Classificatio of
                                    partners</a></li>
                            <li><a href="#" class="text-white text-decoration-none ">Requests from the
                                    authorities</a></li>
                            <li><a href="#" class="text-white text-decoration-none ">Public</a></li>
                        </ul>
                    </div>

                    <!-- Colonna 3 -->
                    <div class="my-col col-sm-4 col-md-4 col-lg-2 col-12 p-3 text-center mb-4">
                        <h5 class="text-uppercase">Help</h5>
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-white text-decoration-none ">Contacts</a></li>
                            <li><a href="#" class="text-white text-decoration-none ">FAQ</a></li>
                            <li><a href="#" class="text-white text-decoration-none ">Types of cuisine</a></li>
                        </ul>
                    </div>

                    <!-- colonna 4 -->
                    <div
                        class="my-col col-sm-4 col-md-4 col-lg-2 col-12 p-3 text-center mb-4 d-flex justify-content-center">
                        <div class="text-center">
                            <h5 class="text-uppercase">DOWNLOAD APP</h5>
                            <div class="d-flex gap-3 flex-column align-items-center ">
                                <img class="small-image w-50 "
                                    src="{{ asset('storage/download_images/appstore.png') }}"
                                    alt="App Store">
                                <img class="small-image w-50 "
                                    src="{{ asset('storage/download_images/playstore.png') }}"
                                    alt="App Store">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row d-flex pb-5 w-100 justify-content-center align-items-center ">
                    <div class="col-12 col-sm-6 pt-4 d-flex justify-content-center align-items-center  ">
                        <div class="text-center">
                            <h5 class="text-uppercase">COPYRIGHT</h5>
                            <p class="mb-0">© 2024 Deliveboo. Developed by MLMSM</p>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 pt-4 d-flex flex-column justify-content-start align-items-center ">
                        <div class="text-center ">
                            <h5 class="text-uppercase">FOLLOW US</h5>
                            <div class="box-icon d-flex justify-content-around gap-4">
                                <i class=" fa-brands fa-square-facebook "></i>
                                <i class=" fa-brands fa-square-x-twitter "></i>
                                <i class=" fa-brands fa-square-instagram "></i>
                                <i class=" fa-brands fa-linkedin "></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>
