<?php

for ($contador = 0; $contador <= 15; $contador++) {
    if ($contador == 13) {
        // quando contador for 13 o comando continue vai pular para a proxima iteração (quer vai ser quando o contador for 14, chegou no continue, sai do laço e entra dnv, sem verificar o restante do escopo do laço, diferente do break, que simplesmente sai do laço)
        continue;
    }
    echo "#$contador" . PHP_EOL;
}
