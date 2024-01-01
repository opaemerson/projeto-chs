<?php
include('../protecao.php');
require_once('../config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganolia</title>
    <style>
        body {
            background-color: #f0dbb5; 
            text-align: center;
            padding: 20px;
        }

        h2 {
            color: #000080; /* Azul escuro */
        }

        a {
            display: block;
            margin: 2px auto;
            padding: 7px;
            background-color: #4169e1; /* Azul royal */
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 24px;
            width: 250px;
            text-align: center;
            border: 2px solid #000;
        }

        a[jogar] {
            color: black;
            background-color: #91bf2c;
            border: 2px solid #000;
            font-weight: bold;
        }

        a[jogar]:hover {
            background-color: #6a8c20;
        }

        a:hover {
            background-color: #000080; /* Azul escuro */
        }
    </style>
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
<a href="../index.php" style="background-color: #dc143c;">SAIR</a> <!-- Botão Vermelho -->
