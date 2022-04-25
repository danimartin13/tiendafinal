<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = ['estado'];
    public function categoria(){
        return $this->belongsTo('app\Categoria');
    }
}
