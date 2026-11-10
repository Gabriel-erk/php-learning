<?php

namespace Pratica06Pdo\Domain\Model;

use Exception;

class Product
{
    public function __construct(private ?int $id, private string $name, private float $price, private int $stock)
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
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function getStock(): int
    {
        return $this->stock;
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
            throw new Exception('ID do produto já foi definido.');
        }
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @param int $stock
     */
    public function setStock(int $stock): void
    {
        $this->stock = $stock;
    }

    public function show(): void
    {
        echo "Name: {$this->getName()} - Price: {$this->getPrice()}" . PHP_EOL;
        echo "Stock: {$this->getStock()}" . PHP_EOL;
    }
}