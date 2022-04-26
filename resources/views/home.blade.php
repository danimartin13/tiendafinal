@extends('menu')

@section('titulo')
    home
@endsection

@section('content')
<div class="subheader">
    @foreach ($categorias as $categoria)

    <a href="{{route('categoria',$categoria->nombre)}}">{{$categoria->nombre}}</a>

    @endforeach
</div>

<div class="productoshome">
    @foreach ($productos as $producto)    
    <div class="claseproducto">
        <a href="{{route('producto',$producto->id)}}">
            <img class="homeimagenproductos" src="fotos/{{$producto->id}}/{{$producto->foto}}" alt=""> 
        </a>
        {{-- <img class="homeimagenproductos" src="fotos/{{$producto->id}}/{{$producto->foto}}" alt=""> --}}
        <h2>{{$producto->nombre}}</h2>
        <h5>{{$producto->descripcion}}</h5>
        <h6>{{$producto->precio}} €</h6>
        <div class="unidades">
            <h6>Queda</h6>
            {{$producto->stock}}
            <h6>Unidades</h6>
        </div>
    </div>
    @endforeach
</div>

@endsection