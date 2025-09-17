<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Producto::create([
            'producto' => 'Laptop Dell',
            'cantidad' => 10,
            'precio_base' => 850.00,
            'iva_porcentaje' => 15.00
        ]);

        \App\Models\Producto::create([
            'producto' => 'Mouse Logitech',
            'cantidad' => 25,
            'precio_base' => 25.50,
            'iva_porcentaje' => 15.00
        ]);

        \App\Models\Producto::create([
            'producto' => 'Teclado Mecánico',
            'cantidad' => 15,
            'precio_base' => 75.00,
            'iva_porcentaje' => 15.00
        ]);

        \App\Models\Producto::create([
            'producto' => 'Monitor Samsung 24"',
            'cantidad' => 8,
            'precio_base' => 320.00,
            'iva_porcentaje' => 15.00
        ]);

        \App\Models\Producto::create([
            'producto' => 'Impresora HP',
            'cantidad' => 5,
            'precio_base' => 180.00,
            'iva_porcentaje' => 15.00
        ]);
    }
}
