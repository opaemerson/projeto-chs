<?php
include('../protecao.php');
require_once('../config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/ganolia.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>Ganolia</title>

</head>
<body>

<div class="w3-bar w3-black w3-card">
  <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right" href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
  <a href="../index.php" class="w3-bar-item w3-button w3-hover-red w3-padding-large custom-square">VOLTAR </a>
  <a href="./guia.php" class="w3-bar-item w3-button w3-padding-large custom-square" style="text-decoration: none;">MANUAL</a>
  <a href="./guia_territorio.php" class="w3-bar-item w3-button w3-padding-large custom-square" style="text-decoration: none;">TERRITORIOS</a>
  <a href="./guia_item.php" class="w3-bar-item w3-button w3-padding-large custom-square" style="text-decoration: none;">ITENS</a>
  <a href="./guia_personagem2.php" class="w3-bar-item w3-button w3-padding-large custom-square" style="text-decoration: none;">PERSONAGEM</a>
  <?php if (isset($_SESSION['permissao']) && $_SESSION['permissao'] == 'Admin') { ?>
    <a href="./adm_index.php" class="w3-bar-item w3-button w3-hover-yellow w3-padding-large custom-square" style="text-decoration: none;">ADMINISTRACAO</a>
    <?php } ?>
</div>

<div class="sessao">
    <div class="quadro">
    <h2>Atacando</h2>
    <form action="processar_ataque.php" method="post">
    <label for="">Selecione o ID do Item Ofensivo:</label>
    <input type="text" style="width: 40px;" id="codigoItemAtaque">
    <button type="button" onclick="buscarItemAtaque()">Buscar</button>
    <br><br>
    <img id="imagemItemAtaque" src="" class="img-enviado" width="150" height="220" style="display: none;">
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
    
    <h2>Defendendo</h2>
    <form action="processar_ataque.php" method="post">
    <label for="">Desenvolvendo[...]</label>

    <h2>Recolhendo Drop</h2>
    <form action="">
    <label for="">Selecione o ID da Criatura:</label>
    <input type="text" style="width: 40px;" id="idCriatura">
    <button type="button" onclick="buscaCriatura()">Buscar</button>
    <br><br>
    <div id="resultadoCriatura"></div>
    <div style="margin-bottom: 10px;"></div>
    <div class="row">
        <div class="col-md-3">
            <div class="card mt-3">
                <img id="imagemCriatura1" src="" class="img-enviado card-img-top" width="150" height="220" style="display: none;">
                <div class="card-body">
                    <div id="nomeDrop1" style="display: none;"></div>
                    <div id="nomeRaridade1" style="display: none;"></div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mt-3">
                <img id="imagemCriatura2" src="" class="img-enviado card-img-top" width="150" height="220" style="display: none;">
                <div class="card-body">
                    <div id="nomeDrop2" style="display: none;"></div>
                    <div id="nomeRaridade2" style="display: none;"></div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mt-3">
                <img id="imagemCriatura3" src="" class="img-enviado card-img-top" width="150" height="220" style="display: none;">
                <div class="card-body">
                    <div id="nomeDrop3" style="display: none;"></div>
                    <div id="nomeRaridade3" style="display: none;"></div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mt-3">
                <img id="imagemCriatura4" src="" class="img-enviado card-img-top" width="150" height="220" style="display: none;">
                <div class="card-body">
                    <div id="nomeDrop4" style="display: none;"></div>
                    <div id="nomeRaridade4" style="display: none;"></div>
                </div>
            </div>
        </div>
    </div>
    <br><br></form>

    <form action="">
    <input type="hidden" id="idCriatura">
    <button type="button" onclick="buscaDrop()" style="background-color: #B22222; color: white;">Recolher</button>
    <br><br>
    <img id="imagemDrop" src="" class="img-enviado" width="180" height="220" style="display: none;">
    <div id="resultadoDrop"></div>
    </form>
    <br><br>
    <button type="button" onclick="limpar()">Limpar</button>
    </div>
</div>
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
            if ($row['item_usado'] !== ''){
            echo '<div class="">' . '[' . $row['horario'] . ']: <b>' . $row['nome'] . '</b> - ' . $row['evento'] . '<br> [' . $row['horario'] . ']: ' . ' Item Usado: ' . $row['item_usado'] . '<hr>' . '</div>';
            } 
            else{
            echo '<div class="">' . '[' . $row['horario'] . ']: <b>' . $row['nome'] . '</b> - ' . $row['evento'] . '<br>' . '<hr>' . '</div>';
            }
        }
    }
    ?>
</div>

<script src="../scripts/mecanismo_ganolia.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</body>
</html>