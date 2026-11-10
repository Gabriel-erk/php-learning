<?php

namespace Pratica06Pdo\Domain\Model;

use {Exception, DateTimeImmutable};

class Order
{
    public function __construct(private ?int $id, private int $customer_id, private float $total, private DateTimeImmutable $createdAt)
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
    public function getCustomerId(): int
    {
        return $this->customer_id;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @return float
     */
    public function getTotal(): float
    {
        return $this->total;
    }

    /**
     * @param int|null $id
     * @throws Exception
     */
    public function setId(?int $id): void
    {
        if ($this->getId() == null) {
            $this->id = $id;
        } else {
            throw new Exception('ID do pedido já foi definido.');
        }
    }

    /**
     * @param int $customer_id
     */
    public function setCustomerId(int $customer_id): void
    {
        $this->customer_id = $customer_id;
    }

    /**
     * @param float $total
     */
    public function setTotal(float $total): void
    {
        $this->total = $total;
    }

    /**
     * @param DateTimeImmutable $createdAt
     */
    public function setCreatedAt(DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function show(): void
    {
        echo "Customer ID: {$this->getCustomerId()} - Total: {$this->getTotal()}" . PHP_EOL;
        echo "Created At: {$this->getCreatedAt()->format('Y-m-d')}" . PHP_EOL;
    }
}