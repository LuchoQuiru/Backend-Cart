<?php

namespace Database\Seeders;

use App\Models\Pedido;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PedidosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['total' => 14000,
            'id_usuario' => '1'],

            ['total' => 81000,
            'id_usuario' => '3'],

            ['total' => 5000,
            'id_usuario' => '4'],
        ];

        DB::table('pedidos')->insert($data);
    }
}
