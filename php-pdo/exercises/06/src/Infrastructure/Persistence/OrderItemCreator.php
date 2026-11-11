<?php

namespace Pratica06Pdo\Infrastructure\Persistence;

use Pratica06Pdo\Domain\Model\OrderItem;

class OrderItemCreator
{
    public static function HydrateOrderItems(array $orderItemsData): array
    {
        $orderItems = [];
        foreach ($orderItemsData as $orderItemData) {
            $orderItems[] = self::HydrateOrderItem($orderItemData);
        }
        return $orderItems;
    }

    public static function HydrateOrderItem(array $orderItemData): OrderItem
    {
        return new OrderItem(
            $orderItemData['id'],
            $orderItemData['order_id'],
            $orderItemData['product_id'],
            $orderItemData['quantity'],
            $orderItemData['unit_price']
        );
    }
}