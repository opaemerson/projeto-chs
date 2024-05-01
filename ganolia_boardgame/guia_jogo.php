<?php
include('../protecao.php');
require_once('../config.php');
require_once('repository/log.php');

$usuarioId = $_SESSION['id'];
$personagemId = $_SESSION['personagem_ganolia'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/ganolia_boardgame/guia_jogo.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="./scripts/ganolia_boardgame.js"></script>
    <script src="./scripts/guia_jogo.js"></script>
    <title>Ganolia</title>
</head>

<body>

    <!-- DIV de LOG -->
    <div class="scrolling-container" id="scrollingContainer">
    <?php
        $log = (new Log())->buscaLog($conn);

        if ($log === false || empty($log)){
            echo "Erro ao buscar Log";
        }

        foreach ($log as $row) {
            $hora = date('H:i:s', strtotime($row['horario']));
            if ($row['item_usado'] !== '') {
                echo '<div class="">' . '[' . $hora . ']: <b>' . $row['nome'] . '</b> - ' . $row['evento'] . '<br> [' . $hora . ']: ' . ' Item Usado: ' . $row['item_usado'] . '<hr>' . '</div>';
            } else {
                echo '<div class="">' . $row['nome'] . '</b> - ' . $row['evento'] . '<br>' . '<hr>' . '</div>';
            }
        }
        
    ?>
    </div>
</body>

</html>