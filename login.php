<?php
header('Access-Control-Allow-Origin: *');
require_once('config.php');

class Login
{
    private $conn;

    public function __construct()
    {
        $this->db = new Config();
        $this->conn = $this->db->conn;
    }

    public function limparEntrada($entrada) {
        return $this->conn->real_escape_string(strip_tags(trim($entrada)));
    }
    
    public function init()
    {
      if (isset($_POST['login'])) {
          $email = $this->limparEntrada($_POST['email']);
          $senha = $this->limparEntrada($_POST['senha']);
    
          $stmt = $this->conn->prepare("SELECT u.id,
              u.nome,
              u.permissao,
              u.personagem_ganolia,
              gp.classe as personagem_classe
              FROM usuarios u 
              LEFT JOIN ganolia_personagem gp
              ON gp.id = u.personagem_ganolia
              WHERE email = ? AND senha = ?");
    
          if ($stmt) {
              $stmt->bind_param("ss", $email, $senha);
              $stmt->execute();
              $resultado = $stmt->get_result();
    
              if ($resultado->num_rows == 1) {
                  $row = $resultado->fetch_assoc();
    
                  session_start();
    
                  $_SESSION['id'] = $row['id'];
                  $_SESSION['nome'] = $row['nome'];
                  $_SESSION['permissao'] = $row['permissao'];
                  $_SESSION['personagem_ganolia'] = $row['personagem_ganolia'];
                  $_SESSION['personagem_classe'] = $row['personagem_classe'];
    
                  header('Location: index.php');
                  exit;
              } else {
                  echo 'Credenciais inválidas. Por favor, tente novamente.';
              }
          } else {
              echo 'Erro ao preparar a declaração SQL: ' . $this->conn->error;
          }
      }
    }
}

$login = new Login();
$login->init();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/chs/login.css">
    <link rel="stylesheet" href="css/chs/erro.css">
    <title>Login e Cadastro</title>
</head>
<body>
<div class="container">
  <form method="POST" action="login.php">
    <div class="card">
      <a>Projeto Login</a>
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
