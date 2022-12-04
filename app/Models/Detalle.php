<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
    use HasFactory;
    protected $table = "detalles";
    public $timestamps = false;   

    public function pedido(){
        return $this->hasOne('App\Models\Pedido','id','id_pedido');
    }

    public function producto(){
        return $this->hasOne('App\Models\Producto','id','id_producto');
    }
}
