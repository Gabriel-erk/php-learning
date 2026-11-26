<?php

namespace Src\Infrastructure\Repository;

use Src\Domain\Model\Produto;
use Src\Domain\Repository\ProdutoRepository;
use PDOStatement;
use PDO;

class ProdutoPdoRepository implements ProdutoRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function index(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM produtos');
        return $this->hydrateProducts($stmt);
    }

    private function hydrateProducts(PDOStatement $stmt): array
    {
        $stmt->execute();
        $dadosProdutos = $stmt->fetchAll();
        $produtos = [];

        foreach ($dadosProdutos as $dadosProduto) {
            $produtos[] = new Produto(
                $dadosProduto['id'],
                $dadosProduto['tipo'],
                $dadosProduto['nome'],
                $dadosProduto['descricao'],
                $dadosProduto['imagem'],
                $dadosProduto['preco']
            );
        }
        return $produtos;
    }

    public function produtosCafe(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM produtos WHERE tipo = 'Café' ORDER BY preco ASC");
        return $this->hydrateProducts($stmt);
    }

    public function produtosAlmoco(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM produtos WHERE tipo = 'Almoço'");
        return $this->hydrateProducts($stmt);
    }

    public function findById(int $id): ?Produto
    {
        $stmt = $this->pdo->prepare('SELECT * FROM produtos WHERE id = ?');
        $stmt->execute([
            $id
        ]);
        $dadosProduto = $stmt->fetch();

        if (is_null($dadosProduto)) {
            return null;
        }

        return new Produto(
            $dadosProduto['id'],
            $dadosProduto['tipo'],
            $dadosProduto['nome'],
            $dadosProduto['descricao'],
            $dadosProduto['imagem'],
            $dadosProduto['preco']
        );
    }

    public function update(Produto $produto): bool
    {
        $produto = $this->findById($produto->getId());

        if (is_null($produto)) {
            return false;
        }

        $stmt = $this->pdo->prepare('UPDATE produtos SET tipo = :tipo, nome = :nome, descricao = :descricao, imagem = :imagem, preco = :preco WHERE id = :id');

        return $stmt->execute([
            ':tipo' => $produto->getTipo(),
            ':nome' => $produto->getNome(),
            ':descricao' => $produto->getDescricao(),
            ':imagem' => $produto->getImagem(),
            ':preco' => $produto->getPreco(),
            ':id' => $produto->getId()
        ]);
    }

    public function delete(Produto $produto): bool
    {
        $stmt = $this->pdo->query('DELETE FROM produtos WHERE id = ?');
        return $stmt->execute([
            $produto->getId()
        ]);
    }
}