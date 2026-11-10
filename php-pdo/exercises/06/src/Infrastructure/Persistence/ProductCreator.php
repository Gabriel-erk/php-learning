<?php

namespace Pratica06Pdo\Infrastructure\Persistence;

use Pratica06Pdo\Domain\Model\Product;

class ProductCreator
{
    public static function CreateMultipleProducts(array $productsData): array
    {
        $products = [];
        foreach ($productsData as $productData) {
            // como este método estático chamao createProduct pertence a nossa classe atual, apenas usamos o self para acessa-lo
            $products[] = self::CreateProduct($productData);
        }
        return $products;
    }

    public static function CreateProduct(array $productData): Product
    {
        return new Product(
            $productData['id'],
            $productData['name'],
            $productData['price'],
            $productData['stock']
        );
    }

}