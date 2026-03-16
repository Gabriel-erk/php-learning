<?php

/* 
* FUNÇÃO que irá receber um array com valores do tipo float (que serão as minhas notas) - vou pedir 4 para calcuar a média anual direto
* retorna se o aluno está aprovado (caso media >= 7)
* especificar retorno dos parâmetros (array) e da função (retornarei um tipo booleano, true se passou, false se não)
* verificar dentro da função se os valores passados são do tipo float, caso não seja, joga uma mensagem que os valores precisam ser float, se n me engano o valor inteiro vai ser convertido e passará, TALVEZ
*/

function calcula_media(array $notas): float
{
    $media = 0;
    $soma_notas = 0;
    foreach ($notas as $nota) {
        $soma_notas += $nota;
    }
    $media = $soma_notas / count($notas);

    return $media;
}

// array a ser preenchido pelo usuário
$notas_bimestrais = [];

for ($i = 0; $i < 4; $i++) {
    echo "Digite a nota do " . $i + 1 . " bimestre: ";
    /*
    * Observações sobre floatval
    * caso o usuário digite apenas caracteres, será convertido para 0.00
    * caso digite com caracteres e número no final, será convertido para 0
    * caso digite um número inteiro no começo, será pego este número e desconsiderar os caracteres
    * caso digite com vírgula ex: 7,12, ele ignorará a vírgula e arredondará para baixo (mesmo sendo 8,5 para cima)
    * caso tenha qualquer número (por ex: inteiro) vai converter para float (8 vai para 8.0)
    * string vazia convertida para 0.0
    * número float com espaço no começo pega apenas o número (ex: ' 9.8' == 9.8)
    */
    $notas_bimestrais[$i] = floatval(fgets(STDIN));
}

$media_calculada = calcula_media($notas_bimestrais);

if ($media_calculada >= 7.0 && $media_calculada <= 10.0) {
    echo "Você foi aprovado, Parabéns!" . PHP_EOL;
    echo $media_calculada;
} else {
    echo "Você foi reprovado ou não inseriu as notas corretamente (a nota máxima é 10.0 e a mínima 0.0)." . PHP_EOL;
}
