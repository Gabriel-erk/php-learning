<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// quando temos uma Model do Eloquente ORM (como está aqui (serie)) ela é mapeada/configurada/direcionada para uma tabela do banco, logo, se eu tenho uma Model/Classe chamada: Serie(como está aqui) o Eloquent ORM vai procurar uma tabela do banco com o nome: "series" (sim, no plural e dentro de database/migrations/nomeDaMigrationQueBateComNomeDoModelELoquentORM), porém em uma situação onde temos uma tabela chamada: seriados, poderiamos ter a linha: protected $table = 'nomeDaTabelaAqui' (ou seja, protected $table = 'seriados'), pois não teria como ele colocar 'seriados' no plural na hora da busca assim como ele fez com "serie" que ao invés de buscar "serie" buscaria "series"
// esta classe extende Model, logo, ela É UM MODEL (consequentemente, existem vários métodos que podemos utilizar)
// essa classe representa uma série, sabe se salvar no banco de dados (exemplo do método store em SeriesController na linha: $serie->save() onde salva todas suas informações no banco) e permite que executemos consultas (como no método index, onde trazemos TODAS as séries do banco e as listamos: $series->Serie::all() - assim retornando uma collection com todas as séries existentes no banco)
// podemos utilizar query builder nessa nossa entidade também (query builer == criador de query, ou seja, algo que nos permite montar consultar como trazer séries ordenadas pelo nome: $series = Serie::query()->orderBy('nome') trazendo as séries ordenadas pelo campo NOME e podendo personalizar mais, como: ordem crescente (asc) ou descrescente (desc), como $series = Serie::query()->orderBy('nome', 'desc')) que no fim das contas retorna uma query para a váriavel $series onde para eu executar essa query e pegar as informações dela (trazer todas as séries do banco ordenas pelo nome de forma ascendente == ordem alfabética == A-Z) preciso aplicar o ->get() para pegar/buscar esse resultado e retornar uma Collection com todos esses dados pra a váriavel $series, ficando: $series = Serie::query()->orderBy('nome', 'asc')->get(); (fiando em ordem alfabetica)
// logo, com a mesma classe (Serie), consigo criar queries/querys/consultas no banco ($series = Serie::query()->orderBy('nome', 'asc')->get()), inserir dados no banco ($serie->save()) e consigo representar um objeto do meu domínio ($serie = new Serie())
class Serie extends Model
{
    //
}
