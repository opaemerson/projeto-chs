<?php
header('Access-Control-Allow-Origin: *');
require_once('config.php');

// Função para limpar e escapar dados do usuário
function limparEntrada($entrada) {
    global $conn;
    return $conn->real_escape_string(strip_tags(trim($entrada)));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {
        $nome = limparEntrada($_POST['nome']);
        $senha = limparEntrada($_POST['senha']);
        $sql = "SELECT * FROM usuarios WHERE nome = '$nome' AND senha = '$senha'";
        $resultado = $conn->query($sql) or die("Falha na execucao do codigo SQL: " . $conn->error);

        if ($resultado->num_rows == 1) {
            $row = $resultado->fetch_assoc();

            if(!isset($_SESSION)){
                session_start();
            }

            $_SESSION['id'] = $row['id'];
            $_SESSION['nome'] = $row['nome'];

            header('Location: index.php'); 
            exit;
        } else {
            $erro_login = 'Credenciais inválidas. Por favor, tente novamente.';
        }
    } else {
        $erro_cadastro = 'Erro ao cadastrar o usuário: ' . $mysqli->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login e Cadastro</title>
</head>
<body>
    <h2>Login</h2>
    <form method="POST" action="login.php">
        <label for="nome">Nome de Usuario:</label>
        <input type="text" id="nome" name="nome" required>
        <br>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
        <br>
        <button type="submit" name="login">Entrar</button>
    </form>

    <a href="cadastrar.php">Cadastrar</a>
    <a href="inicial.php">Voltar</a>
</body>
</html>
