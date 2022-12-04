<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{
    use HasFactory;
    protected $table = "ofertas";
    public $timestamps = false;

    public function producto(){
        return $this->hasOne('App\Models\Producto','id','id_producto');
    }
}
