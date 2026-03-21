<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// quando temos uma Model do Eloquente ORM (como está aqui (serie)) ela é mapeada/configurada/direcionada para uma tabela do banco, logo, se eu tenho uma Model/Classe chamada: Serie(como está aqui) o Eloquent ORM vai procurar uma tabela do banco com o nome: "series" (sim, no plural e dentro de database/migrations/nomeDaMigrationQueBateComNomeDoModelELoquentORM), porém em uma situação onde temos uma tabela chamada: seriados, poderiamos ter a linha: protected $table = 'nomeDaTabelaAqui' (ou seja, protected $table = 'seriados'), pois não teria como ele colocar 'seriados' no plural na hora da busca assim como ele fez com "serie" que ao invés de buscar "serie" buscaria "series"
// esta classe extende Model, logo, ela É UM MODEL (consequentemente, existem vários métodos que podemos utilizar)
class Serie extends Model
{
    //
}
