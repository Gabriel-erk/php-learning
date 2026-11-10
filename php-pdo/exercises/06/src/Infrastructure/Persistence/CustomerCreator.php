<?php

namespace Pratica06Pdo\Infrastructure\Persistence;

use Pratica06Pdo\Domain\Model\Customer;

class CustomerCreator
{
    public static function CreateMultipleCustomers(array $customersData): array
    {
        $customers = [];
        foreach ($customersData as $customer) {
            // como este método estático chamando createCustomer pertence a nossa classe atual, apenas usamos o self para acessa-lo
            $customers[] = self::CreateCustomer($customer);
        }
        return $customers;
    }

    public static function CreateCustomer(array $customerData): Customer
    {
        return new Customer(
            $customerData['id'],
            $customerData['name'],
            $customerData['email']
        );
    }

}