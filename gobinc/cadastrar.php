<?php
header('Access-Control-Allow-Origin: *');
require_once('../config.php');

if (isset($_POST['cadastro'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $referencia_select = $_POST['referencia_select'];
    $permissao = 'Usuario';

    try {
        if ($referencia_select == '') {
            echo "Por favor, selecione uma opção de referência.";
            throw new Exception();
        }
    
        if (strlen($senha) != 3) {
            echo "<script>alert('O campo senha deve ter apenas 3 dígitos.');</script>";
            throw new Exception(); 
        }
    
        if (!strpos($email, '@')) {
            echo "<script>alert('O campo de e-mail deve conter o caractere @.');</script>";
            throw new Exception();
        } else {
            $stmt = $conn->prepare("SELECT email FROM usuarios WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();
    
            if ($stmt->num_rows > 0) {
                echo "<script>alert('Esse usuário já existe');</script>";
                throw new Exception();
            } else {
                $sql = "INSERT INTO usuarios (nome, email, senha, permissao, referencia, personagem_ganolia) VALUES ('$nome','$email', '$senha', '$permissao', '$referencia_select', 1)";
                if ($conn->query($sql) === TRUE) {
                    header('Location: ../gobinc/obrigado_cadastro.php');
                    exit;
                } else {
                    echo "<script>alert('Erro de conexao ao Banco de Dados, tente novamente mais tarde.');</script>";
                    throw new Exception();
                }
            }
    
            $stmt->close();
            $conn->close();
        }
    } catch (Exception $e) {
        header("Refresh:0");
        exit;
    }
    

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/chs/login.css">
    <style>
                input, select {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            background-color: #eee;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            color: #333;
        }
    </style>
    <title>Cadastro</title>
</head>
<body>

<form method="POST" action="cadastrar.php" class="card">
    <div class="card">
    <a>Projeto Login</a>
    <a class="login">Cadastrar</a>
        <label for="nome" class="inputBox">
            Nome:
            <input type="text" id="nome" name="nome" required>
            <span>Nome</span>
        </label>
        <label for="email" class="inputBox">
            E-mail:
            <input type="text" id="email" name="email" required>
            <span>E-mail</span>
        </label>
        <label for="senha_cadastro" class="inputBox">
            Senha [3 digitos]:
            <input type="password" id="senha_cadastro" name="senha" required>
            <span>Senha</span>
        </label>
        <br>
        <label for="referencia" class="inputBox">
            Me conhece da onde?
            <select id="referencia_select" name="referencia_select" required>
                <option value="">Selecione uma opção</option>
                <option value="Amigo">Amigo</option>
                <option value="Linkedin">Linkedin</option>
            </select>
        </label>
        <br>
        <button type="submit" name="cadastro" class="enterenter">Enviar</button>
        <a class="enter" href="login.php">Voltar</a>
</div>
</form>

</body>
</html>