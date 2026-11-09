<?php

use Pratica06Pdo\Infrastructure\Persistence\ConnectionCreator;
use Pratica06Pdo\Domain\Model\Product;
require_once '../Infrastructure/Persistence/ConnectionCreator.php';
require_once '../Domain/Model/Product.php';

$pdo = ConnectionCreator::CreateConnection();
$stmt = $pdo->query('SELECT * FROM products', PDO::FETCH_ASSOC);

if ($stmt != false) {
} else {
    echo "Não foi possível trazer os clientes." . PHP_EOL;
}
