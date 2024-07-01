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
<style>
    body {
            background-color: #f0dbb5; /* Amarelo */
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            text-align: center;
        }

        h3 {
            color: #000080; /* Azul escuro */
        }

        .custom-form {
            max-width: 400px;
            width: 100%;
        }

        .btn-dark {
            background-color: #4169e1; /* Azul royal */
            color: #fff;
        }

        .btn-dark:hover {
            background-color: #000080; /* Azul escuro */
        }

        .btn-danger {
            background-color: #dc143c; /* Vermelho escuro */
            color: #fff;
        }

        .btn-danger:hover {
            background-color: #8b0000; /* Vermelho mais escuro */
        }
</style>
</head>
<body>
<?php
$idUsuario = $_SESSION['id'];
if (isset($_SESSION['nome'])) {
?>


<!-- SEGUNDO FORMULARIO DE SELEÇÃO -->
<form action="processar_select_personagem.php" class="m-3" method="POST">
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
                    $personagemAtual = empty($pegaPersonagem['personagem_atual']) ? 'Nenhum' : $pegaPersonagem['personagem_atual'];
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
                        echo "<option value=''>Selecione um personagem </option>";
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
        <button type="submit" class="btn btn-dark">Enviar</button>
        <br><br>
        <a href="guia_personagem.php" class="btn btn-danger">Voltar</a>
    </form>

    <?php
} else {
    echo "Erro ao acessar a página";
}
?>


</body>