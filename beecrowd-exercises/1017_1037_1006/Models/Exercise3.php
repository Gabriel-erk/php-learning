<?php 

class Exercise3 
{
    public function solucao(array $notas): float {
        $pesoNotaA = 2;
        $pesoNotaB = 3;
        $pesoNotaC = 5;
        $somaPesos = $pesoNotaA + $pesoNotaB + $pesoNotaC;
        return (($notas[0] * $pesoNotaA) + ($notas[1] * $pesoNotaB) + ($notas[2] * $pesoNotaC)) / $somaPesos; 
    }
}
