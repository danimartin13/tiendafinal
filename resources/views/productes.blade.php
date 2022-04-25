@extends('inicio')

@section('titulo')
    productes
@endsection

@section('content')
    <div class="general">
        
        <div class="mediapa">
            <h1>Productos</h1>
        <button type="button" class="btn btn-primary">Añadir categoria</button>
            <table>
                <tr>
                    <td>id</td>
                    <td>stock</td>
                    <td>foto</td>
                    <td>nombre</td>
                    <td>precio</td>
                    <td>estado</td>
                    <td>descripcion</td>
                    <td>id_categoria</td>
                    <td>bloquear</td>
                   
                </tr>
                @foreach ($productos as $producto)
                <tr>
                    {{-- <form action="{{route('eliminarcategoria',$producto)}}" method="post">
                        @csrf @method('DELETE') --}}
                        <td>{{$producto->id}}</td>
                        <td>{{$producto->stock}}</td>
                        <td><img class="imagenproductos" src="fotos/{{$producto->id}}/{{$producto->foto}}" alt=""> </td>
                        <td>{{$producto->nombre}}</td>
                        <td>{{$producto->precio}}</td>
                        
                        <td>{{$producto->descripcion}}</td>
                        <td>{{$producto->id_categoria}}</td>
                        {{-- <td><input type="submit" value="Eliminar"></td> --}}
                        <td>
                            <form action="{{route('actproducto',$producto)}}" method="post">
                            @csrf @method('PATCH')
                            <select name="estado" id="">
                                <option value="1" {{"1"==$producto->estado ? "selected='true'" : ""}}>Activo</option>
                                <option value="2" {{"2"==$producto->estado ? "selected='true'" : ""}}>Bloqueado</option>
                            </select>
                            <input type="submit" value="Guardar">
                            </form>
                        </td>
                        <form action="{{route('eliminarprooducto',$producto)}}" method="post">
                            @csrf @method('DELETE')
                        <td><input type="submit" value="Eliminar"></td>
                    </form>
                </tr>
        
                
                @endforeach
            </table>
        </div>
        <div class="mediapa">
            <form action="{{route('anadirproducto')}}" method="post" enctype="multipart/form-data">
                @csrf
                
                <label for="">stock
                    <input type="text" name="stock" id=""></label><br>
                <label for="">imagen
                    <input type="file" name="foto"></label><br>
                <label for="">nombre
                    <input type="text" name="nombre" id=""></label><br>
                <label for="">precio
                    <input type="number" name="precio" id=""></label><br>
                    <label for="">estado
                        <input type="number" name="estado" id=""></label><br>
                <label for="">descripcion
                    <input type="text" name="descripcion" id=""></label><br>
                <label for="">id_categoria
                    <select name="id_categoria" id="">
                    @foreach ($categorias as $categoria)
                        <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                    @endforeach
                </select></label><br>
                <input type="submit" value="Enviar">
            </form>
            <div>
                <h2>Buscar Productos</h2>
                <form action="{{route('listarProductos')}}" method="get">
                    @csrf
                    <input type="text" name="buscar">
                    <button type="submit">Buscar</button>
                </form>
                <a href="{{route('listarProductos')}}"><button>Limpiar</button></a>
            </div>
        </div>
        
        
    </div>
@endsection