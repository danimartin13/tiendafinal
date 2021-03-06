<?php

namespace App\Http\Controllers;
?>

@extends('menu')

@section('titulo')
    home
@endsection

@section('content')
<h1>Carrito</h1>
@if (session('status'))
    <p id="status">{{session('status')}}</p>
@endif
<table>
    <tr>
        <td>Producto</td>
        <td>Cantidad</td>
        <td>Precio Unidad</td>
        <td>Precio total</td>
        <td>Eliminar</td>
    </tr>
    @isset($cat)
        @foreach ($cat as $cats)
            <tr>
                <td>{{InicioController::devolverNombreProducto($cats->id_prod)}}</td>
                <td>{{$cats->cantidad}}
                <form action="{{route('sumarprod', $cats)}}" method="post">
                    @csrf @method('PATCH')
                    <input type="submit" value="+">
                </form>
                <form action="{{route('restprod', $cats)}}" method="post">
                    @csrf @method('PATCH')
                    <input type="submit" value="-">
                </form>
                
                </td>
                <td>{{InicioController::devolverprecio($cats->id_prod)}}</td>
                <td>{{InicioController::devolverprecio($cats->id_prod)*$cats->cantidad}}</td>
                <td><form action="{{route('eliminarproductocarrito', $cats->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Eliminar">
                </form></td>
            </tr>
            @endforeach
            
        </table>
        @foreach ($cat as $cats)
            <form action="{{route('comprarproducto', $cats->id)}}" method="post">
                @csrf @method('PATCH')
                <input type="submit" value="Comprar">
            </form>
            @endforeach    
    @endisset
        
    
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
        <td>{{InicioController::devolverprecio($ants->id_prod)*$ants->cantidad}}</td>
        <td>{{$ants->estado}}</td>
    </tr>
    @endforeach
    
    
</table>
@endsection