<?php

use Illuminate\Support\Facades\Route;
// utilizo a classe "Route" + :: + verbo http que espero receber aquela requisição (no nosso caso, como estamos acessando direto no navegador (acessando a rota no caso através do navegador, onde após o "dominio" == por padrão é nosso localhost + porta 8000 e incluindo "/" que o primeiro parâmetro que este método get pede, temos acesso a view "welcome" que se encontra dentro do corpo da função passada como segundo parâmetro) GET)
// POST = para receber dados de um formulário
// caso fosse API = posso usar todos os verbos HTTP
Route::get('/', function () {
    return view('welcome');
});

// criamos uma rota e a partir dela podemos executar qualquer código PHP (caso queira criar todo o sistema de forma procedural ali dentro, eu consigo), no caso abaixo acessamos a classe Route, chamamos o método get(um dos verbos http), passamos como parâmetro a url que virá após nosso "dominio" para acesso ao código PHP que tera o corpo da função do segundo parâmetro (poderiamos retornar uma view ao acessar essa rota, mas estamos exibindo o texto "ola mundo" com um echo) e como descrito antes, um segundo parâmetro que é uma função anônima que executa um echo com o texto "ola mundo"
// ao acessar essa rota nos será devolvido uma página em branco (basicamente um html caso vá ver no f12) com o nosso texto escrito
Route::get('/ola', function (){
    echo "ola mundo";
});