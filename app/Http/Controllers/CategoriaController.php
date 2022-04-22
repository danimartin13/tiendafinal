<?php

namespace App\Http\Controllers;
use App\Categoria;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriaController extends Controller
{
    protected $fillable = ['id', 'nombre'];
    public function listar(){
        if(Auth::user()){
                $usuario = User::find(Auth::id());
            if ($usuario->rol == '1'){
                $categorias = Categoria::get();
                    return view('categories',
                    [
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

    static function anadircategoria(Request $request){
        $categorianueva = new Categoria;
        $categorianueva ->nombre = $request->nombre;
        $categorianueva ->estado = $request->estado;
        $categorianueva -> save();
        return redirect('categorias');
    }

    static function eliminarcategoria($categoria){
        $categoria2 = Categoria::find($categoria);
        $categoria2->delete();
        return back();
    }
    public function listarProductos($categoria){
        $cat = Categoria::where('nombre','=',$categoria)->get();
        $productos = Producto::where('id_categoria','=',$cat[0]->id)->get();
        return view('categoria',compact('productos'));
    }
    
    public function actcategoria($categoria){
        Categoria::find($categoria)->update([
            'estado' => request('estado')
        ]);
        return redirect('categorias');
    }
}
