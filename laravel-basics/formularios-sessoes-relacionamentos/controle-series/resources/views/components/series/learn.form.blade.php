<x-layout title="Cadastro Série">
    <form action="{{ route('series.store') }}" method="post">
        {{-- sigla importante em todos os formulários ao se trabalhar com laravel para garantir uma camada a mais de segurança e evitar certos tipos de ataques como: forjar requisições para nosso sistema vindo de outro lugar, o @csrf garante que, ao enviarmos essas informaçoes do formulário, que elas REALMENTE vieram desse formulário aqui e não de outro lugar externo --}}
        @csrf
        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            {{-- campo name extremamente importante, pois, sem ele, indicando qual input estou passando para o db, ele não recebe nenhum valor, sem o campo name aqui, mesmo preenchendo o input, ao submeter isso (ao clicar no botão adicionar, nada seria passado, para cada campo de formulário/input responsável por passar valor a um campo da minha tabela no db, é necessário um campo "name" na tag HTML input responsável pelo mesmo, logo, meu campo input "email", precisa do name="email" para quando clicar no botão do tipo submit no meu form ele passar o valor corretamente associando: valor digitado no input com atributo name="email" E associar com minha tabela no banco que possui o campo email, para que ela possa receber e manipular esse valor (adicionando, atualizando, removendo...)) --}}
            <input type="text" id="nome" name="nome" class="form-control">
        </div>
        <button type="submit" class="btn btn-dark">Adicionar</button>
    </form>
</x-layout>
