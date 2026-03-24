<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{SeriesController};
// utilizo a classe "Route" + :: + verbo http que espero receber aquela requisição (no nosso caso, como estamos acessando direto no navegador (acessando a rota no caso através do navegador, onde após o "dominio" == por padrão é nosso localhost + porta 8000 e incluindo "/" que o primeiro parâmetro que este método get pede, temos acesso a view "welcome" que se encontra dentro do corpo da função passada como segundo parâmetro) GET)
// POST = para receber dados de um formulário
// caso fosse API = posso usar todos os verbos HTTP
Route::get('/', function () {
    // devolvendo/retornando uma resposta de redirecionamento para a minha rota "series.index", que chama o método "index" do controller series, a sintaxe abaixo é a mais "amigavel/profissional" quando queremos utilizar rotas + apelidos (abaixo estamos chamando a rota pelo seu apelido == series.index) 
    return redirect()->route('series.index');
});

// criamos uma rota e a partir dela podemos executar qualquer código PHP (caso queira criar todo o sistema de forma procedural ali dentro, eu consigo), no caso abaixo acessamos a classe Route, chamamos o método get(um dos verbos http), passamos como parâmetro a url que virá após nosso "dominio" para acesso ao código PHP que tera o corpo da função do segundo parâmetro (poderiamos retornar uma view ao acessar essa rota, mas estamos exibindo o texto "ola mundo" com um echo) e como descrito antes, um segundo parâmetro que é uma função anônima que executa um echo com o texto "ola mundo"
// ao acessar essa rota nos será devolvido uma página em branco (basicamente um html caso vá ver no f12) com o nosso texto escrito
// Route::get('/ola', function (){
//     echo "ola mundo";
// });

// queremos utilizar o método da classe "SeriesController" quando a nossa rota (do tipo get) for chamada, então, primeiro criamos um array, onde a primeira posição é a classe que vamos usar (com essa sintaxe mesmo, SeriesController::class, para definir que usaremos esta classe nessa rota/que chamaremos um método dessa classe como segunda posição do nosso array) e o segundo o método que iremos chamar da mesma
// por fim, de segunda posição do nosso array (1), o nome do método que será chamado da nossa classe na primeira posição (0) 
// Route::get("/series", [SeriesController::class,'index']);

// linha abaixo, meio muito UTIL de simplificar definição de rotas, pesquisar na doc ou jogar no chat para melhor implementação do mesmo
// Route::resource('/series', SeriesController::class);

// através do método estático controller de "Route" (== Route::controller), nós conseguimos agrupar as rotas por controller, onde passando por parâmetro para o método estatico "controller" de Route QUAL CONTROLLER iremos agrupar e depois usamos o método "group" passando como parâmetro uma função anônima onde, seu corpo irá ter as rotas (url's de cada uma e QUAL método do "controller pai" irá disparar, como por exemplo, a primeira rota: Route::get("/series", 'index')), na rota "/series" na URL irá chamar o método 'index' do "controller pai" == SeriesController (como definimos na linha 26 com: Route::controller(SeriesController::class)->group(function() { rotas aqui }))
Route::controller(SeriesController::class)->group(function () {
    Route::get("/series", 'index')->name('series.index');
    Route::get("/series/criar", 'create')->name('series.create'); // por exemplo, caso a url para esta rota mude (atual: /series/criar e mude para: /series/create, teria de acessar TODAS as rotas que tinham /series/criar e alterar para /series/create, o que seria meio trabalhoso? não? por isso, vem o conveito a seguir chamado de "rotas nomeadas"), não quero ter que ter todo esse trabalho, logo, podemos adicionar um apelido para está rota, onde, em cada lugar que chamava a rota: "/series/criar" apenas chamamos o apelido novo: 'series.create', que definimos no método "->name('apelidoDaRotaAqui')", onde, por padrão usamos essa convenção para definir apelidos: ->name(nomeGeralRota/prefixoDaPalavraControllerNoControllerResponsavelPorEssaRota.nomeDoMetodoChamadoParaEsta rota) ou seja == ->name('series.create'); // claro, neste caso, nosso conjunto de rotas é baseado em "series" devido a nossa tabela ser chamada series (controller == series e Model Serie) e depois o método que aquela rota ali está disparando
    Route::post("/series/salvar", 'store')->name('series.store');
});
