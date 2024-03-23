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
    <link rel="stylesheet" href="../css/ganolia_boardgame/guia_personagem.css">
    <title>Guia Personagem</title>
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
    <a href="page_criar_personagem.php">CRIAR PERSONAGEM</a>
    <a href="page_select_personagem.php">SELECIONAR PERSONAGEM</a>
    <a href="index.php" style="background-color: #dc143c;">VOLTAR</a> <!-- Botão Vermelho -->
</body>
</html>
