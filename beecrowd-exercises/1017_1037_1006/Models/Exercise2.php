<?php

class Exercise2
{
    public function  solucao(float $numero): string
    {
        if ($numero >= 0 && $numero <= 25.0000) {
            return "Intervalo [0,25]";
        } else if ($numero >= 25.00001 && $numero <= 50.0000000) {
            return "Intervalo (25,50]";
        } else if ($numero >= 50.00001 && $numero <= 75.0000000) {
            return "Intervalo (50,75]";
        } else if ($numero >= 75.00001 && $numero <= 100.0000000) {
            return "Intervalo (75,100]";
        } else {
            return "Fora de intervalo";
        }
    }
}
