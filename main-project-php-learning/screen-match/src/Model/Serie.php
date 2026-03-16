<?php 
namespace ScreenMatch\Model;

// é possível implementar mais de uma interface separando por vírgula
class Serie extends Titulo 
{
    public function __construct(string $nome, int $anoLancamento, Genero $genero, public readonly int $temporadas, public readonly int $episodiosPorTemporada, public readonly int $minutosPorEpisodio)
    {
        parent::__construct($nome, $anoLancamento, $genero);
    }

    // ATRIBUTO override que indica que estou sobreescrevendo um método
    // \ para indicar que estamos buscando o atributo no namespace global do php
    #[\Override]
    public function duracaoEmMinutos(): int
    {
        return $this->temporadas * $this->episodiosPorTemporada * $this->minutosPorEpisodio;
    }
}

