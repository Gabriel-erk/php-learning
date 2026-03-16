<?php 
namespace ScreenMatch\Exception;

use Throwable;

// para que eu possa utilizar "throw" e outros comandos vinculados a exeções é necessário herdar da classe "Exception" mas existe um porém
/*
* estamos criando nossa própria exception, pois, utilizando como exemplo uma aplicação bancária, ao passar como parametro um objeto do tipo "ContaCorrente" para um método que esperaria um objeto do tipo "ContaSalario" geraria uma exceção do tipo "InvalidArgumentException" indicando que o argumento passado foi inválido (onde passariamos uma msg para o construtor de InvalidArgumentException pois ele é instanciado ao usar "throw new Invalid...") porém em outras situaçoes deste mesmo banco isso também poderia acontecer, como: passar um valor negativo para saque em um método que NÃO permite isso, também seria uma "InvalidArgumentException", logo quando qualquer uma dessas coisas ou até mesmo outras situações parecidas acontecessem, cairia no mesmo catch responsável por tratar (o que estavamos planejando) que seria apenas UM dos inúmeros casos de "InvalidArgumentException"
 * seguindo boas práticas, deveriamos ser mais específicos no momento de tratamento e exibição de nossas exceções, para isso, estamos sendo específicos e criando uma exceção ESPECÍFICA para nosso caso atual caso tenhamos alguma nota inválida
 * pelo fato de também ser um "InvalidArgumentException" herdamos diretamente dele ao invés de uma Exception comum, pois os casos de exceção que serão tratados aqui nesta classe são casos onde os argumentos também são inválidos
 * normalmente classes de Exceção assim ficam até vazias, o que faz eu me perguntar: logo, qual seu objetivo? que a resposta que me vem a mente seria em questão de boas práticas, diferenciando de apenas jogar uma "InvalidArgumentException" em questão de nome, porém, aqui a mensagem que será exibida quando uma exceção deste tipo (NotaInvalidaException) for lançada será a mesma, logo, posso sobrescrever o construtor padrão da nossa classe (como herda de "InvalidArgumentException", sobrescreverei o construtor da mesma) 
 */
class NotaInvalidaException extends \InvalidArgumentException {
    // no php não é necessário atribuir todos os parâmetros que o "método pai" pede para poder sobrescreve-lo
    public function __construct()
    {
        // passando para o construtor da classe pai (InvalidArgumentException) a mensagem que queremos que o atributo "message" tenha
        return parent::__construct("Nota precisa ser entre 0 e 10");
    }
}