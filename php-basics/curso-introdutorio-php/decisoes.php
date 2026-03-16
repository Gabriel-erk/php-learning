<?php

$idade = 17;

echo 'Você pode entrar a partir dos 18 anos.' . PHP_EOL;

if ($idade >= 18) {
    echo "Você tem $idade, pode entrar.";
} else {
    echo "Você só tem $idade, não pode entrar.";
}
