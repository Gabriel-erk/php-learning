<?php
namespace ScreenMatch\Model;

// um episódio NÃO é um titulo, ele não "existe por si só" como uma série e um filme, um episódio só existe POR CAUSA de uma série, sem uma série um episódio não existe e os atributos/métodos de uma série não são iguais aos de um episódio/um episódio NÃO é uma série, logo, ele também não extende de Série - lembrando que, dependendo da regra de negócio de outro sistema, um episódio poderia ser um titulo (e extender dele), porém na nossa não é
class Episodio implements Avaliavel
{
    use ComAvaliacao;
    public function __construct(public readonly Serie $serie, public readonly string $titulo, public readonly int $numeroEpisodio) {}
}
