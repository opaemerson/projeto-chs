<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Projeto C.E.E</title>
</head>
<body>
    <?php
    session_start();
    ?>

    <h1>Projeto C.E.E</h1>
    <p><b>Objetivo:</b> fazer fkjsadogfh hgiuf fgjhdiu hfireu kpf.</p>

    <?php
        if (isset($_SESSION['nome'])) {
            echo '<h2>Bem-Vindo(a), ' . $_SESSION['nome'] . '</h2>';
        }
    ?>

    <script>
        var usuarioLogado = <?php echo isset($_SESSION['nome']) ? 'true' : 'false'; ?>;

        function verificarLogin() {
            if (!usuarioLogado) {
                window.location.href = 'login.php';
            } else {
                window.location.href = 'index.php';
            }
        }
    </script>

    <button type="button" onclick="verificarLogin()">Acessar</button>
    
    <?php
        if (isset($_SESSION['nome'])) {
            echo '<a href="sair.php" class="botao-sair">Sair</a>';
        }
    ?>
    
</body>
</html>
