<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
Use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Administrador',
            'Gerente',
            'Funcionário',
            'Visitante',
        ];

        foreach ($categories as $name) {
            Category::create(['name' => $name]);
        }
    }
}
