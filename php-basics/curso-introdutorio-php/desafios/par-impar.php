<?php

for ($contador=0; $contador <= 100; $contador++) { 
    if ($contador % 2 == 0) {
        echo "número: $contador é par." . PHP_EOL;
    } else {
        echo "número: $contador é ímpar." . PHP_EOL;
    }
}