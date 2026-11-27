<?php
require_once 'src/Domain/Model/Produto.php';
require_once 'src/Domain/Repository/ProdutoRepository.php';
require_once 'src/Infrastructure/Persistence/ConnectionCreator.php';
require_once 'src/Infrastructure/Repository/ProdutoPdoRepository.php';

use Src\Infrastructure\Persistence\ConnectionCreator;
use Src\Infrastructure\Repository\ProdutoPdoRepository;

$pdo = ConnectionCreator::CreateConnection();
$produtoPdoRepository = new ProdutoPdoRepository($pdo);
$produtos = $produtoPdoRepository->index();
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="icon" href="img/icone-serenatto.png" type="image/x-icon">
    <title>Serenatto - Admin</title>
</head>
<body>
<main>
    <section class="container-admin-banner">
        <img src="img/logo-serenatto-horizontal.png" class="logo-admin" alt="logo-serenatto">
        <h1>Admistração Serenatto</h1>
        <img class="ornaments" src="img/ornaments-coffee.png" alt="ornaments">
    </section>
    <h2>Lista de Produtos</h2>

    <section class="container-table">
        <table>
            <thead>
            <tr>
                <th>Produto</th>
                <th>Tipo</th>
                <th>Descricão</th>
                <th>Valor</th>
                <th colspan="2">Ação</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($produtos as $produto): ?>
                <!-- tr == table row (linha de tabela), ou seja, aqui é uma representação semelhante a uma linha de registro em banco de dados, onde cada TD dentro da abertura e fechamento da tag html TR representa um dado vínculado a uma COLUNA aqui da nossa table seguindo a ordem de definição da coluna, logo, o primeiro td aparecerá como valor da primeira coluna definida aqui na tabela (colunas foram definidas no thead (table head/cabeçalho) acima do tbody (table body) que estamos dentro)  -->
                <tr>
                    <td><?= $produto->getNome() ?></td>
                    <td><?= $produto->getTipo() ?></td>
                    <td><?= $produto->getDescricao() ?></td>
                    <td><?php $produto->getPrecoFormatado() ?></td>
                    <td><a class="botao-editar" href="editar-produto.html">Editar</a></td>
                    <td>
                        <form method="post" action="src/Infrastructure/Repository/ProdutoPdoRepository.php">
                                <!-- type hidden fará com que este input abaixo esteja presente na página HTML, porém ele não será VISÍVEL para o usuário, este campo estará OCULTO (poderá ser visto apenas em caso de inspecionarem a página e etc, caso este campo tivesse o tipo number ou text, ele ocuparia um certo espaço na tela, coisa que não queremos, já que a única funcionalidade do campo abaixo é permitir que possamos enviar o valor do id do produto para o arquivo de exclusão (especificado no nosso action) QUANDO o usuário clicar no botão de excluir abaixo deste input do type hidden  -->
                            <input type="hidden" name="id" value="<?php $produto->getId() ?>">
                            <input type="submit" class="botao-excluir" value="Excluir">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <a class="botao-cadastrar" href="cadastrar-produto.html">Cadastrar produto</a>
        <form action="#" method="post">
            <input type="submit" class="botao-cadastrar" value="Baixar Relatório"/>
        </form>
    </section>
</main>
</body>
</html>