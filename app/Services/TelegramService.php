<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramService
{

    public static function enviar(string $mensagem): void
    {
        $token = config('services.telegram.bot_token');
        $chatId = config('services.telegram.chat_id');

        /** Abaixo está uma abordagem correta, preventiva e profissional para evitar ou tratar esse erro em produção. */
        try {
            $response = Http::timeout(5) # segundos
            ->retry(2, 1000) # 2 tentativas, 1s entre elas
            ->post("https://api.telegram.org/bot{$token}/sendMessage", [
                'chat_id' => $chatId,
                'text' => $mensagem,
                'parse_mode' => 'HTML'
            ]);

            if ($response->failed()) {
                Log::warning('Telegram API error', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
            }

        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('Telegram connection timeout', [
                'message' => $e->getMessage(),
            ]);
        }


//        Http::timeout(15) # segundos
//        ->retry(3, 1000) # 3 tentativas, 1s entre elas
//        ->post("https://api.telegram.org/bot{$token}/sendMessage", [
//            'chat_id' => $chatId,
//            'text' => $mensagem,
//            'parse_mode' => 'HTML'
//        ]);
    }

    // botão
    public static function enviarInlineButton(string $mensagem, string $botaoTexto, string $url): void
    {
        $token = config("services.telegram.bot_token");
        $chatId = config("services.telegram.chat_id");

        Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
            "chat_id" => $chatId,
            "text" => $mensagem,
            "parse_mode" => "HTML",

            // ✅ Inline button
            "reply_markup" => json_encode([
                "inline_keyboard" => [
                    [
                        [
                            "text" => $botaoTexto,
                            "url" => $url
                        ]
                    ]
                ]
            ])
        ]);
    }

    /** Abaixo está a versão completa e profissional para enviar alertas do sistema para vários chat_id ao mesmo tempo
     * percorre todos os chat IDs
     * envia a mesma mensagem para cada um
     * suporta grupos e canais
     * funciona até com 20, 50, 100 admins simultaneamente
     * */
    public static function envioMultiplos(string $mensagem): void
    {
        $token = config('services.telegram.bot_token');
        $chatIds = config('services.telegram.chat_ids');

        if (!is_array($chatIds)) return;

        foreach ($chatIds as $chatId) {
            Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
                'chat_id' => trim($chatId),
                'text' => $mensagem,
                'parse_mode' => 'HTML'
            ]);
        }
    }


    public static function enviarKeyboard(string $mensagem, array $botoes = []): void
    {
        $token = config('services.telegram.bot_token');
        $chatIds = config('services.telegram.chat_ids');

        foreach ($chatIds as $chatId) {
            $payload = [
                'chat_id' => trim($chatId),
                'text' => $mensagem,
                'parse_mode' => 'HTML'
            ];

            // Se houver botões, adicionar teclado
            if (!empty($botoes)) {
                $payload['reply_markup'] = json_encode([
                    'inline_keyboard' => $botoes
                ]);
            }

            Http::post("https://api.telegram.org/bot{$token}/sendMessage", $payload);
        }
    }


}
