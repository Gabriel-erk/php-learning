<?php

namespace Pratica06Pdo\Infrastructure\Persistence;

use Pratica06Pdo\Domain\Model\Product;

class ProductCreator
{
    public static function ProductCreator(array $productData): Product
    {
        return new Product(
            $productData['id'],
            $productData['name'],
            $productData['price'],
            $productData['stock']
        );
    }
}