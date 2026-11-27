<?php

require_once 'src/Domain/Model/Produto.php';
require_once 'src/Domain/Repository/ProdutoRepository.php';
require_once 'src/Infrastructure/Persistence/ConnectionCreator.php';
require_once 'src/Infrastructure/Repository/ProdutoPdoRepository.php';

use Src\Infrastructure\Persistence\ConnectionCreator;
use Src\Infrastructure\Repository\ProdutoPdoRepository;

$pdo = ConnectionCreator::CreateConnection();
$produtoPdoRepository = new ProdutoPdoRepository($pdo);
$produto = $produtoPdoRepository->findById($_GET['id']);