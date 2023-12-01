<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/cabecalho.css">
    <title>Projeto</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/template1.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@500&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bungee+Spice&family=Dosis:wght@500&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bungee+Spice&family=Dosis:wght@500&family=Oswald:wght@300&family=Playfair+Display:wght@500&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php session_start(); ?>

    <header>
        <div class="container">
        <div class="logo"><h3 style="color: #00ff00;">GOBLINS</h3></div>
            <div class="menu">
                <nav>
                    <a href="index.php">PROJETOS</a>
                    <a href="contato.php">CONTATO</a>
                    <a href="login.php">ENTRAR</a>
                    <?php
                    if (isset($_SESSION['nome'])) {
                    echo '<a href="sair.php">SAIR</a>';
                    }
                    ?>
                </nav>
            </div>

            <div class="social">
                    <?php
                    echo '<p style="color: #00ff00;">Bem-Vindo, ' . $_SESSION['nome'] . ' | Permissao: ' . $_SESSION['permissao'] . 
                    ' | ID: ' . $_SESSION['id'] . '</p>';
                    ?>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 40vh;">
            <div class="col-md-4 text-center">
                <h1>Contato</h1>
                <hr>
                <p>Entre em contato via telepatia</p>
                <hr>
                <p>Telefone: 174716</p>
            </div>
        </div>
    </div>

    <script>
        var usuarioLogado = <?php echo isset($_SESSION['nome']) ? 'true' : 'false'; ?>;
        var permissaoUsuario = <?php echo isset($_SESSION['permissao']) ? 'true' : 'false'; ?>;
    </script>
    <script src="./scripts/verificacoes.js"></script>
</body>
</html>
