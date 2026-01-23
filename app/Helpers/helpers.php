<?php

if(!function_exists('showServerError')){
    function showServerError()
    {
        if(session()->has('server_error')){
            return '<div class="text-sm italic text-red-500">' . session()->get('server_error') . '</div>';
        } else {
            return '';
        }
    }
}
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
