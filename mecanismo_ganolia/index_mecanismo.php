<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>MecanismoG</title>
    <style>
        button {
            padding: 10px 20px;
            background-color: #191970;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Estilo quando o cursor passa por cima do botão */
        button:hover {
            background-color: #4169E1;
        }
</style>

</head>
<body>
    <h2>Atacando</h2>
    <form action="processar_ataque.php" method="post">
    <label for="">Selecione o ID do Item Ofensivo:</label>
    <input type="text" id="codigoItemAtaque">
    <button type="button" onclick="buscarItemAtaque()">Buscar</button>
    <br><br>
    <img id="imagemItemAtaque" src="" class="img-enviado" width="30" height="30" style="display: none;">
    <div id="resultadoConsulta"></div>
    <br><br>
    </form>

    <form action="">
    <input type="hidden" id="codigoItemAtaque">
    <button type="button" style="background-color: #B22222; color: white;" onclick="atacar()">Atacar</button>
    <br><br>
    <div id="resultadoAtaque"></div>
    </form>
    <br><br>

    <h2>Recolhendo Drop</h2>
    <form action="">
    <label for="">Selecione o ID da Criatura:</label>
    <input type="text" id="idCriatura">
    <button type="button" onclick="buscaCriatura()">Buscar</button>
    <br><br>
    <div id="resultadoCriatura"></div>
    <div style="margin-bottom: 10px;"></div>
    <img id="imagemCriatura1" src="" class="img-enviado" width="30" height="30" style="display: none;">
    <div id="nomeDrop1" style="display: none;"></div>
    <img id="imagemCriatura2" src="" class="img-enviado" width="30" height="30" style="display: none;">
    <div id="nomeDrop2" style="display: none;"></div>
    <img id="imagemCriatura3" src="" class="img-enviado" width="30" height="30" style="display: none;">
    <div id="nomeDrop3"  style="display: none;"></div>
    <img id="imagemCriatura4" src="" class="img-enviado" width="30" height="30" style="display: none;">
    <div id="nomeDrop4"  style="display: none;"></div>
    <img id="imagemCriatura5" src="" class="img-enviado" width="30" height="30" style="display: none;">
    <div id="nomeDrop5"  style="display: none;">
</div>

    <br><br></form>

    <form action="">
    <input type="hidden" id="idCriatura">
    <button type="button" onclick="buscaDrop()" style="background-color: #B22222; color: white;">Recolher</button>
    <br><br>
    <img id="imagemDrop" src="" class="img-enviado" width="30" height="30" style="display: none;">
    <div id="resultadoDrop"></div>
    </form>
    <br><br>

    <button type="button" onclick="limpar()">Limpar</button>
    <br>
    <a href="../index.php">V</a>
<script src="../scripts/mecanismo_ganolia.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>