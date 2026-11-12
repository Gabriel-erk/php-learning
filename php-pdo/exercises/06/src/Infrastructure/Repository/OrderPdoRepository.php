<?php

namespace Pratica06Pdo\Infrastructure\Repository;

use Pratica06Pdo\Domain\Model\Order;
use Pratica06Pdo\Domain\Model\OrderItem;
use Pratica06Pdo\Domain\Repository\OrderRepository;
use Pratica06Pdo\Infrastructure\Persistence\ConnectionCreator;
use Pratica06Pdo\Infrastructure\Persistence\OrderCreator;
use Exception;
use PDOException;
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
     * @throws PDOException|Exception
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

    /**
     * @throws PDOException|Exception
     */
    public function insertItem(OrderItem $orderItem): bool
    {
        if ($this->saveItem($orderItem)) {
            $orderItem->setId($this->pdo->lastInsertId());
            return true;
        } else {
            return false;
        }
    }

    private function saveItem(OrderItem $orderItem): bool
    {
        if (is_null($orderItem->getId())) {
            $sql = 'INSERT INTO order_items (order_id, product_id, quantity, unit_price) VALUES (:orderId, :productId, :quantity, :unitPrice)';
            $stmt = $this->pdo->prepare($sql);

            $this->pdo->beginTransaction();

            $stmt->bindValue(':orderId', $orderItem->getOrderId(), PDO::PARAM_INT);
            $stmt->bindValue(':productId', $orderItem->getProductId(), PDO::PARAM_INT);
            $stmt->bindValue(':quantity', $orderItem->getQuantity(), PDO::PARAM_INT);
            $stmt->bindValue(':unitPrice', $orderItem->getUnitPrice());

            return $this->pdo->commit();
        } else {
            return false;
        }
    }
}