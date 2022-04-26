<?php

namespace App\Http\Controllers;
?>

@extends('menu')

@section('titulo')
    home
@endsection

@section('content')
<h1>Carrito</h1>
<table>
    <tr>
        <td>Producto</td>
        <td>Cantidad</td>
        <td>Precio Unidad</td>
        <td>Precio total</td>
        <td>Eliminar</td>
    </tr>
    @foreach ($cat as $cats)
    <tr>
        <td>{{InicioController::devolverNombreProducto($cats->id_prod)}}</td>
        <td>{{$cats->cantidad}}</td>
        <td>{{InicioController::devolverprecio($cats->id_prod)}}</td>
        <td>{{InicioController::devolverprecio($cats->id_prod)*$cats->cantidad}}</td>
        <td><form action="{{route('eliminarproductocarrito', $cats->id)}}" method="post">
            @csrf
            @method('DELETE')
            <input type="submit" value="Eliminar">
        </form></td>
    </tr>
    
    
    
</table>
     <form action="{{route('comprarproducto', $cats->id)}}" method="post">
        @csrf @method('PATCH')
         <input type="submit" value="Comprar">
     </form>
     @endforeach
<h2>Compras</h2>
<table>
    <tr>
        <td>Producto</td>
        <td>Cantidad</td>
        <td>Precio Total</td>
        <td>Estado</td>
    </tr>
    @foreach ($ant as $ants)
    <tr>
        <td>{{InicioController::devolverNombreProducto($ants->id_prod)}}</td>
        <td>{{$ants->cantidad}}</td>
        <td>{{InicioController::devolverprecio($cats->id_prod)*$cats->cantidad}}</td>
        <td>{{$ants->estado}}</td>
    </tr>
    @endforeach
    
    
</table>
@endsection