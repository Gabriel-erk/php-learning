<?php
namespace ScreenMatch\Model;

// interface é como se fosse uma classe abstrata sem propriedades onde todos os métodos são abstratos - logo, é possível implementar várias interfaces por conta de seus métodos não terem uma implementação fixa, no nosso sistema isso se aplica da seguinte forma: minha classe episódio tem algumas coisas em comum com minha classe título, porém não são iguais, existem atributos/metodos que não seriam utilziados (deixando nosso código bagunçado caso colocassemos que a classe episodio herda da classe titulo), fora que, conceitualmente (na regra de negócio do nosso sistema) um episódio não é um titulo, eles não são iguais e um um episodio não pode simplesmente existir solto (como um filme e uma série), ele depende de uma série, está vinculado a ela, porém ele também NÃO É uma série (logo, não faz sentido ele extender da mesma), por isso para criarmos ess vínculo entre série e filme utilizamos uma "chave estrangeira" na classe Episódio, onde vinculamos cada objeto instanciado a partir da classe episódio a uma série
// a interface vem para permitir que as classes instanciadas a partir de titulo (a classe titulo não tem obrigação de preenhcer os métodos abstratos da noss interface pois ele também é abstrato, apenas por isso) tenham os métodos avalia() e media() e também permitir que a classe episodio tenha os métodos avalia() e media(), assim evitando reutilização inútil de código e deixando algo uniforme (caso episódio fosse extendido por alguma classe, a mesma teria de implementar esses 2 métodos abstratos também) 
// uma interface é um contrato, um compromisso que eu firmo dizendo: se eu implementar essa interface (ou seja, se minha classe implementar alguma interface) eu GARANTO/EU TENHO QUE TER aqui (na classe que esta implementando a interface) todos os métodos que minha interface diz ter (afinal, uma interface não possui atributos)
// interface, assim como uma classe também é um tipo, que pode ser utilizado como parâmetro (de funções e métodos), como retorno (de funções e métodos)
// todos os métdos declarados em uma interface são public por padrão, ou seja, não é possível definir métodos protected ou private em uma interface e todos são abstratos, logo, a palavra chave "abstract" não é utilizada em interfaces
interface Avaliavel
{

    public function avalia(float $nota): void;
    public function media(): float;
}
