<?php

// definindo um modelo/molde/template dizendo o que todo filme precisa ter
// cada filme instanciado vai ter suas prórpiras características, porém, seguindo este padrão/modelo de construção
// todos os filmes que eu criar terão os atributos, comportamentos e métodos abaixo, dentro da classe filme
// para definir isso, usamos a palavra reservada "class", para representar que estamos criando uma classe, estamos criando o nosso próprio TIPO (como se fosse um int, float, double...são tipos), porém diferente dos outros tipos, esse é mais complexo pois possui vários valores ()
class Filme
{
    // definindo os valores que TODO FILME PRECISA TER
    // palavra reservada que vai me permitir acessar o atributo quando eu tiver um atributo do tipo "Filme" desejado vem antes do nome do atributo (no caso, o modificador public)
    // especificar o tipo do atributo é considerado uma boa prática e evita erros bobos como alguém passar o uma string para o atributo ano de lançamento
    // public vem antes do nosso atributo para especificar que podemos acessa-lo fora do nosso "Filme", ou seja, fora da classe Filme
    public string $nome;
    public int $anoLancamento;
    public string $genero;
    // incializando meu array como um array vazio
    // utilizando private pois quero que apenas seja possivel acessar esse atributo de dentro da classe filme, pois seguindo nossa regra de negócio, qual é o sentido de, após eu receber minhas notas para meu filme (podendo realizar o cálculo da média dele e etc) e de repente no meu arquivo de execução eu zerar as notas com um: $meuFilme->notas = []; (definindo que o atributo é um array vazio) ou $meuFilme->notas =[0]; ?? isso não faz sentido e quebra nossa aplicação, as notas devem apenas ser adicionadas, não modificadas/removidas
    // qualquer outro código que não esteja dentro da classe não vai acessar essa propriedade/atributo notas - com private eu defino que qualquer arquivo/extensão não consiga ver este atributo fora da minha classe Filme, logo, essa linha aqui: $meuFilme->notas = []; me jogaria um erro no terminal dizendo que estou tentando acessar um atributo que eu não tenho acesso (claro, tentando fazer isso fora da minha classe/arquivo que minha classe está)
    /* 
    * qual o intuito deste comportamento?
    * evitar que um atributo importante para o funcionamento do sistema seja manipulado livremente por qualquer um e estrague o comportamento da minha aplicação
    * manipular o meu arquivo notas de forma segura, pois você pode pensar, tá, mas se eu não vou acessar esses atributos fora da classe, por que vou sequer cria-lo? como que eu vou manipulá-lo? qual sua utilidade afinal? e ai vem o seu real uso, que é, permitir que meu atributo privado $notas seja manipulado da maneira que EU desejar, pois caso observe bem o código em "Filme.php" e "index.php" eu ainda estou manipulando o atributo $notas, porém, com o comportamento desejado, evitando uma série de erros
    * faço isso pois no "index.php" chamo meu método avalia (que passa valores para meu atributo notas, ou seja, comportamento fixo e filtrado, não permito que altere/delete a qualquer momento o valor do campo $notas, apenas que inclua, pois é isso que meu método publico "avalia" faz)
    * logo após, em "index.php" também, chamo meu método "media" que realiza a soma e calcula a média das notas presentes em $notas, mais uma vez, um COMPORTAMENTO ESPERADO E CONTROLADO POR MIM, fazendo exatamente o que eu quero, não manipulando o atributo livremente ao bel prazer do usuário
    * esse é o intuito do uso de atributos privados que compreendi, você irá usa-los de formas diferentes, desde valores fixos até permitir que recebão valores de fora, porém por meios seguros, como os "métodos", igual no exemplo que utilizamos agora onde permito manipular os valores de $notas de dentro da classe e o único comportamenteo que "permito"/é "publico" é o de inserção, que não é tão público assim pois, em um método eu passo valores para o atributo $notas através de um parâmetro do método "avalia" e depois, por estar dentro da classe e poder fazer isso, no outro método, eu apenas faço a soma de todos os valores presentes no array $notas e divido esse valor pela quantidade de itens que esse mesmo array ($notas) possui
    * motivo importantisso e talvez até o principal para que os atributos sejam privados e possuam um get/setter cada um, é que, pensando na regra de negócio que o meu sistema tem/poderá ter, é o método mais seguro e eficiente (mas por que?) pelo simples fato de que, caso eu queira que no meu sistema de filmes, não haja nomes de filmes com palavrão, sem letras maiúsculas ou até mesmo sem números, eu posso simplesmente alterar o meu método de "setter" para adicionar minhas verificações e requisições para aquele filme ser setado/definido de fato sabe? pois, apenas imagine, como isso seria feito caso o atributo fosse publico e pudesse ser alterado em qualquer outro arquivo? todo lugar q tem uma setagem de filme em outros arquivos precisaria passar por essa verificação, seria um trabalho bem mais manual e complicado
    * atualização sobre informação que coloquei acima: inicializei meu array notas como vazio, porém, após a criação/aprendizado sobre construtores, o instrutor do video comentou que possui como prática definir quaisquer tipos de valores dentro do próprio construtor, independente se será vazio, ou não, logo, não deixarei a definição de $notas como um array vazio aqui, e sim, dentro do meu construtor para se acostumar com a prática de mercado dos programadores
    */
    private array $notas;

    /*
    * método construtor
    * método chamado AUTOMATICAMENTE após a criação/instanciação de um objeto a partir desta classe 
    * todo método chamado automaticamente em php começa com a sigla "__" antes de seu nome
    * não se pode definir um retorno no método construtor (logo, ele será omitido e não colocaremos)
    * um método construtor não retorna nada (não pode ter um return dentro dele), logo, ele possui um comportamento de subrotina, apenas EXECUTA o que está dentro de seu escopo no momento de construção (pois seu retorno é meio que explicíto, pois basicamente o "retorno" é o objeto criado, atribuindo valores para seus atributos/propriedades a partir dos parâmetros que ele recebeu, que foram passados no momento de criação do objeto no arquivo que criou este objeto), qualquer inicialização de propriedade/atributo é alocada no método construtor
    */

    public function __construct(string $nome, int $anoLancamento, string $genero)
    {
        $this->nome = $nome;
        $this->anoLancamento = $anoLancamento;
        $this->genero = $genero;
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
