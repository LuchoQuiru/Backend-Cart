<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class ProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
        [
            "nombre_producto" => "CocaCola",
            "id_categoria" => "1",
            "img" => null,
            "precio" => 250,
            "stock" => 50,
        ],
        [
            "nombre_producto" => "SevenUp",
            "id_categoria" => "1",
            "img" => null,
            "precio" => 210,
            "stock" => 60,
        ],
        [
            "nombre_producto" => "IPA x6 unidades lata",
            "id_categoria" => "4",
            "img" => null,
            "precio" => 950,
            "stock" => 30,
        ],
        [
            "nombre_producto" => "Lays",
            "id_categoria" => "3",
            "img" => null,
            "precio" => 180,
            "stock" => 60,
        ],
        [
            "nombre_producto" => "Patagonia VERA IPA",
            "id_categoria" => "4",
            "img" => null,
            "precio" => 230,
            "stock" => 90,
        ]
        ];

        DB::table('productos')->insert($data);
    }
}
