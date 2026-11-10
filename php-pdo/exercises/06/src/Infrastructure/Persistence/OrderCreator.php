<?php

namespace Pratica06Pdo\Infrastructure\Persistence;
use Pratica06Pdo\Domain\Model\Order;

class OrderCreator
{
    public static function CreateMultipleOrders(array $ordersData): array
    {
        $orders = [];
        foreach ($ordersData as $orderData) {
            $orders[] = self::CreateOrder($orderData);
        }
        return $orders;
    }

    public static function CreateOrder(array $orderData): Order
    {
        return new Order(
            $orderData['id'],
            $orderData['customer_id'],
            $orderData['total'],
            $orderData['created_at']
        );
    }
}