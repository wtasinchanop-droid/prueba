<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Cliente::create([
            'codigo' => 'CLI001',
            'nombre' => 'Juan Pérez',
            'numeroTelefono' => '555-0001'
        ]);

        \App\Models\Cliente::create([
            'codigo' => 'CLI002',
            'nombre' => 'María García',
            'numeroTelefono' => '555-0002'
        ]);

        \App\Models\Cliente::create([
            'codigo' => 'CLI003',
            'nombre' => 'Carlos López',
            'numeroTelefono' => '555-0003'
        ]);

        \App\Models\Cliente::create([
            'codigo' => 'CLI004',
            'nombre' => 'Ana Martínez',
            'numeroTelefono' => '555-0004'
        ]);

        \App\Models\Cliente::create([
            'codigo' => 'CLI005',
            'nombre' => 'Luis Rodríguez',
            'numeroTelefono' => '555-0005'
        ]);
    }
}
