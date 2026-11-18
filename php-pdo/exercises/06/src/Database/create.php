<?php

use Pratica06Pdo\Infrastructure\Persistence\ConnectionCreator;
require_once '../Infrastructure/Persistence/ConnectionCreator.php';

$pdo = ConnectionCreator::CreateConnection();

$pdo->beginTransaction();
$pdo->exec('CREATE TABLE IF NOT EXISTS customers (id INTEGER PRIMARY KEY AUTOINCREMENT, name TEXT, email TEXT)');
$pdo->exec('CREATE TABLE IF NOT EXISTS products (id INTEGER PRIMARY KEY AUTOINCREMENT, name TEXT, price REAL, stock INT)');
$pdo->exec('CREATE TABLE IF NOT EXISTS orders 
(id INTEGER PRIMARY KEY AUTOINCREMENT, customer_id INT, total REAL, created_at TEXT, 
FOREIGN KEY (customer_id) REFERENCES customers(id)
)');
$pdo->exec('CREATE TABLE IF NOT EXISTS order_items 
(id INTEGER PRIMARY KEY AUTOINCREMENT, order_id INT, product_id INT, quantity INT, unit_price REAL,
FOREIGN KEY(order_id) REFERENCES orders(id) ON DELETE CASCADE,
FOREIGN KEY(product_id) REFERENCES products(id)
)');

$pdo->commit();
