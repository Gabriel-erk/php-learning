<?php

use Pratica06Pdo\Infrastructure\Persistence\ConnectionCreator;
require_once '../Infrastructure/Persistence/ConnectionCreator.php';

$pdo = ConnectionCreator::CreateConnection();

$pdo->beginTransaction();
$pdo->exec('CREATE TABLE IF NOT EXISTS customers (id INT PRIMARY KEY, name TEXT, email TEXT)');
$pdo->exec('CREATE TABLE IF NOT EXISTS products (id INT PRIMARY KEY, name TEXT, price REAL, stock INT)');
$pdo->exec('CREATE TABLE IF NOT EXISTS orders 
(id INT PRIMARY KEY, customer_id INT, total REAL, created_at TEXT, 
FOREIGN KEY (customer_id) REFERENCES customers(id)
)');
$pdo->exec('CREATE TABLE IF NOT EXISTS order_items 
(id INT PRIMARY KEY, order_id INT, product_id INT, quantity INT, unit_price REAL,
FOREIGN KEY(order_id) REFERENCES orders(id),
FOREIGN KEY(product_id) REFERENCES products(id)
)');

$pdo->commit();
