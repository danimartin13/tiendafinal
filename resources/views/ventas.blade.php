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
            <td>Producto</td>
            <td>Cantidad</td>
            <td>Precio Total</td>
            <td>Estado</td>
        </tr>
        @foreach ($todos as $todo)
        <tr>
            <td>{{InicioController::devolverNombreProducto($todo->id_prod)}}</td>
            <td>{{$todo->cantidad}}</td>
            <td>{{InicioController::devolverprecio($todo->id_prod)*$todo->cantidad}}</td>
            {{-- <td>{{
            if($todo->estado!='carrito'){
                echo '<form action="" method="post">
                    <select name="actuesta" id="">
                        <option value="pendiente" {{"pendiente"==$todo->estado ? "selected='true'" : ""}}>pendiente</option>
                        <option value="enviado" {{"enviado"==$todo->estado ? "selected='true'" : ""}}>Enviado</option>
                    </select>
                </form>';
            }}}</td>
        </tr> --}}
        @endforeach
        
        
    </table>
   
    
@endsection