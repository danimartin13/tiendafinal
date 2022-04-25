<?php

namespace App\Http\Controllers;
use App\Categoria;
use App\Producto;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{
    protected $fillable = ['id', 'stock', 'foto', 'nombre', 'descripcion', 'id_categoria'];
    public function listar(){
        if(Auth::user()){
            $usuario = User::find(Auth::id());
        if ($usuario->rol == '1'){
            if(request('buscar')){
                $texto = request('buscar');
                $productos = Producto::whereRaw('lower(NOMBRE) like (?)',["%{$texto}%"])->get();
                $categorias = Categoria::get();
            }else{
                $productos = Producto::get();
                $categorias = Categoria::get();}
                    return view('productes',
                    [
                        'productos'=>$productos,
                        'categorias'=>$categorias
                    ]);
                }else{
                    return redirect('home');
                }
            }else{
                return redirect('home');
            }
        //echo "Hola";
    }
    static function anadirproducto(Request $request){
        
        
        if (is_uploaded_file($_FILES['foto']['tmp_name'])){
            $productonueva = new Producto;
            $productonueva ->stock = $request->stock;
            $productonueva ->foto = $_FILES["foto"]['name'];
            $productonueva ->nombre = $request->nombre;
            $productonueva ->precio = $request->precio;
            $productonueva ->estado = $request->estado;
            $productonueva ->descripcion = $request->descripcion;
            $productonueva ->id_categoria = $request->id_categoria;
            $productonueva -> save();
            $productos = Producto::orderBy('id','desc')->get();
            //mover foto
                $estructura = "fotos/".$productos[0]->id;
                if (!is_dir($estructura)){
                    mkdir($estructura, 0777, true);
                }
                move_uploaded_file($_FILES["foto"]['tmp_name'], $estructura."/".$_FILES["foto"]['name']);
               
        }
        return redirect(route('listarProductos'));

    }
    static function eliminarprooducto($producto){
        $categoria2 = Producto::find($producto);
        $categoria2->delete();
        return back();
    }
    // actproducto
    public function actproducto($producto){
        Producto::find($producto)->update([
            'estado' => request('estado')
        ]);
        return redirect('productos');
    }
    public function lisiar(){
        
                $productos = Producto::get();
                $categorias = Categoria::get();
                    return view('home',
                    [
                        'productos'=>$productos,
                        'categorias'=>$categorias
                    ]);
                }
        //echo "Hola";
    
}
