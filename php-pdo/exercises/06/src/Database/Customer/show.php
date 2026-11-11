<?php

use Pratica06Pdo\Infrastructure\Persistence\{ConnectionCreator, CustomerCreator};

require_once '../../Infrastructure/Persistence/ConnectionCreator.php';
require_once '../../Infrastructure/Persistence/CustomerCreator.php';
require_once '../../Domain/Model/Customer.php';

$pdo = ConnectionCreator::CreateConnection();
$stmt = $pdo->query('SELECT * FROM customers');
$customers = [];

//se $stmt tiver qualquer valor diferente de false, irá entrar no corpo do if
if ($stmt) {
    $customersData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $customers = CustomerCreator::HydrateCustomers($customersData);
    foreach ($customers as $customer) {
        $customer->show();
    }
} else {
    echo "Não foi possível trazer os clientes." . PHP_EOL;
}
