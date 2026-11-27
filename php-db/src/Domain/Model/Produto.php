<?php

namespace Src\Domain\Model;

class Produto
{
    // readonly em $id, já que não é possível ficar alterando deliberadamente o valor do atributo id do nosso objeto (baseado na regra de negócio deste sistema)
    public function __construct(private readonly int $id, private string $tipo, private string $nome, private string $descricao, private string $imagem, private float $preco)
    {

    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTipo(): string
    {
        return $this->tipo;
    }

    /**
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * @return string
     */
    public function getDescricao(): string
    {
        return $this->descricao;
    }

    /**
     * @return string
     */
    public function getImagem(): string
    {
        return $this->imagem;
    }

    public function getImagemDiretorio(): void
    {
        echo 'img/' . $this->imagem;
    }

    /**
     * @return float
     */
    public function getPreco(): float
    {
        return $this->preco;
    }

    public function getPrecoFormatado(): void
    {
        echo 'R$ ' . number_format($this->preco, 2);
    }

    /**
     * @param string $tipo
     */
    public function setTipo(string $tipo): void
    {
        $this->tipo = $tipo;
    }

    /**
     * @param string $descricao
     */
    public function setDescricao(string $descricao): void
    {
        $this->descricao = $descricao;
    }

    /**
     * @param string $imagem
     */
    public function setImagem(string $imagem): void
    {
        $this->imagem = $imagem;
    }

    /**
     * @param string $nome
     */
    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    /**
     * @param float $preco
     */
    public function setPreco(float $preco): void
    {
        $this->preco = $preco;
    }
}