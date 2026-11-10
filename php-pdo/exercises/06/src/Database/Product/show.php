<?php

use Pratica06Pdo\Infrastructure\Persistence\{ConnectionCreator, ProductCreator};

require_once '../../Infrastructure/Persistence/ConnectionCreator.php';
require_once '../../Infrastructure/Persistence/ProductCreator.php';
require_once '../../Domain/Model/Product.php';

$pdo = ConnectionCreator::CreateConnection();
$stmt = $pdo->query('SELECT * FROM products');
$products = [];

//se $stmt tiver qualquer valor diferente de false, irá entrar no corpo do if
if ($stmt) {
    $productsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $products = ProductCreator::CreateMultipleProducts($productsData);
    foreach ($products as $product) {
        $product->show();
    }
} else {
    echo "Não foi possível trazer os produtos." . PHP_EOL;
}
