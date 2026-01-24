<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::insert([
            [
                'name'        => 'Administrador',
                'email'       => 'admin@sistema.com',
                'status'      => 1,
                'phone'       => '11988887777',
                'password'    => Hash::make('Aa123456'),
                'birth_date'  => '1990-05-10',
                'cpf'         => '52998224725', // CPF válido
                'address'     => 'Rua Central, 100',
                'role' => 'sys-admin',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'Gerente',
                'email'       => 'gerente@sistema.com',
                'status'      => 1,
                'phone'       => '11977776666',
                'password'    => Hash::make('Aa123456'),
                'birth_date'  => '1988-03-22',
                'cpf'         => '16899535009', // CPF válido
                'address'     => 'Av. Paulista, 500',
                'role' => 'client-admin',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'Usuário Ativo',
                'email'       => 'usuario@sistema.com',
                'status'      => 1,
                'phone'       => '11966665555',
                'password'    => Hash::make('Aa123456'),
                'birth_date'  => '1995-11-01',
                'cpf'         => '98765432100', // CPF válido
                'address'     => 'Rua das Flores, 45',
                'role' => 'client-user',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'Usuário Inativo',
                'email'       => 'inativo@sistema.com',
                'status'      => 0,
                'phone'       => '11955554444',
                'password'    => Hash::make('Aa123456'),
                'birth_date'  => '1992-08-18',
                'cpf'         => '39053344705', // CPF válido
                'address'     => 'Rua Secundária, 12',
                'role' => 'guest',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }
}
