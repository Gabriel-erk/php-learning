<?php

use Pratica06Pdo\Infrastructure\Persistence\ConnectionCreator;
require_once '../Infrastructure/Persistence/ConnectionCreator.php';

$pdo = ConnectionCreator::CreateConnection();
$stmt = $pdo->prepare('INSERT INTO customers(name,email) VALUES(:name, :email)');
$pdo->beginTransaction();

// INSERINDO CLIENTES
$stmt->bindValue(':name','Gabriel Ferreira');
$stmt->bindValue(':email', 'gabriel@email.com');
$stmt->execute();

$stmt->bindValue(':name','Ana Oliveira');
$stmt->bindValue(':email', 'ana@email.com');
$stmt->execute();

$stmt->bindValue(':name','Lucas Santos');
$stmt->bindValue(':email', 'lucas@email.com');
$stmt->execute();

$pdo->commit();

$stmt = $pdo->prepare('INSERT INTO products(name, price, stock) VALUES(:name, :price, :stock)');
$pdo->beginTransaction();

// INSERINDO PRODUTOS
$stmt->bindValue(':name', 'Teclado Mecânico');
$stmt->bindValue(':price', 250.00);
$stmt->bindValue(':stock', 10, PDO::PARAM_INT);
$stmt->execute();

$stmt->bindValue(':name', 'Mouse gamer');
$stmt->bindValue(':price', 120.00);
$stmt->bindValue(':stock', 5, PDO::PARAM_INT);
$stmt->execute();

$stmt->bindValue(':name', 'Mousepad');
$stmt->bindValue(':price', 45.00);
$stmt->bindValue(':stock', 8, PDO::PARAM_INT);
$stmt->execute();

$stmt->bindValue(':name', 'Monitor');
$stmt->bindValue(':price', 900.00);
$stmt->bindValue(':stock', 2, PDO::PARAM_INT);
$stmt->execute();

$stmt->bindValue(':name', 'Headset');
$stmt->bindValue(':price', 180.00);
$stmt->bindValue(':stock', 0, PDO::PARAM_INT);
$stmt->execute();

$pdo->commit();