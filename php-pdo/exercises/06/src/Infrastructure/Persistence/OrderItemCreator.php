<?php

namespace Pratica06Pdo\Infrastructure\Persistence;

use Pratica06Pdo\Domain\Model\OrderItem;

class OrderItemCreator
{
    public static function CreateMultipleOrderItems(array $orderItemsData): array
    {
        $orderItems = [];
        foreach ($orderItemsData as $orderItemData) {
            $orderItems[] = self::CreateOrderItem($orderItemData);
        }
        return $orderItems;
    }

    public static function CreateOrderItem(array $orderItemData): OrderItem
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