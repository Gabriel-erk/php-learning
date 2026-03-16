<?php 

$alimentos = ["arroz", "feijão", "batata", "carne", "frango"];

// outro jeito de fazer, porem menos usado, onde passo a chave para outra variavel e o valor para outra variavel, com o inuito de evitar de fazer $alimentos[index]
// foreach ($alimentos as $key => $value) {
//     echo $key . $value . PHP_EOL;
// }

foreach ($alimentos as $alimento) {
    echo $alimento . PHP_EOL;
}


?>