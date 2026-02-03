<?php
// mostrar erros do lado do usuário
if(!function_exists('showValidationError')){
    function showValidationError($fieldName, $validationErrors)
    {
        if($validationErrors->has($fieldName)){
            return '<div class="alert alert-danger" role="alert">' . $validationErrors->first($fieldName) . '</div>';
        } else {
            return '';
        }
    }
}


// mostrar erros do lado do servidor
if(!function_exists('showServerError')){
    function showServerError()
    {
        if(session()->has('server_error')){
            return '<div class="alert alert-danger" role="alert">' . session()->get('server_error') . '</div>';
        } else {
            return '';
        }
    }
}

// Formatar CPF
function formatCpf($cpf)
{
    return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $cpf);
}

// Formatar telefone
function formatPhone($phone)
{
    return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $phone);
}

// Status do User
if (! function_exists('userStatus')) {
    function userStatus($status)
    {
        return $status == 1 ? 'Ativo' : 'Inativo';
    }
}

// Last login
if (! function_exists('formatLastLogin')) {
    function formatLastLogin($date): string
    {
        return $date
            ? $date->format('d/m/Y H:i')
            : 'Nunca acessou';
    }
}

// Helper do role
if (! function_exists('roleLabel')) {
    function roleLabel(string $role): string
    {
        return match ($role) {
            'sys-admin'     => 'Administrador',
            'client-admin'  => 'Gerente',
            'client-user'   => 'Funcionário',
            'guest'         => 'Visitante',
            default         => 'Indefinido',
        };
    }
}


//if (! function_exists('formatCpf')) {
//    function formatCpf(?string $cpf): string
//    {
//        if (! $cpf) {
//            return '-';
//        }
//
//        $cpf = preg_replace('/\D/', '', $cpf);
//
//        if (strlen($cpf) !== 11) {
//            return '-';
//        }
//
//        return preg_replace(
//            '/(\d{3})(\d{3})(\d{3})(\d{2})/',
//            '$1.$2.$3-$4',
//            $cpf
//        );
//    }
//}
