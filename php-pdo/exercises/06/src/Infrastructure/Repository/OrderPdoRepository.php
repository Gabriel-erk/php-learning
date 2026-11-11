<?php

namespace Pratica06Pdo\Infrastructure\Repository;

use Pratica06Pdo\Domain\Model\Order;
use Pratica06Pdo\Domain\Model\OrderItem;
use Pratica06Pdo\Domain\Repository\OrderRepository;
use Pratica06Pdo\Infrastructure\Persistence\ConnectionCreator;
use Pratica06Pdo\Infrastructure\Persistence\OrderCreator;
use Exception;
use PDO;

class OrderPdoRepository implements OrderRepository
{
    public function __construct(private PDO $pdo)
    {
        $this->pdo = ConnectionCreator::CreateConnection();
    }

    public function findById(int $id): Order
    {
        $sql = 'SELECT * FROM orders WHERE id = ?';
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(1, $id);

        $orderData = $stmt->fetch(PDO::FETCH_ASSOC);
        return OrderCreator::HydrateOrder($orderData);
    }

    public function listAll(): array
    {
        $sql = 'SELECT * FROM orders';
        $stmt = $this->pdo->query($sql);
        $ordersData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return OrderCreator::HydrateOrders($ordersData);
    }

    /**
     * TRATAR EXCEÇÃO QUE PODE SER GERADA AQUI NO ARQUIVO PRINCIPAL
     */
    public function insert(Order $order): bool
    {
        if ($this->save($order)) {
            $order->setId($this->pdo->lastInsertId());
            return true;
        }
        return false;

    }

    private function save(Order $order): bool
    {
        if ($order->getId() !== null) {
            $sql = 'INSERT INTO orders (customer_id, total, created_at) VALUES(:customerId, :total, :createdAt);';
            $stmt = $this->pdo->prepare($sql);

            $this->pdo->beginTransaction();
            $stmt->bindValue(':customerId', $order->getCustomerId(), PDO::PARAM_INT);
            $stmt->bindValue(':total', $order->getTotal());
            $stmt->bindValue(':createdAt', $order->getCreatedAt()->format('Y-m-d'));
            $stmt->execute();
            return $this->pdo->commit();
        } else {
            return false;
        }
    }

    public function insertItem(OrderItem $orderItem): bool
    {
        // TODO: Implement insertItem() method.
    }
}