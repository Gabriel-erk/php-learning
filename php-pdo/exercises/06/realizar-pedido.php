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

function menu(): void
{
    echo "===== MENU =====" . PHP_EOL;
    echo "1 - Catálogo de produtos" . PHP_EOL;
    echo "0 - Sair" . PHP_EOL;
}

// inicializando repositórios e conexão com banco sqlite
$pdo = ConnectionCreator::CreateConnection();
$customerPdoRepository = new CustomerPdoRepository($pdo);
$orderPdoRepository = new OrderPdoRepository($pdo);
$productPdoRepository = new ProductPdoRepository($pdo);

while (true) {
    $customerId = (int)readline('Informe seu ID:');
    $customer = $customerPdoRepository->findById($customerId);

    if (!$customer) {
        echo "Cliente inexistente." . PHP_EOL;
        return false;
    }

    menu();
    $option = (int)readline('Informe a opção desejada: ');

    if ($option == 1) {
        $products = $productPdoRepository->listAll();
        $orderItems = [];

        foreach ($products as $product) {
            $product->show();
        }
        $option = (int)readline('Deseja comprar?');

        if ($option == 's') {
            echo "Informe os ID's dos produtos desejados (digite '00' para parar de adicionar ao carrinho):";
            $order = new Order(null, $customer->getId(), 0, new DateTimeImmutable('2026-11-15')); // abrindo pedido, pois irei e irei alterar o seu valor total em tempo de execução
            $orderTotal = 0; // váriavel responsável por armazenar o total do pedido que PODE ser realizado aqui (terei de percorrer todos os items de pedido uma hora ou outra, logo, nesse momento, farei o cálculo do total do pedido, pois ele me disponibiliza as informações necessárias para tal
            $orderItems = [];
            $productId = 999;

            while ($productId != 00) {
                $productId = (int)readline('Informe o ID do produto:');

                if ($productId == 00) {
                    break;
                } else {
                    $product = $productPdoRepository->findById($productId);

                    if (!$product) {
                        echo 'Produto não encontrado.' . PHP_EOL;
                    } else {
                        $quantity = (int)readline('Informe a quantidade desejada do produto:');

                        if ($quantity > $product->getStock()) {
                            echo 'Quantidade inválida!' . PHP_EOL;
                        } else {
                            $orderItems[] = new OrderItem(null, $order->getId(), $product->getId(), $quantity, $product->getPrice()); // criando item de pedido
                            // $product->setStock($product->getStock() - $quantity); // após criar um objeto guardando as especificações do produto, a sua quantidade será reduzida a fim de se adequar a regra de negócio
                            $orderTotal += $product->getPrice() * $quantity; // essa expressão calcula o total do pedido atual e soma na váriavel que irá acumular o total do pedido inteiro
                        }
                    }
                }
            }
            $order->setTotal($orderTotal); // passando para o atributo $total do nosso objeto que representa o pedido, o RESULTADO da SOMA de todos os itens que entrarão nele

            $pdo->beginTransaction(); // Outra observação é que, de que adianta aplicar isso apenas aos itens dos pedidos? De que adianta inserir um registro na tabela pedidos, se os seus itens não forem inseridos também? (logo, só quero inserir um registro na tabela pedidos se todos os itens também forem inseridos, por isso, começo a minha transação aqui
            // iniciando transação, pois quero que insira QUALQUER item de pedido apenas se TODOS os outros forem inseridos também

            try {
                $orderPdoRepository->insert($order); // com os atributos preenchidos, dizemos para nosso repositório inserir o objeto no banco de dados
            } catch (PDOException|Exception $e) {
                echo $e->getMessage();
            }

            $order = $orderPdoRepository->findById($pdo->lastInsertId()); // recuperando o pedido que acabamos de mandar entrar no banco (pegando o último ID inserido no banco)

            foreach ($orderItems as $orderItem) {
                try {
                    $orderPdoRepository->insertItem($orderItem);

                    $productId = $orderItem->getProductId();
                    $product = $productPdoRepository->findById($productId);
                    $product->setStock($product->getStock() - $orderItem->getQuantity());
                    // já estou dentro de um try-catch, que coincidentemente, o catch da linha abaixo pega exatamente o mesmo tipo de exceção
                    $productPdoRepository->updateStock($product);

                    $pdo->commit();
                } catch (Exception|PDOException $e) {
                    echo $e->getMessage() . PHP_EOL;
                    $pdo->rollBack();
                }
            }
        }
    } else if ($option == 0) {
        return false;
    } else {
        echo 'Opção inválida!' . PHP_EOL;
    }
}
