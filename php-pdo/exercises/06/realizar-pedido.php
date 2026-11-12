<?php

use Pratica06Pdo\Infrastructure\Persistence\ConnectionCreator;
use Pratica06Pdo\Domain\Model\{Customer, Product, Order, OrderItem};
use Pratica06Pdo\Domain\Repository\{ProductRepository, OrderRepository, CustomerRepository};
use Pratica06Pdo\Infrastructure\Repository\{CustomerPdoRepository, ProductPdoRepository, OrderPdoRepository};

require_once 'src/Infrastructure/Persistence/ConnectionCreator.php';
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

$pdo = ConnectionCreator::CreateConnection();
$customerPdoRepository = new CustomerPdoRepository($pdo);

$customer = $customerPdoRepository->findById(1);
if ($customer !== false) {
    echo '===== CLIENTE ENCONTRADO =====' . PHP_EOL;
    $customer->show();
    echo PHP_EOL;
} else {
    echo 'Não foi possível encontrar o cliente com id = 1' . PHP_EOL;
}



