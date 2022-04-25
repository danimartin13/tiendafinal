@extends('inicio')

@section('titulo')
    categories
@endsection




@section('content')
<div class="general">
    <div class="mediapa">
        <h1>categories</h1>
    <button type="button" class="btn btn-primary">Añadir categoria</button>
    <table>
        <tr>
            <td>id</td>
            <td>nombre</td>
            <td>bloquear</td>
            <td>eliminar</td>
        </tr>
        @foreach ($categorias as $categoria)
        <tr>
                <td>{{$categoria->id}}</td>
                <td>{{$categoria->nombre}}</td>
                <td>
                    <form action="{{route('actcategoria',$categoria)}}" method="post">
                        @csrf @method('PATCH')
                        <select name="estado" id="">
                            <option value="1" {{"1"==$categoria->estado ? "selected='true'" : ""}}>Activo</option>
                            <option value="2" {{"2"==$categoria->estado ? "selected='true'" : ""}}>Bloqueado</option>
                        </select>
                        <input type="submit" value="Guardar">
                    </form>
                </td>
                <form action="{{route('eliminarcategoria',$categoria)}}" method="post">
                    @csrf @method('DELETE')
                <td><input type="submit" value="Eliminar"></td>
            </form>
        </tr>

        
        @endforeach
    </table>
    </div>
    <div class="mediapa">
        <form action="{{route('anadircategoria')}}" method="post">
            @csrf
            <label for="">Nombre de la categoria</label><br>
            <input type="text" name="nombre" id="">
            <select name="estado" id="">
                <option value="1">Activo</option>
                <option value="2">Bloqueado</option>
            </select>
            <input type="submit" value="Enviar">
        </form>
        <div>
            <h2>Buscar Categorias</h2>
            <form action="{{route('listarCategorias')}}" method="get">
                @csrf
                <input type="text" name="buscar">
                <button type="submit">Buscar</button>
            </form>
            <a href="{{route('listarCategorias')}}"><button>Limpiar</button></a>
        </div>
    </div>
    
    
</div>
@endsection