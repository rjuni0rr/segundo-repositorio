<?php

namespace App\Observers;

use App\Models\User;
use App\Services\TelegramService;

class UserObserver
{
    /**
     * Quando um usuário for criado
     */
    public function created(User $user): void
    {
        $mensagem = "
            🚀 <b>Novo usuário cadastrado!</b>

            👤 Nome: {$user->name}
            📧 Email: {$user->email}
            🕒 Data: {$user->created_at->format('d/m/Y H:i')}
                    ";

        TelegramService::enviar($mensagem);
    }


    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
