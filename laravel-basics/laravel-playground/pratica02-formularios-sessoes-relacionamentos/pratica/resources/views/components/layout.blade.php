<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard - {{ $title }} ({{ $page }})</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('users.index') }}">SimpleCrud</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('users.index') }}">Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('rooms.index') }}">Rooms</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('reserves.index') }}">Reserves</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="container">

        @if (session('status'))
            <div class="alert alert-success mt-3">
                <div>
                    {{ session('status') }}
                </div>
            </div>
        @endif

        <div class="my-3">

            <div class="{{ $add == true || $back == true ? 'd-flex justify-content-between align-items-center' : '' }}">
                <h1>{{ $title }} - {{ $page }}</h1>

                <a class="{{ $add == true ? '' : 'd-none' }} btn btn-primary h-50"
                    href="{{ $routeAdd != null ? route($routeAdd) : '#' }}">Add</a>

                {{-- esse url previous volta para a última página acessada --}}
                <a class="{{ $back == true ? '' : 'd-none' }} btn btn-primary"
                    href="{{ url()->previous() }}">Voltar</a>
            </div>

        </div>
        {{ $slot }}
    </main>
</body>

</html>
