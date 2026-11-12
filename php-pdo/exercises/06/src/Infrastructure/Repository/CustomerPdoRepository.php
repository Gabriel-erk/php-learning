<?php

namespace Pratica06Pdo\Infrastructure\Repository;

use Pratica06Pdo\Domain\Model\Customer;
use Pratica06Pdo\Domain\Repository\CustomerRepository;
use Pratica06Pdo\Infrastructure\Persistence\ConnectionCreator;
use Pratica06Pdo\Infrastructure\Persistence\CustomerCreator;
use PDOException;
use Exception;
use PDO;

class CustomerPdoRepository implements CustomerRepository
{
    public function __construct(private PDO $pdo)
    {
        $this->pdo = ConnectionCreator::CreateConnection();
    }

    public function findById(int $id): Customer|bool
    {
        $sql = 'SELECT * FROM customers WHERE id = ?';
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(1, $id);

        $customerData = $stmt->fetch(PDO::FETCH_ASSOC);
        // se a variável abaixo tiver o valor ESTRITAMENTE DIFERENTE (diferente em valor e tipo), entrará no corpo do if e poderá retornar um objeto do tipo Customer
        if ($customerData !== false) {
            return CustomerCreator::HydrateCustomer($customerData);
        }

        return false;
    }

    public function listAll(): array
    {
        $sql = 'SELECT * FROM customers';
        $stmt = $this->pdo->query($sql);
        $customersData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return CustomerCreator::HydrateCustomers($customersData);
    }

    /**
     * @throws PDOException|Exception
     */
    public function insert(Customer $customer): bool
    {
        if ($this->save($customer)) {
            $customer->setId($this->pdo->lastInsertId());
            return true;
        }
        return false;
    }

    private function save(Customer $customer): bool
    {
        if ($customer->getId() !== null) {
            $sql = 'INSERT INTO customers (name, email) VALUES(:name, :email);';
            $stmt = $this->pdo->prepare($sql);

            $this->pdo->beginTransaction();
            $stmt->bindValue(':name', $customer->getName());
            $stmt->bindValue(':email', $customer->getEmail());
            $stmt->execute();
            return $this->pdo->commit();
        } else {
            return false;
        }
    }
}