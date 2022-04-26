<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    protected $fillable = ['estado'];
    public function categoria(){
        return $this->belongsTo('app\Categoria');
    }

    public function producto(){
        return $this->belongsTo('app\Producto');
    }
}
