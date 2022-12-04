<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;



class DetallesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id_pedido' => '1',
            'id_producto' => '1',
            'cantidad' => 5,
            'total' => 100],

            ['id_pedido' => '2',
            'id_producto' => '2',
            'cantidad' => 5,
            'total' => 300],

            ['id_pedido' => '2',
            'id_producto' => '1',
            'cantidad' => 3,
            'total' => 80]
        ];

        DB::table('detalles')->insert($data);
    }
}
