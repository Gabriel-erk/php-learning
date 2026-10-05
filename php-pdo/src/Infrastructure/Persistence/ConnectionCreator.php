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
        return new PDO('sqlite:' . $databasePath);
    }
}
