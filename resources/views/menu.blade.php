<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <title>@yield('titulo')</title>
</head>
<body>
    <nav class="headeer">
        <a href="/"><img class="logo" src="fotos/logo_tv.png" alt=""></a>
        <ul class="likhea">
           
            @guest
                <li><a href="{{route('login')}}"><li class="lis">Iniciar sesion</a></li>

            @else
                <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
                </a>
                <li><a href="{{route('editarperfil')}}"><li class="lis">Perfil</a></li>
                <a href="/carrito"><li class="lis">carrito</li></a>
                
            @endguest
            
            <form action="{{route('/')}}" method="get">
                @csrf
                <input type="text" name="buscar">
                <button type="submit">Buscar</button>
            </form>
            <a href="{{route('/')}}"><button>Limpiar</button></a>
        </ul>
    </nav>
    

    @yield('content')

    <footer>
        <p>Footer de la tienda virtual</p>
    </footer>
</body>
</html>
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>