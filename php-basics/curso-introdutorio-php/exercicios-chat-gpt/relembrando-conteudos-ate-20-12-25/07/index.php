<?php 
    require_once 'pessoas.php';

    foreach($pessoas as $pessoa){
        echo "Nome: $pessoa[nome] - Idade: $pessoa[idade] anos" . PHP_EOL;
    }
