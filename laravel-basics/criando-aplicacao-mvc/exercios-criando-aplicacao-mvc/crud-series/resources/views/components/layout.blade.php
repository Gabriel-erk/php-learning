<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }} - Crud de Séries</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="/series">Crud de séries</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                    aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/series">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/series/criar">Cadastrar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/series/excluir">Excluir</a>
                        </li>
                    </ul>
                    <span class="navbar-text">
                        Sistema de crud de séries.
                    </span>
                </div>
            </div>
        </nav>

    </header>

    <main class="container">
        <h1 class="mt-2">{{ $title }}</h1>

        {{ $slot }}
    </main>
</body>

</html>
