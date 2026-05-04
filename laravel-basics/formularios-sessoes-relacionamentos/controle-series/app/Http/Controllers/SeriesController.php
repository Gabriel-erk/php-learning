<?php

namespace App\Http\Controllers;

use App\Models\Serie;
// classe "Request" é uma classe do Laravel que representa uma requisição HTTP feita pelo cliente, ela encapsula todas as informações relacionadas a essa requisição, como os dados enviados, os parâmetros da URL, os cabeçalhos, entre outros. Ela é usada para acessar e manipular os dados da requisição de forma fácil e organizada dentro dos controladores do Laravel.
// classe já é importada automaticamente ao gerarmos um controller via linha de comando (terminal), pois o controller em si (como descrito no Notion) recebe uma requisição (Request) e retorna uma resposta (Response), então sempre que falamos de Http no geral, esse é o comportamento esperado de um controller (tanto que os controllers (ou controladores em portugues) no laravel ficam dentro da pasta Http, para ilustrar isso melhor)
use Illuminate\Http\Request;

// todo controller que criamos é um "Controller" ou seja, eles extedem da classe "Controller", são classes filhas do mesmo e tem acesso a tudo o que ele tem (métodos, atributos, constantes....) - "Controller" é uma super classe
class SeriesController extends Controller
{
    public function index()
    {
        $series = Serie::query()->orderBy('nome', 'asc')->get();
        // método que o laravel chama de "helper" que nos permite buscar dados da sessão
        $mensagemSucesso = session('mensagem.sucesso');

        return view('series.index', compact('series', 'mensagemSucesso'));
    }

    public function create()
    {
        return view('series.create');
    }

    public function edit(Serie $series)
    {
        // quando não estou usando em um redirecionamento (to_route, redirect) e sim carregando uma view (com o método view(viewAqui)), ao utilizar o "with" ele permite que eu passe uma váriavel para aquela view com esta sintaxe aqui: with('nomeQueAvariavel/objetoTeraNaview', nomeDaVariavel/ObjetoQueVouPassarParaMinhaView)
        return view('series.edit')->with('serie', $series);
    }

    public function show() {}

    public function store(Request $request)
    {
        // outra forma de acesar um atributo/campo de formulário passado para minha requisição ao apertar um botão do tipo submit fazendo com que o form dispare este métodoa aqui é da forma abaixo (acessando o campo nome com a sintaxe: $request->nomeDoAtributoAqui) 
        // pegando o campo/propriedade "nome" que vem no CORPO da requisição (request)
        // $nomeSerie = $request->nome;
        // $serie = new Serie();
        // $serie->nome = $nomeSerie;

        // para realizarmos a inserção de dados em massa (== passar várias informações de uma vez só para nossa Model, como por ex: preencher mais de um campo da "model" já seria considerado uma inserção de dados em massa) na nossa tabela, o Eloquent nos permite utilizar um método estático chamado create, que recebe um array associativo de parâmetro com todas as propriedades/colunas do db que quero armazenar (por ex, quero preencher o campo nome e genero da minha série == Serie::create([ 'nome' => $request->nome, 'genero' => $request->genero ])), que já vai inserir no banco de dados uma nova série com o nome e o genero que veio em nosso request
        // caso darmos um dd($request) veremos que ele traz um array associativo que mostra o seu corpo (que contém as informações do formulário em um array associativo, onde por ex: input com o name = "nome" com o valor Game of Thrones e um input com o name = "genero" com o valor Ação Medieval, ao clicar no botão do tipo submit dentro da tag html "forms" com um action direcionado para a rota DESTE método que estamos (store em SeriesController) será passado uma requisição para a nossa váriavel no parâmetro DESTE método, e o corpo desta requisição será o VALOR da nossa váriavel de parâmetro ($request) e esse valor estará da seguinte forma: "nome" => "Game of Thrones", "genero" => "Ação Medieval", este será o valor de $request (caso tenha um token (graças ao @csrf que passamos em cada formulário ao utilizar o laravel) ele estará lá também), e então preencherá corretamente o array associativo que devriamos colocar para cada campo da nossa tabela série dentro do array que Serie::create(estouFalandoDesseArrayAquiÒcasoVaVerComOMouseEmcimaDe:Serie::create(VereiQueOvalorPassadoAquiTemQueSerUmArray,Logo,OretornoDe$request->all()éUmArrayComOcampoTokenEnomeOndeNomeFoiPassadoNoFormQueChamaArotaQueDisparaEsteMétodoAqui)) pede, por isso não temos que escrever algo como: Serie::create("nome" => $request->nome) pois a sintax, o corpo de $request->all() já nos entrega isso corretamente (claro, dependendo da estrutura do formulário, se o formulário estiver com os campos corretos/correspondentes ao que minha série precisa para ser criada, irá funcionar, pois não faz sentido eu disparar esse create aqui em um formulário que passaria para minha $request de parâmetro os campos: cidade, uf, rua...pois não tem nada haver com oq o model que está NESSE REQUEST aqui, ele NÃO PRECISA DESSAS CAMPOS NADA HAVER (cidade, uf, ruia....)) )
        // dd($request->all());
        $serie = Serie::create($request->all());
        // $request->session()->flash('mensagem.sucesso', "Série '{$serie->nome}' adicionada com sucesso.");
        // devolvendo/retornando uma resposta de redirecionamento para a minha rota "series.index", que chama o método "index" do controller series, a sintaxe abaixo é a mais "amigavel/profissional" quando queremos utilizar rotas + apelidos (abaixo estamos chamando a rota pelo seu apelido == series.index), da mesma forma que a outra sintax que aprendemos para fazer a mesma coisa: redirect()->route('series.index') porém de uma forma mais simplificada e interessante aqui 
        return to_route('series.index')->with('mensagem.sucesso', "Série '{$serie->nome}' adicionada com sucesso.");
    }

