<?php

namespace Pratica06Pdo\Domain\Model;

use Exception;

class OrderItem
{
    public function __construct(private ?int $id, private int $order_id, private int $product_id, private int $quantity, private float $unit_price)
    {
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getOrderId(): int
    {
        return $this->order_id;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->product_id;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @return float
     */
    public function getUnitPrice(): float
    {
        return $this->unit_price;
    }

    /**
     * @param int|null $id
     * @throws Exception
     */
    public function setId(?int $id): void
    {
        if ($this->id == null) {
            $this->id = $id;
        } else {
            throw new Exception('ID do item de pedido já foi definido.');
        }
    }

    /**
     * @param int $order_id
     */
    public function setOrderId(int $order_id): void
    {
        $this->order_id = $order_id;
    }

    /**
     * @param int $product_id
     */
    public function setProductId(int $product_id): void
    {
        $this->product_id = $product_id;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @param float $unit_price
     */
    public function setUnitPrice(float $unit_price): void
    {
        $this->unit_price = $unit_price;
    }

    public function show(): void
    {
        echo "Order ID: {$this->getOrderId()} - Product ID: {$this->getProductId()}" . PHP_EOL;
        echo "Quantity: {$this->getQuantity()} - Unit Price: {$this->getUnitPrice()}" . PHP_EOL;
    }
}