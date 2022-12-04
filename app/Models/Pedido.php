<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    protected $table = "pedidos";
    public $timestamps = false;

    public function usuario(){
        return $this->hasOne('App\Models\User','id','id_usuario');
    }

    public function detalles(){
        return $this->hasMany('App\Models\Detalle','id','id_detalle');
    }

    
}
