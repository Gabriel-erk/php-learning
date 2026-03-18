<?php

namespace App\Http\Controllers;
// classe "Request" é uma classe do Laravel que representa uma requisição HTTP feita pelo cliente, ela encapsula todas as informações relacionadas a essa requisição, como os dados enviados, os parâmetros da URL, os cabeçalhos, entre outros. Ela é usada para acessar e manipular os dados da requisição de forma fácil e organizada dentro dos controladores do Laravel.
// classe já é importada automaticamente ao gerarmos um controller via linha de comando (terminal), pois o controller em si (como descrito no Notion) recebe uma requisição (Request) e retorna uma resposta (Response), então sempre que falamos de Http no geral, esse é o comportamento esperado de um controller (tanto que os controllers (ou controladores em portugues) no laravel ficam dentro da pasta Http, para ilustrar isso melhor)
use Illuminate\Http\Request;

// todo controller que criamos é um "Controller" ou seja, eles extedem da classe "Controller", são classes filhas do mesmo e tem acesso a tudo o que ele tem (métodos, atributos, constantes....) - "Controller" é uma super classe
class SeriesController extends Controller
{
    // logo, como descrito acima, aqui estaremos recebdno uma requisição por parâmetro, que nos permite obter várias informações da requisição, como: URL, detalhes da queryString, input que viria de um formulário e etc, logo, também podemos retornar uma resposta (Response)
    public function index(Request $request): string
    {
        $series = [
            "Arcane",
            "Haikyuu",
            "You"
        ];
        $html = '<ul>';
        foreach ($series as $serie) {
            // $html .= "<li>$serie</li>" onde o operador de atribuição ".=" é em PHP uma atribuidor de atribuição de concatenação, ou seja, ele concatena o valor a direita ao final do valor a esquerda, ou seja, concatena "<li>$serie</li>" (valor a direita) com o final do valor a esquerda ($html), utilizada para juntar textos, construir strings longas ou adicionar textos ou elementos HTML 
            $html .= "<li>$serie</li>";
        }
        $html .= '</ul>';

        return $html;
    }
}
