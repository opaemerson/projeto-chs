<?php
header('Access-Control-Allow-Origin: *');
require_once('config.php');

if (isset($_POST['cadastro'])) {
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $permissao = 'Usuario';
    $usuarioExiste = "SELECT nome FROM usuarios WHERE nome = '$nome'";
    $resultadoExistente = $conn->query($usuarioExiste);
    if ($resultadoExistente->num_rows > 0){
        echo "Ja existe esse mano.";
    }else{
        $sql = "INSERT INTO usuarios (nome, senha, permissao) VALUES ('$nome', '$senha', '$permissao')";
        if ($conn->query($sql) === TRUE) {
            header('Location: inicial.php'); 
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
    <link rel="stylesheet" href="css/login.css">
    <title>Document</title>
</head>
<body>

    <form method="POST" action="cadastrar.php" class="card">
    <div class="card">
    <a class="login">Cadastrar</a>
        <label for="nome" class="inputBox">
            Nome de Usuario:
            <input type="text" id="nome" name="nome" required>
            <span>Nome de Usuario</span>
        </label>
        <br>
        <label for="senha_cadastro" class="inputBox">
            Senha:
            <input type="password" id="senha_cadastro" name="senha" required>
            <span>Senha</span>
        </label>
        <br>
        <button type="submit" name="cadastro" class="enter">Cadastrar</button>
        <a href="inicial.php">Voltar</a>
</div>
    </form>

</body>
</html>