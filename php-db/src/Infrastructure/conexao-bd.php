<?php
// host == onde está localizado este banco de dados, neste caso, está localizado em localhost
$host = 'localhost';
// porta que o banco se encontra
$port = '5432';
// nome deste banco de dados (informação presente em pgadmin4
$dbname = 'serenatto';
// usuário dono deste banco (configurado em pgadmin4 também
$user = 'postgres';
//senha do banco
$password = '28112006';

// pgsql == driver do banco postgreesql, após os ':' estou informando as informações que o pdo precisa para se conectar
// string recebeu este nome ($dsn) pois é o nome da string de conexão que um objeto do tipo PDO pede para nós
$dsn = "pgsql:host=$host;port=$port;dbname=$dbname";

try {
    // passando o mouse em cima de um objeto do tipo PDO, na sua instância, podemos ver o que ele precisa: string de conexão (dsn), usuário caso tenha ($user) e uma senha caso tenha ($password), e o último parâmetro que também podemos passar, chamado $options, diz que podemos informar os atributos que desejamos passar a nossa conexão com o banco de dados, aqui estamos setando o atributo de erro (PDO::ATTR_ERRMODE com o valor de PDO::ERRMODE_EXCEPTION) para ter o seguinte comportamento: PDO, sermpre que tiver um erro, qualquer problema, me lançe uma exceção, e o segundo PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, fazendo com que o comportamento padrão dos métodos FETCH (fetchAll e fetch) tragam os dados em formato de array associativo para nós sempre que usarmos eles
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
    var_dump($pdo);
} catch (PDOException $e) {
    echo $e->getMessage();
}