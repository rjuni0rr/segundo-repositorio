<?php

namespace App\Http\Controllers\RolesController;

use App\Http\Controllers\Controller;
use App\Services\GoogleShoppingService;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
        return view('guest.home');
    }

    public function buscar()
    {
        return view("guest.buscar");
    }

    public function buscarSubmit(Request $request)
    {
        $request->validate([
            "produto" => "required|string|min:2"
        ]);

        $termo = $request->produto;

        $produtos = GoogleShoppingService::buscarProduto("comprar $termo");

        if (empty($produtos)) {
            return back()->with("erro", "Nenhum produto encontrado 😢");
        }

        // Lojas confiáveis
        $lojasPermitidas = [
            "Amazon", "Magazine Luiza", "Magalu",
            "Mercado Livre", "Americanas",
            "Casas Bahia", "Shopee", "KaBuM"
        ];

        // Filtrar
        $filtrados = array_filter($produtos, function ($p) use ($lojasPermitidas) {

            if (!isset($p["price"], $p["source"])) return false;

            return in_array(trim($p["source"]), $lojasPermitidas);
        });

        if (empty($filtrados)) {
            return back()->with("erro", "Nenhum produto confiável encontrado 😢");
        }

        // Ordenar menor preço
        usort($filtrados, function ($a, $b) {
            return $this->limparPreco($a["price"]) <=> $this->limparPreco($b["price"]);
        });

        $melhor = $filtrados[0];
        $top10  = array_slice($filtrados, 0, 10);

        return view("guest.produtos.resultado", compact("melhor", "top10", "termo"));
    }


    private function limparPreco(string $precoTexto): float
    {
        $precoTexto = str_replace(["R$", ".", " "], "", $precoTexto);
        $precoTexto = str_replace(",", ".", $precoTexto);

        return floatval($precoTexto);
    }

}
