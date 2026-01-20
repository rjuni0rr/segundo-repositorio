<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return User::select(
            'name',
            'email',
            'cpf',
            'phone',
            'status',
            'created_at'
        )->get();
    }

    public function headings(): array
    {
        return [
            'Nome',
            'E-mail',
            'CPF',
            'Telefone',
            'Status',
            'Criado em',
        ];
    }

    public function map($user): array
    {
        return [
            $user->name,
            $user->email,
            $this->formatCpf($user->cpf),
            $this->formatPhone($user->phone),
            ucfirst($user->status),
            $user->created_at->format('d/m/Y'),
        ];
    }

    private function formatCpf($cpf)
    {
        return preg_replace(
            '/(\d{3})(\d{3})(\d{3})(\d{2})/',
            '$1.$2.$3-$4',
            $cpf
        );
    }

    private function formatPhone($phone)
    {
        return preg_replace(
            '/(\d{2})(\d{5})(\d{4})/',
            '($1) $2-$3',
            $phone
        );
    }
}
