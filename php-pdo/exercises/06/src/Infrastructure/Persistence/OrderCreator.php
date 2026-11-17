<?php

namespace Pratica06Pdo\Infrastructure\Persistence;
use DateMalformedStringException;
use Pratica06Pdo\Domain\Model\Order;

class OrderCreator
{
    /**
     * @throws DateMalformedStringException
     */
    public static function HydrateOrders(array $ordersData): array
    {
        $orders = [];
        foreach ($ordersData as $orderData) {
            $orders[] = self::HydrateOrder($orderData);
        }
        return $orders;
    }

    /**
     * @throws DateMalformedStringException
     */
    public static function HydrateOrder(array $orderData): Order
    {
        return new Order(
            $orderData['id'],
            $orderData['customer_id'],
            $orderData['total'],
            new \DateTimeImmutable($orderData['created_at'])
        );
    }
}