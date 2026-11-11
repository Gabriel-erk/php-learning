<?php

namespace Pratica06Pdo\Domain\Repository;

use Pratica06Pdo\Domain\Model\Product;

interface ProductRepository
{
    public function findById(int $id): Product;

    public function listAll(): array;

    public function insert(Product $product): bool;

    public function updateStock(Product $product): bool;
}