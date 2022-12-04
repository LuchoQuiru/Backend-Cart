<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class OfertaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['fecha_inicio' => date("2022-9-20"),
            'fecha_fin' => date("2022-9-28"),
            'descuento' => 30,
            'id_producto' => '1'],

            ['fecha_inicio' => date("2022-4-20"),
            'fecha_fin' => date("2022-9-28"),
            'descuento' => 20,
            'id_producto' => '2'],

            ['fecha_inicio' => date("2022-4-20"),
            'fecha_fin' => date("2022-9-28"),
            'descuento' => 10,
            'id_producto' => '3'], 
            ['fecha_inicio' => date("2022-4-20"),
            'fecha_fin' => date("2022-9-28"),
            'descuento' => 10,
            'id_producto' => '4'],
        ];

        DB::table('ofertas')->insert($data);
    }
}
