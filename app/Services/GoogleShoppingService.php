<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GoogleShoppingService
{
    public static function buscarProduto(string $termo): array
    {
        $apiKey = env("SERPAPI_KEY");

        $response = Http::get("https://serpapi.com/search.json", [
            "engine" => "google_shopping",
            "q" => $termo,
            "hl" => "pt",
            "gl" => "br",
            "api_key" => $apiKey,
        ]);

        if ($response->failed()) {
            dd("Erro SerpAPI:", $response->status(), $response->body());
        }

        return $response->json()["shopping_results"] ?? [];
    }
}
