<?php
include('../protecao.php');
require_once('../config.php');
header('Access-Control-Allow-Origin: *');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guia Personagem</title>
    <style>
        body {
            background-color: #f0dbb5; /* Amarelo */
            text-align: center;
            padding: 20px;
        }

        h2 {
            color: #000080; /* Azul escuro */
        }

        a {
            display: block;
            margin: 10px 0;
            padding: 10px;
            background-color: #4169e1; /* Azul royal */
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        a:hover {
            background-color: #000080; /* Azul escuro */
        }
        
    </style>
</head>
<body>
<?php
$idUsuario = $_SESSION['id'];
if (isset($_SESSION['nome'])) {
    $sqlName = "SELECT gp.id as id_personagem, 
    gp.nome, 
    (select x.nome from ganolia_personagem x where x.id = u.personagem_ganolia) as personagem_atual
    FROM ganolia_personagem gp
    INNER JOIN usuarios u
    ON u.id = gp.usuario_id
    WHERE usuario_id = $idUsuario";

    $resultadoName = $conn->query($sqlName);

    $pegaPersonagem = $resultadoName->fetch_assoc();
    $personagemAtual = empty($pegaPersonagem['personagem_atual']) ? 'Nenhum' : $pegaPersonagem['personagem_atual'];
    echo '<label class="form-label"><h2>' . 'Seu personagem atual é: <b>' .  $personagemAtual . '</b></h2></label>';
}
?>
    <a href="page_criar_personagem.php">Criar Personagem</a>
    <a href="page_select_personagem.php">Selecionar Personagem</a>
    <a href="index_mecanismo.php" style="background-color: #dc143c;">Voltar</a> <!-- Botão Vermelho -->
</body>
</html>
