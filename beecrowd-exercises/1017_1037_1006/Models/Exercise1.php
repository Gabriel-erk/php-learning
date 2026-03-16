<?php 

class Exercise1 
{
    public function solucao(int $tempoGastoViagem, int $velocidadeMediaKm): float {
        $distanciaPercorrida = $tempoGastoViagem * $velocidadeMediaKm;
        // quantos km o carro percorre por litro (como o exericio nos entregou)
        $kmPorLitro = 12;
        return $distanciaPercorrida / $kmPorLitro;
    }
}

