<?php
namespace ScreenMatch\Model;
use ScreenMatch\Exception\NotaInvalidaException;

// trait vai permitir que separemos um espaço do nosso código principal para chamar outro código (como se fosse o nosso require, que por debaixo dos panos pega e "cola" no arquivo que chamamos o require o arquivo indicado pelo mesmo) 
// palavra reservada trait nada mais é do que uma "característica de uma classe", nesse caso a nossa trait vai ser uma "característica de uma classe que possui avaliação"
// traduzindo do inglês, trait = característica = mecanismo para reutilizar código sem duplicação (que pode ser utilizada em várias classes)
// em outros termos também poderiamos chamar de "herança horizontal" (falando em diagramas de classe, a classe que herda sempre fica abaixo da classe pai, porém na herança horizontal ambas ficam lado a lado, como se estivessem no "mesmo nível", elas não herdam, elas não estendem a outra classe, elas "utilizam" a outra classe, por isso o nome herança horizontal), aqui é como se fosse o processo de herança mas sem utilizar um tipo
// não deve ser considerada um tipo, como hábito das boas práticas, não passamos Trait como tipo de parâmetro, retorno, NADA, ela pode até "ser aceita" pelo código, mas não devemos fazer isso como programadores, Traits são características utilizadas pelas classes
// permitem remover duplicação de código (pois estou centralizando o código em um único lugar e "chamando" o mesmo pedaço, o mesmo código, em vários arquivos diferentes) sem usar herança 
// "Permite um copiar e colar código de um lugar para o outro"
// conceito de Trait se resume em: "còdigo que pode ser reutilizado"
trait ComAvaliacao
{
    // por mais que seja uma pratica a se evitar nesse conceito de classes inicializar um atributo/propriedade fora do construtor, nesse cenário, nos NÃO temos um construtor, logo, é mais interessante inicializarmos por aqui
    private array $notas = [];

   // subrotina, pois não retorna nada, apenas realiza uma ação
    // modificador de acesso public para dizer que nosso método pode ser acessado de fora do nosso Filme, ou seja fora da nossa classe Filme
    // comentário abaixo irá deixar explicito para quem for chamar este método que ele pode retornar uma exceção dizendo que ele LANÇA uma NotaInvalidaException e logo após um comentário dizendo que isso acontece apenas se a nota for negativa ou maior que 10, coisa que será vista quando alguém passar o mouse em cima do método e etc
    /**
     * @throws NotaInvalidaException Se a nota for negativa ou maior do que 10
     */
    public function avalia(float $nota): void
    {
        // quero LANÇAR/JOGAR uma exceção para o usuário caso essa condição seja verdadeira (nota < 0 o nota > 10) - pois não se encaixa na minha regra de negócio
        // jogarei um objeto do tipo "Throwable" ou seja, um objeto que tenha relação com a interface "Throwable" (podendo ser tanto uma Exception quanto um Erro, pois ambos tem relação com essa interface)
        if ($nota < 0 || $nota > 10) {
            // estou sempre "jogando" (ou seja, após o throw) um objeto, no nosso caso, do tipo "InvalidArgumentException" (uma exceção de ARGUMENTO INVÁLIDO indicando que o argumento passado (parâmetro) não está no formato correto)
            // todos os Throwable esperam como parâmetro para o construtor, uma mensagem indicando o que foi que gerou aquele erro, no nosso caso, mostramos que a nota precisa ser entre 0 e 10 - logo, para quem tratar isso com um CATCH e utilizar o método getMessage, terá acesso a nossa mensagem que estamos passando por aqui: "Nota precisa ser entre 0 e 10", se não a mensagem será exibida na stack trace
            // caso caia dentro deste if, ao ler a linha 27 e jogar o erro, a execução será interrompida (não lerá mais nenhuma linha deste método)
            // como mensagem a ser passada ao construtor de "NotaInvalidaException" é sempre a mesma, defino ela dentro da classe (NotaInvalidaException) reescrevendo o seu construtor deixando a mensagem "Nota precisa ser entre 0 e 10" por padrão
            throw new NotaInvalidaException();  
        }
        // para executar/chamar os métodos funções (serão chamados a partir de um objeto que instanciou esta classe), eu preciso especificar que estou chamando o atributo publico "$notas" do objeto que CHAMOU essa função, caso no meu objeto "$filme20" eu chame $filme20->avalia(10), dentro do método eu preciso estar especificando que, estou chamando o atributo $notas exatamente responsavel pelo $filme 20, se não, me gerará um erro e não conseguirei prosseguir com a execuçaõ do programa
        // devido a isso, é utilizado o "$this" antes de chamar os atributos da classe, pois os métodos/funções não o reconhecem, o atributos definidos fora do método não enxergam os atributos da minha classe sem a palavra $this antes do atributo em si
        // $this = esse (use o atributo para esse objeto que chamou a função)
        // $this = palavra reservada que indica o objeto utilizado para executar a função
        $this->notas[] = $nota;
    }

    public function media(): float
    {
        $somaNotas = array_sum($this->notas);
        // count conta a quantidade de itens dentro do array
        $quantidadeNotas = count($this->notas);
        return $somaNotas / $quantidadeNotas;
    }
}
