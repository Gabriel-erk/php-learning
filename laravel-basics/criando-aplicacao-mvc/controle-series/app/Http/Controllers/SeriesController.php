<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// todo controller que criamos é um "Controller" ou seja, eles extedem da classe "Controller", são classes filhas do mesmo e tem acesso a tudo o que ele tem (métodos, atributos, constantes....) - "Controller" é uma super classe
class SeriesController extends Controller
{
    public function index(): void
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

        echo $html;
    }
}
