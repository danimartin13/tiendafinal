@extends('menu')

@section('titulo')
    home
@endsection

@section('content')


<div class="">
    @foreach ($productos as $producto)    
    <div class="general">
        <div class="mediapa">
            <img class="" src="fotos/{{$producto->id}}/{{$producto->foto}}" alt=""> 
        </div>
        <div class="mediapa">
            <h1>{{$producto->nombre}}</h1>
            <h3>{{$producto->descripcion}}</h3>
            <h5>Quedan: {{$producto->stock}} unidades</h5>
            <h5>{{$producto->precio}}€</h5>
            <form action="{{route('subircarrito',$producto)}}" method="post">
                @csrf
                <select name="cantidad" id="">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
                <input type="submit" value="Añadir al Carrito">
            </form>
        </div>
    </div>
       
    @endforeach
</div>

@endsection