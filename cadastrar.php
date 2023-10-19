<?php
header('Access-Control-Allow-Origin: *');
require_once('config.php');

$modalMessage = ''; // Variável para armazenar a mensagem do modal

if (isset($_POST['cadastro'])) {
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $permissao = 'Usuario';
    $usuarioExiste = "SELECT nome FROM usuarios WHERE nome = '$nome'";
    $resultadoExistente = $conn->query($usuarioExiste);
    if ($resultadoExistente->num_rows > 0) {
        $modalMessage = "Ja existe esse mano.";
    } else {
        $sql = "INSERT INTO usuarios (nome, senha, permissao) VALUES ('$nome', '$senha', '$permissao')";
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
    <link rel="stylesheet" href="css/login.css">
    <title>Document</title>
    <style>
.modal {
            display: <?php echo ($modalMessage !== '') ? 'block' : 'none'; ?>;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fff;
            width: 60%; /* Largura do modal */
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        /* Estilos para o botão de fechar o modal */
        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            color: red; /* Cor do botão de fechar */
            font-size: 24px; /* Tamanho do botão de fechar */
        }
    </style>
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

    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal()">&times;</span>
            <p><?php echo $modalMessage; ?></p>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById("myModal").style.display = "block";
        }

        function closeModal() {
            document.getElementById("myModal").style.display = "none";
        }

        <?php
            if ($modalMessage !== '') {
                echo "openModal();";
            }
        ?>
    </script>
</body>
</html>
