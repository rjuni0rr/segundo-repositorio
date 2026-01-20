<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'João Silva',
            'email' => 'joao@email.com',
            'phone' => '11912345678',
            'cpf' => '12345678901',
            'status' => true,
            'password' => Hash::make('123456'),
        ]);

        User::create([
            'name' => 'Maria Souza',
            'email' => 'maria@email.com',
            'phone' => '11987654321',
            'cpf' => '98765432100',
            'status' => false,
            'password' => Hash::make('123456'),
        ]);
    }
}
