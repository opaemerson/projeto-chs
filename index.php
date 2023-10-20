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
    <style>
    body {font-family: "Lato", sans-serif}
    .mySlides {display: none}
    </style>
</head>
<body>
    <?php
    session_start();
    ?>

<div class="w3-bar w3-black w3-card">
  <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right" href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
  <a href="index.php" class="w3-bar-item w3-button w3-padding-large custom-square" style="text-decoration: none;">HOME </a>
  <a href="index.php" class="w3-bar-item w3-button w3-padding-large custom-square" style="text-decoration: none;">PROJETOS</a>
  <a href="#band" class="w3-bar-item w3-button w3-padding-large w3-hide-small custom-square" style="text-decoration: none;">CONTATO</a>
  <a href="login.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small custom-square" id="loginLi" style="text-decoration: none;">ENTRAR</a>
  <?php
if (isset($_SESSION['nome'])) {
    echo '<div class="w3-bar-item  w3-padding-large w3-hide-small w3-text-yellow"  style="text-decoration: none;">';
    echo 'Bem-Vindo, ' . $_SESSION['nome'] . ' | Permissao: ' . $_SESSION['permissao'] . ' | ID: ' . $_SESSION['id'];
    echo '</div>';
    echo '<a href="sair.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small w3-hover-red custom-square" style="text-decoration: none;">SAIR</a>';
}
?>
</div>

<!-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">GOBLINS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#projeto-cee">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#projeto-geekzero">Projetos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#projeto-dintask">Contato</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php" id="loginLi">Entrar</a>
                </li>
            </ul>
            <?php
            if (isset($_SESSION['nome'])) {
                echo '<ul class="navbar-nav ml-auto">';
                echo '<li class="nav-item">';
                echo '<p class="text-light">Bem-Vindo, ' . $_SESSION['nome'] . ' | Permissao: ' . $_SESSION['permissao'] . ' | ID: ' . $_SESSION['id'] . '</p>';
                echo '</li>';
                echo '<li class="nav-item">';
                echo '<a class="nav-link" href="sair.php">Sair</a>';
                echo '</li>';
                echo '</ul>';
            }
            ?>
        </div>
    </div>
</nav> -->

<div class="container mt-5" id="projeto-cee">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">Projeto CHS</h1>
                    <p class="card-text"><b>Objetivo:</b> Controle de Envio de Equipamentos.</p>
                    <button type="button" onclick="verificarLogin()">Acessar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5" id="projeto-geekzero">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">Projeto Geekzero</h1>
                    <p class="card-text"><b>Objetivo:</b> Notas sobre SERIES | FILMES | JOGOS VIRTUAIS | BOARDGAMES</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5" id="projeto-dintask">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">Projeto Dintask</h1>
                    <p class="card-text"><b>Objetivo:</b> Controle sobre qualquer tipo de tarefa</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5" id="projeto-ganolia">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">Projeto Ganolia</h1>
                    <p class="card-text"><b>Objetivo:</b> Boardgame unico e hibrido</p>
                </div>
            </div>
        </div>
    </div>
</div>

    <script>
        var usuarioLogado = <?php echo isset($_SESSION['nome']) ? 'true' : 'false'; ?>;

        function verificarLogin() {
            if (!usuarioLogado) {
                window.location.href = 'login.php';
            } else {
                window.location.href = 'projeto_chs/index_chs.php';
            }
        }

        if (usuarioLogado) {
        document.getElementById('loginLi').style.display = 'none';
        }
    </script>
    
</body>
</html>
