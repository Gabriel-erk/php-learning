<?php 
// PDO é a maneira que uitlizamos em php para conversar com o banco de dados, o php oferece diversos drivers para diferentes bancos de dados, e o que iremos utilizar aqui, é o driver para o sqlite
// arquivo com único intuito de realizar uma conexão com o banco de dados em sqlite

// nos conectando ao nosso arquivo de banco de dados (criado por nós e deixado de forma vazia, sem nada escrito nele de forma manual)
// criando instância de um PDO, classe que usamos para fazer conexão com o banco de dados
// a instância permite 3 parâmetros, onde o primeiro é a string de conexão, que informa qual banco de dados estamos usando, através de seu driver (aqui, o sqlite)
// logo após os : como estamos no sqlite, apenas informamos o caminho do nosso banco (que está em um arquivo, logo, passaremos o caminho do arquivo), mas caso fosse um mysql, informarios o número da porta, host...informações necessárias para conectarmos nossa aplicação com o banco
// PDO == PHP DATA OBJECTS (objetos de dado, em php), uma interface que permite acessar bancos de dados em php, cada sgbd (mysql, postgree, sqlite...) oferece uma forma específica de acessar aqueles bancos de dados, para isso, o pdo permite que usemos drives para conversarmos com cada sgbd
// $pdo = new PDO('sqlite:banco.sqlite');
// __DIR__ == diretório atual (pasta atual)
$absoluteDatabasePath = __DIR__ . '/banco.sqlite';
// utilizando caminho absoluto apenas para seguir as boas práticas descritas na documentação oficial do php sobre este processo
$pdo = new PDO('sqlite:' . $absoluteDatabasePath);
echo 'Conectei';

$pdo->exec("INSERT INTO phones (area_code, number, student_id) VALUES ('24', '999999999', 1), ('24', '989898989', 1)");
//exit();

$createTableSql = '
    CREATE TABLE IF NOT EXISTS students (
        id INTEGER PRIMARY KEY,
        name TEXT,
        birth_date TEXT  
    );

    CREATE TABLE IF NOT EXISTS phones (
      id INTEGER PRIMARY KEY,
      area_code TEXT,
      number TEXT,
      student_id INTEGER,
      FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE 
    );
';

$pdo->exec($createTableSql);