<?php

namespace App\Http\Controllers;

class SeriesController
{
    public function listarSeries() {
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
