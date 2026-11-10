<?php

use Pratica06Pdo\Infrastructure\Persistence\{ConnectionCreator, OrderItemCreator};

require_once '../../Infrastructure/Persistence/ConnectionCreator.php';
require_once '../../Infrastructure/Persistence/OrderItemCreator.php';
require_once '../../Domain/Model/OrderItem.php';

$pdo = ConnectionCreator::CreateConnection();
$stmt = $pdo->query('SELECT * FROM order_items');
$orderItems = [];

//se $stmt tiver qualquer valor diferente de false, irá entrar no corpo do if
if ($stmt) {
    $orderItemsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $orderItems = OrderItemCreator::CreateMultipleOrderItems($orderItemsData);
    foreach ($orderItems as $orderItem) {
        $orderItem->show();
    }
} else {
    echo "Não foi possível trazer os itens de pedido." . PHP_EOL;
}
