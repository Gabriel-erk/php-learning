<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MovieFlix - {{ $title }}</title>
</head>
<body>
    <header>
        <nav></nav>
    </header>
    <main class="container">
        {{ $slot }}
    </main>
</body>
</html>