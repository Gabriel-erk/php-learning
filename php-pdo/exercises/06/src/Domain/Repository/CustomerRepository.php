<?php

namespace Pratica06Pdo\Domain\Repository;

use Pratica06Pdo\Domain\Model\Customer;

interface CustomerRepository
{
    public function findById(int $id): Customer;

    public function listAll(): array;
}