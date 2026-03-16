<?php

require_once "autoload.php";

use InventarioCasaAbandonada\Model\ItemEcontrado;

$objetosEncontrados = [];
while (true) {
    echo "=== Menu de opções === \n";
    echo "1 - Inserir objeto encontrado \n";
    echo "2 - Sair \n";
    // int vai converter o valor final para o tipo inteiro
    $opcao = (int) readline("Digite a opção desejada: ");
    echo PHP_EOL;
    
    if ($opcao == 1) {
        while (count($objetosEncontrados) < 3) {
            $nomeObjetoEncontrado = readline("Digite o nome do objeto encontrado: \n");
            $comodoObjetoEncontrado = readline("Digite o comôdo do objeto encontrado: \n");
            $nivelPerigoObjetoEncontrado = readline("Digite o nível de perigo do objeto encontrado: \n");

            // in array retorna true se o objeto estiver no array e false se não estiver, logo, coloco, se retornar false, com "!" é para entrar no if
            if (!in_array($nomeObjetoEncontrado, $objetosEncontrados)) {
                $objetoEncontrado = new ItemEcontrado($nomeObjetoEncontrado, $comodoObjetoEncontrado, $nivelPerigoObjetoEncontrado);
                $objetosEncontrados[$objetoEncontrado->nome] = [
                    "comodo" => $objetoEncontrado->comodo,
                    "perigo" => $objetoEncontrado->nivelPerigo
                ];
                echo "Objeto '$nomeObjetoEncontrado' adicionado ao inventário. \n";
                echo PHP_EOL;
            } else {
                echo "Objeto já está no inventário, não foi possível adicionar. \n";
            }
        }
        echo "Inventário preenhcido.";
        echo PHP_EOL;
    } else {
        if (count($objetosEncontrados) > 0) {
            echo "Objetos encontrados na casa: \n";
            $contadorObjetosPerigos = 0;

            foreach ($objetosEncontrados as $indice => $objetoEncontrado) {
                // $indice é de fato o índice dos objetosEncontrados, onde vai ter o: $nomeObjetoEncontrado
                echo "{$indice} - Encontrado(a) no {$objetoEncontrado['comodo']} - Perigo: {$objetoEncontrado['perigo']} \n";
                if ($objetoEncontrado['perigo'] == "alto") {
                    $contadorObjetosPerigos += 1;
                }
            }

            echo PHP_EOL;
            echo "Total de objetos perigosos: $contadorObjetosPerigos";

            break;
        }
    }
}
