<?php 

$horarioDia = $argv[1];

if ($horarioDia >= 6 and $horarioDia <= 12) {
    echo "Bom dia!" . PHP_EOL;
} else if ($horarioDia >= 13 and $horarioDia <= 18) {
    echo "Boa tarde!" . PHP_EOL;
} else {
    echo "Boa noite!" . PHP_EOL;
}