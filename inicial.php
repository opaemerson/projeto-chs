<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Projeto C.E.E</title>
      <!-- Inclua a biblioteca Bootstrap (CSS e JS) aqui -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <?php
    session_start();
    ?>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Empresa XYZ</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#projeto-cee">Projeto C.E.E</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#projeto-geekzero">Projeto Geekzero</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#projeto-dintask">Projeto Dintask</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#projeto-ganolia">Projeto Ganolia</a>
                </li>
            </ul>
            <?php
                if (isset($_SESSION['nome'])) {
                    echo '<ul class="navbar-nav ml-auto">';
                    echo '<li class="nav-item">';
                    echo '<p class="text-light">Bem-Vindo, ' . $_SESSION['nome'] . '</p>';
                    echo '</li>';
                    echo '<li class="nav-item">';
                    echo '<a class="nav-link" href="sair.php">Sair</a>';
                    echo '</li>';
                    echo '</ul>';
                }
            ?>
        </div>
    </div>
</nav>

<div class="container mt-5" id="projeto-cee">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">Projeto C.E.E</h1>
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
                    <p class="card-text"><b>Objetivo:</b> Notas sobre SÉRIES | FILMES | JOGOS VIRTUAIS | BOARDGAMES</p>
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
                    <p class="card-text"><b>Objetivo:</b> Boardgame único e híbrido</p>
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
                window.location.href = 'index.php';
            }
        }
    </script>
    
</body>
</html>
