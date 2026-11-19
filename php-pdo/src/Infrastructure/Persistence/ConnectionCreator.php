<?php

namespace Alura\Pdo\Infrastructure\Persistence;

use PDO;

class ConnectionCreator
{
    // como podemos ver, esta classe não possui nada além deste método, e este método, apenas é executado e nos retorna uma informação, não precisamos passar parâmetros a ele nem nada que exigiria uma instância da nossa classe 'ConnectionCreator', logo, deixaremos o método estático, para que tenhamos acesso a ele, de fora da classe, sem a necessidade de fazer com que tenhamos um objeto do tipo 'ConnectionCreator'
    public static function createConnection(): PDO
    {
        // fizemos o uso de '/../' algumas vezes pois, esse é o caminho até o nosso arquivo do banco de dados A PARTIR da onde estamos criando este método em: pastaRaiz/src/Infrastructure/Persistence, então, com essas barras e pontos finais, fazemos com que cheguemos até a pasta raiz e encontremos nosso arquivo de banco de dados
        $databasePath = __DIR__ . '/../../../banco.sqlite';
        // retornando a instância de um objeto do tipo PDO (onde o parâmetro que estamos passando é o driver do banco de dados que vamos utilizar, com sqlite: e concatenando com as informações do db que aquele driver (sqlite) pede, no nosso caso, é apenas o caminho para o arquivo com a extensão sqlite)
        // return new PDO('sqlite:' . $databasePath);
        $connection = new PDO('sqlite:' . $databasePath);
        // uma coisa interessante a se fazer, é ao invés de retornar um 'true/false' quando a execução de algum método relacionado a minha conexão sql (meu objeto do tipo pdo) seria retornar uma exceção (pois assim estariamos seguindo as boas práticas de desenvolvimento e entendendo melhor como que o erro está acontecendo)
        // tendo isso em mente, o que podemos fazer é SETAR um atributo no nosso objeto do tipo PDO que faz com que TODA vez que uma operação no banco não der certo, seja retornada uma exceção, para fazer isso, podemos criar um objeto do tipo PDO (como na linha acima) e setar este atributo na nossa conexão com o banco com o método abaixo: setAttribute, onde o primeiro parâmetro é que tipo de atributo estamos configurando, o segundo, qual VALOR este atributo terá, que dizermos que é: seguinte pdo, toda vez que eu tive rum erro no banco, me retorne uma exceção == PDO::ERRMODE_EXCEPTION (uma obs interessante é que o tipo de Exception que será retornado é: PDOException, como a doc nos informa)
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // definindo mais um atributo para nossa conexão com banco de dados, dessa vez, o atributo que nos permite alterar qual vai ser o comportamento padrão de métodos fetch/fetchAll (que sempre é especificar que queremos o formato de array associativo PDO::FETCH_ASSOC)
        // o atributo que queremos alterar é o PDO::ATTR_DEFAULT_FETCH_MODE e o valor dele é PDO::FETCH_ASSOC (pois queremos que TODA vez que usarmos o método FETCH/FETCH ALL os dados já venham formato de array associativo por PADRÃO
        $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $connection;
    }
}
