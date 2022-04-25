<?php

namespace App\Http\Controllers;
use App\Producto;
use App\Categoria;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index(){
        if(request('buscar')){
            $texto = request('buscar');
            $productos = Producto::where('estado','!=','2')->whereRaw('lower(NOMBRE) like (?)',["%{$texto}%"])->get();
        }
        else $productos = Producto::where('estado','!=','2')->get();
        $categorias = Categoria::where('estado','!=','2')->get();
        
            return view('home', compact('productos','categorias'));
        }


    public function perfil(){
        if(Auth::user()){
            $usuario = User::find(Auth::id());
            return view('editarperfil',compact('usuario'));
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
}
