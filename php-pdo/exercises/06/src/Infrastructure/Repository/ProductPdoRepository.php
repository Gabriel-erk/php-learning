<?php

namespace Pratica06Pdo\Infrastructure\Repository;
use Pratica06Pdo\Infrastructure\Persistence\ConnectionCreator;
use PDO;

class ProductPdoRepository
{
    public function __construct(private PDO $pdo)
    {
        $this->pdo = ConnectionCreator::CreateConnection();
    }
}