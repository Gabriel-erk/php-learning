<?php

namespace Pratica06Pdo\Infrastructure\Repository;
use PDO;
use Pratica06Pdo\Infrastructure\Persistence\ConnectionCreator;

class CustomerPdoRepository
{
    public function __construct(private PDO $pdo)
    {
        $this->pdo = ConnectionCreator::CreateConnection();
    }
}