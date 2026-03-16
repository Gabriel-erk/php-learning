<?php
require_once __DIR__ . "/Models/Exercise1.php";
require_once __DIR__ . "/Models/Exercise2.php";
require_once __DIR__ . "/Models/Exercise3.php";

while (true) {
    echo "1 - Gasto de Combustível" . PHP_EOL;
    echo "2 - Intervalo" . PHP_EOL;
    echo "3 - Média 2" . PHP_EOL;
    echo "0 - Sair" . PHP_EOL;
    echo "Digite a opção:" . PHP_EOL;
    // utilizando função trim, pois usando apenas fgets, ele traz o valor digitado + um /n (no meu caso não será util, e o trim impede que isso aconteça)]
    // (int) vem antes apra converter o resultado da operação de trim + fgets para inteiro
    $opcao = trim(fgets(STDIN));

    if ($opcao == 1) {
        echo "=== Gasto de Combustível ===" . PHP_EOL;
        echo "Digite o tempo gasto na viagem:" . PHP_EOL;
        $tempoGastoViagem = (int) trim(fgets(STDIN));
        echo "Digite a velocidade média durante a viagem (em km): " . PHP_EOL;
        $velocidadeMediaKm = (int) trim(fgets(STDIN));

        $att1 = new Exercise1();
        $resultado = $att1->solucao($tempoGastoViagem, $velocidadeMediaKm);

        echo number_format($resultado, 3, ',', '.');
        echo "\n";
    } else if ($opcao == 2) {
        echo "=== Intervalo ===" . PHP_EOL;
        echo "Digite um número:" . PHP_EOL;
        $numero = (float) trim(fgets(STDIN));

        $att2 = new Exercise2();
        $resultado = $att2->solucao($numero);

        echo $resultado;
        echo "\n";
    } else if ($opcao == 3) {
        echo "=== Média 2 ===" . PHP_EOL;
        $notas = [];
        $cont = 1;
        while (count($notas) <= 2) {
            echo "Digite a nota {$cont}:" . PHP_EOL;
            $nota = trim(fgets(STDIN));
            if ($nota < 0 || $nota > 10.00) {
                echo "Digite uma nota válida (entre 0 e 10)" . PHP_EOL;
            } else {
                $notas[] = $nota;
                $cont++;
            }
        }

        $att3 = new Exercise3();
        $resultado = $att3->solucao($notas);

        echo "MEDIA = " . number_format($resultado, 1) . PHP_EOL;
    } else if ($opcao == 0) {
        echo "Obrigado por utilizar o sistema!" . PHP_EOL;
        break;
    } else {
        echo "Opção inválida, digite novamente." . PHP_EOL;
    }
}
