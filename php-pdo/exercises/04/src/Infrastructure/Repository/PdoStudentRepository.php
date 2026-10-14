<?php

namespace Pratica04Pdo\Src\Infrastructure\Repository;

use Pratica04Pdo\Src\Domain\Repository\StudentRepository;
use PDO;

class PdoStudentRepository implements StudentRepository
{
    private PDO $connection;
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }
}
