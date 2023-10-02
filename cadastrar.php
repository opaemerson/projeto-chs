<?php
header('Access-Control-Allow-Origin: *');
require_once('config.php');

if (isset($_POST['cadastro'])) {
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $usuarioExiste = "SELECT nome FROM usuarios WHERE nome = '$nome'";
    $resultadoExistente = $conn->query($usuarioExiste);
    if ($resultadoExistente->num_rows > 0){
        echo "Ja existe esse mano.";
    }else{
        $sql = "INSERT INTO usuarios (nome, senha) VALUES ('$nome', '$senha')";
        if ($conn->query($sql) === TRUE) {
            header('Location: index.php'); 
            exit;
            }
        } 
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Cadastro</h2>

    <form method="POST" action="cadastrar.php">
        <label for="nome">Nome de Usuario:</label>
        <input type="text" id="nome" name="nome" required>
        <br>
        <label for="senha_cadastro">Senha:</label>
        <input type="password" id="senha_cadastro" name="senha" required>
        <br>
        <button type="submit" name="cadastro">Cadastrar</button>
    </form>
    <a href="inicial.php">Voltar</a>
</body>
</html>