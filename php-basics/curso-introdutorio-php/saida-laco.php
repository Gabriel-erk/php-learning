<?php

for ($contador = 0; $contador <= 15; $contador++) {
    if ($contador == 13) {
        // quando contador for 13 o comando break vai sair do laço de repetição e executar o que estiver sm seguida, como não temos nada, a execução se encerrará depois do break
        break;
    }
    echo "#$contador" . PHP_EOL;
}