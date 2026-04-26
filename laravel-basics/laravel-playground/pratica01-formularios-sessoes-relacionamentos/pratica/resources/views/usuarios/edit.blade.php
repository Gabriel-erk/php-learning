<x-layout title="Editar - Usuários">
    <div id="titulo" class="d-flex justify-content-between mb-3">
        <h2>Atualização de Usuários</h2>
    </div>
    <form action="{{ route('usuarios.update', $usuario['id']) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ $usuario['nome'] }}">
        </div>

        <div class="mb-3">
            <label for="sobrenome" class="form-label">Sobrenome</label>
            <input type="text" class="form-control" id="sobrenome" name="sobrenome" value="{{ $usuario['sobrenome'] }}">
        </div>

        <div class="mb-3">
            <label for="inputPassword5" class="form-label">Password</label>
            <input type="password" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock"
                name="senha" value="{{ $usuario['senha'] }}">
            <div id="passwordHelpBlock" class="form-text">
                Your password must be 6-20 characters long, contain letters and numbers, and must not contain spaces,
                special characters, or emoji.
            </div>
        </div>

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com"
                name="email" value="{{ $usuario['email'] }}">
        </div>

        <div class="mb-3">
            <label for="celular" class="form-label">Celular</label>
            <input type="tel" class="form-control" id="celular" name="celular" placeholder="Número de celular" value="{{ $usuario['celular'] }}">
        </div>
        
        <div class="mt-4 d-flex gap-2">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('filmes.index') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </form>
</x-layout>
