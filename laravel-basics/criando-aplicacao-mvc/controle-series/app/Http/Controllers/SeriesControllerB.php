<?php

namespace App\Http\Controllers;

use App\Models\Serie;
// classe "Request" é uma classe do Laravel que representa uma requisição HTTP feita pelo cliente, ela encapsula todas as informações relacionadas a essa requisição, como os dados enviados, os parâmetros da URL, os cabeçalhos, entre outros. Ela é usada para acessar e manipular os dados da requisição de forma fácil e organizada dentro dos controladores do Laravel.
// classe já é importada automaticamente ao gerarmos um controller via linha de comando (terminal), pois o controller em si (como descrito no Notion) recebe uma requisição (Request) e retorna uma resposta (Response), então sempre que falamos de Http no geral, esse é o comportamento esperado de um controller (tanto que os controllers (ou controladores em portugues) no laravel ficam dentro da pasta Http, para ilustrar isso melhor)
use Illuminate\Http\Request;

// todo controller que criamos é um "Controller" ou seja, eles extedem da classe "Controller", são classes filhas do mesmo e tem acesso a tudo o que ele tem (métodos, atributos, constantes....) - "Controller" é uma super classe
class SeriesControllerB extends Controller
{
    // logo, como descrito acima, aqui estaremos recebdno uma requisição por parâmetro, que nos permite obter várias informações da requisição, como: URL, detalhes da queryString, input que viria de um formulário e etc, logo, também podemos retornar uma resposta (Response)
    // public function index(Request $request): string
    // {
    //     $series = [
    //         "Arcane",
    //         "Haikyuu",
    //         "You"
    //     ];
    //     $html = '<ul>';
    //     foreach ($series as $serie) {
    //          $html .= "<li>$serie</li>" onde o operador de atribuição ".=" é em PHP uma atribuidor de atribuição de concatenação, ou seja, ele concatena o valor a direita ao final do valor a esquerda, ou seja, concatena "<li>$serie</li>" (valor a direita) com o final do valor a esquerda ($html), utilizada para juntar textos, construir strings longas ou adicionar textos ou elementos HTML 
    //         $html .= "<li>$serie</li>";
    //     }
    //     $html .= '</ul>';

    //     return $html;
    // }

    public function index(){
        // devido ao Eloquent, nos será trazido uma "Collection" == lista de resultados/dados do banco (porém, com poderes extras, é um objeto com vários métodos prontos(como where, select...)), exemplificando melhor, é um "array" melhorado, onde nos traz objeto/objetos que possuem funções para manipulações desses dados do banco (pois como é uma lista de dados do banco (como por ex a linha abaixo: $series = Serie::all(), o valor de $serie é uma lista de dados do banco, possui TODAS as séries do banco ou seja == Collection onde cada registro, ou seja, cada "$serie" dentro de "$series" possuem funções para manipular livremente esses dados que elas possuem))
        // array comum == só guarda dados
        // Collection == guarda dados + tem funções úteis ($series->first(), $series->where(......), $series->count() e etc)
        // fora que caso nos apliquemos um dd($series) == var_dump melhorado, iremos ver que o retorno de cada série será apontado como Collection e além da propriedade "nome" que inserimos na nossa tabela "series" também virá uma série de itens/propriedades de conexão com o banco de dados
        // $series = Serie::all();
        // model do Eloquen ORM me permite um query builder == construtor de queries (como orderBy e outras funcionalidades vistas geralmente em consultas SQL) para que eu possa ordenar TODAS as séries do banco de dados pelo campo 'nome' de forma ascendente (ou seja, alfabetica, A-Z) e por fim pegando o resultando dessa consulta no banco e retornando para a váriavel/objeto $series com o método get()
        $series = Serie::query()->orderBy('nome', 'asc')->get();
        // função view busca um arquivo de visualização(== view) e dessa view monta a resposta (view) do nosso conteúdo da resposta (Response), é como se pegasse aquele HTML (escrito na view que passamos de parâmetro para a função view aqui em nosso return) e retornasse a string, logo, como já anotamos, quando o laravel recebe um retorno de string, ele coloca isso no retorno da resposta, precisamos apenas colocar o nome da view (que ele já sabera procurar na pasta resources/views) que ele achará (a não ser, claro, que se estiver dentro de views dentro de outra pasta, ai temos de informa-la nas '' juntamente da view)
        // como queremos passar nosso array de series, informamos o segundo parâmetro da função view ($data, que por padrão, vem com o valor null e é do tipo array), como é um array, abrimos colchetes e informamos o nome da váriavel que será criada na view, dentro de '' e logo após a flecha => informamos o nome da váriavel DENTRO DO CONTROLLER que terá seu valor passado para o nome informado em '' antes da flecha =>
        // return view('index', [
        //     'series' => $series
        // ]);
        // função compact é igual ao trecho acima: ['series' => $series], onde o parâmetro passado em ''(aqui == 'series') será o nome da váriavel que será criada na view e procurará no CONTROLLER uma váriavel com o mesmo nome que passamos em ''(aqui == 'series'), ou seja, achará nosso array $series, e criará uma variavel na view chamada '$series' para ser acessada e manipulada ao nosso bel prazer
        // logo, passamos ela como segundo parâmetro da função view, logo, quando este controller for chamado (através da rota, na pasta Routes/webp.php) ele irá retornar a view index passando o array existente no nosso controller (com a assinatura de index) chamado series com o nome de series na view
        return view('series.index', compact('series'));
    }

    public function create() {
        return view('series.create');
    }

    public function store(Request $request) {
        // meu parâmetro $request (do tipo Request) guarda os valores passados pelo formulário na requisição que ele recebeu, logo, ele possui os valores dos campos do formulário submetido, sendo um deles o campo que procuramos: 'nome', que é o nome da nossa série, onde através do método "input" temos acesso ao campo que colocarmos nas suas ('')
        // aqui estou pegando o nome da séris (ainda não foi inserido no banco de dados)
        $nomeSerie = $request->input('nome');
        // criando uma nova série, ou seja, instanciando um objeto do tipo serie (algo que tenha TODOS os atributos de uma série para que assim eu possa definir o valor de suas propriedades que vieram da minha requisição)
        $serie = new Serie();
        // definindo o valor da propriedade "nome" da minha nova série como o valor da váriavel acima ($nomeSerie) que seu valor é o que recebemos da nossa requisição (o valor que nos passaram via formulário)
        $serie->nome = $nomeSerie;
        // dizendo para a série se auto salvar no banco de dados como: serie! se salve no banco - coisa que, assim, atualiza o registro na nossa tabela, tendo nossa nova série lá
        // também preenchendo os nossos campos "timestaps" (created_at e updated_at)
        $serie->save();
        // após inserir no banco de dados, redireciono a página que o usuário está (através do metodo redirect) para home ou seja para /series, igual passado no parâmetro do método redirect
        return redirect('/series');
    }
}
