<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/chs/styles.css">
    <link rel="stylesheet" href="css/chs/cabecalho.css">   
    <link rel="stylesheet" href="css/chs/template1.css">
    <title>Projeto</title>
</head>

<body>
<?php
    session_start();
    ?>
    <header>
        <div class="container">
        <div class="logo"><h3 style="color: #00ff00;">Projeto CHS</h3></div>
            <div class="menu">
                <nav>
                    <?php
                    if (isset($_SESSION['nome'])) {
                    echo '<a href="sair.php" class="botao-sair">SAIR</a>';
                    } else{
                    echo '<a href="login.php">ENTRAR</a>';
                    }
                    ?>
                </nav>
            </div>

            <div class="social">
                    <?php
                    if (isset($_SESSION['nome'])) {
                    echo '<p style="color: #00ff00;">' . $_SESSION['nome'] . ' | Permissao: ' . $_SESSION['permissao'] . 
                    ' | ID: ' . $_SESSION['id'] . '</p>';
                    }
                    ?>
            </div>
        </div>
    </header>
<br><br>
<div class="centro">
    <p><b>Projeto:</b> Control Handling Sytem - CHS</p>
    <button type="button" class="botao-carousel" onclick="verificarLogin('chs')">Acessar</button>
</div>

<script>
        var usuarioLogado = <?php echo isset($_SESSION['nome']) ? 'true' : 'false'; ?>;
        var permissaoUsuario = <?php echo isset($_SESSION['permissao']) ? 'true' : 'false'; ?>;
</script>
<script src="js/verificacoes.js"></script>
</body>
</html>
