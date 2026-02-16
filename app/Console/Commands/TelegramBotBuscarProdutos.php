<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Services\TelegramService;
use App\Services\GoogleShoppingService;

class TelegramBotBuscarProdutos extends Command
{
    // nome do comando no terminal
    protected $signature = 'telegram:buscar';

    // descrição
    protected $description = 'Bot Telegram que busca o produto mais barato no Google Shopping (SerpAPI)';

    public function handle()
    {
        $this->info("🤖 Bot Telegram iniciado...");

        $token = config("services.telegram.bot_token");
        $offset = 0;

        while (true)
        {
            // buscar novas mensagens
            $response = Http::get("https://api.telegram.org/bot{$token}/getUpdates", [
                "offset" => $offset,
                "timeout" => 10
            ]);

            $updates = $response->json()["result"] ?? [];

            foreach ($updates as $update)
            {
                $offset = $update["update_id"] + 1;

                $message = $update["message"] ?? null;
                if (!$message) continue;

                $chatId = $message["chat"]["id"];
                $text = $message["text"] ?? "";

                $this->info("Mensagem recebida: {$text}");

                // Comando /buscar
                if (str_starts_with($text, "/buscar"))
                {
                    $termo = trim(str_replace("/buscar", "", $text));

                    if (!$termo) {
                        TelegramService::enviar("❌ Use assim:\n/buscar iphone 15");
                        continue;
                    }

                    TelegramService::enviar("🔎 Buscando o melhor preço para: <b>$termo</b> ...");

                    // Buscar produtos no Google Shopping
                    $produtos = GoogleShoppingService::buscarProduto($termo);

                    if (empty($produtos)) {
                        TelegramService::enviar("Nenhum produto encontrado 😢");
                        continue;
                    }

                    $lojasFiltro = [
                        "Amazon", "Magazine Luiza", "Magalu", "Mercado Livre", "Americanas", "Casas Bahia",
                        "Shopee", "KaBuM", "AliExpress", "Submarino", "Ponto", "Extra", "Carrefour", "Fast Shop"
                    ];

                    $palavrasBloqueadas = [
                        // 🎮 Jogos e mídia
                        "jogo", "game", "games", "mídia", "midia", "cd", "dvd", "blu-ray", "bluray",
                        "digital", "download", "key", "código", "codigo", "gift card", "cartão presente",
                        // 🎮 Consoles e acessórios
                        "controle", "joystick", "dualshock", "dualsense", "gamepad",
                        "cabo", "usb", "carregador", "fonte", "adaptador", "extensão", "extensao",
                        "dock", "base", "suporte", "stand", "case", "capa", "proteção", "protecao",
                        // 🎧 Áudio e comunicação
                        "headset", "fone", "fone de ouvido", "microfone", "speaker", "caixa de som",
                        "bluetooth", "wireless", "som",
                        // 📦 Armazenamento e peças
                        "hd", "ssd", "memória", "memoria", "cartão", "cartao", "storage",
                        "pendrive", "flash drive", "expansão", "expansao",
                        // 🛠 Peças e reparos
                        "peça", "peca", "reposição", "reposicao", "assistência", "assistencia",
                        "conserto", "reparo", "manutenção", "manutencao", "técnico", "tecnico",
                        // 🖥 Componentes eletrônicos
                        "placa", "motherboard", "processador", "cpu", "gpu", "placa de vídeo",
                        "cooler", "fan", "memória ram", "ram",
                        // 🎒 Skins e decoração
                        "skin", "adesivo", "película", "pelicula", "decoração", "decoracao",
                        "custom", "customizado", "personalizado",
                        // 📺 Imagem e monitores
                        "monitor", "tv", "tela", "display", "projetor", "hdmi",
                        // 🕹 Jogos específicos populares
                        "fifa", "pes", "call of duty", "cod", "fortnite", "gta", "minecraft",
                        "elden ring", "spiderman", "mario", "zelda",
                        // 🧾 Serviços e assinaturas
                        "assinatura", "subscription", "ps plus", "game pass", "online",
                        "serviço", "servico", "licença", "licenca",
                        // 📚 Guias e conteúdo
                        "manual", "guia", "tutorial", "curso", "ebook", "livro",
                        // 🏷 Usados e condições ruins
                        "usado", "seminovo", "recondicionado", "defeito", "quebrado",
                        "para peças", "para pecas",
                        // 🎁 Kits e bundles confusos
                        "kit", "combo", "bundle", "pacote", "acessórios", "acessorios",
                        // 🔋 Energia e baterias
                        "bateria", "pilha", "power bank", "energia",
                        // 🚚 Frete e logística
                        "frete", "envio", "importado", "internacional",
                        // 🛒 Termos genéricos que poluem
                        "promoção", "promocao", "oferta", "desconto", "barato",
                        "original", "genérico", "generico"
                    ];

                    // Filtrar apenas produtos com preço
                    $produtosFiltrados = array_filter($produtos, function ($p) use ($palavrasBloqueadas, $lojasFiltro) {

                        if (!isset($p["price"])) return false;
                        if (!isset($p["source"])) return false;

                        $titulo = strtolower($p["title"]);
                        $loja = trim($p["source"]);

                        // Bloqueia acessórios/jogos
                        foreach ($palavrasBloqueadas as $bloqueada) {
                            if (str_contains($titulo, $bloqueada)) return false;
                        }

                        // Permitir somente lojas principais
                        if (!in_array($loja, $lojasFiltro)) return false;

                        return true;
                    });

                    if (empty($produtosFiltrados)) {
                        TelegramService::enviar("Nenhum produto com preço disponível 😢");
                        continue;
                    }

                    // Ordenar do menor para o maior preço
                    usort($produtosFiltrados, function ($a, $b) {
                        return $this->limparPreco($a["price"]) <=> $this->limparPreco($b["price"]);
                    });

                    // Pegamos o produto mais barato
                    $melhor = $produtosFiltrados[0];

                    $titulo = $melhor["title"] ?? "Produto";
                    $preco = $melhor["price"] ?? "Sem preço";
                    $loja = $melhor["source"] ?? "Loja";
                    $link = $melhor["product_link"] ?? $melhor["serpapi_product_api"] ?? "#";

                    // Mensagem final
                    $mensagem = "🥇 <b>Melhor oferta encontrada:</b>\n\n" .
                        "📌 <b>$titulo</b>\n" .
                        "🏪 Loja: $loja\n" .
                        "💰 Preço: $preco\n";

                    // envia com botão in-line
                    TelegramService::enviarInlineButton(
                        $mensagem,
                        "🛒 Comprar agora",
                        $link
                    );
                }
            }

            // evita flood
            sleep(2);
        }
    }

    // converter preço
    private function limparPreco(string $precoTexto): float
    {
        $precoTexto = str_replace(["R$", ".", " "], "", $precoTexto);
        $precoTexto = str_replace(",", ".", $precoTexto);
        return floatval($precoTexto);
    }
}
