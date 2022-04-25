<?php

namespace App\Http\Controllers;
use App\Categoria;
use App\Producto;
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
                if(request('buscar')){
                    $texto = request('buscar');
                    $categorias = Categoria::whereRaw('lower(NOMBRE) like (?)',["%{$texto}%"])->get();
                }else $categorias = Categoria::get();

                    return view('categories',
                    [
                        'categorias'=>$categorias
                    ]);
            }else{
                return redirect('login');
            }
        }else{
            return redirect('login');
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
        $categorias = Categoria::where('estado','!=','2')->get();
        $productos = Producto::where('id_categoria','=',$cat[0]->id)->where('estado','!=',"2")->get();
        return view('categoria',compact('productos', 'categorias'));
    }
    
    public function actcategoria($categoria){
        Categoria::find($categoria)->update([
            'estado' => request('estado')
        ]);
        return redirect('categorias');
    }
}
