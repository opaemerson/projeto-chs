<?php
header('Access-Control-Allow-Origin: *');
require_once('config.php');

function limparEntrada($entrada) {
    global $conn;
    return $conn->real_escape_string(strip_tags(trim($entrada)));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {
        $email = limparEntrada($_POST['email']);
        $senha = limparEntrada($_POST['senha']);

        // para evitar SQL Injection
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ? AND senha = ?");
        $stmt->bind_param("ss", $email, $senha);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows == 1) {
            $row = $resultado->fetch_assoc();

            session_start();

            $_SESSION['id'] = $row['id'];
            $_SESSION['nome'] = $row['nome'];
            $_SESSION['permissao'] = $row['permissao'];

            header('Location: index.php');
            exit;
        } else {
            $erro_login = 'Credenciais inválidas. Por favor, tente novamente.';
        }
    } else {
        $erro_cadastro = 'Erro ao cadastrar o usuário: ' . $conn->error;
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
    <link rel="stylesheet" href="css/erro.css">
    <title>Login e Cadastro</title>
    <style>
  .link-container a {
    display: inline-block;
    margin-right: 10px;
    text-align: center;
    line-height: 50px;
  }
</style>
</head>
<body>
<div class="container">
  <form method="POST" action="login.php">
    <div class="card">
      <a class="login">Entrar</a>
      <div class="inputBox">
        <input type="text" required="required" id="email" name="email">
        <span class="user">E-mail</span>
      </div>

      <div class="inputBox">
        <input type="password" required="required" id="senha" name="senha">
        <span>Senha</span>
      </div>

      <button type="submit" class="enterenter" name="login">Enter</button>
      <div class="link-container">
      <a class="enter" href="cadastrar.php">Cadastrar</a>
      <a class="enter" href="index.php">Voltar</a>
      </div>
    </div>
  </form>
</div>
</body>
</html>
