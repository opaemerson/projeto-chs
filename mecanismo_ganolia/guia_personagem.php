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


<!-- PARTE DO HTML -->
<!-- PRIMEIRO FORMULARIO DE CRIAÇÃO -->
<?php
$idUsuario = $_SESSION['id'];
if (isset($_SESSION['nome'])) {
?>
    <form action="personagem_criar.php" class="m-3" method="POST">
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
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
<?php
?>
<?php
} else {
    echo "Erro ao acessar a página";
}
?>

<!-- SEGUNDO FORMULARIO DE SELEÇÃO -->
    <form action="personagem_selecionar.php" class="m-3" method="POST">
        <?php
            echo '<label>' . '<h3>' . $_SESSION['nome'] . ', Selecione seu Personagem' . '</h3>' . '</label>';
        ?>
        <div class="mb-3">
                <?php
                    $sqlName = "SELECT gp.id as id_personagem, 
                    gp.nome, 
                    (select x.nome from ganolia_personagem x where x.id = u.personagem_ganolia) as personagem_atual
                    FROM ganolia_personagem gp
                    INNER JOIN usuarios u
                    ON u.id = gp.usuario_id
                    WHERE usuario_id = $idUsuario";

                    $resultadoName = $conn->query($sqlName);

                    $pegaPersonagem = $resultadoName->fetch_assoc();
                    $personagemAtual = $pegaPersonagem['personagem_atual'];
                 echo '<label  class="form-label">' . $_SESSION['nome'] . ', seu personagem atual é: <b>' .  $personagemAtual . '</b> </label>';
                ?>

            <select class="form-select" id="selectPersonagem" name="selectPersonagem" aria-label="Default select example">
                <?php
                    $sql = "SELECT gp.id as id_personagem, 
                    gp.nome
                    FROM ganolia_personagem gp
                    INNER JOIN usuarios u
                    ON u.id = gp.usuario_id
                    WHERE usuario_id = $idUsuario";

                    $resultado = $conn->query($sql);
                    if ($resultado) {
                    while ($row = $resultado->fetch_assoc()) {
                        $idPersonagem = $row["id_personagem"];
                        $nome = $row["nome"];
                        echo "<option value='$idPersonagem'>$nome</option>";
                    }
                    } else {
                    echo "Erro na consulta: " . $conn->error;
                    }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>




<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</body>
</html>
