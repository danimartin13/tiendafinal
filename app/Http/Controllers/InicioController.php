<?php

namespace App\Http\Controllers;
use App\Producto;
use App\Categoria;
use App\User;
use App\Carrito;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use config\session;

use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index(){
        if(request('buscar')){
            $texto = request('buscar');
            $productos = Producto::where('estado','!=','2')->whereRaw('lower(NOMBRE) like (?)',["%{$texto}%"])->get();
        }
        else $productos = Producto::where('estado','!=','2')->where('stock','>','0')->get();
        $categorias = Categoria::where('estado','!=','2')->get();
        
            return view('home', compact('productos','categorias'));
        }


    public function perfil(){
        if(Auth::user()){
            $usuario = User::find(Auth::id());
            $categorias = Categoria::where('estado','!=','2')->get();
            return view('editarperfil',compact('usuario', 'categorias'));
        }else{
            return view('home');
        }
    }
    
    public function editarperfil($usuario){
        if(Auth::user()){
            if (request('name')) {

                if(Validator::make($data, [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'password' => ['required', 'string', 'min:8', 'confirmed']
                ]));

                User::find(Auth::id())->update([
                    'name' => request('name'),
                    'password' => Hash::make(request('password'))
                ]);
                return back()->with('status','Se ha enviado formulario');
            }
            else{
                $usuario = User::find(Auth::id());
                return view('editarperfil',compact('usuario'));
            }
        }else{
            return view('home');
        }
    }

    public function subircarrito($prod){
        $texto = request('cantidad');
        if(Auth::user()){
            $usuario = User::find(Auth::id());
            $carritonuevo = new Carrito;
            $carritonuevo ->id_user = $usuario->id;
            $carritonuevo ->id_prod = $prod;
            $carritonuevo ->cantidad = $texto;
            $carritonuevo ->estado = 'carrito';
            $carritonuevo -> save();
            return back();
        }else{
            return view('auth.login')->with('status','Es necesario identificarse');
        } 
    }

    public function carrito(){
        $usuario = User::find(Auth::id());
        $usuarios = $usuario->id;
        $cat = Carrito::where('id_user','=', $usuarios)->where('estado','=', 'carrito')->get();
        $ant = Carrito::where('id_user','=', $usuarios)->where('estado','!=', 'carrito')->get();
        return view('carrito', compact('cat', 'ant'));
    }
    static function devolverNombreProducto($id){
        return Producto::find($id)->nombre;
    }

    static function devolverNombrecliente($id){
        return User::find($id)->name;
    }

    static function devolverprecio($id){
        return Producto::find($id)->precio;
    }

    public function eliminarproductocarrito($id){
        $categoria2 = Carrito::find($id);
        $categoria2->delete();
        return back();
    }
    public function comprarproducto($id){
        $carrito = carrito::find($id);
        $prod = Producto::find($carrito->id_prod);
        if ($prod->stock>=$carrito->cantidad) {
            $carrito->update([
                'estado' => 'pendiente'
            ]);
            $prod->update([
                'stock' => $prod->stock - $carrito->cantidad
            ]);
            return back()->with('status','la compra se ha realizado');
        }else{
            return back()->with('status','no hay stock suficiente');
        }
        
        return back();
    }
    public function ventas(){
        $todos = Carrito::where('estado','!=', 'carrito')->get();
        return view('ventas', compact('todos'));
    }
    public function actestado($id){
        Carrito::find($id)->update([
            'estado' => 'Enviado'
        ]);
        return back();
    }
    public function sumarprod($id){
        $carrito = carrito::find($id);
        $carrito->update([
            'cantidad' => $carrito->cantidad++
        ]);
        return back()->with('status','se ha modificado correctamente');
    }
    public function restprod($id){
        $carrito = carrito::find($id);
        $carrito->update([
            'cantidad' => $carrito->cantidad--
        ]);
        return back()->with('status','se ha modificado correctamente');
    }
    
}
