<?php

namespace App\Http\Controllers;
?>
@extends('inicio')

@section('titulo')
    productes
@endsection

@section('content')
    
    <table>
        <tr>
            <td>Cliente</td>
            <td>Producto</td>
            <td>Cantidad</td>
            <td>Precio Total</td>
            <td>Estado</td>
        </tr>
        @foreach ($todos as $todo)
        <tr>
            <td>{{InicioController::devolverNombrecliente($todo->id_user)}}</td>
            <td>{{InicioController::devolverNombreProducto($todo->id_prod)}}</td>
            <td>{{$todo->cantidad}}</td>
            <td>{{InicioController::devolverprecio($todo->id_prod)*$todo->cantidad}}</td>
            <td>@if ($todo->estado!='Enviado')
                <p>Pendiente</p>
                <form action="{{route('actestado', $todo->id)}}" method="post">
                    @csrf @method('PATCH')
                    
                    <input type="submit" value="Marcar como enviado">
                </form>
                @else
                <p>Enviado</p>
                <form action="{{route('comprarproducto', $todo->id)}}" method="post">
                    @csrf @method('PATCH')
                    
                    <input type="submit" value="Desmarcar como enviado">
                </form>
            @endif
            
                </td>
        </tr>
        @endforeach
        
        
    </table>
   
    
@endsection