<?php
// aqui estou definindo que o namespace desta classe "ConverteNotaEstrela" é "ScreenMatch\Calculos", logo, tudo que estiver neste arquivo (classes, traits, interfaces...) serão buscadas APENAS dentro deste namespace "ScreenMatch\Calculos", o que podemos ver que não irá funcionar corretamente pois no meu método "converte" eu estou pedindo por parâmetro algo do tipo "Avaliavel", que se encontra em OUTRO namespace (explicação sobre no use)
// caso eu queira solicitar este arquivo em outro arquivo eu teria de usar: ScreenMatch\Calculos\ConversorNotaEstrela - pois por mais que eu não tenha definido o nome "ConversorNotaEstrela" na linha abaixo para se referenciar a este arquivo, o PHP é inteligente e isso não se faz necessário, na linha 4 onde defino a que "grupo de classes" esta classe "ConversorNotaEstrela" pertence com "namespace ScreenMatch\Calculos" automaticante para me referenciar a este arquivo eu colocarei o nome dele a frente da última palavra para chama-lo, assim completando o caminho até ele, ficando ao certo: use ScreenMatch\Calculos\ConversorNotaEstrela, assim terei acesso ao meu conversor de qualquer arquivo que chama-lo
namespace ScreenMatch\Calculos;
// logo após a definição do namespace, defino quais classes, traits, interfaces quero solicitar que não estão presentes no namespace atual "ScreenMatch\Calculos" e assim, solicito o que eu estava precisando, a interface avaliavel dentro do namespace ScreenMatch\Model - comando já busca da raiz, ou seja, eu não precisarai "voltar uma pasta" com: use \ScreenMatch\Model\Avaliavel

use DivisionByZeroError;
use ScreenMatch\Model\Avaliavel;
use Throwable;

class ConversorNotaEstrela
{
    // porque trocar o tipo de parâmetro de Titulo para Avaliavel? pois TUDO que for avaliavel vai ter o método media, incluindo minha classe episodio, que implementa a interface avaliavel (tudo que implementar a interface avaliavel irá se encaixar aqui, poderá ser passado como parâmetro para meu método "converte") agora, se eu definir como "titulo", não posso utilizar este método para meus episódios
    public function converte(Avaliavel $avaliavel): float
    {
        // ao executar o método "media" do meu objeto do tipo "avaliavel" (que pode ser um filme, série ou episódio, pois todos implementam a interface avaliavel) ele irá me retornar a média de avaliações deste objeto, e com esta média eu posso fazer o cálculo para converter esta nota em estrelas, ou seja, de 0 a 5 estrelas, onde cada estrela representa 2 pontos na escala de 0 a 10 (ou seja, 0 a 5 estrelas) - porém, entretanto, todavia, ao executar a linha: $nota = $avaliavel->media(); PODEMOS ter um erro, onde, por mais que eu possa "soluciona-lo" para que mesmo que não seja como o esperado não retornar este erro, existem cenários que é melhor deixar o erro acontecer e tratarmos a nossa maneira, então, dentro do bloco: "try", tentamos executar nossa aplicação principal, caso retorne o erro, quero que "pegue" ele, ou seja, será jogado dentro do nosso "catch" (pegar, basicamente traduzindo do inglês e )
        try {
            $nota = $avaliavel->media();
            // usando como parâmetro que iremos receber notas de 0 a 10 e queremos converter para 0 a 5 estrelas, arredondando para o inteiro mais próximo e depois dividindo por 2 para que fique na escala de 0 a 5 (ou seja, 0 a 5 estrelas)
            return round($nota) / 2;
        }
        // como padrão, nosso "catch" espera por parâmetro o tipo de erro que estamos tentando pegar, no nosso caso, o tipo que o prórpio terminal nos entregou: "DivisionByZeroError"
        // catch nos ajuda a nos recuperar de erros e exceções (erros e exceções são conceitos ligeiramente diferentes em php, porém, ambos ainda são classes) - em um sistema, ele seguirá seu fluxo pré-definido, porém, em alguns casos ele pode se DESVIAR desse fluxo, fazendo com que gere uma exceção, mostrando que, exceção é quando algo acontece que não foi necessariamente erro da linguagem, do código, pois no cenário: tentei me conectar a uma API e não deu certo, seria me jogado uma Exception, não um erro de sintaxe, código, da linguagem é um cenário excepcional, um caminho alternativo
        // caso não fossemos imprimir nenhuma mensagem de erro e queiramos apenas nos recuperar do erro que aconteceu, essa váriavel "$e" que criei a partir da classe DivisionByZeroError não seria necessaria, apenas deixar no parâmetro (DivisionByZeroError) {return 0 // meio de se recuperar desse erro}; que funcionaria normalmente 
        /* 
        * obs
        * 1 - podemos ter vários catch, tratando diferentes erros - feito quando o tratamenteo de 2 ou mais erros não são iguais, onde faremos mais de um catch para trata-lo da forma que o erro precisa
        * 2 - podemos tratar vários erros no mesmo catch - geralmente feito quando o tratamento dos 2 pode ser igual
        * 3 - existe uma hierarquia quando falamos de erros e exceções, todos os erros e exceções IMPLEMENTAM a interface "Throwable", ou seja, ao invés de "nichar/especificar" o tipo do erro que queremos pegar, podemos simplesmente pegar qualquer erro ou exceção que aconteça, usando a interface "Throwable" como tipo do parâmetro do nosso catch, ou seja, catch (Throwable $e) { // código para tratar o erro }, isso é útil quando queremos tratar de forma genérica, ou seja, independente do tipo do erro que aconteça, queremos apenas tratar de uma forma genérica (permitindo que possamos pegar QUALQUER tipo de erro e exceção, pois ambos implementam a interface "Throwable"), como por exemplo, imprimir a mensagem de erro e retornar 0, ou seja, independente do tipo do erro que aconteça, queremos apenas imprimir a mensagem de erro e retornar 0 - nesse caso como DivisionByZeroError extende da classe "Error", ou seja, ele também É um ERRO, o tipo no parâmetro também poderia ser "Error" que funcionaria normalmente - agora colocando Exception, o catch nunca seria lido, pois o erro que estamos tendo não é desse tipo, logo, "ninguém" saberia trata-lo e a stack trace seria jogada no nosso terminal, mostrando que o erro DivisionByZeroError não foi pego (Uncaught)
        */
        catch (Throwable $e) {
            // todas as classes de erros "são também do tipo" Throwable (implementam ele (pois é uma interface), vi ao passar o mouse em cima do método getMessage), e os objetos instanciados a partir desse tipo de classe tem acesso a esse método "getMessage" que irá nos permitir ter acesso a mensagem de erro que tivemos
            // aqui, através do echo (necesário para imprimir algo na "tela"/"terminal") estamos exibindo a mensagem de erro e logo após retornando 0, encerrando a execução do método converte (encerrando a stack dele também)
            // no caso é como se fosse o "tipo do erro" ao invés de uma msg gigante sabe? então quando este erro acontecer ele irá imprimir no terminal apenas "Division by zero"
            echo $e->getMessage();
            // aqui nosso "meio de se recuperar" do erro é retornando 0 ao invés de imprimir aquela mensagem grotesca para o usuário
            return 0;
        }
    }
}
