<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Factura::create([
            'id_producto' => 1,
            'codigo_cliente' => 'CLI001'
        ]);

        \App\Models\Factura::create([
            'id_producto' => 2,
            'codigo_cliente' => 'CLI002'
        ]);

        \App\Models\Factura::create([
            'id_producto' => 3,
            'codigo_cliente' => 'CLI003'
        ]);

        \App\Models\Factura::create([
            'id_producto' => 1,
            'codigo_cliente' => 'CLI004'
        ]);

        \App\Models\Factura::create([
            'id_producto' => 4,
            'codigo_cliente' => 'CLI005'
        ]);
    }
}
