<?php
namespace ScreenMatch\Model;

// definindo um modelo/molde/template dizendo o que todo filme precisa ter
// cada filme instanciado vai ter suas prórpiras características, porém, seguindo este padrão/modelo de construção
// todos os filmes que eu criar terão os atributos, comportamentos e métodos abaixo, dentro da classe filme
// para definir isso, usamos a palavra reservada "class", para representar que estamos criando uma classe, estamos criando o nosso próprio TIPO (como se fosse um int, float, double...são tipos), porém diferente dos outros tipos, esse é mais complexo pois possui vários valores ()
// extends quer dizer que a minha classe mais especifica (filme, é especifica pois é voltada apenas para filmes, nada mais) extende de outra classe mais genérica (Titulo, mais genérica pois o seu conteúdo é o que mais de uma série pode ter, ela é como uma base para os filhos poderem criar as próprias pernas), ou seja, pega os atributos e metódos da classe mais genérica e permite qua a classe filme tenha suas próprias outras propriedasdes/metódos
// com extends estou querendo dizer que "a classe filme é um título e extende/adiciona coisas a mais, coloca informações a mais tendo como base a classe titulo" - apenas os métodos públicos serão de acesso das classes filhas
// dica: se possivel evitar usar herança, apenas em casos como esse, onde "Uma série é um título"/"Um filme é um título"
class Filme extends Titulo 
{
    // nome, anoLancamento e genero, não fazem parte diretamente do filme, eles não são criados/instanciados aqui (por mais que eu esteja os passando para o meu construtor e o atributo $duracaoEmMinutos seja instanciado aqui) - eles são criados dentro da classe Titulo (lembre-se que todo filme é um Titulo), porém ao instanciar um objeto do tipo Filme, seguindo a lógica de que o meu construtor teria apenas os valores "plus" que o titulo não tem, eu não teria que passar mais valores/não teria onde passar os valores pois a escrita desses atributos estaria na classe Titulo e a que estou instanciando é a FIlme, certo? (meio confuso né?), porém, como eu conseguiria definir o nome, ano de lançamento e o genero do meu filme se a única coisa que posso passar é o $duracaoEmMinutos? exatamente, nossa aplicação não funcionaria, pois "todo Filme é um Título", logo, todo filme PRECISA ter os atributos "nome, ano de lançamento e genero", logo, eu defino 3 parâmetros com esses nomes (apenas tipando eles, pois os modificadores de acesso e o readonly que permitirá que o atributo não seja alterado e apenas lido, estão no construtor da Classe Titulo), e depois passo esses valores para a minha classe Título/classe Pai/classe Mãe/classe Base atráves do comando parent::_construct($nome, $anoLancamento, $genero) - o comando parent:: permite que eu passe valores/métodos/qualquer coisa para a classe mãe - A palavra reservada parent permite o acesso de métodos da classe base/mãe, onde no exemplo abaixo chamo o método construtor da classe mãe/base
    // agora toda vez que eu instanciar um objeto do tipo Filme, ele também irá inicializar tudo como um titulo e agora terei acesso a todos os dados
    public function __construct(string $nome, int $anoLancamento, Genero $genero, public readonly int $duracaoEmMinutos)
    {
        parent::__construct($nome, $anoLancamento, $genero);
    }

    // sobrescrevendo o método duracaoEmMinutos da classe Titulo, pois por mais que seja o mesmo "metódo" (com mesmo nome e retorno), o comportamento dele é diferente, pois agora ele retornará o valor do atributo $duracaoEmMinutos que é específico do filme (já que cada filme tem uma duração diferente), coisa que na classe Titulo não faz sentido, pois lá não existe esse atributo (já que é genérico) e não faria sentido fazer isso naquela classe pois iria quebrar o comportamente das outras classes que a herdam (como a série, e caso queira expandir para "videos", "documentários" etc quebraria o comportamento delas também pois o comportamento do método duracaoEmMinutos da classe que deveria ser genéria está sendo específo para filmes apenas, coisa que não deve acontecer, por isso, implemento um método de forma genérica em "Titulo" e para cada classe filha eu reescrevo o método, permitindo que ele tenha um comportamento diferente para cada classe que o chama-lo)
    #[\Override]
    public function duracaoEmMinutos(): int
    {
        return $this->duracaoEmMinutos;
    }

}
