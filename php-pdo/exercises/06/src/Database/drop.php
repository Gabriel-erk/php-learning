<?php

use Pratica06Pdo\Infrastructure\Persistence\ConnectionCreator;
require_once '../Infrastructure/Persistence/ConnectionCreator.php';

$pdo = ConnectionCreator::CreateConnection();

$pdo->beginTransaction();

$pdo->exec('DROP TABLE IF EXISTS customers;');
$pdo->exec('DROP TABLE IF EXISTS products;');
$pdo->exec('DROP TABLE IF EXISTS orders;');
$pdo->exec('DROP TABLE IF EXISTS order_items;');

$pdo->commit();