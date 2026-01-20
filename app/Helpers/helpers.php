<?php

function formatCpf($cpf)
{
    return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $cpf);
}

function formatPhone($phone)
{
    return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $phone);
}

if (! function_exists('userStatus')) {
    function userStatus($status)
    {
        return $status == 1 ? 'Ativo' : 'Inativo';
    }
}
