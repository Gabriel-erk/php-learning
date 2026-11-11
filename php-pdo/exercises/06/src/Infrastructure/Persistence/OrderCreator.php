<?php

namespace Pratica06Pdo\Infrastructure\Persistence;
use Pratica06Pdo\Domain\Model\Order;

class OrderCreator
{
    public static function HydrateOrders(array $ordersData): array
    {
        $orders = [];
        foreach ($ordersData as $orderData) {
            $orders[] = self::HydrateOrder($orderData);
        }
        return $orders;
    }

    public static function HydrateOrder(array $orderData): Order
    {
        return new Order(
            $orderData['id'],
            $orderData['customer_id'],
            $orderData['total'],
            $orderData['created_at']
        );
    }
}