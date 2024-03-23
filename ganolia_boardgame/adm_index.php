<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/ganolia_boardgame/guia_personagem.css">
    <title>Document</title>
</head>
<body>
    <a href="adm_espada.php">Espadas</a>
    <br>
    <a href="adm_espada_inativa.php">Espadas Inativas</a>
    <br>

    <form action="adm_limpar_historico.php" method="POST">
    <input type="hidden" name="acao" value="limpar">
    <button type="submit">Limpar Historico</button>
    </form>

    <br>
    <a href="index.php">Voltar</a>
</body>
</html>
