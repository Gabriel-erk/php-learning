<?php

namespace Pratica06Pdo\Infrastructure\Repository;

use Exception;
use Pratica06Pdo\Domain\Model\Product;
use Pratica06Pdo\Domain\Repository\ProductRepository;
use Pratica06Pdo\Infrastructure\Persistence\ConnectionCreator;
use Pratica06Pdo\Infrastructure\Persistence\ProductCreator;
use PDOException;
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

    /**
     * @throws PDOException|Exception
     */
    public function updateStock(Product $product): bool
    {
        if (is_null($product->getId())) {
            $this->insert($product);
            return false;
        } else {
            $sql = 'UPDATE products SET name = :name, price = :price, stock = :stock WHERE id = :id';
            $stmt = $this->pdo->prepare($sql);

            $this->pdo->beginTransaction();

            $stmt->bindValue(':name', $product->getName());
            $stmt->bindValue(':price', $product->getPrice());
            $stmt->bindValue(':stock', $product->getStock());
            $stmt->bindValue(':id', $product->getId());

            return $this->pdo->commit();
        }
    }

    /**
     * @throws PDOException|Exception
     */
    public function insert(Product $product): bool
    {
        if ($this->save($product)) {
            $product->setId($this->pdo->lastInsertId());
            return true;
        }
        return false;
    }


    private function save(Product $product): bool
    {
        if (is_null($product->getId())) {
            $sql = 'INSERT INTO products (name, price, stock) VALUES(:name, :price, :stock);';
            $stmt = $this->pdo->prepare($sql);

            $this->pdo->beginTransaction();
            $stmt->bindValue(':name', $product->getName());
            $stmt->bindValue(':price', $product->getPrice());
            $stmt->bindValue(':stock', $product->getStock(), PDO::PARAM_INT);
            $stmt->execute();
            return $this->pdo->commit();
        } else {
            return false;
        }
    }
}