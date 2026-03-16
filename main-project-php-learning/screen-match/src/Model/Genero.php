<?php 
namespace ScreenMatch\Model;

// Enum é um tipo que permite enumerar um conjunto de valores possíveis, como se fosse uma lista de valores possíveis
// meu Enum Genero também é considerado um "tipo", assim como minha classe "Filme", podendo ser utilizado como um tipo de parâmetro, de retorno (método), de propriedade/atributo...
Enum Genero {
    case Acao;
    case Comedia;
    case Terror;
    case SuperHeroi;
    case Drama;
}