<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Producto extends Model
{
    use HasFactory;

    protected $table = "productos";
    public $timestamps = false;

    public function categoria(){
        return $this->hasOne('App\Models\Categoria','id','id_categoria');
    }
}
