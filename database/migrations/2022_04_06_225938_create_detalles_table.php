<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles', function (Blueprint $table) {
            $table->id();

            $table->bigInteger("id_pedido");
            $table->bigInteger("id_producto");
            
            $table->foreign("id_pedido")->references("id")->on("pedidos")->onDelete("cascade");
            $table->foreign("id_producto")->references("id")->on("productos")->onDelete("cascade");
            

            $table->integer("cantidad");
            $table->integer("total");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalles');
    }
};
