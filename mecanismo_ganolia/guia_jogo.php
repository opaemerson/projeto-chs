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
    <link rel="stylesheet" href="../css/ganolia/ganolia.css">
    <link rel="stylesheet" href="../css/ganolia/tabuleiro.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>Ganolia</title>
</head>
<body>
<div class="centralizando">
    <button class="button" id="jogarButton" onclick="mostrarJogar()">Jogar</button>
    <button class="button" id="ataqueButton" onclick="mostrarAtaque()">Ataque</button>
    <button class="button" id="defesaButton" onclick="mostrarDefesa()">Defesa</button>
    <button class="button" id="recolherButton" onclick="mostrarRecolher()">Recolher</button>
    <button class="button" onclick="limpar()">Limpar</button>
    <button class="button" sair onclick="sair()">Sair</button>
</div>
<div class="linha-fina"></div>


<div class="sessao">
    <div class="quadro">

    <?php
    $verificaVez = "SELECT *
    FROM ganolia_sessao gs
    WHERE gs.personagem_id = $personagemId
    AND gs.vez = 'A'";

    $conexao = $conn->query($verificaVez);

    if ($conexao === FALSE) {
        echo "<script>alert('Erro ao buscar VEZ no banco de dados!');</script>";
    } 

    if($conexao->num_rows == 0){
        echo '<h2>NÃO É SUA VEZ</h2>';
    }
    else {
        ?>
        <h2>É SUA VEZ</h2>
        <div id="jogar" style="display: none;">
            <button>manipular</button>
        </div>
        <?php
    }
    ?>

    <div id="ataque" style="display: none;">
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
    <div class="row">
        <div class="col-md-3">
            <div class="card mt-3" id="mt1" style="border: none;">
                <img id="imagemCriatura1" src="" class="img-enviado card-img-top" width="80" height="150" style="display: none;">
                <div class="card-body">
                    <div id="nomeDrop1" style="display: none;"></div>
                    <div id="nomeRaridade1" style="display: none;"></div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mt-3" id="mt2" style="border: none;">
                <img id="imagemCriatura2" src="" class="img-enviado card-img-top" width="80" height="150" style="display: none;">
                <div class="card-body">
                    <div id="nomeDrop2" style="display: none;"></div>
                    <div id="nomeRaridade2" style="display: none;"></div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mt-3" id="mt3" style="border: none;">
                <img id="imagemCriatura3" src="" class="img-enviado card-img-top" width="80" height="150" style="display: none;">
                <div class="card-body">
                    <div id="nomeDrop3" style="display: none;"></div>
                    <div id="nomeRaridade3" style="display: none;"></div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mt-3" id="mt4" style="border: none;">
                <img id="imagemCriatura4" src="" class="img-enviado card-img-top" width="80" height="150" style="display: none;">
                <div class="card-body">
                    <div id="nomeDrop4" style="display: none;"></div>
                    <div id="nomeRaridade4" style="display: none;"></div>
                </div>
            </div>
        </div>
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
</div>


<!--DIV do tabuleiro -->
<div class="corpo">
<div class="grid-container" id="grid-container"></div> 
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


<div class="mochila" id="mochila">
    <button onclick="openModalMochila()">
        <img class="iconMochila" src='../Images/Ganolia/Icons/mochila.jpg'>
    </button>
</div>

<!-- Modal da Mochila -->
<div class="modal" id="modalMochila">
    <div class="modal-content">
        <span class="close" onclick="closeModalMochila()">&times;</span>

        <?php
        $buscaItem = "SELECT gp.mochila as mochila
            FROM ganolia_personagem gp
            INNER JOIN usuarios u ON u.personagem_ganolia = gp.id
            WHERE u.id = $usuarioId";

        $buscaQuery = $conn->query($buscaItem);

        if ($buscaQuery === FALSE) {
            echo "<script>alert('Erro ao buscar dados');</script>";
            echo "<script>window.location.href = 'index_mecanismo.php';</script>";
        } else {
            $linha = $buscaQuery->fetch_assoc();
            $arrayItens = explode(';', $linha['mochila']);
            echo "<div class='flex-container'>";
            foreach ($arrayItens as $key) {
                $encontraImagem = "SELECT gi.imagem as imagem
                FROM ganolia_item gi
                WHERE gi.id = $key";

                $cnBanco = $conn->query($encontraImagem);

                if ($cnBanco === FALSE) {
                    echo "<script>alert('Erro ao buscar dados');</script>";
                    echo "<script>window.location.href = 'index_mecanismo.php';</script>";
                } else {
                    $img = $cnBanco->fetch_assoc();
                    $linhaImg = $img['imagem'];

                    if (!empty($linhaImg)) {
                        echo "<div class='image-container'><img class='resized-image' src='$linhaImg'></div>";
                    } else {
                        echo "<div class='image-container'><span class='not-found'>Imagem não encontrada</span></div>";
                    }
                }
            }
        }
        echo "</div>";
        ?>
    </div>
</div>


<script src="./scripts/mecanismo_ganolia.js"></script>
<script src="./scripts/tabuleiro.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>