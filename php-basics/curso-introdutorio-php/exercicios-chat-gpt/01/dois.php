<?php

// função que recebe array associativo com nomes de pessoas e suas idades, retorna APENAS o nome das pessoas COM 18 ou MAIS

function eh_maior (array $nomes_e_idades) : array 
{
    $contador = 0;
    foreach ($nomes_e_idades as $nome_e_idade) {
        if ($nome_e_idade['Idade'] >= 18) {
            $contador ++;
            // passando para cada posição do array apenas o nome, não "a posição completa do array com a chave, nome, e idade" apenas o nome do maior de idade para a váriavel, então ao acessa-la, conterá apenas uma string normal, contendo apenas o nome do maior de idade
            $nomes_maiores_de_idade[$contador] = $nome_e_idade['Nome'];
        }
    }
    return $nomes_maiores_de_idade;
}

$pessoas = [
    0 => [
        'Nome' => 'Gabriel',
        'Idade' => 18
    ],
    1 => [
        'Nome' => 'Joana',
        'Idade' => 32
    ],
    2 => [
        'Nome' => 'Fabiola',
        'Idade' => 16
    ],
    3 => [
        'Nome' => 'Mercedez',
        'Idade' => 12
    ],
    4 => [
        'Nome' => 'Pierre',
        'Idade' => 98
    ],
];


$armazena_maiores_de_idade = eh_maior($pessoas);
foreach ($armazena_maiores_de_idade as $maior_de_idade) {
    // acessando váriavel da forma correta, antes estava tomando o erro Fatal error: Uncaught TypeError: Cannot access offset of type string on string pois estava tentando acessar uma chave que não existe nessa váriavel ($maior_de_idade['nome']) porém essa váriavel apenas possui o nome do maior de idade
    echo "$maior_de_idade é maior de idade." . PHP_EOL;
}