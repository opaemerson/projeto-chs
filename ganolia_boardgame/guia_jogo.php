<?php
include('../protecao.php');
require_once('../config.php');

$usuarioId = $_SESSION['id'];
$personagemId = $_SESSION['personagem_ganolia'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<<<<<<< HEAD
    <link rel="stylesheet" href="../css/ganolia/ganolia.css">
    <link rel="stylesheet" href="../css/ganolia/tabuleiro.css">
    <script src="./scripts/round.js"></script>
    <script src="./scripts/ganolia_boardgame.js"></script>
    <script src="./scripts/tabuleiro.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
=======
    <link rel="stylesheet" href="../css/ganolia_boardgame/guia_jogo.css">
    <link rel="stylesheet" href="../css/ganolia/index_mecanismo.css">
>>>>>>> 89553a0fc4fa7f3fdd70cb47bd438f818d208e2a
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>Ganolia</title>
</head>
<body>

<div class="container">
<div class="centralizando_esquerda">
    <button class="button" id="ataqueButton" onclick="mostrarAtaque()">Atacar</button>
    <button class="button" id="defesaButton" onclick="mostrarDefesa()">Defesa</button>
    <button class="button" id="recolherButton" onclick="mostrarRecolher()">Recolher</button>
    <button class="button" onclick="limpar()">Limpar</button>
<<<<<<< HEAD
    <button class="button" onclick="sair()">Sair</button>
=======
    <button class="button" id="limparButton" sair onclick="sair()">Sair</button>
>>>>>>> 89553a0fc4fa7f3fdd70cb47bd438f818d208e2a
</div>

<div id="ataque" class="centralizando_direita" style="display: none;">
    <h2>Atacando</h2>
    <label for="">Selecione o ID do Item Ofensivo:</label>
    <input type="text" style="width: 40px;" id="codigoItemAtaque">
    <button type="button" onclick="buscarItemAtaque()">Buscar</button>
    <br><br>
    <img id="imagemItemAtaque" src="" class="img-enviado" width="150" height="220" style="display: none;">
    <div id="resultadoConsulta"></div>

    <input type="hidden" id="codigoItemAtaque">
    <button type="button" style="background-color: #B22222; color: white;" onclick="atacar()">Atacar</button>
    <br><br>
    <div id="resultadoAtaque"></div>
    <br><br>
</div>
    
<div id="defesa" style="display: none;">
    <h2>Defendendo</h2>
    <label for="">Desenvolvendo[...]</label>
</div>


<div id="recolher" style="display: none;">
    <h2>Recolhendo Drop</h2>
    <label for="">Selecione o ID da Criatura:</label>
    <input type="text" style="width: 40px;" id="idCriatura">
    <button type="button" onclick="buscaCriatura()">Buscar</button>
    <br><br>
    <div id="resultadoCriatura"></div>
    <div style="margin-bottom: 10px;"></div>
</div>
<br><br>

<!-- Container que irá mostrar o botão RECOLHER + Imagem do resultado do drop -->
<input type="hidden" id="idCriatura">
<button type="button" onclick="buscaDrop()" style="background-color: #B22222; color: white;">Recolher</button>
<br><br>
<img id="imagemDrop" src="" class="img-enviado" width="180" height="220" style="display: none;">
<div id="resultadoDrop"></div>
</div>
</div>

<!-- DIV de LOG -->
<div class="scrolling-container" id="scrollingContainer">
    <?php
    $sql = "SELECT gh.evento, gp.nome , gp.classe , gp.sessao, gh.horario, gh.item_usado
    from ganolia_historico gh 
    inner join ganolia_personagem gp 
    on gp.id = gh.personagem_id
    order by gh.horario asc";
    $resultado = $conn->query($sql);
    if($resultado){
        while ($row = $resultado->fetch_assoc()) {
            $hora = date('H:i:s', strtotime($row['horario']));
            if ($row['item_usado'] !== ''){
            echo '<div class="">' . '[' . $hora . ']: <b>' . $row['nome'] . '</b> - ' . $row['evento'] . '<br> [' . $hora . ']: ' . ' Item Usado: ' . $row['item_usado'] . '<hr>' . '</div>';
            } 
            else{
            echo '<div class="">' . $row['nome'] . '</b> - ' . $row['evento'] . '<br>' . '<hr>' . '</div>';
            }
        }
    }
    ?>
</div>

<<<<<<< HEAD
<!-- Modal de Ataques -->
<div class="modal" id="modalAtaques">
    <div id="modal-do-ataque">
    </div>
</div>

=======
<script src="./scripts/guia_jogo.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
>>>>>>> 89553a0fc4fa7f3fdd70cb47bd438f818d208e2a
</body>
</html>