<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Blog</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">


</head>
<div class="container">
    <header>
        <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
            <i class="fab fa-blogger  fa-2x mr-1"></i>
            <span class="my-0 mr-md-auto font-weight-normal h3 mt-1" >Blog</span>
            <nav class="my-2 my-md-0 mr-md-3">
                <a class="text-dark ml-1 mr-1" href={{ route('articles.index') }}>Главная</a>
                <a class="text-dark ml-1 mr-1" href="{{ route('articles.create') }}">Новая статья</a>
            </nav>
            @guest
                <a class="btn btn-primary mr-1" href="{{ route('login') }}">{{ __('Login') }}</a>
                <a class="btn btn-primary" href="{{ route('register') }}">{{ __('Register') }}</a>
            @else
                <a class="btn btn-primary" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @endguest
        </div>
    </header>
    <div class="mt-2 p-3" style="background: white">
        <div class="row">
            <div class="col-md-8">
                @yield('content')
            </div>
        </div>
    </div>
</div>
</body>
</html>