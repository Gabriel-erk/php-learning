<x-layout title="Cadastro">
    <form action="/series/salvar" method="post">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome da série:</label>
            <input type="text" class="form-control" name="nome" placeholder="informe o nome da série">
        </div>

        <button type="submit" class="btn btn-dark">Adicionar</button>
    </form>
</x-layout>