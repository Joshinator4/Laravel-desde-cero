<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        {{-- Helper optional: si hay algo que puede ser null no saltará un error de null (en este caso el usuario, si no hay usuario logeado user() devolveria null) --}}
                        {{-- A traves del helper auth()buscamos el usuario que este logeado ->user() y llamamos al metodo ->isAdmin --}}
                        @if (optional(auth()->user())->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('panel') }}">{{ __('Panel') }}</a>
                            </li>
                        @endif
                        {{-- Esta es la pestaña del carrito --}}
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('carts.index') }}">
                                {{-- Así podremos añadir la funcion de contar los productos que tiene el carrito --}}
                                @inject('cartService', 'App\Services\CartService'){{--Con inject podemos agregar servicios a las vistas --}}
                                Cart ({{ $cartService->countProducts() }})

                            </a>

                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                     <img src="{{ asset(Auth::user()->profile_image) }}" alt="{{ Auth::user()->name }}" class="rounded-circle" width="50px" height="50px" >{{--Asi añadimos la imagen del usuario, si no tiene imagen se mostrrá el nombre del usuario y se le pone en un circulo con el tamaño deseado--}}
                                    <span class="caret"></span>
                                </a>


                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                        {{ __('Profile') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>



                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container-fluid">
                <!-- Dump mostrará en tiempo de ejecucion los errores que hay-->
                {{--@dump($errors)--}}
                <!-- Esto filtra si hay algún error enviado desde el controlador  salte aquí, de esta forma solo se hace 1 vez por esta plantilla-->
                @if (session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error')}}
                    </div>

                @endif

                <!-- Esto filtra si hay algún mensaje de exito para mostrarlo-->
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success')}}
                    </div>

                @endif

                <!-- esto coge los posibles errores generados por validate del conjunto de reglas generadas en el controlador, any es por si esta vacío (no hay errores)-->
                @if (isset($errors) && $errors->any())
                    <!-- se recorre la lista de errores mostrandolos en una lista -->
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{  $error  }}</li>
                            @endforeach
                        </ul>
                    </div>

                @endif

                <!--yield indica que aqui ira una sección de la vista-->
                @yield('content')
            </div>

        </main>
    </div>
</body>
</html>
