<?php

// definindo um modelo/molde/template dizendo o que todo filme precisa ter
// cada filme instanciado vai ter suas prórpiras características, porém, seguindo este padrão/modelo de construção
// todos os filmes que eu criar terão os atributos, comportamentos e métodos abaixo, dentro da classe filme
// para definir isso, usamos a palavra reservada "class", para representar que estamos criando uma classe, estamos criando o nosso próprio TIPO (como se fosse um int, float, double...são tipos), porém diferente dos outros tipos, esse é mais complexo pois possui vários valores ()
class Filme
{
    private array $notas;

    /*
    * método construtor
    * método chamado AUTOMATICAMENTE após a criação/instanciação de um objeto a partir desta classe 
    * todo método chamado automaticamente em php começa com a sigla "__" antes de seu nome
    * não se pode definir um retorno no método construtor (logo, ele será omitido e não colocaremos)
    * um método construtor não retorna nada (não pode ter um return dentro dele), logo, ele possui um comportamento de subrotina, apenas EXECUTA o que está dentro de seu escopo no momento de construção (pois seu retorno é meio que explicíto, pois basicamente o "retorno" é o objeto criado, atribuindo valores para seus atributos/propriedades a partir dos parâmetros que ele recebeu, que foram passados no momento de criação do objeto no arquivo que criou este objeto), qualquer inicialização de propriedade/atributo é alocada no método construtor
    * para não ficar repetitivo como estava logo acima, onde, definimos os atributos, depois, pediamos parâmetros e ai sim passavamos os valores dos parâmetros para os atributos/propriedades, seria mais interessante facilitar este processo, onde o php nos permite indicar que, os "parâmetros" do método construtor serão promovidos a propriedaedes/atributos no momento em que o método construtor for chamado a primeira vez, assim evitando repetição de código, e o jeito de se fazer isso é muito simples! apenas colocar o modificador de acesso no parâmetro que irá virar nosso atributo, como abaixo: "private string $nome", pronto, ao ser inicializado, ele já será considerado uma atributo diretamente, logo não é necessário o código que tinhamos antes de: "$this-nome = $nome; $this->anoLancamento = $anoLancamento..." para setar os valores de cada atributo pois agora que nossos parâmetros viraram nossos atributos, isso já será feito automaticamente - isso só acontece no construtor - todos os parâmetros que virarão atributos/propriedades precisam estar com a tipagem definida (se é string, int, float...) para que as IDE não reclamem e evite problemas ao decorrer do sistema
    * na prática, essas propriedades são apenas de leitura (mas por que?), pois, após informadas na sua construção, elas não podem ser alteradas (sem contar com $notas, pois sempre posso inserir uma nota a mais, logo, estou modificando ela), porém o restante é apenas de leitura, pois após serem definidas na instância do objeto, elas apenas podem ser "lidas/visualizadas" através do método "get" (que temos até então) - chamamos esse conceito de "readonly", que também é uma palavra reservada no php, que serve para informar que certas propriedades só vão ter acesso de leitura (após serem escritas/definidas uma vez, não podem ser escritas/definidas/alteradas em nenhum outro momento), logo, como é um atributo privado, ele terá de ser modificado dentro da própria classe, porém ao tentar executar em um metódo privado esta linha: $this->nome = 'teste'; me retornará um erro no terminal devido a palavra reservada "readonly" atribuida ao meu atributo/propriedade $nome, e todos os atributos/propriedades com essa palavra reservada atribuida, podem ter seus valores definidos apenas uma vez (no caso, no seu momento de construção/instância do objeto a partir desta classe que estamos)
    */

    public function __construct(private readonly string $nome, private readonly int $anoLancamento, private readonly string $genero)
    {
      
        $this->notas = [];
    }

    // subrotina, pois não retorna nada, apenas realiza uma ação
    // modificador de acesso public para dizer que nosso método pode ser acessado de fora do nosso Filme, ou seja fora da nossa classe Filme
    public function avalia(float $nota): void
    {
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

    /*
    * métodos de acesso, feitos devido ao conceito que, todo atributo privado DEVE ter seus metodos de acesso que são obrigatoriamente públicos
    * método getter/recuperador = método de acesso que recupera uma informação para você, marjoritariamente em cenários que "poxa, quero ver o conteúdo do meu atributo privado "nome"", o getter te retorna esta informação (geralmente cada atributo privado terá seu método getter e setter (que define o valor daquela informação após você criar um objeto, e e por ele ser privado você não poder acessar deliberadamente/diretamente, terá este setter (metódo público) que lhe permite inserir informações no atributo))
    * com meu método construtor definido eu só preciso apenas da definição dos meus métodos de acesso "getters" (que apenas retornam o valor atual do atributo do objeto que está chamando aquele método)
    */
    public function getNome(): string
    {
        return $this->nome;
    }

    public function getAnoLancamento(): int {
        return $this->anoLancamento;
    }

    public function getGenero(): string {
        return $this->genero;
    }

    // método set não é mais necessário, pois todos os atributos privados que eu possuia foram encaixados dentro do meu método construtor, logo, quando eu instaciar o objeto, ele irá requisistar parâmetros obrigatórios, que quando eu passar em seus parênteses, serão atribuidos diretamente para os atributos desse objeto
    /* public function set_nome($nomeFilme):void {
          traduzindo linha de código abaixo: o atributo/propriedade "nome" do objeto que está chamando este método (set_nome // por conta do $this) irá receber como seu valor o conteúdo do parâmetro $nomeFilme
         $this->nome = $nomeFilme;
     } */
}
