<x-layout title="Cadastro Série">
    <form action="/series/salvar" method="post">
        {{-- sigla importante em todos os formulários ao se trabalhar com laravel para garantir uma camada a mais de segurança e evitar certos tipos de ataques como: forjar requisições para nosso sistema vindo de outro lugar, o @csrf garante que, ao enviarmos essas informaçoes do formulário, que elas REALMENTE vieram desse formulário aqui e não de outro lugar externo --}}
        @csrf
        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" id="nome" class="form-control">
        </div>
        <button type="submit" class="btn btn-dark">Adicionar</button>
    </form>
</x-layout>
