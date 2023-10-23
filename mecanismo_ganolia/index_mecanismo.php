<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MecanismoG</title>
</head>
<body>
<h2>Atacando</h2>
<form action="processar_ataque.php" method="post">
    <label for="idItemOfensivo">Selecione o ID do Item Ofensivo:</label>
    <input type="text" id="codigoItemAtaque">
    <button type="button" onclick="buscarItemAtaque()">Buscar</button>
    <br><br>
    <div id="resultadoConsulta"></div>
    <br><br>
    <label for="idMonstro">Selecione o ID do Monstro:</label>
    <input type="text" name="idMonstro">
    <br><br>
    <button type="submit">Jogar</button>
</form>


<h2>Resultado</h2>
<a href="../index.php">V</a>
<script src="../scripts/mecanismo_ganolia.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>