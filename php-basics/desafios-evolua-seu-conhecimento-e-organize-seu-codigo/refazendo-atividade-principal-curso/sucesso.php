<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensagem de Sucesso</title>
</head>
<body>
    <h1>Sucesso! Série <?php echo $_GET['nomeSerie']?> inserida com sucesso</h1>
    <h2>Informações complementares:</h2>
    <ul>
        <li>Ano De Lançamento: <?php echo $_GET['anoLancamento'] ?></li>
        <li>Nota Média: <?php echo $_GET['nota'] ?></li>
        <li>Gênero: <?php echo $_GET['genero'] ?></li>
    </ul>
</body>
</html>