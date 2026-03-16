<?php

class Titulo
{
    // classe "Titulo" que vai possuir as características em comum tanto da classe "Filme" quanto da classe "Serie", pois, eles tem muita coisa em comum e sem esse método que usaremos aqui, teriamos que repetir muito código, o que, pensando em boas práticas e no futuro, não é uma ação recomendada (pois, caso fique duplicando código, caso nossa regra de negócio mude ou aquela (por exemplo) método de problema ou precise de reestrutruração? teria que mudar tudo manualmente, o que pode causar um caos e mais problemas, dessa forma que faremos, caso precise alteramos apenas em um lugar e todos os outros lugares que possuem vínculo serão atingidos automaticamente)
    // aqui apenas os atributos e métodos essenciais/em comum entre as classes Filme e Serie, o resto, elas aplicarão depois/em seus próprios arquivos
    // aqui a nossa Série "é um título" e nosso filme também é um "título" pois eles serão como "filho" da nossa classe titulo, herdando suas caracteristicas e ações (metodos) mas também tendo suas próprias características
    private array $notas;
    /*
    * método construtor
    * método chamado AUTOMATICAMENTE após a criação/instanciação de um objeto a partir desta classe 
    * todo método chamado automaticamente em php começa com a sigla "__" antes de seu nome
    * não se pode definir um retorno no método construtor (logo, ele será omitido e não colocaremos)
    * um método construtor não retorna nada (não pode ter um return dentro dele), logo, ele possui um comportamento de subrotina, apenas EXECUTA o que está dentro de seu escopo no momento de construção (pois seu retorno é meio que explicíto, pois basicamente o "retorno" é o objeto criado, atribuindo valores para seus atributos/propriedades a partir dos parâmetros que ele recebeu, que foram passados no momento de criação do objeto no arquivo que criou este objeto), qualquer inicialização de propriedade/atributo é alocada no método construtor
    * para não ficar repetitivo como estava logo acima, onde, definimos os atributos, depois, pediamos parâmetros e ai sim passavamos os valores dos parâmetros para os atributos/propriedades, seria mais interessante facilitar este processo, onde o php nos permite indicar que, os "parâmetros" do método construtor serão promovidos a propriedaedes/atributos no momento em que o método construtor for chamado a primeira vez, assim evitando repetição de código, e o jeito de se fazer isso é muito simples! apenas colocar o modificador de acesso no parâmetro que irá virar nosso atributo, como abaixo: "private string $nome", pronto, ao ser inicializado, ele já será considerado uma atributo diretamente, logo não é necessário o código que tinhamos antes de: "$this-nome = $nome; $this->anoLancamento = $anoLancamento..." para setar os valores de cada atributo pois agora que nossos parâmetros viraram nossos atributos, isso já será feito automaticamente - isso só acontece no construtor - todos os parâmetros que virarão atributos/propriedades precisam estar com a tipagem definida (se é string, int, float...) para que as IDE não reclamem e evite problemas ao decorrer do sistema
    * na prática, essas propriedades são apenas de leitura (mas por que?), pois, após informadas na sua construção, elas não podem ser alteradas (sem contar com $notas, pois sempre posso inserir uma nota a mais, logo, estou modificando ela), porém o restante é apenas de leitura, pois após serem definidas na instância do objeto, elas apenas podem ser "lidas/visualizadas" através do método "get" (que temos até então) - chamamos esse conceito de "readonly", que também é uma palavra reservada no php, que serve para informar que certas propriedades só vão ter acesso de leitura (após serem escritas/definidas uma vez, não podem ser escritas/definidas/alteradas em nenhum outro momento), logo, como é um atributo privado, ele terá de ser modificado dentro da própria classe, porém ao tentar executar em um metódo privado esta linha: $this->nome = 'teste'; me retornará um erro no terminal devido a palavra reservada "readonly" atribuida ao meu atributo/propriedade $nome, e todos os atributos/propriedades com essa palavra reservada atribuida, podem ter seus valores definidos apenas uma vez (no caso, no seu momento de construção/instância do objeto a partir desta classe que estamos)
    * tornando os atributos públicos, pois como explicado acima, a palavra reservada readonly permite que o atributo seja escrito APENAS UMA VEZ, logo é impossível reescrever o contéudo delas mesmo de dentro da nossa classe (coisa que era permitida apenas com atributos privados sem essa palavra) logo, já que é IMPOSSIVEL os valores dos atributos/propriedades serem alterados após serem definidos a primeira vez, por que nãoe deixa-los publicos para facilitar o acesso deles no código normal? exatamente o que fizemos aqui, tornando-os publicos, podemos acessa-los de qualquer arquivo, logo, não tem mais a necessidade dos getters (métodos de acesso utilizados para acessar o valor de atributos privados, como não temos mais atributos privados, não precisamos mais deles, logo, serão removidos deste código aqui) 
    * inicialização dessas propriedades devem ser feitas dentro da classe em que foram criadas (não posso simplesmente criar, por exemplo o atributo nome fora de um construtor com a palavra readonly e atribuir o valor a ele no escopo global(ou seja, em outro arquivo), por mais que o valor esteja sendo definido pela primeira vez, no escopo global é a forma incorreta, deve ser feito na classe de origem)
    * devido ao fato de que o nosso atributo "$genero" tem uma possibilidade finita de valores, nos podemos encapsular/padronizar isso melhor, pois, por que deixar para o usuário decidir se, usando como base uma regra de negócios comum, não existem tantos genêros assim? (e orra, qual a chance de surgir um novo? mesmo surgindo, so acrescentarmos aqui), podemos facilitar o preenchimento do valor de genêro utilizando "enum" (ou seja, iremos enumerar os nossos genêros, onde, por exemplo o número 1 pode ser: "ação", o 2: "comédia" e assim por diante), onde a estruturação dele ficará no arquivo "Genero.php" 
    * agora meu atributo $genero é do tipo "Genero", assim passarei um valor do mesmo tipo para ele durante a instanciação do objeto no escopo global do sistema
    *essas anotações acima estavem em "filme" porém a regra das coisas veio para cá, logo, os comentários também
    */
    public function __construct(public readonly string $nome, public readonly int $anoLancamento, public readonly Genero $genero)
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

    // é necessário deixar essa estrutura padrão com o "return 0" (conhecido como "implementação falsa") para que o método exista respeitando o limite que colocamos de : "este método irá retornar um valor do tipo inteiro", caso contrário, se não tivesse esse "return 0", o php reclamaria que o método não está retornando nada, quebrando a aplicação, deixamos esse return 0 apenas para respeitar a estrutura do método, porém, ele será sobrescrito nas classes filhas (filme e série) para que cada uma retorne o valor correto de duração em minutos, logo fica claro que este método aqui, da clase Titulo, não será utilizado diretamente, apenas servirá como base para as classes filhas
    public  function duracaoEmMinutos(): int
    {
        return 0;
    }
}
