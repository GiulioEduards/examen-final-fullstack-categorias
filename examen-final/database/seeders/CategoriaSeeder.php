<?php

namespace Database\Seeders;
use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
        ['name' => 'Entradas', 'description' => 'Aperitivos y entradas'],
        ['name' => 'Platos Principales', 'description' => 'Platos fuertes'],
        ['name' => 'Postres', 'description' => 'Deliciosos postres'],
        ['name' => 'Bebidas', 'description' => 'Refrescos y jugos'],
    ];

    foreach ($categories as $category) {
        Categoria::create($category);
    }
    }
}
