<?php

function cria_array_associativo(array $nomes, array $idades):array
{
    if (count($nomes) != count($idades)) {
        echo "Erro: os arrays precisam ser do mesmo tamanho.";
        exit;
    } else {
        $array_associativo = [];
        $contador = 0;
        foreach ($nomes as $nome) {
            // definindo que meu array associativo vai ter a chave com o nome do usuário e vai receber o valor do campo idade (percorrendo o array de idades de certa forma também)
            $array_associativo[$nome]['idade'] = $idades[$contador];
            $contador++;
        }
        return $array_associativo;
    }
}

$array_associativo_nomes_idades = cria_array_associativo(['joao', 'pedro', 'henrique', 'benicio'], [10,20,30,40]);

foreach ($array_associativo_nomes_idades as $key => $value) {
    echo "Nome: $key" . PHP_EOL;
    echo "Idade: {$value['idade']}" . PHP_EOL;
}