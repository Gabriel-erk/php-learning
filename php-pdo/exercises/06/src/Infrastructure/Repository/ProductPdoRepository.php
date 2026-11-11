<?php

namespace Pratica06Pdo\Infrastructure\Repository;

use Pratica06Pdo\Domain\Model\Product;
use Pratica06Pdo\Domain\Repository\ProductRepository;
use Pratica06Pdo\Infrastructure\Persistence\ConnectionCreator;
use Pratica06Pdo\Infrastructure\Persistence\ProductCreator;
use Exception;
use PDO;

class ProductPdoRepository implements ProductRepository
{
    public function __construct(private PDO $pdo)
    {
        $this->pdo = ConnectionCreator::CreateConnection();
    }

    public function findById(int $id): Product
    {
        $sql = 'SELECT * FROM products WHERE id = ?';
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(1, $id);

        $productData = $stmt->fetch(PDO::FETCH_ASSOC);
        return ProductCreator::CreateProduct($productData);
    }

    public function listAll(): array
    {
        $sql = 'SELECT * FROM products';
        $stmt = $this->pdo->query($sql);
        $productsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return ProductCreator::CreateMultipleProducts($productsData);
    }

    public function updateStock(Product $product): bool
    {
        // TODO: Implement updateStock() method.
    }

    /**
     * @throws Exception
     */
    public function insert(Product $product): bool
    {
        if ($product->getId() !== null) {
            $sql = 'INSERT INTO products (name, price, stock) VALUES(:name, :price, :stock);';
            $stmt = $this->pdo->prepare($sql);

            $this->pdo->beginTransaction();
            $stmt->bindValue(':name', $product->getName());
            $stmt->bindValue(':price', $product->getPrice());
            $stmt->bindValue(':stock', $product->getStock());
            $stmt->execute();
            return $this->pdo->commit();
        } else {
            throw new Exception('Produto já está inserido no banco de dados.');
        }
    }
}