<?php

// subrotina que não retorna nada, apenas exibe uma mensagem na tela, por isso o tipo de retorno é void (vazio) que significa a ausência de retorno de qualquer tipo
function exibeMensagemLancamento(int $ano): void
{
    if ($ano > 2022) {
        echo "Esse filme é um lançamento.";
    } elseif ($ano > 2020 and $ano <= 2022) {
        echo "Esse filme ainda é novo." . PHP_EOL;
    } else {
        echo "Esse filme não é um lançamento." . PHP_EOL;
    }
}

// definindo a função incluidoNoPlano que recebe dois parâmetros: um booleano $planoPrime e um inteiro $anoLancamento para facilitar o tratamento da lógica de inclusão no plano e não permitir que valores diferentes desses tipos sejam passados para a função, caso passe, o php irá avisar um erro de tipo de váriavel (ou em alguns casos, ele pode tentar converter o valor passado para o tipo esperado, mas isso não é garantido)
// fazendo isso adicionamos robustez ao código, protegendo contra erros humanos, pois eu, ou alguém que esteja mexendo no código, pode acabar passando um valor errado para a função, como uma string ou um array, o que poderia causar comportamentos inesperados ou erros em tempo de execução
// para melhorar mais ainda, podemos definir o tipo de retorno da função como booleano, utilizando ": bool" após os parênteses dos parâmetros, assim garantimos que a função sempre retornará um valor booleano (true ou false), caso contrário, o PHP irá avisar um erro de tipo de retorno
function incluidoNoPlano(bool $planoPrime, int $anoLancamento): bool
{
    // return quer dizer: devolva o resultado dessa expressão para quem te chamou, lá abaixo eu chamo essa função na váriavel $incluido no plano, e ela irá me retornar o resultado da operação lógica utilizando os valores que eu passar como argumentos para a função
    return $planoPrime || $anoLancamento < 2020;
}

// função construtora, para evitar que, ao criar um filme o usuário deixe passar alguma informação/não preencha os atributos do meu filme da forma correta
// função que define todos os parâmetros para a estrutura no meu return
// defini que o retorno da minha função é um objeto do tipo Filme, sempre tem que retornar algo com o tipo "Filme", que é definido na minha pasta de "Model/Modelo" e lá instancio minha classe filme (onde, com esse comportamento de classe, me dá um maior controle sobre seus atributos e comportamentos do que simplesmente deixa-lo jogado pelos arquivos/nos arquivos de execução, fora que é melhor para controlar os tipos do filme)
//  function criaFilme(string $nome, int $anoLancamento, string $genero, float $nota,): Filme {
//     // palavra reservada "new" é utilizada toda vez que quero instânciar um novo objeto do tipo da minha classe (aqui, do tipo filme)
//     $filme = new Filme(); 
//     // minha classe possui os atributos: nome, anoLancamento, nota e genero
//     // logo abaixo acesso cada atributo da minha classe filme (através da "->" e o objeto $filme, que, como visto acima, foi instanciado a partir da classe Filme em "$filme = new Filme();) e digo que o valor do atributo do filme ATUAL será o valor passado por parâmetro na função que estamos (criaFilme)
//     $filme->nome = $nome;
//     $filme->anoLancamento = $anoLancamento;
//     $filme->nota = $nota;
//     $filme->genero = $genero;

//     return $filme;
//  }

 function criaSerie(string $nomeSerie, int $qntdEpisodios, float $duracaoPorEpisodio, bool $possuiLegenda): Serie{
    $serie = new Serie();

    $serie->nome = $nomeSerie;
    $serie->qntdEpisodios = $qntdEpisodios;
    $serie->duracaoPorEpisodio = $duracaoPorEpisodio;
    $serie->possuiLegenda = $possuiLegenda;

    return $serie;
}