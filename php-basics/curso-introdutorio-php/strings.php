<?php

//concatentando textos

$idade = 25;
// com aspas simples é necessário dessa forma, pois com aspas simples ele entende que não precisa interpetar mais nada, é vai entender tudo como uma string
echo 'Olá mundo, minha idade é ' . $idade . ' anos \n';

// semprq que for utilizar um caracter especial usar dentro de aspas duplas
echo "\n";

echo "Utilizando da forma correta a quebra de linha \n";

// com aspas duplas não é necessário usar ponto para concatenar váriaveis nos textos
echo "Olá mundo, minha idade é $idade anos";