    // através de uma sessão, podemos guardar uma informação temporariamente no servidor, onde ele irá nos devolver um cookie dizendo que a sessão pertence a nós
    // passando o parâmetro to tipo $serie, por debaixo dos panos ele realiza essa linha: Serie::findOrFail($serie), logo, no corpo do método não precisamos dela, pois o laravel já vai encontra-la para nos, e só vai entrar no corpo do método "destroy" se possui um valor como parâmetro do tipo serie (e sempre passamos para o destroy, como parâmetro, um objeto do tipo série)
    // nome do parâmetro aqui, precisa estar alinhado com o nome do parâmetro que a rota que leva até este método pede
    // laravel trás facilidades como: "route model binding" == quando passamos um parâmetro do tipo "model" para um método de um controller, o laravel já se encarrega de buscar a instância dessa model no banco de dados, utilizando o valor passado na rota (que é o id da série) e já nos entrega essa instância/model pronta para ser utilizada dentro do corpo do método, ou seja, não precisamos fazer uma consulta manual para buscar a série pelo id, o laravel já faz isso para nós, basta apenas passarmos o parâmetro do tipo "model" (no caso aqui, "Serie") e o nome do parâmetro (no caso aqui, "$series") que deve ser igual ao nome do parâmetro que a rota pede (no caso aqui, "{series}")
    public function destroy(Serie $series)
    {
        // se essa série aqui existe, ele apaga para nós, se não, não faz nada
        $series->delete();
        // para pegar os dados de uma sessão usamos o método session, que é possivel acessar através de um objeto/variavel do tipo Request, onde em session, tenho acesso a vários outros métodos para trabalhar com uma sesssão
        // em session chamo o método flash, que me permite adicionar normalmente um item de sessão, onde, na próxima atualização da página, vai fazer com que aquela sessão (contendo os valores que armazenei) seja "apagada" da sessão atual automaticamente
        // flash == dado que adiciono na minha sessão que só dura UM request
        // mensagem.sucesso == chave que vou usar para me referenciar a essa sessão, como a sessão que estou passando, o dado que estou passando, é apenas uma mensagem de sucesso, então simplifico para este nome: 'mensagem.sucesso'
        // session()->flash('mensagem.sucesso', "Série '{$series->nome}' removida com sucesso.");

        // ao utilizarmos métodos de redirecionamentos (como o to_route, redirect(), redirect()->route() etc..) nos temos nosso método "with()" que realiza o nosso redirecionamento com a nossa flash message (que faziamos com: $request->flash('mensagem.sucesso', 'mensagemAqui') ou session()->flash('mensagem.sucesso','mensagemAqui')), utilizando quase a mesma sintaxe, então seria: with('nomeDaFlashMessageAqui', 'mensagemDaFlashAqui')
        return to_route('series.index')->with('mensagem.sucesso', "Série '{$series->nome}' removida com sucesso.");
    }
}
