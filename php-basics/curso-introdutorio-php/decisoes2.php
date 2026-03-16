<?php

$idade = 18;
$numero_pessoas = 2;

echo "Só pode entrar a partir de 18 anos ou ";
echo "com 16 anos porém acompanhado" . PHP_EOL;

if ($idade >= 18) {
    echo "Você tem $idade, pode entrar.";
} else if ($idade >= 16  and $numero_pessoas > 1){
    echo "Você tem $idade e está acompanhado de $numero_pessoas pode entrar";
} else {
    echo "Você tem $idade e não está acompanhado, não pode entrar.";
}

