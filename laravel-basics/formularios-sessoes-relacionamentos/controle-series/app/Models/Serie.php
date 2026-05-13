<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Override;

// quando temos uma Model do Eloquente ORM (como está aqui (serie)) ela é mapeada/configurada/direcionada para uma tabela do banco, logo, se eu tenho uma Model/Classe chamada: Serie(como está aqui) o Eloquent ORM vai procurar uma tabela do banco com o nome: "series" (sim, no plural e dentro de database/migrations/nomeDaMigrationQueBateComNomeDoModelELoquentORM), porém em uma situação onde temos uma tabela chamada: seriados, poderiamos ter a linha: protected $table = 'nomeDaTabelaAqui' (ou seja, protected $table = 'seriados'), pois não teria como ele colocar 'seriados' no plural na hora da busca assim como ele fez com "serie" que ao invés de buscar "serie" buscaria "series"
// esta classe extende Model, logo, ela É UM MODEL (consequentemente, existem vários métodos que podemos utilizar)
// essa classe representa uma série, sabe se salvar no banco de dados (exemplo do método store em SeriesController na linha: $serie->save() onde salva todas suas informações no banco) e permite que executemos consultas (como no método index, onde trazemos TODAS as séries do banco e as listamos: $series->Serie::all() - assim retornando uma collection com todas as séries existentes no banco)
// podemos utilizar query builder nessa nossa entidade também (query builer == criador de query, ou seja, algo que nos permite montar consultar como trazer séries ordenadas pelo nome: $series = Serie::query()->orderBy('nome') trazendo as séries ordenadas pelo campo NOME e podendo personalizar mais, como: ordem crescente (asc) ou descrescente (desc), como $series = Serie::query()->orderBy('nome', 'desc')) que no fim das contas retorna uma query para a váriavel $series onde para eu executar essa query e pegar as informações dela (trazer todas as séries do banco ordenas pelo nome de forma ascendente == ordem alfabética == A-Z) preciso aplicar o ->get() para pegar/buscar esse resultado e retornar uma Collection com todos esses dados pra a váriavel $series, ficando: $series = Serie::query()->orderBy('nome', 'asc')->get(); (fiando em ordem alfabetica)
// logo, com a mesma classe (Serie), consigo criar queries/querys/consultas no banco ($series = Serie::query()->orderBy('nome', 'asc')->get()), inserir dados no banco ($serie->save()) e consigo representar um objeto do meu domínio ($serie = new Serie())
class Serie extends Model
{
    // propriedade protegida chamada "$fillable" que nos pede para informar quais campos do nosso model (== tabela series) podem receber "mass assignement", ou seja, inserção de dados em massa, onde nos permitirá usar métodos do nosso model que nos permitem esse tipo de comportamento como Serie::create([]) que faz uma inserção de dados em massa, diferente do que vimos no outro curso: $serie->save() que não faz isso, se não teriamos sido barrados com um erro pedindo que informassemos o "token" (como acontece caso tentarmos usar Serie::create([]) sem a propriedade $fillable definida corretamente em nosso model nas PROPRIEDADES DA NOSSA TABELA que podem receber inserção em massa de dados) 
    protected $fillable = [
        "nome"
    ];
    // este atributo protegido chamado with vai permitir que passemos para ele um array, onde cada posićão dele vai representar um relacionamento relacionado a nossa Model Serie, como podemos ver abaixo, a forma de passar esse relacionamento é chamando o MÉTODO de relacionamento que a model atual tem, no caso da Model atual, o nome de método de relacionamento é temporadas, e toda vez que carregarmos as informaćões de uma $serie, queremos trazer as temporadas junto e evitar ficar fazendo consultas e requisićões sempre a partir da série para ficar pegando suas temporadas, ao carregar uma série, carrega junto suas temporadas
    protected $with = ['temporadas'];

    // método de relacionamento, onde o nome do método é o nome que eu quero usar para ACESSAR esse relacionamento em CADA instância (objeto) da classe Serie, logo, seria algo como: $serieUm->temporadas()
    // lógica: para cada série, eu quero poder acessar as temporadas que ela têm
    public function temporadas()
    {
        // este método de relacionamento precisa RETORNAR ALGUMA forma de relacionamento (1:1, 1:N, N:N etc..)
        // aqui, uma série TEM várias temporadas e VÁRIAS temporadas TEM uma série
        // $this == ESSA SERIE (serie atual, do objeto que chamar este método)
        // hasMany == TEM MUITAS(Aqui, O QUE ela tem muitas, no caso, ela tem MUITAS 'Season' == temporadas, ou seja, cada série PODE ter MUITOS vínculos em da classe/modelo Season == temporada)
        // resumo da linha abaixo: está dizendo que a classe/modelo Series tem um relacionamento com a classe Season, do tipo: 1 para muitos (1:N), onde UMA série possui VÁRIAS temporadas
        // como segundo parâmetro, podemos passar qual o nome da chave estrangeira que estará presente na tabela/classe/modelo 'Season', chave estrangeira, campo do tipo inteiro que irá representar a minha série atual (série que está chamando este método de relacionamento aqui: temporadas, logo, cada campo 'series_id' tem vínculo com a nossa tabela/classe/model Serie e TODAS a informaćoes na mesma linha de qualquer campo "series_id" (campo que estamos referenciando/criando na linha abaixo) também "pertencerão" a série com o mesmo id na tabela series)
        // caso queiramos que nosso segundo parâmetro (series_id, vulgo: coluna que será criada na tabela/classe/modelo Season) para o método hasMany referenciasse uma coluna que JÁ EXISTE na nossa tabela ATUAL que está criado o relacionamento (Serie) basta apenas passarmos um terceiro parâmetro dizendo qual o nome da coluna, onde no nosso caso PODERIAMOS referenciar apenas a nossa chave primária (da tabela series) que por padrão, se chama: id
        return $this->hasMany(Season::class, 'series_id');
    }

    // sempre que for "Buscar as séries, sempre que for encontrar algumas séries, faća um ESCOPO de busca", como por exemplo, sempre que for buscar QUALQUER tipo de série que possua vínculo com o arquivo Model "Serie" traga em ordem alfabética e o nome dessa técnica é justamente: escopo
    // escopos locais == quero pegar as séries DESSE ESCOPO QUE EU ESPEFICAR
    // método booted vai fazer com que quando esta model (Serie) estiver sendo inicializada eu adicione este escopo, no nosso caso será um escopo GLOBAL, logo, não preciso especificar nenhum, será como uma "regra geral da classe" 
    #[Override]
    protected static function booted()
    {
        // podemos passar um nome para este escopo, mas não precisamos, logo, quando não definimos um nome, estamos criando um escopo ANÔNIMO, mas aqui, vamos definir com: 'ordered', logo, o segundo parâmetro é uma funćão anônima que vai CONFIGURAR o meu escopo, que, por padrão, recebe um queryBuilder
        self::addGlobalScope('ordered', function (Builder $queryBuilder) {
            // aqui, aplicamos uma query através do noss parâmetro/variável $queryBuilder que ordena TODAS as vezes que realizarmos qualquer busca no Model Serie através do campo nome (por padrão, em ordem alfabética mas podendo ser alterado para outras formas) com a linha: $queryBuilder->orderBy('nome')
            $queryBuilder->orderBy('nome');
        });
    }
}
