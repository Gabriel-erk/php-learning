<?php 
// PDO é a maneira que uitlizamos em php para conversar com o banco de dados, o php oferece diversos drivers para diferentes bancos de dados, e o que iremos utilizar aqui, é o driver para o sqlite
// arquivo com único intuito de realizar uma conexão com o banco de dados em sqlite

// nos conectando ao nosso arquivo de banco de dados (criado por nós e deixado de forma vazia, sem nada escrito nele de forma manual)
// criando nova instância de um PDO, classe que usamos para fazer conexão com o banco de dados
// a instância permite 3 parâmetros, onde o primeiro é a string de conexão, que informa qual banco de dados estamos usando, através de seu driver (aqui, o sqlite)
// logo após os : como estamos no sqlite, apenas informamos o caminho do nosso banco (que está em um arquivo, logo, passaremos o caminho do arquivo), mas caso fosse um mysql, informarios o número da porta, host...informações necessárias para conectarmos nossa aplicação com o banco
$pdo = new PDO('sqlite:banco.sqlite');

echo 'Conectei';