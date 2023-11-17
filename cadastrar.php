<?php
header('Access-Control-Allow-Origin: *');
require_once('config.php');

if (isset($_POST['cadastro'])) {
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $referencia_select = $_POST['referencia_select'];
    $permissao = 'Usuario';

    if($referencia_select == ''){
        echo "Por favor,  selecione uma opcao de referencia.";
    }

    if (!strpos($nome, '@')) {
        echo "O campo de e-mail deve conter o caractere '@'.";
    } else {
    $stmt = $conn->prepare("SELECT nome FROM usuarios WHERE nome = ?");
    $stmt->bind_param("s", $nome);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Este usuário já existe.";
    } else{
        $sql = "INSERT INTO usuarios (nome, senha, permissao, referencia) VALUES ('$nome', '$senha', '$permissao', '$referencia_select')";
        if ($conn->query($sql) === TRUE) {
            echo "cadastrado";
            header('Location: index.php'); 
            exit;
        } else {
            echo "erro de conexao";
        }
    }

    $stmt->close();
    $conn->close();
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
            E-mail:
            <input type="text" id="nome" name="nome" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}">
            <span>E-mail</span>
        </label>
        <br>
        <label for="senha_cadastro" class="inputBox">
            Senha:
            <input type="password" id="senha_cadastro" name="senha" required>
            <span>Senha</span>
        </label>
        <br>
        <label for="referencia" class="inputBox">
            Me conhece da onde?
            <select name="referencia_select" id="referencia_select" required>
                <option value=''>Selecione uma opcao</option>"
                <option value="Amigo">Amigo</option>
                <option value="Linkedin">Linkedin</option>
            </select>
        </label>
        <br>
        <button type="submit" name="cadastro" class="enter">Cadastrar</button>
        <a href="index.php">Voltar</a>
</div>
</form>

</body>
</html>