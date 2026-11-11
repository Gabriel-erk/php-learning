<?php

namespace Pratica06Pdo\Domain\Repository;

use Pratica06Pdo\Domain\Model\Order;
use Pratica06Pdo\Domain\Model\OrderItem;

interface OrderRepository
{
    public function findById(int $id): Order;

    public function listAll(): array;

    public function insert(Order $order): bool;

    public function insertItem(OrderItem $orderItem): bool;
}