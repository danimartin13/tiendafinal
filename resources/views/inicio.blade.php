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
        <a href="/">Imagen logotipo</a>
        <ul class="likhea">
            <a href="/categorias"><li class="lis">Categorias</li></a>
            <a href="/productos"><li class="lis">Productos</li></a>
            <a href="/ventas"><li class="lis">Ventas</li></a>
        </ul>
    </nav>

    @yield('content')

    <footer>
        <p>Footer de la tienda virtual</p>
    </footer>
</body>
</html>