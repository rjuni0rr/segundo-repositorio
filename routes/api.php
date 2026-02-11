<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Telegram\Bot\Facades\Telegram;

Route::post('/telegram/webhook', function (Request $request) {

    $update = Telegram::getWebhookUpdates();

    $chatId = $update->getMessage()->getChat()->getId();
    $text   = $update->getMessage()->getText();

    Telegram::sendMessage([
        'chat_id' => $chatId,
        'text' => "Você disse: $text"
    ]);

    return response("ok", 200);
});
