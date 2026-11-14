<?php

use Pratica06Pdo\Infrastructure\Persistence\ConnectionCreator;
use Pratica06Pdo\Domain\Model\{Customer, Product, Order, OrderItem};
use Pratica06Pdo\Domain\Repository\{ProductRepository, OrderRepository, CustomerRepository};
use Pratica06Pdo\Infrastructure\Repository\{CustomerPdoRepository, ProductPdoRepository, OrderPdoRepository};

require_once 'src/Infrastructure/Persistence/ConnectionCreator.php';
require_once 'src/Infrastructure/Persistence/CustomerCreator.php';
require_once 'src/Infrastructure/Persistence/OrderCreator.php';
require_once 'src/Infrastructure/Persistence/OrderItemCreator.php';
require_once 'src/Infrastructure/Persistence/ProductCreator.php';
require_once 'src/Domain/Model/Customer.php';
require_once 'src/Domain/Model/Product.php';
require_once 'src/Domain/Model/Order.php';
require_once 'src/Domain/Model/OrderItem.php';
require_once 'src/Domain/Repository/CustomerRepository.php';
require_once 'src/Domain/Repository/OrderRepository.php';
require_once 'src/Domain/Repository/ProductRepository.php';
require_once 'src/Infrastructure/Repository/CustomerPdoRepository.php';
require_once 'src/Infrastructure/Repository/ProductPdoRepository.php';
require_once 'src/Infrastructure/Repository/OrderPdoRepository.php';

function menu(): void {
    echo "===== MENU =====" . PHP_EOL;
    echo "1 - Catálogo de produtos" . PHP_EOL;
    echo "0 - Sair" . PHP_EOL;
}

// inicializando repositórios e conexão com banco sqlite
$pdo = ConnectionCreator::CreateConnection();
$customerPdoRepository = new CustomerPdoRepository($pdo);
$orderPdoRepository = new OrderPdoRepository($pdo);
$productPdoRepository = new ProductPdoRepository($pdo);

while(true) {
    menu();
    $option = (int) readline('Informe a opção desejada: ');

    if ($option == 1) {
        $products = $productPdoRepository->listAll();
        $cart = [];

        foreach ($products as $product) {
            $product->show();
        }
        $option = (int) readline('Deseja comprar?');

        if ($option == 's') {
            echo "Informe os ID's dos produtos desejados (digite Stop para parar de adicionar ao carrinho):";
        }
    } else if($option == 0) {
        return false;
    } else {
        echo "Opção inválida!" . PHP_EOL;
    }
}
