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

    <div class="w3-bar w3-black w3-card">
        <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right" href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
        <a href="index.php" class="w3-bar-item w3-button w3-padding-large custom-square" style="text-decoration: none;">PROJETOS</a>
        <a href="contato.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small custom-square" style="text-decoration: none;">CONTATO</a>
        <a href="login.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small custom-square" id="loginLi" style="text-decoration: none;">ENTRAR</a>
        <?php if (isset($_SESSION['nome'])) { ?>
            <div class="w3-bar-item w3-padding-large w3-hide-small w3-text-yellow" style="text-decoration: none;">
                Bem-Vindo, <?php echo $_SESSION['nome']; ?> | Permissao: <?php echo $_SESSION['permissao']; ?> | ID: <?php echo $_SESSION['id']; ?>
            </div>
            <a href="sair.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small w3-hover-red custom-square" style="text-decoration: none;">SAIR</a>
        <?php } ?>
    </div>

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
