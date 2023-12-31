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
    <title>Criar Personagem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

</head>
<body>

<?php
$idUsuario = $_SESSION['id'];
if (isset($_SESSION['nome'])) {
?>
    <form action="processar_criar_personagem.php" class="m-3" method="POST">
        <?php
            echo '<label>' . '<h3>' . 'Criar personagem' . '</h3>' . '</label>';
        ?>
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome">
        </div>
        <div class="mb-3">
            <label  class="form-label">Classe</label>
            <select class="form-select" id="classe" name="classe">
                <option value="Guerreiro">Guerreiro</option>
                <option value="Mago">Mago</option>
            </select>
        </div>
        <button type="submit" class="btn btn-dark">Enviar</button>
    </form>
<?php
?>
<?php
} else {
    echo "Erro ao acessar a página";
}
?>

<br>
<a href="guia_personagem.php" class="btn btn-danger">Voltar</a>
</body>