<?php

namespace Pratica06Pdo\Infrastructure\Repository;

use Exception;
use Pratica06Pdo\Domain\Model\Customer;
use Pratica06Pdo\Domain\Repository\CustomerRepository;
use Pratica06Pdo\Infrastructure\Persistence\ConnectionCreator;
use Pratica06Pdo\Infrastructure\Persistence\CustomerCreator;
use PDO;

class CustomerPdoRepository implements CustomerRepository
{
    public function __construct(private PDO $pdo)
    {
        $this->pdo = ConnectionCreator::CreateConnection();
    }

    public function findById(int $id): Customer
    {
        $sql = 'SELECT * FROM customers WHERE id = ?';
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(1, $id);

        $customerData = $stmt->fetch(PDO::FETCH_ASSOC);
        return CustomerCreator::HydrateCustomer($customerData);
    }

    public function listAll(): array
    {
        $sql = 'SELECT * FROM customers';
        $stmt = $this->pdo->query($sql);
        $customersData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return CustomerCreator::HydrateCustomers($customersData);
    }

    /**
     * @throws Exception
     */
    public function insert(Customer $customer): bool
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
            throw new Exception('Produto já está inserido no banco de dados.');
        }
    }
}