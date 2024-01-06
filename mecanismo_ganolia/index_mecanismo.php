<?php
include('../protecao.php');
require_once('../config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/ganolia/index_mecanismo.css">
    <title>Ganolia</title>
</head>
<body>
    
</body>
</html>

<a href="guia_jogo.php" jogar>JOGAR</a>
<br>
<a href="guia_personagem.php">PERSONAGEM</a>
<br>
<a href="guia_biblioteca.php">BIBLIOTECA</a>
<br>
<a href="guia_criatura.php">CRIATURAS</a>
<br>
<a href="guia_item.php">ITENS</a>
<br>
<a href="guia_manual.php">MANUAL</a>

<?php if (isset($_SESSION['permissao']) && $_SESSION['permissao'] == 'Admin') { ?>
    <br>
    <a href="adm_index.php" style="background-color: #212120;">ADMINISTRAÇÃO</a>
<?php } ?>

<br>
<a href="../index.php" style="background-color: #dc143c;">SAIR</a>
