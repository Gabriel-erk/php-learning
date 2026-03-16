<?php

/**
 * aqui estou criando uma váriavel do tipo string, onde dentro de suas aspas está o número 10 e o comando de quebra de linha \n
 */
$numero_em_string = "10\n";
// a multiplicação é realizada com sucesso pois quando possui apenas valores númericos em uma string o php realiza a conversão automaticamente para valores números e consegue realizar operaçõa matemáticas, então o comando abaixo seri: $tabuada = 10 * 2; e ele não tem problemas com o \n pois ele não interpreta espaços em branco (barra n é isso, um espaço em branco) no ínicio e no fim da string ao interpretar números (era uma string, ao realizar operações foi convertido para número, então, ele ignora os espaços em brancos)
// vale lembrar que caso estivesse usando fgets para coletar um número inteiro, ele adicionaria o \n obrigatoriamente e ficaria o valor de tabuada em uma linha e "oi" em outra
$tabuada = $numero_em_string * 2;
echo "$tabuada oi";