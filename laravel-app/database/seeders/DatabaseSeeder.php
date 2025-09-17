<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Crear usuario administrador
        \App\Models\User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        // Ejecutar seeders de las tablas
        $this->call([
            ProductoSeeder::class,
            ClienteSeeder::class,
            FacturaSeeder::class,
        ]);
    }
}
