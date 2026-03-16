<?php

/*
* função que receba um array associativo que contenha o nome de alunos, suas notas e retorne uma lista com o nome dos alunos que tiraram mais que 8
* percorrer array associativo na chave notas, se o aluno tirou mais que 8, guarda o nome em outro array (utilizar foreach)
* retornar array com os nomes 
*/

function verifica_aprovados(array $alunos):array
{
    $alunos_aprovados = [];
    $contador = 0;
    foreach ($alunos as $aluno) {
        if ($aluno['nota'] >= 8) {
            $alunos_aprovados[$contador] = $aluno['nome'];
            $contador++;
        }
    }

    return $alunos_aprovados;
}

$alunos = [
    0 => [
        "nome" => "Juninho",
        "nota" => 8.0,
    ],
    1 => [
        "nome" => "Noah",
        "nota" => 7.0,
    ],
    2 => [
        "nome" => "Nate",
        "nota" => 10.0,
    ],
    3 => [
        "nome" => "Kick",
        "nota" => 5.0,
    ],
    4 => [
        "nome" => "hetan",
        "nota" => 5.0,
    ],
    5 => [
        "nome" => "BronPAPaPaPa",
        "nota" => 8.0,
    ],
];

$alunos_aprovados = verifica_aprovados($alunos);

foreach ($alunos_aprovados as $aluno) {
    echo $aluno . PHP_EOL;
}