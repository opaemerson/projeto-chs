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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_SESSION['id'];
    $nome = $_POST['nome'];
    $classe = $_POST['classe'];

    if (empty($nome) || empty($classe)) {
        echo "<script>alert('Todos os campos precisam ser preenchidos');</script>";
    } else {
    
        $nomeExistente = "SELECT gp.nome FROM ganolia_personagem gp WHERE nome = '$nome'";
        $resultado = $conn->query($nomeExistente);
    
        if ($resultado->num_rows > 0 || $resultado == FALSE){
            echo "<script>alert('Nome já existe / Falha na busca');</script>";
        } else {
            $insert = "INSERT INTO ganolia_personagem (nome, classe, sessao, usuario_id) 
            VALUES ('$nome', '$classe', '', '$usuario')";

            //tratativa caso der b.o na insercao
            echo ($conn->query($insert) === TRUE) ? "<script>alert('Salvo no banco de dados!');</script>" : "<script>alert('Erro ao inserir no banco de dados!');</script>";
        }
    }
}
?>

<!-- PARTE DO HTML -->
<!-- PRIMEIRO FORMULARIO DE CRIAÇÃO -->
<?php
if (isset($_SESSION['nome'])) {
?>
    <form action="" class="m-3" method="POST">
        <?php
            echo '<label>' . '<h3>' . $_SESSION['nome'] . ', Crie seu personagem!' . '</h3>' . '</label>';
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


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</body>
</html>
