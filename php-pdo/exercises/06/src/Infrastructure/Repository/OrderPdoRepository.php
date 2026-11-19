<?php

namespace Pratica06Pdo\Infrastructure\Repository;

use DateMalformedStringException;
use Pratica06Pdo\Domain\Model\Order;
use Pratica06Pdo\Domain\Model\OrderItem;
use Pratica06Pdo\Domain\Repository\OrderRepository;
use Pratica06Pdo\Infrastructure\Persistence\{ConnectionCreator, OrderCreator, OrderItemCreator};
use Exception;
use PDOException;
use PDO;

class OrderPdoRepository implements OrderRepository
{
    public function __construct(private PDO $pdo)
    {
        $this->pdo = ConnectionCreator::CreateConnection();
    }

    /**
     * @throws DateMalformedStringException
     */
    public function findById(int $id): Order|bool
    {
        $sql = 'SELECT * FROM orders WHERE id = ?';
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(1, $id);
        $stmt->execute();

        $orderData = $stmt->fetch();
        if ($orderData !== false) {
            return OrderCreator::HydrateOrder($orderData);
        }

        return false;
    }

    /**
     * @throws DateMalformedStringException
     */
    public function listAll(): array
    {
        $sql = 'SELECT * FROM orders';
        $stmt = $this->pdo->query($sql);
        $ordersData = $stmt->fetchAll();

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
        if (is_null($order->getId())) {
            $sql = 'INSERT INTO orders (customer_id, total, created_at) VALUES(:customerId, :total, :createdAt);';
            $stmt = $this->pdo->prepare($sql);

            $stmt->bindValue(':customerId', $order->getCustomerId(), PDO::PARAM_INT);
            $stmt->bindValue(':total', $order->getTotal());
            $stmt->bindValue(':createdAt', $order->getCreatedAt()->format('Y-m-d'));

            return $stmt->execute();
        } else {
            return false;
        }
    }

    public function update(Order $order): bool
    {
        $sql = 'UPDATE orders SET customerId = :customerId, total = :total, created_at = :createdAt WHERE id = :id';

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':customerId' => $order->getCustomerId(),
            ':total' => $order->getTotal(),
            ':createdAt' => $order->getCreatedAt(),
            ':id' => $order->getId()
        ]);
    }

    public function delete(Order $order): bool
    {
        $sql = 'DELETE FROM orders WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':id' => $order->getId()
        ]);
    }

    /**
     * @throws DateMalformedStringException
     */
    public function financialReport(): void
    {
        $orderItems = $this->listAllItems();
        $ordersQuantity = count($this->listAll());

        if ($ordersQuantity > 0) {
            $total = 0;
            $soldUnities = 0;
            foreach ($orderItems as $orderItem) {
                $total += $orderItem->getUnitPrice() * $orderItem->getQuantity();
                $soldUnities += $orderItem->getQuantity();
            }
            $average = $total / $ordersQuantity; // valor médio dos produtos

            echo '===== RELATÓRIO FINANCEIRO =====' . PHP_EOL;
            echo "QUANTIDADE DE PEDIDOS: {$ordersQuantity}" . PHP_EOL;
            echo "TOTAL: {$total}" . PHP_EOL;
            echo "MÉDIA DE VALOR DOS PRODUTOS: {$average}" . PHP_EOL;
            echo "UNIDADES VENDIDAS: {$soldUnities}" . PHP_EOL;
        } else {
            echo 'Nenhum pedido efetuado até o momento.' . PHP_EOL;
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

            $stmt->bindValue(':orderId', $orderItem->getOrderId(), PDO::PARAM_INT);
            $stmt->bindValue(':productId', $orderItem->getProductId(), PDO::PARAM_INT);
            $stmt->bindValue(':quantity', $orderItem->getQuantity(), PDO::PARAM_INT);
            $stmt->bindValue(':unitPrice', $orderItem->getUnitPrice());

            return $stmt->execute();
        } else {
            return false;
        }
    }

    private function listAllItems(): array
    {
        $sql = 'SELECT * FROM order_items';
        $stmt = $this->pdo->query($sql);
        $orderItemsData = $stmt->fetchAll();

        return OrderItemCreator::HydrateOrderItems($orderItemsData);
    }

    public function orderItems(Order $order): array
    {
        $allOrderItems = $this->listAllItems();
        $orderItems = [];
        foreach ($allOrderItems as $orderItem) {
            if ($orderItem->getOrderId() == $order->getId()) {
                $orderItems = $orderItem;
            }
        }
        return $orderItems;
    }
}