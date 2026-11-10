<?php

use Pratica06Pdo\Infrastructure\Persistence\{ConnectionCreator, OrderCreator};

require_once '../../Infrastructure/Persistence/ConnectionCreator.php';
require_once '../../Infrastructure/Persistence/OrderCreator.php';
require_once '../../Domain/Model/Order.php';

$pdo = ConnectionCreator::CreateConnection();
$stmt = $pdo->query('SELECT * FROM orders');
$orders = [];

//se $stmt tiver qualquer valor diferente de false, irá entrar no corpo do if
if ($stmt) {
    $ordersData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $orders = OrderCreator::CreateMultipleOrders($ordersData);
    foreach ($orders as $order) {
        $order->show();
    }
} else {
    echo "Não foi possível trazer os pedidos." . PHP_EOL;
}
